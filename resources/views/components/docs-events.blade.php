@props([
    'docs'   => [],
    'events' => [],
    'eventsTitle' => 'Upcoming <em>webinars &amp; roadshows.</em>',
])

<section class="section" style="background:var(--bg-2);">
    <div class="wrap">
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:40px; align-items:start;">

            {{-- Documents checklist --}}
            <div class="card" style="padding:28px;">
                <div class="eyebrow" style="margin-bottom:12px;">What you'll need</div>
                <h3 style="font-family:'Instrument Serif',serif; font-size:26px; font-weight:400; margin:0 0 20px;">{!! 'Documents <em>checklist.</em>' !!}</h3>
                <div>
                    @foreach($docs as $doc)
                    <div style="display:flex; justify-content:space-between; align-items:baseline; padding:9px 0; border-bottom:1px solid var(--rule-soft); gap:12px;">
                        <div style="display:flex; gap:10px; align-items:baseline;">
                            <span style="color:#2a8a6a; font-size:14px; flex-shrink:0;">✓</span>
                            <span style="font-size:14px;">{{ $doc['name'] }}</span>
                        </div>
                        <span class="eyebrow" style="color:var(--muted); white-space:nowrap;">{{ $doc['req'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Events --}}
            <div class="card" style="padding:28px;">
                <div class="eyebrow" style="margin-bottom:12px;">Events &amp; activities</div>
                <h3 style="font-family:'Instrument Serif',serif; font-size:26px; font-weight:400; margin:0 0 20px;">{!! $eventsTitle !!}</h3>
                @foreach($events as $event)
                <div style="display:flex; gap:16px; align-items:center; padding:12px 0; border-bottom:1px solid var(--rule-soft);">
                    <div style="background:var(--ink-deep); color:#fff; min-width:44px; text-align:center; padding:6px 8px; flex-shrink:0;">
                        <div style="font-family:'Instrument Serif',serif; font-size:22px; line-height:1;">{{ $event['d'] }}</div>
                        <div class="eyebrow" style="color:rgba(255,255,255,0.5); font-size:9px;">{{ $event['m'] }}</div>
                    </div>
                    <div style="flex:1; min-width:0;">
                        <h5 style="font-family:'Instrument Serif',serif; font-size:16px; font-weight:400; margin:0 0 3px; color:var(--ink); white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ $event['title'] }}</h5>
                        <div style="font-size:12px; color:var(--muted);">{{ $event['meta'] }}</div>
                    </div>
                    <span style="font-family:'JetBrains Mono',monospace; font-size:9px; letter-spacing:0.1em; text-transform:uppercase; padding:3px 8px; border:1px solid {{ $event['type'] === 'webinar' ? 'var(--ink)' : 'var(--gold)' }}; color:{{ $event['type'] === 'webinar' ? 'var(--ink)' : 'var(--gold)' }}; white-space:nowrap; flex-shrink:0;">
                        {{ $event['label'] }}
                    </span>
                </div>
                @endforeach
                <a href="#" style="display:inline-flex; align-items:center; gap:6px; color:var(--accent); font-size:14px; margin-top:18px; font-weight:500; text-decoration:none;">
                    View full events calendar →
                </a>
            </div>

        </div>
    </div>
</section>
