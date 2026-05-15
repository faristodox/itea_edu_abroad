@extends('layouts.app')

@section('title', 'ITEA EduAbroad — Study Abroad in China, Malaysia & Indonesia')
@section('description', 'ITEA EduAbroad places Southeast Asian students into top universities in China, Malaysia and Indonesia. Scholarship matching, visa support, and end-to-end counselling since 2009.')
@section('nav_logo', 'assets/logo.jpeg')

@section('content')

{{-- ── Hero ────────────────────────────────────────────────── --}}
<section style="background:var(--ink-deep); color:#fff; overflow:hidden;" x-data="heroSlider()" x-init="start()" @mouseenter="stop()" @mouseleave="start()">
    <div class="wrap" style="display:grid; grid-template-columns:1fr 1fr; gap:40px; align-items:center; padding-top:56px; padding-bottom:64px;">

        {{-- Left: headline + stats --}}
        <div>
            <div style="display:flex; align-items:center; gap:10px; font-family:'JetBrains Mono',monospace; font-size:10.5px; letter-spacing:0.14em; text-transform:uppercase; color:rgba(255,255,255,0.45); margin-bottom:20px;">
                <span style="display:inline-block; width:28px; height:1px; background:var(--accent);"></span>
                EST. 2009 · Kuala Lumpur
            </div>
            <h1 style="font-family:'Instrument Serif',serif; font-size:clamp(52px,6vw,88px); font-weight:400; line-height:0.95; letter-spacing:-0.02em; margin:0 0 24px;">
                Your future,<br>
                <em style="color:var(--accent);">studied abroad</em><br>
                <span style="opacity:0.75;">in Asia.</span>
            </h1>
            <p style="font-size:17px; line-height:1.6; color:rgba(255,255,255,0.8); max-width:480px; margin:0 0 32px;">
                ITEA EduAbroad places students from across Southeast Asia into top universities in China, Malaysia and Indonesia — with scholarship matching, visa support and a counsellor at every step.
            </p>
            <div style="display:flex; gap:14px; align-items:center; flex-wrap:wrap; margin-bottom:48px;">
                <a href="{{ route('application') }}#apply" class="btn-primary">Start your application →</a>
                <a href="{{ route('contact') }}" style="color:rgba(255,255,255,0.7); text-decoration:underline; text-underline-offset:4px; font-size:14px;">Or book a 30-min consultation</a>
            </div>

            {{-- Stats row --}}
            <div style="display:flex; gap:32px; padding-top:28px; border-top:1px solid rgba(255,255,255,0.1);">
                @foreach([['12,400+','Students placed since 2009'],['300+','Partner universities'],['94%','Scholarship match rate']] as [$num,$lbl])
                <div>
                    <div style="font-family:'Instrument Serif',serif; font-size:32px; color:#fff;">{{ $num }}</div>
                    <div style="font-size:12px; color:rgba(255,255,255,0.5); margin-top:2px;">{{ $lbl }}</div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Right: slider --}}
        <div style="position:relative; height:480px; overflow:hidden;">
            @php
            $slides = [
                ['kicker'=>'01 · Destinations','title'=>'Study in China — from Beijing to Hangzhou','body'=>'280+ partner universities. Diploma, degree, master, PhD and Mandarin programmes — fully supported from application to arrival.','cta'=>'Explore Chinese universities','image'=>'assets/uni-zust.png','label'=>'ZUST · HANGZHOU','href'=>route('china')],
                ['kicker'=>'02 · Short-term','title'=>'Summer camps, study tours & sit-ins','body'=>'Two to eight week immersions across China and Malaysia. Customised cohorts for schools, universities and corporate groups.','cta'=>'Browse short programmes','image'=>'assets/slide-klcc.jpg','label'=>'KLCC · KUALA LUMPUR','href'=>route('malaysia')],
                ['kicker'=>'03 · Funding','title'=>'Scholarships covering up to 100% of tuition','body'=>'Chinese Government, Confucius Institute, Belt & Road and ITEA Merit Awards — matched to your profile within 48 hours.','cta'=>'Match me to a scholarship','image'=>'assets/scholarship.jpg','label'=>'SCHOLARSHIP · INTAKE 2026','phA'=>'#a51717','phB'=>'#4a0808','href'=>route('scholarship')],
            ];
            @endphp

            @foreach($slides as $i => $slide)
            <div style="position:absolute; inset:0; transition:opacity 0.6s ease;" :style="current === {{ $i }} ? 'opacity:1;pointer-events:auto' : 'opacity:0;pointer-events:none'">
                @if($slide['image'])
                <img src="{{ asset($slide['image']) }}" alt="{{ $slide['label'] }}" style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover;">
                @else
                <div style="position:absolute; inset:0; background:linear-gradient(135deg, {{ $slide['phA'] ?? '#0a1f5e' }}, {{ $slide['phB'] ?? '#061240' }}); display:flex; align-items:flex-end; padding:16px; box-sizing:border-box;">
                    <span style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.15em; color:rgba(255,255,255,0.4); text-transform:uppercase;">{{ $slide['label'] }}</span>
                </div>
                @endif
                <div style="position:absolute; inset:0; background:linear-gradient(to top, rgba(6,18,64,0.75), transparent 50%);"></div>
                <div style="position:absolute; bottom:0; left:0; right:0; padding:20px 24px;">
                    <div style="font-family:'JetBrains Mono',monospace; font-size:9.5px; letter-spacing:0.15em; text-transform:uppercase; color:rgba(255,255,255,0.5); margin-bottom:6px;">{{ $slide['kicker'] }}</div>
                    <h2 style="font-family:'Instrument Serif',serif; font-size:22px; font-weight:400; color:#fff; margin:0 0 8px; line-height:1.15;">{{ $slide['title'] }}</h2>
                    <p style="font-size:13px; color:rgba(255,255,255,0.7); margin:0 0 12px; line-height:1.5;">{{ $slide['body'] }}</p>
                    <a href="{{ $slide['href'] }}" style="display:inline-flex; align-items:center; gap:6px; background:rgba(255,255,255,0.15); border:1px solid rgba(255,255,255,0.3); padding:7px 14px; color:#fff; text-decoration:none; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase;">{{ $slide['cta'] }} →</a>
                </div>
            </div>
            @endforeach

            {{-- Slide counter --}}
            <div style="position:absolute; top:14px; right:14px; font-family:'JetBrains Mono',monospace; font-size:10.5px; color:rgba(255,255,255,0.45); z-index:5;" x-text="String(current+1).padStart(2,'0') + ' / 03'"></div>

            {{-- Prev / Next --}}
            <button @click="prev()" style="position:absolute; left:10px; top:50%; transform:translateY(-50%); background:rgba(0,0,0,0.35); border:none; color:#fff; width:32px; height:32px; border-radius:50%; cursor:pointer; font-size:18px; z-index:5; display:flex; align-items:center; justify-content:center;">‹</button>
            <button @click="next()" style="position:absolute; right:10px; top:50%; transform:translateY(-50%); background:rgba(0,0,0,0.35); border:none; color:#fff; width:32px; height:32px; border-radius:50%; cursor:pointer; font-size:18px; z-index:5; display:flex; align-items:center; justify-content:center;">›</button>

            {{-- Dots --}}
            <div style="position:absolute; bottom:10px; right:14px; display:flex; gap:5px; z-index:5;">
                @foreach($slides as $i => $slide)
                <button @click="goto({{ $i }})" style="width:6px; height:6px; border-radius:50%; border:none; cursor:pointer; transition:background 0.2s;" :style="current === {{ $i }} ? 'background:#fff' : 'background:rgba(255,255,255,0.35)'"></button>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ── Countries ──────────────────────────────────────────── --}}
<section class="section" x-data="countryTabs()">
    <div class="wrap">
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:40px; align-items:end; margin-bottom:28px;">
            <div>
                <div class="eyebrow" style="margin-bottom:8px;">02 · Destinations</div>
                <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(32px,4vw,52px); font-weight:400; margin:0; line-height:1;">Featured <em style="color:var(--accent);">countries</em></h2>
            </div>
            <div>
                <p style="font-size:15px; line-height:1.6; color:var(--muted); margin:0 0 10px;">Three live destinations and a pipeline of four more launching from 2027. Each desk staffed by counsellors who studied or worked there.</p>
                <a href="{{ route('china') }}" style="color:var(--accent); font-size:14px; display:inline-flex; align-items:center; gap:6px; font-weight:500; text-decoration:none;">See all destinations →</a>
            </div>
        </div>

        {{-- Tabs (CSS-class based — see <style> block below for full styling) --}}
        @php
        $countries = [
            ['id'=>'china',     'name'=>'China',              'zh'=>'中国',      'num'=>'01'],
            ['id'=>'malaysia',  'name'=>'Malaysia',           'zh'=>'马来西亚',  'num'=>'02'],
            ['id'=>'indonesia', 'name'=>'Indonesia',          'zh'=>'印度尼西亚','num'=>'03'],
            ['id'=>'future',    'name'=>'Future Destinations','zh'=>'未来',      'num'=>'04'],
        ];
        @endphp

        <style>
            .ctab-bar {
                display: flex;
                background: var(--bg-2);
                border: 1px solid var(--rule-soft);
                border-bottom: none;
            }
            .ctab {
                flex: 1;
                padding: 18px 16px;
                background: transparent;
                border: none;
                border-right: 1px solid var(--rule-soft);
                border-bottom: 3px solid transparent;
                cursor: pointer;
                transition: background 0.18s ease, border-color 0.18s ease;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 12px;
                min-width: 0;
            }
            .ctab:last-child { border-right: none; }
            .ctab:hover { background: rgba(255,255,255,0.4); }
            .ctab.is-active {
                background: var(--paper);
                border-bottom-color: var(--accent);
            }
            .ctab-num {
                font-family: 'JetBrains Mono', monospace;
                font-size: 10px;
                letter-spacing: 0.1em;
                color: var(--muted);
                opacity: 0.55;
            }
            .ctab-name {
                font-family: 'JetBrains Mono', monospace;
                font-size: 12px;
                letter-spacing: 0.08em;
                text-transform: uppercase;
                font-weight: 500;
                color: var(--muted);
                white-space: nowrap;
            }
            .ctab-zh {
                font-family: 'Noto Serif SC', serif;
                font-size: 13px;
                letter-spacing: 0.04em;
                color: var(--muted);
                opacity: 0.5;
            }
            .ctab.is-active .ctab-num { color: var(--accent); opacity: 0.85; }
            .ctab.is-active .ctab-name { color: var(--ink); }
            .ctab.is-active .ctab-zh { color: var(--accent); opacity: 0.7; }

            /* ── Mobile / Tablet: stack content vertically, allow wrapping ── */
            @media (max-width: 1024px) {
                .ctab {
                    flex-direction: column;
                    gap: 4px;
                    padding: 10px 4px;
                    align-items: center;
                    text-align: center;
                }
                .ctab-zh { display: none; }
                .ctab-num { font-size: 9px; }
                .ctab-name {
                    font-size: 10px;
                    white-space: normal;
                    word-break: break-word;
                    line-height: 1.25;
                    letter-spacing: 0.04em;
                }
            }
        </style>

        <div class="ctab-bar">
            @foreach($countries as $c)
            <button @click="active = '{{ $c['id'] }}'"
                    class="ctab"
                    :class="active === '{{ $c['id'] }}' ? 'is-active' : ''">
                <span class="ctab-num">{{ $c['num'] }}</span>
                <span class="ctab-name">{{ $c['name'] }}</span>
                <span class="ctab-zh">{{ $c['zh'] }}</span>
            </button>
            @endforeach
        </div>

        {{-- China panel --}}
        @php
        $panels = [
            'china'     => ['name'=>'China',               'label'=>'BEIJING · 北京',       'phA'=>'#a51717','phB'=>'#3d0808','blurb'=>'The largest higher-education system in the world. World-class research, generous scholarships and the fastest-growing alumni network in Asia.',       'stats'=>[['280+','Partner universities'],['1,200+','Programmes'],['¥0','Tuition (full-ride)'],['48 hrs','Avg. response']], 'unis'=>[['Zhejiang Univ. of Science & Technology','Hangzhou · Zhejiang · ZUST'],['Shandong University of Technology','Zibo · Shandong · SDUT'],['Jiangxi Univ. of Finance & Economics','Nanchang · Jiangxi · JUFE'],['Hainan Medical University','Haikou · Hainan · HMU']], 'href'=>route('china'),    'zh'=>'中国'],
            'malaysia'  => ['name'=>'Malaysia',            'label'=>'KUALA LUMPUR · KL',    'phA'=>'#0a1f5e','phB'=>'#061240','blurb'=>'English-medium instruction, multicultural campuses and tuition at a fraction of UK/AU costs. A natural bridge for ASEAN and South Asian students.','stats'=>[['45+','Partner universities'],['380+','Programmes'],['RM 18k','From / year'],['72 hrs','Avg. response']],  'unis'=>[['Universiti Malaya','KL · QS #60'],['Universiti Putra Malaysia','Selangor · QS #148'],['Taylor\'s University','Subang · QS #251'],['Sunway University','Bandar Sunway · QS #586'],['Monash University Malaysia','Bandar Sunway · QS Asia #44']], 'href'=>route('malaysia'), 'zh'=>'马来西亚'],
            'indonesia' => ['name'=>'Indonesia',           'label'=>'JAKARTA · ID',         'phA'=>'#c98a1d','phB'=>'#5e3f10','blurb'=>'Newly opened destination with strong programmes in business, hospitality and Southeast Asian studies. Direct cohorts launching from 2026.',          'stats'=>[['32+','Partner universities'],['220+','Programmes'],['IDR 60M','From / year'],['96 hrs','Avg. response']],  'unis'=>[['Universitas Indonesia','Depok · QS #237'],['Institut Teknologi Bandung','Bandung · QS #281'],['Universitas Gadjah Mada','Yogyakarta · QS #239'],['Universitas Airlangga','Surabaya · QS #345'],['Bina Nusantara University','Jakarta · QS #701']], 'href'=>'#',               'zh'=>'印度尼西亚'],
            'future'    => ['name'=>'Future Destinations', 'label'=>'EXPANDING · ASIA',     'phA'=>'#3a3f56','phB'=>'#15182a','blurb'=>'Coming soon — Singapore, Hong Kong, Thailand and Vietnam. Join the waitlist and be first to access pilot cohorts in 2027.',                        'stats'=>[['4','New destinations'],['2027','Pilot launch'],['Free','Waitlist'],['—','Coming soon']],                   'unis'=>[['Singapore','Pilot · 2027'],['Hong Kong SAR','Pilot · 2027'],['Thailand','Pilot · 2027'],['Vietnam','Pilot · 2028'],['Korea (under review)','Pilot · 2028']], 'href'=>'#',               'zh'=>'未来'],
        ];
        @endphp

        @foreach($panels as $id => $p)
        {{-- x-show wrapper: Alpine toggles display on this outer div (block by default) --}}
        {{-- The inner grid div keeps display:grid untouched by Alpine --}}
        <div x-show="active === '{{ $id }}'">
        <div style="display:grid; grid-template-columns:1fr 280px 280px; gap:0; border:1px solid var(--rule-soft); border-top:none; background:var(--paper);">

            {{-- Col 1: Info --}}
            <div style="padding:32px;">
                <div class="eyebrow" style="color:var(--accent); margin-bottom:12px;">{{ $p['label'] }}</div>
                <h3 style="font-family:'Instrument Serif',serif; font-size:clamp(24px,3vw,36px); font-weight:400; margin:0 0 12px; line-height:1.1;">Why <em style="color:var(--accent);">{{ $p['name'] }}</em>?</h3>
                <p style="font-size:15px; line-height:1.65; color:var(--muted); margin:0 0 20px;">{{ $p['blurb'] }}</p>
                <a href="{{ $p['href'] }}"
                   style="display:inline-flex; align-items:center; gap:6px; padding:9px 20px; border:1px solid var(--ink); border-radius:999px; color:var(--ink); text-decoration:none; font-family:'JetBrains Mono',monospace; font-size:10.5px; letter-spacing:0.1em; text-transform:uppercase; transition:background 0.15s, color 0.15s; margin-bottom:24px;"
                   onmouseenter="this.style.background='var(--ink)';this.style.color='var(--paper)'"
                   onmouseleave="this.style.background='transparent';this.style.color='var(--ink)'">Explore {{ $p['name'] }} →</a>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; padding-top:24px; border-top:1px solid var(--rule-soft);">
                    @foreach($p['stats'] as [$num,$lbl])
                    <div>
                        <div style="font-family:'Instrument Serif',serif; font-size:26px; color:var(--ink);">{{ $num }}</div>
                        <div style="font-size:12px; color:var(--muted); margin-top:2px;">{{ $lbl }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Col 2: Image panel --}}
            <div style="background:linear-gradient(160deg, {{ $p['phA'] }}, {{ $p['phB'] }}); position:relative; min-height:300px; overflow:hidden;">
                <div style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center; pointer-events:none;">
                    <span class="zh" style="font-size:120px; font-weight:700; color:rgba(255,255,255,0.07); line-height:1; user-select:none;">{{ $p['zh'] }}</span>
                </div>
                <div style="position:absolute; bottom:0; left:0; right:0; display:flex; justify-content:space-between; align-items:flex-end; padding:14px 16px;">
                    <span style="font-family:'JetBrains Mono',monospace; font-size:9.5px; letter-spacing:0.15em; color:rgba(255,255,255,0.45); text-transform:uppercase;">{{ $p['label'] }}</span>
                    <span class="zh" style="font-size:14px; color:rgba(255,255,255,0.35); letter-spacing:0.06em;">{{ $p['zh'] }}</span>
                </div>
            </div>

            {{-- Col 3: Uni list --}}
            <div style="border-left:1px solid var(--rule-soft); padding:24px;">
                <div class="eyebrow" style="margin-bottom:12px;">Top institutions</div>
                @foreach($p['unis'] as $i => [$name,$city])
                <div style="display:flex; gap:12px; align-items:baseline; padding:10px 0; border-bottom:1px solid var(--rule-soft);">
                    <span style="font-family:'JetBrains Mono',monospace; font-size:10px; color:var(--muted); flex-shrink:0;">{{ str_pad($i+1,2,'0',STR_PAD_LEFT) }}</span>
                    <div style="flex:1; min-width:0;">
                        <div style="font-family:'Instrument Serif',serif; font-size:16px; color:var(--ink); white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ $name }}</div>
                        <div style="font-size:11px; color:var(--muted);">{{ $city }}</div>
                    </div>
                    <span style="color:var(--accent); flex-shrink:0;">→</span>
                </div>
                @endforeach
            </div>

        </div>{{-- /grid --}}
        </div>{{-- /x-show wrapper --}}
        @endforeach
    </div>
</section>

{{-- ── Universities grid ──────────────────────────────────── --}}
@php
$unis = [
    ['country'=>'CHINA','name'=>'Tsinghua University','city'=>'Beijing','rank'=>'QS #20','progs'=>48,'intake'=>'Sep / Mar','phA'=>'#a51717','phB'=>'#3d0808'],
    ['country'=>'CHINA','name'=>'Peking University','city'=>'Beijing','rank'=>'QS #14','progs'=>52,'intake'=>'Sep / Mar','phA'=>'#891414','phB'=>'#330606'],
    ['country'=>'CHINA','name'=>'Fudan University','city'=>'Shanghai','rank'=>'QS #39','progs'=>36,'intake'=>'Sep / Feb','phA'=>'#bb2424','phB'=>'#420c0c'],
    ['country'=>'CHINA','name'=>'Zhejiang University','city'=>'Hangzhou','rank'=>'QS #47','progs'=>42,'intake'=>'Sep / Mar','phA'=>'#a01a1a','phB'=>'#3c0a0a'],
    ['country'=>'MALAYSIA','name'=>'Universiti Malaya','city'=>'Kuala Lumpur','rank'=>'QS #60','progs'=>31,'intake'=>'Sep / Feb','phA'=>'#0a1f5e','phB'=>'#061240'],
    ['country'=>'MALAYSIA','name'=>'Taylor\'s University','city'=>'Subang Jaya','rank'=>'QS #251','progs'=>27,'intake'=>'Aug / Jan / May','phA'=>'#142a6e','phB'=>'#08164a'],
    ['country'=>'MALAYSIA','name'=>'Monash University','city'=>'Bandar Sunway','rank'=>'QS #44 Asia','progs'=>22,'intake'=>'Feb / Jul','phA'=>'#0c2670','phB'=>'#061240'],
    ['country'=>'INDONESIA','name'=>'Universitas Indonesia','city'=>'Depok','rank'=>'QS #237','progs'=>18,'intake'=>'Sep / Feb','phA'=>'#c98a1d','phB'=>'#5e3f10'],
];
@endphp

{{-- .uni-chip styles moved to app.css --}}

<section class="section" style="background:var(--paper); padding-top:48px;" x-data="{ filter: 'ALL' }">
    <div class="wrap">

        {{-- Section header + filters (single, unified) --}}
        <div style="display:flex; justify-content:space-between; align-items:end; margin-bottom:32px; flex-wrap:wrap; gap:16px;">
            <div>
                <div class="eyebrow" style="margin-bottom:8px;">03 · Featured</div>
                <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(28px,3.5vw,42px); font-weight:400; margin:0;">Hand-picked <em style="color:var(--accent);">universities</em></h2>
            </div>
            <div style="display:flex; gap:8px;">
                @foreach(['ALL','CHINA','MALAYSIA','INDONESIA'] as $f)
                <button @click="filter = '{{ $f }}'"
                        class="uni-chip"
                        :class="filter === '{{ $f }}' ? 'is-on' : ''">{{ $f }}</button>
                @endforeach
            </div>
        </div>

        {{-- Cards grid: 24px gap between cards --}}
        <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:24px;">
            @foreach($unis as $u)
            <div class="card" style="overflow:hidden;" x-show="filter === 'ALL' || filter === '{{ $u['country'] }}'">
                <div style="height:180px; background:linear-gradient(135deg,{{ $u['phA'] }},{{ $u['phB'] }}); position:relative;">
                    <span style="position:absolute; top:10px; right:10px; background:rgba(0,0,0,0.4); color:rgba(255,255,255,0.85); font-family:'JetBrains Mono',monospace; font-size:9.5px; letter-spacing:0.1em; padding:3px 8px; text-transform:uppercase;">{{ $u['rank'] }}</span>
                    <span style="position:absolute; bottom:10px; left:10px; font-family:'JetBrains Mono',monospace; font-size:9.5px; letter-spacing:0.12em; text-transform:uppercase; color:rgba(255,255,255,0.4);">{{ strtoupper($u['city']) }}</span>
                </div>
                <div style="padding:18px 20px;">
                    <div class="eyebrow" style="margin-bottom:4px;">{{ $u['country'] }}</div>
                    <h4 style="font-family:'Instrument Serif',serif; font-size:18px; font-weight:400; margin:0 0 3px; color:var(--ink);">{{ $u['name'] }}</h4>
                    <div style="font-size:12px; color:var(--muted); margin-bottom:10px;">{{ $u['city'] }}</div>
                    <div style="display:flex; gap:16px; font-size:12px; color:var(--muted);">
                        <span><strong style="color:var(--ink);">{{ $u['progs'] }}</strong> programmes</span>
                        <span>Intake {{ $u['intake'] }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div style="text-align:center; margin-top:40px;">
            <a href="{{ route('programmes') }}" class="btn-outline">Browse all 300+ universities →</a>
        </div>
    </div>
</section>

{{-- ── Scholarships ───────────────────────────────────────── --}}
<section class="section" style="background:var(--ink-deep); color:#fff;">
    <div class="wrap">
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:40px; align-items:end; margin-bottom:32px;">
            <div>
                <div class="eyebrow" style="color:rgba(255,255,255,0.4); margin-bottom:8px;">04 · Funding</div>
                <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(28px,3.5vw,42px); font-weight:400; margin:0; line-height:1; color:#fff;">Scholarship <em style="color:var(--gold);">opportunities</em></h2>
            </div>
            <p style="font-size:15px; line-height:1.6; color:rgba(255,255,255,0.65); margin:0;">Live, profile-matched scholarships from governments, universities and ITEA. Match runs nightly — your shortlist arrives within 48 hours.</p>
        </div>

        <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:2px; margin-bottom:20px;">
            @php
            $scholItems = [
                ['tag'=>'GOVERNMENT · CHINA','name'=>'Chinese Government Scholarship (CSC)','body'=>'Full tuition, accommodation, monthly stipend and medical insurance — for undergraduate through PhD students.','amt'=>'Up to 100%','note'=>'Tuition + Stipend','deadline'=>'Apr 15'],
                ['tag'=>'LANGUAGE · CHINA','name'=>'Confucius Institute Scholarship','body'=>'Mandarin learning scholarship covering language training, accommodation and a monthly living allowance.','amt'=>'RMB 2,500','note'=>'Per month','deadline'=>'May 30'],
                ['tag'=>'MERIT · ITEA','name'=>'ITEA Merit Award 2026','body'=>'Awarded to top 5% of ITEA applicants by academic and leadership merit. Stackable with country scholarships.','amt'=>'USD 4,000','note'=>'One-time','deadline'=>'Rolling'],
            ];
            @endphp
            @foreach($scholItems as $s)
            <div style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.08); padding:28px; display:flex; flex-direction:column; transition:background 0.18s;" onmouseenter="this.style.background='rgba(255,255,255,0.09)'" onmouseleave="this.style.background='rgba(255,255,255,0.05)'">
                <div class="eyebrow" style="color:var(--gold); margin-bottom:12px;">{{ $s['tag'] }}</div>
                <h4 style="font-family:'Instrument Serif',serif; font-size:22px; font-weight:400; margin:0 0 10px; color:#fff; line-height:1.2;">{{ $s['name'] }}</h4>
                <p style="font-size:14px; line-height:1.6; color:rgba(255,255,255,0.65); margin:0 0 20px; flex:1;">{{ $s['body'] }}</p>
                <div style="display:flex; justify-content:space-between; align-items:baseline; padding-top:16px; border-top:1px solid rgba(255,255,255,0.1);">
                    <div>
                        <div style="font-family:'Instrument Serif',serif; font-size:28px; color:#fff;">{{ $s['amt'] }} <small style="font-size:13px; opacity:0.6; font-family:'Geist',sans-serif;">{{ $s['note'] }}</small></div>
                    </div>
                    <div style="text-align:right;">
                        <div class="eyebrow" style="color:rgba(255,255,255,0.35); margin-bottom:4px;">Deadline</div>
                        <div style="font-family:'Instrument Serif',serif; font-size:20px;">{{ $s['deadline'] }}</div>
                    </div>
                </div>
                <a href="{{ route('scholarship') }}" style="margin-top:16px; color:var(--gold); font-size:13px; font-weight:500; text-decoration:none;">Check eligibility →</a>
            </div>
            @endforeach
        </div>
        <div style="background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.08); padding:16px 24px; display:flex; justify-content:space-between; align-items:center;">
            <span style="font-size:14px; color:rgba(255,255,255,0.65);">15 additional scholarships available across our network.</span>
            <a href="{{ route('scholarship') }}" style="color:var(--gold); font-size:14px; font-weight:500; text-decoration:none;">See all scholarships →</a>
        </div>
    </div>
</section>

{{-- ── Why ITEA ────────────────────────────────────────────── --}}
<section class="section">
    <div class="wrap">
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:40px; align-items:end; margin-bottom:32px;">
            <div>
                <div class="eyebrow" style="margin-bottom:8px;">05 · Why ITEA</div>
                <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(28px,3.5vw,42px); font-weight:400; margin:0;">Why <em style="color:var(--accent);">ITEA</em>?</h2>
            </div>
            <p style="font-size:15px; line-height:1.6; color:var(--muted); margin:0;">Sixteen years placing students from Malaysia, Indonesia and the Philippines into Asia's best universities. Here's what changes when you go through us.</p>
        </div>

        <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:2px;">
            @php
            $reasons = [
                ['num'=>'01','title'=>'End-to-end support','body'=>'From shortlist to airport pickup — a single counsellor across 7 stages of your journey.'],
                ['num'=>'02','title'=>'300+ partner institutions','body'=>'Direct MOUs with universities across China, Malaysia and Indonesia. No middlemen, no surprise fees.'],
                ['num'=>'03','title'=>'Scholarship matching','body'=>'Profile-matched to government, university and ITEA scholarships within 48 hours of enquiry.'],
                ['num'=>'04','title'=>'Mandarin from day one','body'=>'Free access to ITEA Learning — 12 weeks of online Mandarin before you fly. HSK-aligned.'],
                ['num'=>'05','title'=>'Career pathway','body'=>'ITEAJOBS connects you to internships and graduate placements across the ASEAN-China corridor.'],
                ['num'=>'06','title'=>'Alumni & community','body'=>'12,000+ students placed since 2009. Local WhatsApp groups in every city we serve.'],
            ];
            @endphp
            @foreach($reasons as $r)
            <div class="card" style="padding:28px;">
                <div style="font-family:'JetBrains Mono',monospace; font-size:11px; color:var(--muted); margin-bottom:12px;">{{ $r['num'] }}</div>
                <h4 style="font-family:'Instrument Serif',serif; font-size:22px; font-weight:400; margin:0 0 10px; color:var(--ink);">{{ $r['title'] }}</h4>
                <p style="font-size:14px; line-height:1.6; color:var(--muted); margin:0;">{{ $r['body'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ── Application procedure ───────────────────────────────── --}}
<section class="section" style="background:var(--paper);">
    <div class="wrap">
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:40px; align-items:end; margin-bottom:32px;">
            <div>
                <div class="eyebrow" style="margin-bottom:8px;">06 · How it works</div>
                <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(28px,3.5vw,42px); font-weight:400; margin:0;">Application <em style="color:var(--accent);">procedure</em></h2>
            </div>
            <p style="font-size:15px; line-height:1.6; color:var(--muted); margin:0;">From first call to first day of class — most students complete the five-step journey in 8 to 14 weeks.</p>
        </div>
        <div style="display:grid; grid-template-columns:repeat(5,1fr); gap:2px;">
            @php
            $steps = [
                ['lbl'=>'Step 01','t'=>'Consultation','body'=>'Free 30-min counselling — online or at our KL office.'],
                ['lbl'=>'Step 02','t'=>'Shortlist','body'=>'We match you with 3-5 programmes that fit your profile and budget.'],
                ['lbl'=>'Step 03','t'=>'Application','body'=>'Submit one ITEA form — we forward to all your chosen universities.'],
                ['lbl'=>'Step 04','t'=>'Offer & Visa','body'=>'Receive offer letters and JW-202 / Visa Approval Letter through us.'],
                ['lbl'=>'Step 05','t'=>'Departure','body'=>'Pre-departure briefing, airport pickup, hostel setup — all handled.'],
            ];
            @endphp
            @foreach($steps as $i => $s)
            <div class="card" style="padding:24px; {{ $i === 0 ? 'border-left:3px solid var(--accent);' : '' }}">
                <div style="width:32px; height:32px; border-radius:50%; background:{{ $i === 0 ? 'var(--accent)' : 'var(--bg-2)' }}; display:flex; align-items:center; justify-content:center; font-family:'JetBrains Mono',monospace; font-size:12px; margin-bottom:14px; color:{{ $i === 0 ? '#fff' : 'var(--ink)' }};">{{ $i+1 }}</div>
                <div class="eyebrow" style="margin-bottom:6px;">{{ $s['lbl'] }}</div>
                <h5 style="font-family:'Instrument Serif',serif; font-size:20px; font-weight:400; margin:0 0 8px; color:var(--ink);">{{ $s['t'] }}</h5>
                <p style="font-size:14px; line-height:1.55; color:var(--muted); margin:0;">{{ $s['body'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ── Apply CTA ───────────────────────────────────────────── --}}
<section style="background:var(--ink-deep); color:#fff; padding:64px 0;">
    <div class="wrap" style="display:grid; grid-template-columns:1fr 1fr; gap:60px; align-items:center;">
        <div>
            <div class="eyebrow" style="color:rgba(255,255,255,0.4); margin-bottom:12px;">07 · Apply now</div>
            <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(36px,4.5vw,60px); font-weight:400; margin:0; line-height:1;">Begin your<br><em style="color:var(--gold);">journey east.</em></h2>
            <p style="max-width:400px; margin-top:20px; color:rgba(255,255,255,0.75); font-size:16px; line-height:1.6;">
                One form. We take it from here — programme matching, scholarship shortlist and a counsellor's call within 48 hours.
            </p>
        </div>

        <form action="{{ route('enquiry.store') }}" method="POST" style="background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.1); padding:28px;">
            @csrf
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-bottom:14px;">
                <div>
                    <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.12em; color:rgba(255,255,255,0.45); margin-bottom:6px; text-transform:uppercase;">Full name</label>
                    <input name="name" required placeholder="e.g. Aishah Rahman" style="width:100%; background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.15); padding:10px 12px; color:#fff; font-size:14px; box-sizing:border-box; outline:none;" onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='rgba(255,255,255,0.15)'">
                </div>
                <div>
                    <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.12em; color:rgba(255,255,255,0.45); margin-bottom:6px; text-transform:uppercase;">Email</label>
                    <input type="email" name="email" required placeholder="you@example.com" style="width:100%; background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.15); padding:10px 12px; color:#fff; font-size:14px; box-sizing:border-box; outline:none;" onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='rgba(255,255,255,0.15)'">
                </div>
            </div>
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-bottom:14px;">
                <div>
                    <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.12em; color:rgba(255,255,255,0.45); margin-bottom:6px; text-transform:uppercase;">Destination</label>
                    <select name="destination" style="width:100%; background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.15); padding:10px 12px; color:#fff; font-size:14px; box-sizing:border-box; outline:none;">
                        <option value="China">China</option>
                        <option value="Malaysia">Malaysia</option>
                        <option value="Indonesia">Indonesia</option>
                        <option value="Undecided">Undecided</option>
                    </select>
                </div>
                <div>
                    <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.12em; color:rgba(255,255,255,0.45); margin-bottom:6px; text-transform:uppercase;">Level</label>
                    <select name="level" style="width:100%; background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.15); padding:10px 12px; color:#fff; font-size:14px; box-sizing:border-box; outline:none;">
                        <option>Diploma</option>
                        <option selected>Undergraduate</option>
                        <option>Postgraduate</option>
                        <option>Mandarin</option>
                        <option>Short-term</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn-primary" style="width:100%; justify-content:center; padding:13px;">Send enquiry →</button>
            <p style="margin:12px 0 0; font-size:12px; color:rgba(255,255,255,0.4); text-align:center;">Or chat on WhatsApp · +60 12 345 6789</p>
        </form>
    </div>
</section>

@endsection
