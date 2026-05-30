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

        {{-- Summary stats --}}
        @php
        $profileComplete = Auth::user()->phone && Auth::user()->nationality && Auth::user()->education_level;
        $totalDocs = $applications->sum(fn($a) => $a->documents->count());
        @endphp
        <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:2px; margin-bottom:32px;">
            <div class="card" style="padding:24px;">
                <div class="eyebrow" style="color:var(--muted); margin-bottom:8px;">Applications</div>
                <div style="font-family:'Instrument Serif',serif; font-size:36px; color:var(--ink); margin-bottom:6px;">{{ $applications->count() }}</div>
                <a href="{{ route('portal.apply') }}" style="font-size:13px; color:var(--accent); text-decoration:none;">+ Start new application</a>
            </div>
            <div class="card" style="padding:24px;">
                <div class="eyebrow" style="color:var(--muted); margin-bottom:8px;">Documents uploaded</div>
                <div style="font-family:'Instrument Serif',serif; font-size:36px; color:var(--ink); margin-bottom:6px;">{{ $totalDocs }}</div>
                <span style="font-size:13px; color:var(--muted);">Across all applications</span>
            </div>
            <div class="card" style="padding:24px;">
                <div class="eyebrow" style="color:var(--muted); margin-bottom:8px;">Profile</div>
                <div style="font-family:'Instrument Serif',serif; font-size:22px; color:var(--ink); margin-bottom:6px;">{{ $profileComplete ? 'Complete' : 'Incomplete' }}</div>
                <a href="{{ route('portal.profile') }}" style="font-size:13px; color:var(--accent); text-decoration:none;">{{ $profileComplete ? 'Update profile →' : 'Complete profile →' }}</a>
            </div>
        </div>

        {{-- Applications list --}}
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
            <div class="eyebrow">My Applications</div>
            <a href="{{ route('portal.apply') }}" class="btn-primary" style="padding:8px 20px; font-size:11px;">+ New Application</a>
        </div>

        @if($applications->isEmpty())
        <div class="card" style="padding:40px; text-align:center;">
            <div style="font-size:36px; margin-bottom:12px;">📋</div>
            <h3 style="font-family:'Instrument Serif',serif; font-size:22px; font-weight:400; margin:0 0 8px;">No applications yet</h3>
            <p style="font-size:14px; color:var(--muted); margin:0 0 20px;">Start your first application to study abroad with ITEA.</p>
            <a href="{{ route('portal.apply') }}" class="btn-primary">Start application →</a>
        </div>
        @else
        <div style="display:flex; flex-direction:column; gap:2px; margin-bottom:32px;">
            @foreach($applications as $app)
            @php $badge = match($app->status) { 'draft'=>['#f3f4f6','#6b7280'],'submitted'=>['#dbeafe','#1d4ed8'],'reviewing'=>['#fef3c7','#92400e'],'result'=>($app->result==='accepted'?['#d1fae5','#065f46']:['#fee2e2','#991b1b']),default=>['#f3f4f6','#6b7280']}; @endphp
            <div class="card" style="padding:20px; display:grid; grid-template-columns:1fr auto; gap:16px; align-items:center;">
                <div style="display:grid; grid-template-columns:1fr 1fr 1fr 1fr; gap:12px; align-items:center;">
                    <div>
                        <div style="font-size:11px; color:var(--muted); font-family:'JetBrains Mono',monospace; text-transform:uppercase; letter-spacing:0.06em; margin-bottom:3px;">#{{ str_pad($app->id,5,'0',STR_PAD_LEFT) }}</div>
                        <div style="font-size:15px; font-weight:500; color:var(--ink);">{{ Str::limit($app->program_name, 30) }}</div>
                        <div style="font-size:12px; color:var(--muted);">{{ $app->destination }} · {{ $app->level }}</div>
                    </div>
                    <div>
                        <div style="font-size:11px; color:var(--muted); margin-bottom:3px;">University</div>
                        <div style="font-size:13px; color:var(--ink);">{{ $app->university ?: '—' }}</div>
                    </div>
                    <div>
                        <div style="font-size:11px; color:var(--muted); margin-bottom:3px;">Documents</div>
                        <div style="font-size:13px; color:var(--ink);">{{ $app->documents->count() }} uploaded</div>
                    </div>
                    <div>
                        <span style="display:inline-flex; align-items:center; gap:5px; padding:4px 10px; border-radius:999px; background:{{ $badge[0] }}; color:{{ $badge[1] }}; font-family:'JetBrains Mono',monospace; font-size:9px; letter-spacing:0.08em; text-transform:uppercase;">
                            <span style="width:5px;height:5px;border-radius:50%;background:currentColor;flex-shrink:0;"></span>
                            {{ $app->statusLabel() }}{{ $app->result ? ' · '.ucfirst($app->result) : '' }}
                        </span>
                        <div style="font-size:11px; color:var(--muted); margin-top:4px;">{{ $app->created_at->format('d M Y') }}</div>
                    </div>
                </div>
                <div style="display:flex; flex-direction:column; gap:6px; align-items:flex-end;">
                    <a href="{{ route('portal.application', $app->id) }}" style="font-size:12px; color:var(--accent); text-decoration:none; font-family:'JetBrains Mono',monospace; letter-spacing:0.06em; white-space:nowrap;">View →</a>
                    @if($app->status === 'draft')
                    <a href="{{ route('portal.apply.edit', $app->id) }}" style="font-size:12px; color:var(--muted); text-decoration:none; font-family:'JetBrains Mono',monospace; letter-spacing:0.06em; white-space:nowrap;">Edit</a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif

        {{-- Account details + Quick actions --}}
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:2px; margin-bottom:32px;">
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
            <div class="card" style="padding:24px;">
                <div class="eyebrow" style="margin-bottom:16px;">Quick actions</div>
                <div style="display:flex; flex-direction:column; gap:10px;">
                    @php $actions = [
                        ['label'=>'Start new application','href'=>route('portal.apply'),'icon'=>'📝'],
                        ['label'=>'Browse programmes','href'=>route('programmes'),'icon'=>'📚'],
                        ['label'=>'Check scholarships','href'=>route('scholarship'),'icon'=>'🎓'],
                        ['label'=>'Register for Virtual Fair','href'=>route('virtual-fair').'#register','icon'=>'🎪'],
                    ]; @endphp
                    @foreach($actions as $a)
                    <a href="{{ $a['href'] }}" style="display:flex; align-items:center; gap:12px; font-size:13px; color:var(--ink-2); text-decoration:none; padding:8px 0; border-bottom:1px solid var(--rule-soft);">
                        <span style="font-size:18px;">{{ $a['icon'] }}</span>
                        {{ $a['label'] }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
