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
        use App\Models\Program;

        $levelMap = [
            'Diploma'          => 'DIPLOMA',
            'Undergraduate'    => 'UG',
            'Postgraduate'     => 'PG',
            'Mandarin Learning'=> 'MANDARIN',
            'Short-term'       => 'SHORT',
        ];
        $colorMap = [
            'DIPLOMA'  => ['#142a6e','#08164a'],
            'UG'       => ['#0a1f5e','#061240'],
            'PG'       => ['#a51717','#3d0808'],
            'MANDARIN' => ['#d18a2a','#5e3f10'],
            'SHORT'    => ['#1d4e3f','#0a2520'],
        ];

        $programmes = Program::where('status','active')
            ->orderBy('destination')->orderBy('level')->orderBy('name')
            ->get()
            ->map(function($p) use ($levelMap, $colorMap) {
                $levelCode = $levelMap[$p->level] ?? 'UG';
                $colors    = $colorMap[$levelCode] ?? ['#0a1f5e','#061240'];
                return [
                    'level'   => $levelCode,
                    'country' => strtoupper($p->destination),
                    'title'   => $p->name,
                    'uni'     => $p->university ?? '',
                    'city'    => $p->city ?? '',
                    'duration'=> $p->duration ?? '—',
                    'lang'    => $p->language ?? '—',
                    'intake'  => $p->intake ?? '—',
                    'tuition' => $p->tuition ?? '—',
                    'phA'     => $colors[0],
                    'phB'     => $colors[1],
                    'image'   => $p->image,
                    'url'     => null,
                ];
            })->toArray();

        $levelNames = ['DIPLOMA'=>'Diploma','UG'=>'Undergraduate','PG'=>'Postgraduate','MANDARIN'=>'Mandarin Learning','SHORT'=>'Short-term'];
        @endphp

        <div style="scroll-margin-top:90px;" x-data="{
            level: 'ALL',
            country: 'ALL',
            init() {
                const params = new URLSearchParams(window.location.search);
                const l = params.get('level');
                if (l) this.level = l;
            }
        }" id="prog-grid">
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

            @if(empty($programmes))
            <div style="text-align:center; padding:60px 0; color:var(--muted);">
                <div style="font-size:36px; margin-bottom:12px;">📚</div>
                <div style="font-family:'Instrument Serif',serif; font-size:22px; color:var(--ink); margin-bottom:8px;">No programmes yet</div>
                <div style="font-size:14px;">Programmes will appear here once added by the admin.</div>
            </div>
            @else
            <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:24px;">
                @foreach($programmes as $p)
                <div class="card" style="overflow:hidden;"
                     x-show="(level === 'ALL' || level === '{{ $p['level'] }}') && (country === 'ALL' || country === '{{ $p['country'] }}')">
                    <div style="height:160px; background:linear-gradient(135deg,{{ $p['phA'] }},{{ $p['phB'] }}); position:relative; overflow:hidden;">
                        @if(!empty($p['image']))
                        <img src="{{ asset('assets/'.$p['image']) }}" alt="{{ $p['title'] }}"
                             style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover;">
                        <div style="position:absolute; inset:0; background:linear-gradient(to top, rgba(0,0,0,0.55) 0%, transparent 55%);"></div>
                        @endif
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
                        <a href="{{ $p['url'] ?? '#' }}" {{ isset($p['url']) ? 'target="_blank" rel="noopener"' : '' }} style="font-size:12px; color:var(--accent); font-weight:500; text-decoration:none;">View details →</a>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
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
                <a href="{{ $applyUrl }}" class="btn-primary">Start application →</a>
                <a href="{{ route('application') }}" style="color:rgba(255,255,255,0.6); font-size:14px; text-decoration:underline; text-underline-offset:4px;">How it works →</a>
            </div>
        </div>
    </div>
</section>

@endsection
