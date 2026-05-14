@props([
    'eyebrow' => 'When to apply',
    'title'   => 'A typical timeline.',
    'steps'   => [],
])

<section class="section" style="background:var(--bg);">
    <div class="wrap">
        <div style="background:var(--ink-deep); color:#fff; padding:40px 48px;">
            <div class="eyebrow" style="color:rgba(255,255,255,0.4); margin-bottom:14px;">{{ $eyebrow }}</div>
            <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(28px,3.5vw,42px); font-weight:400; margin:0 0 36px; line-height:1;">{!! $title !!}</h2>
            <div style="display:grid; grid-template-columns:repeat(6,1fr); gap:0;">
                @foreach($steps as $i => $step)
                <div style="padding:0 20px 0 0; border-left:{{ $loop->first ? 'none' : '1px solid rgba(255,255,255,0.1)' }}; padding-left:{{ $loop->first ? '0' : '20px' }}; opacity:{{ $i < 2 ? '1' : '0.55' }};">
                    <div style="width:28px; height:28px; border-radius:50%; background:{{ $i < 2 ? 'var(--accent)' : 'rgba(255,255,255,0.15)' }}; display:flex; align-items:center; justify-content:center; font-family:'JetBrains Mono',monospace; font-size:11px; margin-bottom:12px;">{{ $i+1 }}</div>
                    <div class="eyebrow" style="color:rgba(255,255,255,0.4); margin-bottom:6px;">{{ $step['mo'] }}</div>
                    <h5 style="font-family:'Instrument Serif',serif; font-size:17px; font-weight:400; margin:0 0 6px;">{{ $step['t'] }}</h5>
                    <p style="font-size:13px; line-height:1.55; color:rgba(255,255,255,0.6); margin:0;">{{ $step['body'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
