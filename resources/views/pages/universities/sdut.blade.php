@extends('layouts.app')
@section('title', 'SDUT — Shandong University of Technology | ITEA EduAbroad')
@section('description', 'Study at Shandong University of Technology (SDUT) in Zibo, China. Strong engineering programmes, affordable tuition, CSC scholarships available.')
@section('nav_logo', 'assets/logo-china.png')

@section('content')

<section style="background:var(--ink-deep); color:#fff; padding:72px 0 0; position:relative; overflow:hidden;">
    <div style="position:absolute; inset:0; background:linear-gradient(135deg,#34526e,#1a2a3e); opacity:0.95;"></div>
    @if(file_exists(public_path('assets/sdut.jpg')))
    <div style="position:absolute; inset:0; background:url('{{ asset('assets/sdut.jpg') }}') center/cover no-repeat; opacity:0.12;"></div>
    @endif

    <div class="wrap" style="position:relative;">
        <div style="display:flex; align-items:center; gap:8px; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:rgba(255,255,255,0.4); margin-bottom:28px; flex-wrap:wrap;">
            <a href="{{ route('home') }}" style="color:inherit; text-decoration:none;">Home</a>
            <span>·</span>
            <a href="{{ route('china') }}" style="color:inherit; text-decoration:none;">Study in China</a>
            <span>·</span>
            <span style="color:rgba(255,255,255,0.7);">SDUT</span>
        </div>

        <div style="display:grid; grid-template-columns:1fr 300px; gap:48px; align-items:end; padding-bottom:48px;" class="sdut-hero-grid">
            <div>
                <div style="display:inline-flex; align-items:center; gap:8px; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:rgba(255,255,255,0.5); border:1px solid rgba(255,255,255,0.15); padding:4px 12px; border-radius:999px; margin-bottom:20px;">
                    Public University · Zibo, Shandong
                </div>
                <h1 style="font-family:'Instrument Serif',serif; font-size:clamp(28px,4vw,56px); font-weight:400; margin:0 0 6px; line-height:1.05;">Shandong University of<br><em style="color:#7eb8e8;">Technology</em></h1>
                <div class="zh" style="font-size:20px; color:rgba(255,255,255,0.25); margin-bottom:20px;">山东理工大学 · SDUT</div>
                <p style="font-size:15px; line-height:1.65; color:rgba(255,255,255,0.65); max-width:560px; margin:0 0 28px;">A leading engineering university in Zibo, Shandong — known for strong laboratory infrastructure and deep industry collaboration. 34,000 students, 1,000 international, offering affordable tuition with high academic quality.</p>
                <div style="display:flex; gap:12px; flex-wrap:wrap;">
                    <a href="#apply" class="btn-primary">Apply to SDUT →</a>
                    <a href="#programmes" style="color:rgba(255,255,255,0.7); font-size:13px; font-family:'JetBrains Mono',monospace; letter-spacing:0.06em; text-decoration:underline; text-underline-offset:4px; align-self:center;">View programmes ↓</a>
                </div>
            </div>

            <div style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1); padding:24px;">
                <div style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:rgba(255,255,255,0.4); margin-bottom:16px;">At a glance</div>
                @php $facts = [
                    ['label'=>'Founded',                'val'=>'1956'],
                    ['label'=>'Total students',         'val'=>'34,000'],
                    ['label'=>'International students', 'val'=>'1,000'],
                    ['label'=>'Campus',                 'val'=>'Zibo · Shandong'],
                    ['label'=>'Tuition from',          'val'=>'USD 2,500/yr'],
                    ['label'=>'Scholarship',            'val'=>'CSC available'],
                ]; @endphp
                @foreach($facts as $i => $f)
                <div style="display:flex; justify-content:space-between; padding:8px 0; {{ $i < count($facts)-1 ? 'border-bottom:1px solid rgba(255,255,255,0.07);' : '' }}">
                    <span style="font-size:12px; color:rgba(255,255,255,0.45);">{{ $f['label'] }}</span>
                    <span style="font-size:13px; font-weight:500; color:#fff;">{{ $f['val'] }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <div x-data="{ tab: 'overview' }" id="tabs" style="position:relative;">
            <div style="display:flex; gap:0; border-top:1px solid rgba(255,255,255,0.1); overflow-x:auto;" class="sdut-tab-nav">
                @php $tabs = [
                    ['id'=>'overview',      'label'=>'Overview'],
                    ['id'=>'programmes',    'label'=>'Programmes'],
                    ['id'=>'admission',     'label'=>'Admission'],
                    ['id'=>'fees',          'label'=>'Tuition & Fees'],
                    ['id'=>'accommodation', 'label'=>'Accommodation'],
                    ['id'=>'scholarships',  'label'=>'Scholarships'],
                ]; @endphp
                @foreach($tabs as $t)
                <button @click="tab = '{{ $t['id'] }}'"
                    :class="tab === '{{ $t['id'] }}' ? 'sdut-tab-active' : ''"
                    class="sdut-tab" style="flex-shrink:0;">
                    {{ $t['label'] }}
                </button>
                @endforeach
            </div>

            {{-- OVERVIEW --}}
            <div x-show="tab === 'overview'" style="background:var(--paper); color:var(--ink);">
                <div class="wrap sdut-2col" style="display:grid; grid-template-columns:1fr 1fr; gap:48px; padding-top:48px; padding-bottom:48px;">
                    <div>
                        <div class="eyebrow" style="margin-bottom:12px;">About SDUT</div>
                        <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(22px,2.5vw,32px); font-weight:400; margin:0 0 16px;">Engineering excellence,<br><em style="color:var(--accent);">industry-connected.</em></h2>
                        <p style="font-size:14px; line-height:1.75; color:var(--muted); margin:0 0 16px;">Founded in 1956, Shandong University of Technology has grown into one of Shandong Province's leading comprehensive universities, with particular strength in engineering, science and management disciplines.</p>
                        <p style="font-size:14px; line-height:1.75; color:var(--muted); margin:0 0 24px;">Located in Zibo — a dynamic industrial city with strong ties to manufacturing, energy and chemical sectors — SDUT graduates enjoy exceptional employment prospects and industry connections.</p>
                        <div style="background:var(--bg); padding:20px; border-left:3px solid var(--accent);">
                            <div style="font-size:13px; font-weight:500; color:var(--ink); margin-bottom:6px;">"Strong laboratory infrastructure and industry collaboration"</div>
                            <div style="font-size:12px; color:var(--muted);">Modern campus facilities with state-of-the-art engineering labs and research centres.</div>
                        </div>
                    </div>
                    <div>
                        <div class="eyebrow" style="margin-bottom:12px;">Popular fields of study</div>
                        @php $majors = [
                            ['name'=>'Mechanical Engineering',         'tag'=>'Flagship'],
                            ['name'=>'Electrical Engineering',         'tag'=>'English'],
                            ['name'=>'Computer Science',               'tag'=>'English'],
                            ['name'=>'Chemical Engineering',           'tag'=>'Flagship'],
                            ['name'=>'International Economics & Trade','tag'=>'English'],
                            ['name'=>'Civil Engineering',              'tag'=>''],
                            ['name'=>'Materials Science',              'tag'=>''],
                            ['name'=>'Energy Engineering',             'tag'=>''],
                        ]; @endphp
                        <div style="display:flex; flex-direction:column; gap:2px;">
                            @foreach($majors as $m)
                            <div style="display:flex; justify-content:space-between; align-items:center; padding:11px 14px; background:var(--bg);">
                                <span style="font-size:14px; color:var(--ink);">{{ $m['name'] }}</span>
                                @if($m['tag'])
                                <span style="font-family:'JetBrains Mono',monospace; font-size:9px; letter-spacing:0.08em; text-transform:uppercase; color:var(--accent);">{{ $m['tag'] }}</span>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- PROGRAMMES --}}
            <div x-show="tab === 'programmes'" id="programmes" style="background:var(--bg); color:var(--ink);">
                <div class="wrap" style="padding-top:48px; padding-bottom:48px;">
                    <div x-data="{ ptype: 'ug_en' }">
                        <div style="display:flex; gap:8px; flex-wrap:wrap; margin-bottom:32px;">
                            @php $ptypes = [
                                ['id'=>'ug_en',  'label'=>'Undergrad · English'],
                                ['id'=>'ug_zh',  'label'=>'Undergrad · Chinese'],
                                ['id'=>'pg_en',  'label'=>'Postgrad · English'],
                                ['id'=>'pg_zh',  'label'=>'Postgrad · Chinese'],
                            ]; @endphp
                            @foreach($ptypes as $pt)
                            <button @click="ptype = '{{ $pt['id'] }}'" :class="ptype === '{{ $pt['id'] }}' ? 'is-on' : ''" class="uni-chip">{{ $pt['label'] }}</button>
                            @endforeach
                        </div>

                        <div x-show="ptype === 'ug_en'">
                            <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:2px;" class="sdut-prog-grid">
                                @php $ug_en = ['Mechanical Engineering','Electrical Engineering','Computer Science','Chemical Engineering','International Economics & Trade','Civil Engineering','Materials Science','Environmental Engineering','Business Administration','Mathematics','Energy Engineering','Industrial Engineering']; @endphp
                                @foreach($ug_en as $prog)
                                <div class="card" style="padding:20px;">
                                    <div style="font-size:15px; font-weight:500; color:var(--ink); margin-bottom:8px;">{{ $prog }}</div>
                                    <span style="font-family:'JetBrains Mono',monospace; font-size:10px; color:var(--accent);">English · 4 yrs · USD 2,500–4,000/yr</span>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div x-show="ptype === 'ug_zh'">
                            <div style="background:var(--paper); border:1px solid var(--rule-soft); padding:16px 20px; margin-bottom:16px; font-size:13px; color:var(--muted);">
                                <strong style="color:var(--ink);">Chinese-taught undergraduate programmes.</strong> Prerequisite: HSK Level 4.
                            </div>
                            <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:2px;" class="sdut-prog-grid">
                                @php $ug_zh = ['Mechanical Engineering','Electrical Engineering','Civil Engineering','Chemical Engineering','Computer Science','Software Engineering','Materials Science','Environmental Engineering','Business Administration','Accounting','Finance','Marketing','International Trade','Law','Chinese Language','Logistics Management','Energy Engineering','Food Science','Industrial Design','Urban Planning']; @endphp
                                @foreach($ug_zh as $prog)
                                <div class="card" style="padding:16px;">
                                    <div style="font-size:14px; color:var(--ink); margin-bottom:4px;">{{ $prog }}</div>
                                    <span style="font-family:'JetBrains Mono',monospace; font-size:9px; color:var(--muted); text-transform:uppercase; letter-spacing:0.08em;">Mandarin · 4 yrs</span>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div x-show="ptype === 'pg_en'">
                            <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:2px;" class="sdut-prog-grid">
                                @php $pg_en = ['Mechanical Engineering (MSc)','Electrical Engineering (MSc)','Computer Science (MSc)','Chemical Engineering (MSc)','Civil Engineering (MSc)','Materials Science (MSc)','Business Administration (MBA)','Environmental Engineering (MSc)']; @endphp
                                @foreach($pg_en as $prog)
                                <div class="card" style="padding:20px;">
                                    <div style="font-size:15px; font-weight:500; color:var(--ink); margin-bottom:8px;">{{ $prog }}</div>
                                    <span style="font-family:'JetBrains Mono',monospace; font-size:10px; color:var(--accent);">English · 2–3 yrs · USD 3,000–4,500/yr</span>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div x-show="ptype === 'pg_zh'">
                            <div style="background:var(--paper); border:1px solid var(--rule-soft); padding:16px 20px; margin-bottom:16px; font-size:13px; color:var(--muted);">
                                <strong style="color:var(--ink);">Chinese-taught postgraduate programmes.</strong> Prerequisite: HSK Level 5+.
                            </div>
                            <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:2px;" class="sdut-prog-grid">
                                @php $pg_zh = ['Mechanical Engineering (PhD/MSc)','Chemical Engineering (MSc)','Computer Science (MSc)','Civil Engineering (MSc)','Materials Science (MSc)','Business Administration (MBA)','Environmental Engineering (MSc)']; @endphp
                                @foreach($pg_zh as $prog)
                                <div class="card" style="padding:16px;">
                                    <div style="font-size:14px; color:var(--ink); margin-bottom:4px;">{{ $prog }}</div>
                                    <span style="font-family:'JetBrains Mono',monospace; font-size:9px; color:var(--muted); text-transform:uppercase; letter-spacing:0.08em;">Mandarin</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ADMISSION --}}
            <div x-show="tab === 'admission'" style="background:var(--paper); color:var(--ink);">
                <div class="wrap" style="padding-top:48px; padding-bottom:48px;">
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:32px;" class="sdut-2col">
                        <div>
                            <div class="eyebrow" style="margin-bottom:14px;">Academic requirements</div>
                            <div style="display:flex; flex-direction:column; gap:2px;">
                                @php $reqs = [
                                    ['level'=>'Undergraduate','req'=>'High school diploma / SPM / A-Level or equivalent. Minimum age 17.'],
                                    ['level'=>'Postgraduate (MSc)','req'=>'Bachelor\'s degree in a relevant field. CGPA 3.0+ preferred.'],
                                    ['level'=>'PhD','req'=>'Master\'s degree in relevant field. Research proposal required.'],
                                ]; @endphp
                                @foreach($reqs as $r)
                                <div style="padding:16px; background:var(--bg);">
                                    <div style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.08em; text-transform:uppercase; color:var(--accent); margin-bottom:6px;">{{ $r['level'] }}</div>
                                    <div style="font-size:13px; line-height:1.6; color:var(--ink);">{{ $r['req'] }}</div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div>
                            <div class="eyebrow" style="margin-bottom:14px;">Language requirements</div>
                            <div style="display:flex; flex-direction:column; gap:2px; margin-bottom:24px;">
                                <div style="padding:16px; background:var(--bg);">
                                    <div style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.08em; color:var(--accent); text-transform:uppercase; margin-bottom:6px;">English-taught programmes</div>
                                    <div style="font-size:13px; color:var(--ink);">IELTS ≥ 5.5 &nbsp;·&nbsp; TOEFL ≥ 70 &nbsp;·&nbsp; or equivalent</div>
                                </div>
                                <div style="padding:16px; background:var(--bg);">
                                    <div style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.08em; color:var(--accent); text-transform:uppercase; margin-bottom:6px;">Chinese-taught programmes</div>
                                    <div style="font-size:13px; color:var(--ink);">HSK Level 4 &nbsp;·&nbsp; score ≥ 180 points</div>
                                </div>
                            </div>
                            <div class="eyebrow" style="margin-bottom:14px;">Required documents</div>
                            <div style="display:flex; flex-direction:column; gap:6px;">
                                @php $docs = ['Valid passport (18+ months)','Academic transcripts (all levels)','Highest qualification certificate','Language test certificate (IELTS/TOEFL/HSK)','Personal statement','Passport-size photos (2)','Physical examination report','No criminal record certificate']; @endphp
                                @foreach($docs as $doc)
                                <div style="display:flex; align-items:center; gap:10px; font-size:13px; color:var(--ink);">
                                    <span style="color:#2fa86e; flex-shrink:0;">✓</span> {{ $doc }}
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div style="margin-top:32px; display:grid; grid-template-columns:1fr 1fr; gap:2px;" class="sdut-2col">
                        <div style="background:var(--ink-deep); color:#fff; padding:24px;">
                            <div class="eyebrow" style="color:rgba(255,255,255,0.4); margin-bottom:8px;">September Intake</div>
                            <div style="font-family:'Instrument Serif',serif; font-size:24px; margin-bottom:6px;">Sep 2026</div>
                            <div style="font-size:13px; color:rgba(255,255,255,0.6);">Application deadline: <strong style="color:#fff;">30 June 2026</strong></div>
                        </div>
                        <div style="background:var(--bg); border:1px solid var(--rule-soft); padding:24px;">
                            <div class="eyebrow" style="margin-bottom:8px;">March Intake</div>
                            <div style="font-family:'Instrument Serif',serif; font-size:24px; margin-bottom:6px;">Mar 2027</div>
                            <div style="font-size:13px; color:var(--muted);">Application deadline: <strong style="color:var(--ink);">30 November 2026</strong></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TUITION & FEES --}}
            <div x-show="tab === 'fees'" style="background:var(--bg); color:var(--ink);">
                <div class="wrap" style="padding-top:48px; padding-bottom:48px;">
                    <div style="display:grid; grid-template-columns:2fr 1fr; gap:32px; align-items:start;" class="sdut-2col">
                        <div>
                            <div class="eyebrow" style="margin-bottom:16px;">Annual tuition fees (USD)</div>
                            <div style="border:1px solid var(--rule-soft); overflow:hidden;">
                                <div style="display:grid; grid-template-columns:1fr 1fr 1fr; background:var(--ink-deep); color:#fff; padding:12px 16px;">
                                    <div style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.08em; text-transform:uppercase;">Programme</div>
                                    <div style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.08em; text-transform:uppercase;">Language</div>
                                    <div style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.08em; text-transform:uppercase;">Fee / Year</div>
                                </div>
                                @php $fees = [
                                    ['prog'=>'Undergraduate','lang'=>'English','fee'=>'USD 2,500 – 4,000'],
                                    ['prog'=>'Undergraduate','lang'=>'Chinese','fee'=>'USD 2,000 – 3,500'],
                                    ['prog'=>'Postgraduate (MSc)','lang'=>'English','fee'=>'USD 3,000 – 4,500'],
                                    ['prog'=>'Postgraduate (MSc)','lang'=>'Chinese','fee'=>'USD 2,500 – 4,000'],
                                ]; @endphp
                                @foreach($fees as $i => $f)
                                <div style="display:grid; grid-template-columns:1fr 1fr 1fr; padding:12px 16px; {{ $i % 2 === 0 ? 'background:var(--paper);' : 'background:var(--bg);' }} border-top:1px solid var(--rule-soft);">
                                    <div style="font-size:13px; color:var(--ink);">{{ $f['prog'] }}</div>
                                    <div style="font-size:13px; color:var(--muted);">{{ $f['lang'] }}</div>
                                    <div style="font-size:13px; font-weight:500; color:var(--ink);">{{ $f['fee'] }}</div>
                                </div>
                                @endforeach
                            </div>
                            <p style="font-size:12px; color:var(--muted); margin-top:10px;">* Fees are indicative. Contact ITEA for confirmed figures before applying.</p>
                        </div>
                        <div>
                            <div class="eyebrow" style="margin-bottom:14px;">Cost of living · Zibo</div>
                            <div style="display:flex; flex-direction:column; gap:2px;">
                                @php $living = [['Accommodation','RMB 500–1,200/mo'],['Meals (campus)','RMB 400–600/mo'],['Transport','RMB 100–150/mo'],['Books & materials','RMB 150–300/mo'],['Personal expenses','RMB 400–600/mo'],['Total estimate','RMB 1,550–2,850/mo']]; @endphp
                                @foreach($living as $i => $l)
                                <div style="display:flex; justify-content:space-between; padding:10px 14px; {{ $i === count($living)-1 ? 'background:var(--ink-deep); color:#fff;' : 'background:var(--paper);' }}">
                                    <span style="font-size:13px;">{{ $l[0] }}</span>
                                    <span style="font-size:13px; font-weight:500;">{{ $l[1] }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ACCOMMODATION --}}
            <div x-show="tab === 'accommodation'" style="background:var(--paper); color:var(--ink);">
                <div class="wrap" style="padding-top:48px; padding-bottom:48px;">
                    <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:2px; margin-bottom:24px;" class="sdut-prog-grid">
                        @php $rooms = [
                            ['type'=>'Double Room','price'=>'RMB 500–800/mo per person','note'=>'Shared with one roommate. Standard furnishings included.','tag'=>'Most popular'],
                            ['type'=>'Single Room','price'=>'RMB 800–1,200/mo','note'=>'Private room. Limited availability — apply early to secure.','tag'=>'Limited'],
                            ['type'=>'Deposit','price'=>'RMB 1,000','note'=>'One-time refundable deposit payable upon check-in.','tag'=>'Refundable'],
                        ]; @endphp
                        @foreach($rooms as $r)
                        <div class="card" style="padding:24px;">
                            <div style="font-family:'JetBrains Mono',monospace; font-size:9px; letter-spacing:0.1em; text-transform:uppercase; color:var(--accent); margin-bottom:8px;">{{ $r['tag'] }}</div>
                            <h3 style="font-family:'Instrument Serif',serif; font-size:20px; font-weight:400; margin:0 0 6px; color:var(--ink);">{{ $r['type'] }}</h3>
                            <div style="font-family:'Instrument Serif',serif; font-size:22px; color:var(--accent); margin-bottom:10px;">{{ $r['price'] }}</div>
                            <p style="font-size:13px; line-height:1.6; color:var(--muted); margin:0;">{{ $r['note'] }}</p>
                        </div>
                        @endforeach
                    </div>
                    <div style="background:var(--bg); padding:20px 24px; border-left:3px solid var(--accent); font-size:13px; color:var(--muted); line-height:1.65;">
                        International student dormitories are on campus. All rooms include WiFi and air conditioning. Canteen, gymnasium, library and medical clinic available on campus.
                    </div>
                </div>
            </div>

            {{-- SCHOLARSHIPS --}}
            <div x-show="tab === 'scholarships'" style="background:var(--bg); color:var(--ink);">
                <div class="wrap" style="padding-top:48px; padding-bottom:48px;">
                    <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:2px; margin-bottom:32px;" class="sdut-prog-grid">
                        @php $schols = [
                            ['name'=>'Chinese Government Scholarship (CSC)','coverage'=>'Full-ride','detail'=>'Covers tuition, accommodation, monthly stipend and medical insurance. Apply through ITEA for full support.','tag'=>'Full-ride'],
                            ['name'=>'Shandong Provincial Scholarship','coverage'=>'Partial','detail'=>'Provincial government award covering partial tuition. Available to students with strong academic records.','tag'=>'Partial'],
                            ['name'=>'SDUT University Scholarship','coverage'=>'Partial – Full','detail'=>'University-level merit award renewable annually based on academic performance.','tag'=>'Merit'],
                        ]; @endphp
                        @foreach($schols as $s)
                        <div class="card" style="padding:24px;">
                            <div style="font-family:'JetBrains Mono',monospace; font-size:9px; letter-spacing:0.1em; text-transform:uppercase; color:var(--accent); margin-bottom:8px;">{{ $s['tag'] }}</div>
                            <h3 style="font-family:'Instrument Serif',serif; font-size:18px; font-weight:400; margin:0 0 6px; color:var(--ink); line-height:1.3;">{{ $s['name'] }}</h3>
                            <div style="font-size:13px; font-weight:500; color:var(--accent); margin-bottom:10px;">Coverage: {{ $s['coverage'] }}</div>
                            <p style="font-size:13px; line-height:1.6; color:var(--muted); margin:0;">{{ $s['detail'] }}</p>
                        </div>
                        @endforeach
                    </div>
                    <div style="background:var(--ink-deep); color:#fff; padding:28px; display:grid; grid-template-columns:1fr auto; gap:24px; align-items:center;" class="sdut-2col">
                        <div>
                            <div class="eyebrow" style="color:rgba(255,255,255,0.4); margin-bottom:8px;">ITEA scholarship support</div>
                            <div style="font-family:'Instrument Serif',serif; font-size:22px; margin-bottom:8px;">We submit you for every scholarship you qualify for — free of charge.</div>
                            <div style="font-size:13px; color:rgba(255,255,255,0.6);">73% of ITEA candidates receive at least one funded offer.</div>
                        </div>
                        <a href="{{ route('scholarship') }}" style="white-space:nowrap; background:#fff; color:var(--ink); padding:12px 24px; font-family:'JetBrains Mono',monospace; font-size:11px; letter-spacing:0.08em; text-transform:uppercase; text-decoration:none; flex-shrink:0;">View all scholarships →</a>
                    </div>
                </div>
            </div>

        </div>
        <div style="height:48px;"></div>
    </div>
</section>

<section id="apply" style="background:var(--accent); color:#fff; padding:56px 0;">
    <div class="wrap sdut-2col" style="display:grid; grid-template-columns:1fr 1fr; gap:48px; align-items:center;">
        <div>
            <div class="eyebrow" style="color:rgba(255,255,255,0.6); margin-bottom:10px;">Ready to apply to SDUT?</div>
            <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(26px,3vw,40px); font-weight:400; margin:0;">Let ITEA handle your<br><em>full application.</em></h2>
        </div>
        <div>
            <p style="font-size:15px; line-height:1.65; color:rgba(255,255,255,0.85); margin:0 0 24px;">From document prep to scholarship submission — our China desk manages every step.</p>
            <div style="display:flex; gap:14px; flex-wrap:wrap;">
                <a href="{{ $applyUrl }}" style="background:#fff; color:var(--accent); padding:12px 28px; font-family:'JetBrains Mono',monospace; font-size:11px; letter-spacing:0.1em; text-transform:uppercase; text-decoration:none; font-weight:500;">Start my application →</a>
                <a href="{{ route('contact') }}" style="color:rgba(255,255,255,0.8); font-size:13px; text-decoration:underline; text-underline-offset:4px; align-self:center;">Or speak to a counsellor</a>
            </div>
        </div>
    </div>
</section>

<style>
.sdut-tab { padding:16px 20px; font-family:'JetBrains Mono',monospace; font-size:11px; letter-spacing:0.08em; text-transform:uppercase; color:rgba(255,255,255,0.45); background:none; border:none; border-bottom:2px solid transparent; cursor:pointer; transition:all 0.15s; white-space:nowrap; }
.sdut-tab:hover { color:rgba(255,255,255,0.8); }
.sdut-tab-active { color:#fff !important; border-bottom-color:var(--accent) !important; }
@media (max-width:900px) {
    .sdut-hero-grid { grid-template-columns:1fr !important; }
    .sdut-hero-grid > div:last-child { display:none !important; }
    .sdut-2col { grid-template-columns:1fr !important; }
    .sdut-prog-grid { grid-template-columns:1fr 1fr !important; }
}
@media (max-width:640px) { .sdut-prog-grid { grid-template-columns:1fr !important; } }
</style>

@endsection
