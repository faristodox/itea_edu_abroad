@extends('layouts.app')
@section('title', 'My Portal — ITEA EduAbroad')

@section('content')
<section style="background:var(--ink-deep); color:#fff; padding:48px 0;">
    <div class="wrap" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px;">
        <div>
            <div class="eyebrow" style="color:rgba(255,255,255,0.4); margin-bottom:6px;">Applicant Portal</div>
            <h1 style="font-family:'Instrument Serif',serif; font-size:clamp(24px,3vw,36px); font-weight:400; margin:0;">
                Welcome back, <em style="color:var(--accent);">{{ Auth::user()->name }}.</em>
            </h1>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" style="background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.15); color:rgba(255,255,255,0.7); padding:8px 18px; font-family:'JetBrains Mono',monospace; font-size:11px; letter-spacing:0.08em; cursor:pointer;">
                Log out
            </button>
        </form>
    </div>
</section>

<section class="section" style="background:var(--bg);">
    <div class="wrap">

        {{-- Status cards --}}
        <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:2px; margin-bottom:32px;">
            <div class="card" style="padding:24px;">
                <div class="eyebrow" style="color:var(--muted); margin-bottom:8px;">Application Status</div>
                <div style="font-family:'Instrument Serif',serif; font-size:28px; color:var(--ink); margin-bottom:4px;">Not started</div>
                <a href="{{ route('application') }}#apply" style="font-size:13px; color:var(--accent); text-decoration:none;">Start application →</a>
            </div>
            <div class="card" style="padding:24px;">
                <div class="eyebrow" style="color:var(--muted); margin-bottom:8px;">Documents</div>
                <div style="font-family:'Instrument Serif',serif; font-size:28px; color:var(--ink); margin-bottom:4px;">0 / 10</div>
                <span style="font-size:13px; color:var(--muted);">Upload documents to proceed</span>
            </div>
            <div class="card" style="padding:24px;">
                <div class="eyebrow" style="color:var(--muted); margin-bottom:8px;">Counsellor</div>
                <div style="font-family:'Instrument Serif',serif; font-size:22px; color:var(--ink); margin-bottom:4px;">Not assigned</div>
                <a href="{{ route('contact') }}" style="font-size:13px; color:var(--accent); text-decoration:none;">Request a counsellor →</a>
            </div>
        </div>

        {{-- Quick actions --}}
        <div style="margin-bottom:32px;">
            <div class="eyebrow" style="margin-bottom:16px;">Quick actions</div>
            <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:12px;">
                @php $actions = [
                    ['label'=>'Browse Programmes','href'=>route('programmes'),'icon'=>'📚'],
                    ['label'=>'Check Scholarships','href'=>route('scholarship'),'icon'=>'🎓'],
                    ['label'=>'View Destinations','href'=>route('china'),'icon'=>'🌏'],
                    ['label'=>'Register for Fair','href'=>route('virtual-fair').'#register','icon'=>'🎪'],
                ]; @endphp
                @foreach($actions as $a)
                <a href="{{ $a['href'] }}" style="display:flex; flex-direction:column; align-items:center; gap:10px; padding:20px; border:1px solid var(--rule-soft); background:var(--paper); text-decoration:none; color:var(--ink); text-align:center; transition:border-color 0.15s;"
                    onmouseover="this.style.borderColor='var(--accent)'" onmouseout="this.style.borderColor='var(--rule-soft)'">
                    <span style="font-size:28px;">{{ $a['icon'] }}</span>
                    <span style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.08em; text-transform:uppercase; color:var(--muted);">{{ $a['label'] }}</span>
                </a>
                @endforeach
            </div>
        </div>

        {{-- Account info --}}
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:2px;">
            <div class="card" style="padding:24px;">
                <div class="eyebrow" style="margin-bottom:14px;">Account details</div>
                <div style="display:flex; flex-direction:column; gap:10px;">
                    <div style="display:flex; justify-content:space-between; padding-bottom:10px; border-bottom:1px solid var(--rule-soft); font-size:14px;">
                        <span style="color:var(--muted);">Name</span>
                        <span style="color:var(--ink); font-weight:500;">{{ Auth::user()->name }}</span>
                    </div>
                    <div style="display:flex; justify-content:space-between; padding-bottom:10px; border-bottom:1px solid var(--rule-soft); font-size:14px;">
                        <span style="color:var(--muted);">Email</span>
                        <span style="color:var(--ink);">{{ Auth::user()->email }}</span>
                    </div>
                    <div style="display:flex; justify-content:space-between; font-size:14px;">
                        <span style="color:var(--muted);">Member since</span>
                        <span style="color:var(--ink);">{{ Auth::user()->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>
            <div class="card" style="padding:24px;">
                <div class="eyebrow" style="margin-bottom:14px;">Next steps</div>
                <div style="display:flex; flex-direction:column; gap:12px;">
                    @php $steps = [
                        ['done'=>false,'label'=>'Complete your application form','href'=>route('application').'#apply'],
                        ['done'=>false,'label'=>'Upload required documents','href'=>'#'],
                        ['done'=>false,'label'=>'Book a counsellor session','href'=>route('contact')],
                        ['done'=>false,'label'=>'Register for Virtual Education Fair','href'=>route('virtual-fair').'#register'],
                    ]; @endphp
                    @foreach($steps as $s)
                    <a href="{{ $s['href'] }}" style="display:flex; align-items:center; gap:10px; font-size:13px; color:var(--ink-2); text-decoration:none;">
                        <span style="width:18px; height:18px; border-radius:50%; border:1.5px solid var(--rule-soft); display:flex; align-items:center; justify-content:center; flex-shrink:0; font-size:10px; color:var(--muted);">○</span>
                        {{ $s['label'] }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
