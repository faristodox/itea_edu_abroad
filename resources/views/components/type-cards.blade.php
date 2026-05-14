@props([
    'eyebrow' => 'Browse by type',
    'title'   => 'What level <em>are you?</em>',
    'body'    => '',
    'cards'   => [],
])

<section class="section" style="background:var(--paper);">
    <div class="wrap">
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; align-items:end; margin-bottom:32px;">
            <div>
                <div class="eyebrow" style="margin-bottom:8px;">{{ $eyebrow }}</div>
                <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(28px,3.5vw,42px); font-weight:400; margin:0; line-height:1;">{!! $title !!}</h2>
            </div>
            @if($body)
            <p style="font-size:15px; line-height:1.6; color:var(--muted); margin:0;">{{ $body }}</p>
            @endif
        </div>

        <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:2px;">
            @foreach($cards as $card)
            <a href="{{ $card['href'] ?? '#' }}" class="card" style="display:{{ ($card['hidden'] ?? false) ? 'none' : 'block' }}; padding:28px; text-decoration:none; position:relative;">
                {{-- Glyph placeholder --}}
                <div style="width:44px; height:44px; border-radius:50%; background:var(--bg-2); display:flex; align-items:center; justify-content:center; margin-bottom:14px; font-family:'Noto Serif SC',serif; font-size:18px; color:var(--ink);">
                    {{ $card['glyph'] ?? '✦' }}
                </div>
                @if($card['zh'] ?? null)
                <div class="zh" style="font-size:13px; color:var(--muted); margin-bottom:4px;">{{ $card['zh'] }}</div>
                @endif
                <h3 style="font-family:'Instrument Serif',serif; font-size:22px; font-weight:400; margin:0 0 4px; color:var(--ink);">{{ $card['title'] }}</h3>
                <div class="eyebrow" style="color:var(--muted); margin-bottom:8px;">{{ $card['count'] ?? '' }}</div>
                <p style="font-size:14px; color:var(--muted); margin:0 0 12px; line-height:1.5;">{{ $card['body'] ?? '' }}</p>
                <span style="font-size:12px; color:var(--accent); font-weight:500;">Browse → </span>
            </a>
            @endforeach
        </div>
    </div>
</section>
