@extends('layouts.app')
@section('title', 'My Portal — ITEA EduAbroad')
@section('nav_logo', 'assets/logo.png')

@section('content')
<section style="background:var(--ink-deep); color:#fff; padding:48px 0;">
    <div class="wrap" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px;">
        <div>
            <div class="eyebrow" style="color:rgba(255,255,255,0.4); margin-bottom:6px;">Applicant Portal</div>
            <h1 style="font-family:'Instrument Serif',serif; font-size:clamp(24px,3vw,36px); font-weight:400; margin:0;">
                Welcome back, <em style="color:var(--accent);">{{ Auth::user()->name }}.</em>
            </h1>
        </div>
        <div style="display:flex; gap:10px; align-items:center;">
            <a href="{{ route('portal.profile') }}" style="background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.15); color:rgba(255,255,255,0.7); padding:8px 18px; font-family:'JetBrains Mono',monospace; font-size:11px; letter-spacing:0.08em; text-decoration:none;">Edit Profile</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" style="background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.15); color:rgba(255,255,255,0.7); padding:8px 18px; font-family:'JetBrains Mono',monospace; font-size:11px; letter-spacing:0.08em; cursor:pointer;">Log out</button>
            </form>
        </div>
    </div>
</section>

<section class="section" style="background:var(--bg);">
    <div class="wrap">

        @if(session('success'))
        <div style="background:#f0fdf4; border:1px solid #86efac; padding:12px 16px; margin-bottom:24px; font-size:13px; color:#166534;">{{ session('success') }}</div>
        @endif

        {{-- Status cards --}}
        @php $app = Auth::user()->latestApplication; @endphp
        <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:2px; margin-bottom:32px;">
            <div class="card" style="padding:24px;">
                <div class="eyebrow" style="color:var(--muted); margin-bottom:8px;">Application Status</div>
                @if($app)
                <div style="font-family:'Instrument Serif',serif; font-size:22px; color:{{ $app->statusColor() }}; margin-bottom:6px;">{{ $app->statusLabel() }}</div>
                <div style="font-size:12px; color:var(--muted); margin-bottom:8px;">{{ $app->program_name }}</div>
                <a href="{{ route('portal.application', $app->id) }}" style="font-size:13px; color:var(--accent); text-decoration:none;">View application →</a>
                @else
                <div style="font-family:'Instrument Serif',serif; font-size:22px; color:var(--ink); margin-bottom:6px;">Not started</div>
                <a href="{{ route('portal.apply') }}" style="font-size:13px; color:var(--accent); text-decoration:none;">Start application →</a>
                @endif
            </div>
            <div class="card" style="padding:24px;">
                <div class="eyebrow" style="color:var(--muted); margin-bottom:8px;">Documents</div>
                @if($app)
                <div style="font-family:'Instrument Serif',serif; font-size:28px; color:var(--ink); margin-bottom:6px;">{{ $app->documents->count() }} uploaded</div>
                <a href="{{ route('portal.documents', $app->id) }}" style="font-size:13px; color:var(--accent); text-decoration:none;">Manage documents →</a>
                @else
                <div style="font-family:'Instrument Serif',serif; font-size:28px; color:var(--ink); margin-bottom:6px;">0 uploaded</div>
                <span style="font-size:13px; color:var(--muted);">Start application first</span>
                @endif
            </div>
            <div class="card" style="padding:24px;">
                <div class="eyebrow" style="color:var(--muted); margin-bottom:8px;">Profile</div>
                @php $profileComplete = Auth::user()->phone && Auth::user()->nationality && Auth::user()->education_level; @endphp
                <div style="font-family:'Instrument Serif',serif; font-size:22px; color:var(--ink); margin-bottom:6px;">{{ $profileComplete ? 'Complete' : 'Incomplete' }}</div>
                <a href="{{ route('portal.profile') }}" style="font-size:13px; color:var(--accent); text-decoration:none;">{{ $profileComplete ? 'Update profile →' : 'Complete profile →' }}</a>
            </div>
        </div>

        {{-- Application checklist --}}
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:2px; margin-bottom:32px;">
            <div class="card" style="padding:24px;">
                <div class="eyebrow" style="margin-bottom:16px;">Application checklist</div>
                @php
                $checks = [
                    ['done' => (bool)Auth::user()->phone,                              'label' => 'Complete your profile',       'href' => route('portal.profile')],
                    ['done' => (bool)$app,                                             'label' => 'Fill in application form',    'href' => route('portal.apply')],
                    ['done' => $app && $app->documents->count() > 0,                  'label' => 'Upload passport',             'href' => $app ? route('portal.documents', $app->id) : route('portal.apply')],
                    ['done' => $app && $app->documents->whereIn('document_type',['transcript'])->count() > 0, 'label' => 'Upload academic transcript', 'href' => $app ? route('portal.documents', $app->id) : route('portal.apply')],
                    ['done' => $app && in_array($app->status,['submitted','reviewing','result']), 'label' => 'Submit application', 'href' => $app ? route('portal.application', $app->id) : route('portal.apply')],
                ];
                @endphp
                <div style="display:flex; flex-direction:column; gap:12px;">
                    @foreach($checks as $c)
                    <a href="{{ $c['href'] }}" style="display:flex; align-items:center; gap:12px; font-size:14px; color:{{ $c['done'] ? 'var(--muted)' : 'var(--ink)' }}; text-decoration:none;">
                        <span style="width:20px; height:20px; border-radius:50%; border:1.5px solid {{ $c['done'] ? 'var(--accent)' : 'var(--rule-soft)' }}; background:{{ $c['done'] ? 'var(--accent)' : 'transparent' }}; display:flex; align-items:center; justify-content:center; flex-shrink:0; font-size:10px; color:#fff; flex-shrink:0;">{{ $c['done'] ? '✓' : '' }}</span>
                        <span style="{{ $c['done'] ? 'text-decoration:line-through; opacity:0.5;' : '' }}">{{ $c['label'] }}</span>
                    </a>
                    @endforeach
                </div>
            </div>

            <div class="card" style="padding:24px;">
                <div class="eyebrow" style="margin-bottom:14px;">Account details</div>
                <div style="display:flex; flex-direction:column; gap:8px;">
                    @foreach([['Name', Auth::user()->name],['Email', Auth::user()->email],['Phone', Auth::user()->phone ?: '—'],['Nationality', Auth::user()->nationality ?: '—'],['Education', Auth::user()->education_level ?: '—'],['Member since', Auth::user()->created_at->format('d M Y')]] as [$k,$v])
                    <div style="display:flex; justify-content:space-between; padding-bottom:8px; border-bottom:1px solid var(--rule-soft); font-size:13px;">
                        <span style="color:var(--muted);">{{ $k }}</span>
                        <span style="color:var(--ink); font-weight:500;">{{ $v }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Quick actions --}}
        <div class="eyebrow" style="margin-bottom:16px;">Quick actions</div>
        <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:12px;">
            @php $actions = [
                ['label'=>'Start / Edit Application','href'=>route('portal.apply'),'icon'=>'📝'],
                ['label'=>'Browse Programmes','href'=>route('programmes'),'icon'=>'📚'],
                ['label'=>'Check Scholarships','href'=>route('scholarship'),'icon'=>'🎓'],
                ['label'=>'Register for Fair','href'=>route('virtual-fair').'#register','icon'=>'🎪'],
            ]; @endphp
            @foreach($actions as $a)
            <a href="{{ $a['href'] }}" style="display:flex; flex-direction:column; align-items:center; gap:10px; padding:20px; border:1px solid var(--rule-soft); background:var(--paper); text-decoration:none; color:var(--ink); text-align:center;"
                onmouseover="this.style.borderColor='var(--accent)'" onmouseout="this.style.borderColor='var(--rule-soft)'">
                <span style="font-size:28px;">{{ $a['icon'] }}</span>
                <span style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.08em; text-transform:uppercase; color:var(--muted);">{{ $a['label'] }}</span>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endsection
