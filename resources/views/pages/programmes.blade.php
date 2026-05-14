@extends('layouts.app')

@section('title', 'Programmes — ITEA EduAbroad')
@section('description', 'Browse 1,520+ programmes across Diploma, Undergraduate, Postgraduate, Mandarin and Short-term levels in China, Malaysia and Indonesia.')
@section('nav_logo', 'assets/logo.jpeg')
@section('content')

{{-- ── Hero ──────────────────────────────────────────────── --}}
<section style="background:var(--bg); border-bottom:1px solid var(--rule-soft); padding:48px 0;">
    <div class="wrap">
        <div style="display:flex; gap:8px; align-items:center; font-family:'JetBrains Mono',monospace; font-size:10.5px; letter-spacing:0.1em; color:var(--muted); margin-bottom:28px; text-transform:uppercase;">
            <a href="{{ route('home') }}" style="color:var(--muted); text-decoration:none;">Home</a>
            <span>/</span>
            <span style="color:var(--ink);">Programmes</span>
        </div>
        <div style="display:grid; grid-template-columns:1fr 420px; gap:48px; align-items:start;">
            <div>
                <div class="eyebrow" style="margin-bottom:10px;">02 · Programme directory</div>
                <h1 style="font-family:'Instrument Serif',serif; font-size:clamp(40px,5vw,68px); font-weight:400; line-height:0.95; letter-spacing:-0.02em; margin:0 0 18px;">Programmes for <em style="color:var(--accent);">every step</em> of your journey.</h1>
                <p style="font-size:17px; line-height:1.6; color:var(--muted); max-width:520px; margin:0;">From a 4-week summer camp in Beijing to a PhD in artificial intelligence — every ITEA programme is direct-listed by the host university and supported end-to-end by your counsellor.</p>
            </div>
            <div>
                {{-- Trending panel --}}
                <div style="background:var(--ink-deep); color:#fff; padding:20px;">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:14px;">
                        <span class="eyebrow" style="color:rgba(255,255,255,0.45);">Trending now</span>
                        <span style="display:flex; align-items:center; gap:5px; font-family:'JetBrains Mono',monospace; font-size:9px; color:rgba(255,255,255,0.45);">
                            <span style="width:6px; height:6px; border-radius:50%; background:#2fa86e; display:inline-block;"></span>
                            Live · May 2026
                        </span>
                    </div>
                    @php
                    $trending = [
                        ['title'=>'B.Sc. Computer Science','uni'=>'Tsinghua University','applicants'=>'+312 this week','phA'=>'#0a1f5e','phB'=>'#061240'],
                        ['title'=>'MBA — Global Asian Business','uni'=>'Monash University Malaysia','applicants'=>'+248 this week','phA'=>'#142a6e','phB'=>'#06133e'],
                        ['title'=>'Summer Cultural Camp · 4-week','uni'=>'Tsinghua + Beijing Tours','applicants'=>'+186 this week','phA'=>'#e8a93b','phB'=>'#7a5a16'],
                    ];
                    @endphp
                    @foreach($trending as $i => $t)
                    <div style="display:flex; gap:12px; align-items:center; padding:10px 0; border-bottom:1px solid rgba(255,255,255,0.07);">
                        <span style="font-family:'JetBrains Mono',monospace; font-size:13px; color:rgba(255,255,255,0.25); flex-shrink:0; width:20px;">{{ str_pad($i+1,2,'0',STR_PAD_LEFT) }}</span>
                        <div style="width:38px; height:38px; background:linear-gradient(135deg,{{ $t['phA'] }},{{ $t['phB'] }}); flex-shrink:0;"></div>
                        <div style="flex:1; min-width:0;">
                            <div style="font-size:13px; color:#fff; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ $t['title'] }}</div>
                            <div style="font-size:11px; color:rgba(255,255,255,0.4);">{{ $t['uni'] }} · {{ $t['applicants'] }}</div>
                        </div>
                        <span style="color:rgba(255,255,255,0.3); flex-shrink:0;">→</span>
                    </div>
                    @endforeach
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-top:12px; font-size:11px; color:rgba(255,255,255,0.35);">
                        <span>Updated hourly · ranked by enquiries</span>
                        <a href="#" style="color:var(--gold); text-decoration:none;">See top 25 →</a>
                    </div>
                </div>
                <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:0; border:1px solid var(--rule-soft); border-top:none;">
                    @foreach([['Programmes','1,520+','across 5 levels'],['Universities','300+','direct partners'],['Countries','3','live destinations']] as [$lbl,$num,$sub])
                    <div style="padding:14px 16px; border-right:1px solid var(--rule-soft); text-align:center;">
                        <div style="font-family:'JetBrains Mono',monospace; font-size:9px; letter-spacing:0.12em; text-transform:uppercase; color:var(--muted);">{{ $lbl }}</div>
                        <div style="font-family:'Instrument Serif',serif; font-size:26px; color:var(--ink); line-height:1;">{{ $num }}</div>
                        <div style="font-size:11px; color:var(--muted);">{{ $sub }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── Level overview ────────────────────────────────────── --}}
<section class="section" style="background:var(--paper);">
    <div class="wrap">
        <div class="eyebrow" style="margin-bottom:20px;">Browse by level</div>
        <div style="display:grid; grid-template-columns:repeat(5,1fr); gap:2px;">
            @php
            $levels = [
                ['id'=>'DIPLOMA','short'=>'Diploma','count'=>'220+ programmes','body'=>'1–3 year vocational and pre-university qualifications. Strong in Malaysia.','zh'=>'大专'],
                ['id'=>'UG','short'=>'Undergraduate','count'=>'480+ programmes','body'=>'Bachelor\'s degrees, 3–4 years. Engineering to liberal arts.','zh'=>'本科'],
                ['id'=>'PG','short'=>'Postgraduate','count'=>'380+ programmes','body'=>'Master\'s and PhD programmes. Strong research scholarships available.','zh'=>'研究生'],
                ['id'=>'MANDARIN','short'=>'Mandarin','count'=>'Online + 6 cities','body'=>'Free online HSK-aligned course, or full immersion in China.','zh'=>'汉语'],
                ['id'=>'SHORT','short'=>'Short-term','count'=>'40+ cohorts/year','body'=>'Two to eight week summer camps and study tours.','zh'=>'短期'],
            ];
            @endphp
            @foreach($levels as $i => $lvl)
            <div class="card" style="padding:24px; cursor:pointer;" onclick="document.getElementById('programme-filter').scrollIntoView({behavior:'smooth'})">
                <div style="font-family:'Noto Serif SC',serif; font-size:28px; color:var(--ink-2); opacity:0.25; margin-bottom:10px;">{{ $lvl['zh'] }}</div>
                <div class="eyebrow" style="margin-bottom:4px;">0{{ $i+1 }}</div>
                <h3 style="font-family:'Instrument Serif',serif; font-size:20px; font-weight:400; margin:0 0 4px; color:var(--ink);">{{ $lvl['short'] }}</h3>
                <div class="eyebrow" style="color:var(--accent); margin-bottom:8px;">{{ $lvl['count'] }}</div>
                <p style="font-size:13px; line-height:1.5; color:var(--muted); margin:0 0 10px;">{{ $lvl['body'] }}</p>
                <span style="font-size:12px; color:var(--accent);">Browse {{ $lvl['short'] }} →</span>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Filter bar anchor for scroll --}}
<div id="programme-filter"></div>

{{-- Programmes section --}}
<section class="section" style="background:var(--bg-2);">
    <div class="wrap">
        @php
        $programmes = [
            ['level'=>'UG','country'=>'CHINA','title'=>'B.Sc. in Computer Science & Technology','uni'=>'Tsinghua University','city'=>'Beijing','duration'=>'4 years','lang'=>'English / 中文','intake'=>'September','tuition'=>'RMB 30,000 / yr','phA'=>'#0a1f5e','phB'=>'#061240'],
            ['level'=>'PG','country'=>'CHINA','title'=>'M.A. in International Relations','uni'=>'Peking University','city'=>'Beijing','duration'=>'2 years','lang'=>'English','intake'=>'September','tuition'=>'RMB 38,000 / yr','phA'=>'#a51717','phB'=>'#3d0808'],
            ['level'=>'DIPLOMA','country'=>'MALAYSIA','title'=>'Diploma in Hospitality Management','uni'=>'Taylor\'s University','city'=>'Subang Jaya','duration'=>'2.5 years','lang'=>'English','intake'=>'Jan / May / Aug','tuition'=>'RM 38,000 total','phA'=>'#142a6e','phB'=>'#08164a'],
            ['level'=>'UG','country'=>'MALAYSIA','title'=>'B.B.A. in International Business','uni'=>'Universiti Malaya','city'=>'Kuala Lumpur','duration'=>'4 years','lang'=>'English','intake'=>'September','tuition'=>'RM 21,000 / yr','phA'=>'#0a1f5e','phB'=>'#061240'],
            ['level'=>'PG','country'=>'CHINA','title'=>'Master of Civil Engineering','uni'=>'Zhejiang University','city'=>'Hangzhou','duration'=>'3 years','lang'=>'English','intake'=>'September','tuition'=>'RMB 32,000 / yr','phA'=>'#a01a1a','phB'=>'#3c0a0a'],
            ['level'=>'MANDARIN','country'=>'CHINA','title'=>'Chinese Language Programme — HSK 1 to 6','uni'=>'Beijing Language and Culture University','city'=>'Beijing','duration'=>'1 semester +','lang'=>'中文','intake'=>'Mar / Sep','tuition'=>'RMB 11,600 / sem','phA'=>'#c98a1d','phB'=>'#5e3f10'],
            ['level'=>'UG','country'=>'CHINA','title'=>'B.Eng. in Mechanical Engineering','uni'=>'Shanghai Jiao Tong University','city'=>'Shanghai','duration'=>'4 years','lang'=>'English','intake'=>'September','tuition'=>'RMB 28,000 / yr','phA'=>'#891414','phB'=>'#330606'],
            ['level'=>'PG','country'=>'CHINA','title'=>'Ph.D. in Artificial Intelligence','uni'=>'Fudan University','city'=>'Shanghai','duration'=>'4 years','lang'=>'English','intake'=>'September','tuition'=>'Full scholarship','phA'=>'#bb2424','phB'=>'#420c0c'],
            ['level'=>'UG','country'=>'MALAYSIA','title'=>'Bachelor of Architecture','uni'=>'Universiti Putra Malaysia','city'=>'Selangor','duration'=>'4 years','lang'=>'English','intake'=>'September','tuition'=>'RM 18,200 / yr','phA'=>'#0c2670','phB'=>'#061240'],
            ['level'=>'SHORT','country'=>'CHINA','title'=>'4-week Summer Cultural Camp','uni'=>'Tsinghua + Beijing Tours','city'=>'Beijing','duration'=>'4 weeks','lang'=>'English / 中文','intake'=>'July / Aug','tuition'=>'USD 2,400','phA'=>'#e8a93b','phB'=>'#7a5a16'],
            ['level'=>'MANDARIN','country'=>'CHINA','title'=>'Intensive 8-Week Mandarin Immersion','uni'=>'Shanghai Jiao Tong University','city'=>'Shanghai','duration'=>'8 weeks','lang'=>'中文','intake'=>'Rolling','tuition'=>'USD 1,800','phA'=>'#d18a2a','phB'=>'#5e3f10'],
            ['level'=>'SHORT','country'=>'MALAYSIA','title'=>'2-week Customised University Sit-in','uni'=>'Sunway / Monash / Taylor\'s','city'=>'Selangor','duration'=>'2 weeks','lang'=>'English','intake'=>'Custom','tuition'=>'On request','phA'=>'#1d4e3f','phB'=>'#0a2520'],
        ];
        $levelNames = ['DIPLOMA'=>'Diploma','UG'=>'Undergraduate','PG'=>'Postgraduate','MANDARIN'=>'Mandarin','SHORT'=>'Short-term'];
        @endphp

        <div x-data="{ level: 'ALL', country: 'ALL' }" id="prog-grid">
            <div style="display:flex; gap:8px; flex-wrap:wrap; align-items:center; margin-bottom:24px;">
                <span class="eyebrow" style="margin-right:4px;">Level</span>
                @foreach(['ALL'=>'All','DIPLOMA'=>'Diploma','UG'=>'Undergraduate','PG'=>'Postgraduate','MANDARIN'=>'Mandarin','SHORT'=>'Short-term'] as $val => $lbl)
                <button @click="level = '{{ $val }}'"
                        class="uni-chip"
                        :class="level === '{{ $val }}' ? 'is-on' : ''">{{ $lbl }}</button>
                @endforeach

                <span style="width:1px; height:20px; background:var(--rule-soft); margin:0 4px;"></span>

                <span class="eyebrow" style="margin-right:4px;">Country</span>
                @foreach(['ALL'=>'All','CHINA'=>'China','MALAYSIA'=>'Malaysia','INDONESIA'=>'Indonesia'] as $val => $lbl)
                <button @click="country = '{{ $val }}'"
                        class="uni-chip"
                        :class="country === '{{ $val }}' ? 'is-on' : ''">{{ $lbl }}</button>
                @endforeach
            </div>

            <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:24px;">
                @foreach($programmes as $p)
                <div class="card" style="overflow:hidden;"
                     x-show="(level === 'ALL' || level === '{{ $p['level'] }}') && (country === 'ALL' || country === '{{ $p['country'] }}')">
                    <div style="height:160px; background:linear-gradient(135deg,{{ $p['phA'] }},{{ $p['phB'] }}); position:relative;">
                        <span style="position:absolute; top:8px; left:8px; background:rgba(0,0,0,0.5); color:rgba(255,255,255,0.9); font-family:'JetBrains Mono',monospace; font-size:9px; letter-spacing:0.1em; padding:3px 7px; text-transform:uppercase;">{{ $levelNames[$p['level']] ?? $p['level'] }}</span>
                    </div>
                    <div style="padding:16px;">
                        <div class="eyebrow" style="margin-bottom:4px;">{{ $p['country'] }}</div>
                        <h4 style="font-family:'Instrument Serif',serif; font-size:16px; font-weight:400; margin:0 0 3px; color:var(--ink); line-height:1.25;">{{ $p['title'] }}</h4>
                        <div style="font-size:12px; color:var(--muted); margin-bottom:10px;">{{ $p['uni'] }} · {{ $p['city'] }}</div>
                        <div style="display:grid; grid-template-columns:1fr 1fr; gap:6px; font-size:11px; color:var(--muted); margin-bottom:10px;">
                            <div><span style="display:block; font-family:'JetBrains Mono',monospace; font-size:9px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:2px;">Duration</span>{{ $p['duration'] }}</div>
                            <div><span style="display:block; font-family:'JetBrains Mono',monospace; font-size:9px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:2px;">Language</span>{{ $p['lang'] }}</div>
                            <div><span style="display:block; font-family:'JetBrains Mono',monospace; font-size:9px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:2px;">Intake</span>{{ $p['intake'] }}</div>
                            <div><span style="display:block; font-family:'JetBrains Mono',monospace; font-size:9px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:2px;">Tuition</span>{{ $p['tuition'] }}</div>
                        </div>
                        <a href="#" style="font-size:12px; color:var(--accent); font-weight:500; text-decoration:none;">View details →</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ── ITEA Learning / HSK ─────────────────────────────────── --}}
<section class="section" style="background:var(--ink-deep); color:#fff;">
    <div class="wrap" style="display:grid; grid-template-columns:1fr 420px; gap:60px; align-items:center;">
        <div>
            <div class="eyebrow" style="color:rgba(255,255,255,0.4); margin-bottom:12px;">04 · ITEA Learning</div>
            <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(28px,3.5vw,42px); font-weight:400; margin:0 0 16px; line-height:1;">Start Mandarin <em style="color:var(--gold);">before you fly.</em></h2>
            <p style="font-size:16px; line-height:1.65; color:rgba(255,255,255,0.75); margin:0 0 24px; max-width:460px;">Twelve free, HSK-aligned online levels — built by ITEA's own instructors and the Beijing Language &amp; Culture University. Continue in-country at any of our six partner language schools.</p>
            <div style="display:flex; gap:28px; margin-bottom:28px;">
                @foreach([['12','HSK-aligned levels'],['240+','Video lessons'],['Free','For ITEA students']] as [$n,$l])
                <div>
                    <div style="font-family:'Instrument Serif',serif; font-size:28px; color:#fff;">{{ $n }}</div>
                    <div style="font-size:12px; color:rgba(255,255,255,0.5);">{{ $l }}</div>
                </div>
                @endforeach
            </div>
            <div style="display:flex; gap:12px; flex-wrap:wrap;">
                <a href="#" class="btn-primary" style="background:var(--gold); color:var(--ink);">Start free trial →</a>
                <a href="{{ route('china') }}" style="color:rgba(255,255,255,0.7); font-size:14px; text-decoration:underline; text-underline-offset:4px; align-self:center;">Study Mandarin in China →</a>
            </div>
        </div>
        <div style="background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.1); padding:24px;">
            <div class="eyebrow" style="color:rgba(255,255,255,0.35); margin-bottom:14px;">Online curriculum · Pre-departure</div>
            @php
            $hsk = [
                ['HSK 1','Beginner','150 words · Survival Chinese','20 hrs',16],
                ['HSK 2','Elementary','300 words · Everyday topics','30 hrs',32],
                ['HSK 3','Intermediate','600 words · Study / work','45 hrs',48],
                ['HSK 4','Upper-intermediate','1,200 words · Discussion','60 hrs',64],
                ['HSK 5','Advanced','2,500 words · Media literate','80 hrs',80],
                ['HSK 6','Fluent','5,000+ words · Native-near','100 hrs',100],
            ];
            @endphp
            @foreach($hsk as [$lvl,$name,$sub,$dur,$fill])
            <div style="display:flex; align-items:center; gap:10px; padding:8px 0; border-bottom:1px solid rgba(255,255,255,0.06);">
                <span style="font-family:'JetBrains Mono',monospace; font-size:9.5px; color:var(--gold); width:38px; flex-shrink:0;">{{ $lvl }}</span>
                <div style="flex:1; min-width:0;">
                    <div style="font-size:12px; color:#fff;">{{ $name }} <small style="color:rgba(255,255,255,0.4); font-size:10px;">{{ $sub }}</small></div>
                    <div style="height:3px; background:rgba(255,255,255,0.1); margin-top:4px; border-radius:2px; overflow:hidden;">
                        <div style="height:100%; width:{{ $fill }}%; background:var(--gold); border-radius:2px;"></div>
                    </div>
                </div>
                <span style="font-family:'JetBrains Mono',monospace; font-size:9px; color:rgba(255,255,255,0.4); flex-shrink:0;">{{ $dur }}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ── Dual CTA ────────────────────────────────────────────── --}}
<section class="section" style="background:var(--bg-2);">
    <div class="wrap" style="display:grid; grid-template-columns:1fr 1fr; gap:2px;">
        <div class="card" style="padding:36px;">
            <div class="eyebrow" style="margin-bottom:10px;">Not sure which programme?</div>
            <h3 style="font-family:'Instrument Serif',serif; font-size:28px; font-weight:400; margin:0 0 14px; color:var(--ink);">Book a 30-minute consultation.</h3>
            <p style="font-size:15px; line-height:1.6; color:var(--muted); margin:0 0 22px;">One free call with a counsellor — usually scheduled within 48 hours. We'll shortlist 3–5 programmes that fit your profile and budget.</p>
            <div style="display:flex; gap:14px; align-items:center;">
                <a href="{{ route('contact') }}" class="btn-primary">Book consultation →</a>
                <a href="https://wa.me/60123456789" target="_blank" rel="noopener" style="color:var(--muted); font-size:14px; text-decoration:underline; text-underline-offset:4px;">Or WhatsApp us</a>
            </div>
        </div>
        <div style="background:var(--ink-deep); color:#fff; padding:36px;">
            <div class="eyebrow" style="color:rgba(255,255,255,0.4); margin-bottom:10px;">Ready to apply?</div>
            <h3 style="font-family:'Instrument Serif',serif; font-size:28px; font-weight:400; margin:0 0 14px; color:#fff;">One form, every university.</h3>
            <p style="font-size:15px; line-height:1.6; color:rgba(255,255,255,0.7); margin:0 0 22px;">Submit a single ITEA application and we forward it to all your chosen universities — diploma to PhD. Track everything from your dashboard.</p>
            <div style="display:flex; gap:14px; align-items:center;">
                <a href="{{ route('application') }}#apply" class="btn-primary">Start application →</a>
                <a href="{{ route('application') }}" style="color:rgba(255,255,255,0.6); font-size:14px; text-decoration:underline; text-underline-offset:4px;">How it works →</a>
            </div>
        </div>
    </div>
</section>

@endsection
