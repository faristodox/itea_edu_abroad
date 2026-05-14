@props([
    'glow'     => 'red',   /* red | gold | jade | sky | lavender */
    'breadcrumbs' => [],
    'label'    => '',
    'title'    => '',
    'zhTitle'  => '',
    'body'     => '',
    'cta1Text' => 'Start my application',
    'cta1Href' => '',
    'cta2Text' => '',
    'cta2Href' => '',
    'stats'    => [],      /* [['key'=>'...','val'=>'...','sup'=>'...'], ...] */
    'factTitle'=> '',
])

@php
$glowMap = [
    'red'     => 'rgba(216,31,31,0.18)',
    'gold'    => 'rgba(232,169,59,0.32)',
    'jade'    => 'rgba(47,158,110,0.28)',
    'sky'     => 'rgba(120,170,230,0.28)',
    'lavender'=> 'rgba(170,135,220,0.28)',
];
$glowColor = $glowMap[$glow] ?? $glowMap['red'];
$zhColor = [
    'red'      => '#d81f1f',
    'gold'     => '#e8a93b',
    'jade'     => '#2f9e6e',
    'sky'      => '#78aae6',
    'lavender' => '#aa87dc',
][$glow] ?? '#d81f1f';
@endphp

<section style="background:var(--ink-deep); color:#fff; padding:56px 0; position:relative; overflow:hidden;">
    <div style="position:absolute; inset:0; background:radial-gradient(ellipse 60% 80% at 80% 40%, {{ $glowColor }}, transparent); pointer-events:none;"></div>

    <div class="wrap" style="position:relative; z-index:1;">
        {{-- Breadcrumb --}}
        @if(count($breadcrumbs))
        <div style="display:flex; gap:8px; align-items:center; font-family:'JetBrains Mono',monospace; font-size:11px; letter-spacing:0.1em; color:rgba(255,255,255,0.45); margin-bottom:32px; text-transform:uppercase;">
            @foreach($breadcrumbs as $crumb)
                @if(!$loop->last)
                    <a href="{{ $crumb['href'] }}" style="color:rgba(255,255,255,0.45); text-decoration:none; transition:color 0.15s;">{{ $crumb['label'] }}</a>
                    <span style="opacity:0.4;">/</span>
                @else
                    <span style="color:rgba(255,255,255,0.7);">{{ $crumb['label'] }}</span>
                @endif
            @endforeach
        </div>
        @endif

        <div style="display:grid; grid-template-columns:1fr 340px; gap:60px; align-items:start;">
            <div>
                @if($label)
                <div style="display:flex; align-items:center; gap:10px; font-family:'JetBrains Mono',monospace; font-size:10.5px; letter-spacing:0.14em; text-transform:uppercase; color:rgba(255,255,255,0.5); margin-bottom:18px;">
                    <span style="display:inline-block; width:28px; height:1px; background:var(--accent);"></span>
                    {{ $label }}
                </div>
                @endif

                <h1 style="font-family:'Instrument Serif',serif; font-size:clamp(48px,6vw,80px); font-weight:400; line-height:0.95; letter-spacing:-0.02em; margin:0 0 8px;">
                    {!! $title !!}
                    @if($zhTitle)
                    <span class="zh" style="display:block; font-size:clamp(20px,3vw,42px); color:{{ $zhColor }}; opacity:0.85; letter-spacing:0.06em; margin-top:8px;">{{ $zhTitle }}</span>
                    @endif
                </h1>

                <p style="font-size:17px; line-height:1.6; color:rgba(255,255,255,0.8); max-width:520px; margin:20px 0 28px;">{{ $body }}</p>

                <div style="display:flex; gap:14px; align-items:center; flex-wrap:wrap;">
                    @if($cta1Text)
                    <a href="{{ $cta1Href ?: route('application') }}#apply" class="btn-primary">
                        {{ $cta1Text }} <span style="margin-left:4px;">→</span>
                    </a>
                    @endif
                    @if($cta2Text)
                    <a href="{{ $cta2Href ?: '#' }}" style="color:rgba(255,255,255,0.7); text-decoration:underline; text-underline-offset:4px; font-size:14px;">{{ $cta2Text }}</a>
                    @endif
                </div>
            </div>

            {{-- Fact card --}}
            @if(count($stats))
            <div style="background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.1); padding:24px;">
                @if($factTitle)
                <h4 style="font-family:'Instrument Serif',serif; font-size:20px; font-weight:400; margin:0 0 18px; color:#fff;">{{ $factTitle }}</h4>
                @endif
                @foreach($stats as $s)
                <div style="display:flex; justify-content:space-between; align-items:baseline; padding:10px 0; border-bottom:1px solid rgba(255,255,255,0.08);">
                    <span style="font-size:13px; color:rgba(255,255,255,0.55);">{{ $s['key'] }}</span>
                    <span style="font-family:'Instrument Serif',serif; font-size:24px; color:#fff;">
                        {{ $s['val'] }}<small style="font-family:'Geist',sans-serif; font-size:13px; opacity:0.6;">{{ $s['sup'] ?? '' }}</small>
                    </span>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</section>
