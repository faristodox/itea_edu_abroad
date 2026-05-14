@props([
    'eyebrow'    => 'Entry requirements',
    'title'      => 'Who can <em>apply.</em>',
    'body'       => '',
    'headers'    => ['Level','Age','Education','Language','Documents'],
    'rows'       => [],
    'langNote'   => 'Or language equivalent',
])

<section class="section" style="background:var(--paper);">
    <div class="wrap">
        <div style="margin-bottom:28px;">
            <div class="eyebrow" style="margin-bottom:8px;">{{ $eyebrow }}</div>
            <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(28px,3.5vw,42px); font-weight:400; margin:0 0 12px;">{!! $title !!}</h2>
            @if($body)
            <p style="font-size:15px; line-height:1.6; color:var(--muted); max-width:680px; margin:0;">{{ $body }}</p>
            @endif
        </div>

        <div style="border:1px solid var(--rule-soft); overflow-x:auto;">
            <div style="display:grid; grid-template-columns:120px 80px 1fr 1fr 1fr; background:var(--ink-deep); color:#fff; padding:12px 16px; gap:16px;">
                @foreach($headers as $h)
                <div class="eyebrow" style="color:rgba(255,255,255,0.5);">{{ $h }}</div>
                @endforeach
            </div>
            @foreach($rows as $row)
            <div style="display:grid; grid-template-columns:120px 80px 1fr 1fr 1fr; padding:14px 16px; gap:16px; border-top:1px solid var(--rule-soft); background:{{ $loop->even ? 'var(--bg-2)' : 'var(--paper)' }};">
                <div style="font-weight:600; font-size:14px; color:var(--ink);">{{ $row['lvl'] }}</div>
                <div style="font-size:14px; color:var(--ink-2);">{{ $row['age'] }}</div>
                <div style="font-size:14px; color:var(--ink-2);">{{ $row['edu'] }}</div>
                <div style="font-size:14px; color:var(--ink-2);">
                    {{ $row['lang'] }}
                    <small style="display:block; font-size:11px; color:var(--muted);">{{ $langNote }}</small>
                </div>
                <div style="font-size:13px; color:var(--muted);">{{ $row['docs'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>
