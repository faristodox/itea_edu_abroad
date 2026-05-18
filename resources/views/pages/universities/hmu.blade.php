@extends('layouts.app')
@section('title', 'HMU — Hainan Medical University | ITEA EduAbroad')
@section('description', 'Study MBBS and medical programmes at Hainan Medical University (HMU) in Haikou, China. English-medium MBBS, CSC scholarships, tropical coastal campus.')
@section('nav_logo', 'assets/logo-china.png')

@section('content')

<section style="background:var(--ink-deep); color:#fff; padding:72px 0 0; position:relative; overflow:hidden;">
    <div style="position:absolute; inset:0; background:linear-gradient(135deg,#2a8a6a,#0e3527); opacity:0.95;"></div>
    @if(file_exists(public_path('assets/hmu.jpg')))
    <div style="position:absolute; inset:0; background:url('{{ asset('assets/hmu.jpg') }}') center/cover no-repeat; opacity:0.12;"></div>
    @endif

    <div class="wrap" style="position:relative;">
        <div style="display:flex; align-items:center; gap:8px; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:rgba(255,255,255,0.4); margin-bottom:28px; flex-wrap:wrap;">
            <a href="{{ route('home') }}" style="color:inherit; text-decoration:none;">Home</a>
            <span>·</span>
            <a href="{{ route('china') }}" style="color:inherit; text-decoration:none;">Study in China</a>
            <span>·</span>
            <span style="color:rgba(255,255,255,0.7);">HMU</span>
        </div>

        <div style="display:grid; grid-template-columns:1fr 300px; gap:48px; align-items:end; padding-bottom:48px;" class="hmu-hero-grid">
            <div>
                <div style="display:inline-flex; align-items:center; gap:8px; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:rgba(255,255,255,0.5); border:1px solid rgba(255,255,255,0.15); padding:4px 12px; border-radius:999px; margin-bottom:20px;">
                    Public University · Haikou, Hainan
                </div>
                <h1 style="font-family:'Instrument Serif',serif; font-size:clamp(28px,4vw,56px); font-weight:400; margin:0 0 6px; line-height:1.05;">Hainan Medical<br><em style="color:#7aecc8;">University</em></h1>
                <div class="zh" style="font-size:20px; color:rgba(255,255,255,0.25); margin-bottom:20px;">海南医科大学 · HMU</div>
                <p style="font-size:15px; line-height:1.65; color:rgba(255,255,255,0.65); max-width:560px; margin:0 0 28px;">One of China's leading medical universities, founded in 1947. Located in tropical Haikou — offering English-medium MBBS, modern hospital training, and a coastal campus environment. 15,000 students, 1,200 international.</p>
                <div style="display:flex; gap:12px; flex-wrap:wrap;">
                    <a href="#apply" class="btn-primary">Apply to HMU →</a>
                    <a href="#programmes" style="color:rgba(255,255,255,0.7); font-size:13px; font-family:'JetBrains Mono',monospace; letter-spacing:0.06em; text-decoration:underline; text-underline-offset:4px; align-self:center;">View programmes ↓</a>
                </div>
            </div>

            <div style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1); padding:24px;">
                <div style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:rgba(255,255,255,0.4); margin-bottom:16px;">At a glance</div>
                @php $facts = [
                    ['label'=>'Founded',                'val'=>'1947'],
                    ['label'=>'Total students',         'val'=>'15,000'],
                    ['label'=>'International students', 'val'=>'1,200'],
                    ['label'=>'MBBS',                   'val'=>'English-medium'],
                    ['label'=>'Tuition from',          'val'=>'USD 3,000/yr'],
                    ['label'=>'Scholarship',            'val'=>'CSC · Hainan Gov'],
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
            <div style="display:flex; gap:0; border-top:1px solid rgba(255,255,255,0.1); overflow-x:auto;" class="hmu-tab-nav">
                @php $tabs = [['id'=>'overview','label'=>'Overview'],['id'=>'programmes','label'=>'Programmes'],['id'=>'admission','label'=>'Admission'],['id'=>'fees','label'=>'Tuition & Fees'],['id'=>'accommodation','label'=>'Accommodation'],['id'=>'scholarships','label'=>'Scholarships']]; @endphp
                @foreach($tabs as $t)
                <button @click="tab = '{{ $t['id'] }}'" :class="tab === '{{ $t['id'] }}' ? 'hmu-tab-active' : ''" class="hmu-tab" style="flex-shrink:0;">{{ $t['label'] }}</button>
                @endforeach
            </div>

            {{-- OVERVIEW --}}
            <div x-show="tab === 'overview'" style="background:var(--paper); color:var(--ink);">
                <div class="wrap hmu-2col" style="display:grid; grid-template-columns:1fr 1fr; gap:48px; padding-top:48px; padding-bottom:48px;">
                    <div>
                        <div class="eyebrow" style="margin-bottom:12px;">About HMU</div>
                        <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(22px,2.5vw,32px); font-weight:400; margin:0 0 16px;">Medical excellence in<br><em style="color:var(--accent);">tropical China.</em></h2>
                        <p style="font-size:14px; line-height:1.75; color:var(--muted); margin:0 0 16px;">Established in 1947, Hainan Medical University is a leading medical institution offering internationally recognised programmes. Located on China's tropical island province, HMU provides a unique combination of high-quality medical education and an exceptional living environment.</p>
                        <p style="font-size:14px; line-height:1.75; color:var(--muted); margin:0 0 24px;">HMU's English-medium MBBS programme is recognised by the World Health Organization (WHO) and listed in the World Directory of Medical Schools (WDOMS), enabling graduates to sit medical licensing exams in Malaysia, Bangladesh, Pakistan and other countries.</p>
                        <div style="background:var(--bg); padding:20px; border-left:3px solid var(--accent);">
                            <div style="font-size:13px; font-weight:500; color:var(--ink); margin-bottom:6px;">"Recognised MBBS programme taught in English; strong hospital training system"</div>
                            <div style="font-size:12px; color:var(--muted);">Modern medical facilities with affiliated teaching hospitals for clinical training.</div>
                        </div>
                    </div>
                    <div>
                        <div class="eyebrow" style="margin-bottom:12px;">Popular fields of study</div>
                        @php $majors = [['name'=>'MBBS (Clinical Medicine)','tag'=>'English · Flagship'],['name'=>'Nursing','tag'=>'English'],['name'=>'Pharmacy','tag'=>'English'],['name'=>'Public Health','tag'=>''],['name'=>'Medical Imaging','tag'=>''],['name'=>'Stomatology (Dentistry)','tag'=>''],['name'=>'Traditional Chinese Medicine','tag'=>''],['name'=>'Biomedical Engineering','tag'=>''],]; @endphp
                        <div style="display:flex; flex-direction:column; gap:2px;">
                            @foreach($majors as $m)
                            <div style="display:flex; justify-content:space-between; align-items:center; padding:11px 14px; background:var(--bg);">
                                <span style="font-size:14px; color:var(--ink);">{{ $m['name'] }}</span>
                                @if($m['tag'])<span style="font-family:'JetBrains Mono',monospace; font-size:9px; letter-spacing:0.08em; text-transform:uppercase; color:var(--accent);">{{ $m['tag'] }}</span>@endif
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
                            @php $ptypes = [['id'=>'ug_en','label'=>'Undergraduate · English'],['id'=>'ug_zh','label'=>'Undergraduate · Chinese'],['id'=>'pg_en','label'=>'Postgraduate · English'],['id'=>'pg_zh','label'=>'Postgraduate · Chinese']]; @endphp
                            @foreach($ptypes as $pt)
                            <button @click="ptype = '{{ $pt['id'] }}'" :class="ptype === '{{ $pt['id'] }}' ? 'is-on' : ''" class="uni-chip">{{ $pt['label'] }}</button>
                            @endforeach
                        </div>
                        <div x-show="ptype === 'ug_en'">
                            <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:2px;" class="hmu-prog-grid">
                                @php $ug_en = [
                                    ['name'=>'MBBS — Clinical Medicine','dur'=>'6 yrs','fee'=>'USD 4,000–6,000/yr','note'=>'WHO listed · English-medium'],
                                    ['name'=>'Nursing','dur'=>'4 yrs','fee'=>'USD 3,000–5,000/yr','note'=>'English-medium'],
                                    ['name'=>'Pharmacy','dur'=>'4 yrs','fee'=>'USD 3,000–5,000/yr','note'=>'English-medium'],
                                    ['name'=>'Public Health','dur'=>'4 yrs','fee'=>'USD 3,000–5,000/yr','note'=>''],
                                    ['name'=>'Medical Imaging Technology','dur'=>'4 yrs','fee'=>'USD 3,000–5,000/yr','note'=>''],
                                    ['name'=>'Biomedical Engineering','dur'=>'4 yrs','fee'=>'USD 3,000–5,000/yr','note'=>''],
                                ]; @endphp
                                @foreach($ug_en as $prog)
                                <div class="card" style="padding:20px;">
                                    <div style="font-size:15px; font-weight:500; color:var(--ink); margin-bottom:6px;">{{ $prog['name'] }}</div>
                                    @if($prog['note'])<div style="font-family:'JetBrains Mono',monospace; font-size:9px; color:var(--accent); text-transform:uppercase; margin-bottom:6px;">{{ $prog['note'] }}</div>@endif
                                    <div style="font-size:12px; color:var(--muted);">{{ $prog['dur'] }} · {{ $prog['fee'] }}</div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div x-show="ptype === 'ug_zh'">
                            <div style="background:var(--paper); border:1px solid var(--rule-soft); padding:16px 20px; margin-bottom:16px; font-size:13px; color:var(--muted);"><strong style="color:var(--ink);">Chinese-taught undergraduate programmes.</strong> Prerequisite: HSK Level 4.</div>
                            <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:2px;" class="hmu-prog-grid">
                                @php $ug_zh = ['Clinical Medicine (MBBS)','Stomatology (Dentistry)','Traditional Chinese Medicine','Nursing','Pharmacy','Public Health','Medical Imaging Technology','Rehabilitation Medicine','Anaesthesiology','Medical Laboratory Science','Biomedical Engineering','Health Management']; @endphp
                                @foreach($ug_zh as $prog)
                                <div class="card" style="padding:16px;">
                                    <div style="font-size:14px; color:var(--ink); margin-bottom:4px;">{{ $prog }}</div>
                                    <span style="font-family:'JetBrains Mono',monospace; font-size:9px; color:var(--muted); text-transform:uppercase; letter-spacing:0.08em;">Mandarin · 4–6 yrs</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div x-show="ptype === 'pg_en'">
                            <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:2px;" class="hmu-prog-grid">
                                @php $pg_en = ['Clinical Medicine (MSc/PhD)','Nursing (MSc)','Pharmacology (MSc)','Public Health (MPH)','Basic Medicine (MSc/PhD)','Tropical Medicine (MSc)']; @endphp
                                @foreach($pg_en as $prog)
                                <div class="card" style="padding:20px;">
                                    <div style="font-size:15px; font-weight:500; color:var(--ink); margin-bottom:8px;">{{ $prog }}</div>
                                    <span style="font-family:'JetBrains Mono',monospace; font-size:10px; color:var(--accent);">English · 2–4 yrs · USD 4,000–6,000/yr</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div x-show="ptype === 'pg_zh'">
                            <div style="background:var(--paper); border:1px solid var(--rule-soft); padding:16px 20px; margin-bottom:16px; font-size:13px; color:var(--muted);"><strong style="color:var(--ink);">Chinese-taught postgraduate programmes.</strong> Prerequisite: HSK Level 5+.</div>
                            <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:2px;" class="hmu-prog-grid">
                                @php $pg_zh = ['Clinical Medicine (PhD/MSc)','Traditional Chinese Medicine (MSc)','Stomatology (MSc)','Pharmacology (MSc)','Nursing (MSc)','Public Health (MPH)','Basic Medicine (PhD/MSc)']; @endphp
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
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:32px;" class="hmu-2col">
                        <div>
                            <div class="eyebrow" style="margin-bottom:14px;">Academic requirements</div>
                            <div style="display:flex; flex-direction:column; gap:2px;">
                                @php $reqs = [
                                    ['level'=>'MBBS / Undergraduate','req'=>'High school diploma with science subjects (Biology, Chemistry, Physics). Age under 25 preferred.'],
                                    ['level'=>'Postgraduate (MSc)','req'=>'Bachelor\'s degree in a medical or related field. CGPA 3.0+ preferred.'],
                                    ['level'=>'PhD','req'=>'Master\'s degree in a relevant medical field. Research proposal required.'],
                                ]; @endphp
                                @foreach($reqs as $r)
                                <div style="padding:16px; background:var(--bg);">
                                    <div style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.08em; text-transform:uppercase; color:var(--accent); margin-bottom:6px;">{{ $r['level'] }}</div>
                                    <div style="font-size:13px; line-height:1.6; color:var(--ink);">{{ $r['req'] }}</div>
                                </div>
                                @endforeach
                            </div>
                            <div style="margin-top:16px; background:var(--bg); padding:16px; border-left:3px solid #f5a500;">
                                <div style="font-size:12px; color:var(--muted);">⚠ MBBS applicants may be required to attend an interview. Strong science foundation (Biology, Chemistry) is essential.</div>
                            </div>
                        </div>
                        <div>
                            <div class="eyebrow" style="margin-bottom:14px;">Language requirements</div>
                            <div style="display:flex; flex-direction:column; gap:2px; margin-bottom:24px;">
                                <div style="padding:16px; background:var(--bg);"><div style="font-family:'JetBrains Mono',monospace; font-size:10px; color:var(--accent); text-transform:uppercase; margin-bottom:6px;">English-taught (MBBS & others)</div><div style="font-size:13px; color:var(--ink);">IELTS ≥ 6.0 · or equivalent · Interview may be required</div></div>
                                <div style="padding:16px; background:var(--bg);"><div style="font-family:'JetBrains Mono',monospace; font-size:10px; color:var(--accent); text-transform:uppercase; margin-bottom:6px;">Chinese-taught programmes</div><div style="font-size:13px; color:var(--ink);">HSK Level 4–5</div></div>
                            </div>
                            <div class="eyebrow" style="margin-bottom:14px;">Required documents</div>
                            <div style="display:flex; flex-direction:column; gap:6px;">
                                @foreach(['Valid passport (18+ months)','High school transcripts & certificate','Language certificate (IELTS/HSK)','Personal statement','Passport photos (2)','Physical examination report','No criminal record certificate','HIV test result (required for medical programmes)'] as $doc)
                                <div style="display:flex; align-items:center; gap:10px; font-size:13px; color:var(--ink);"><span style="color:#2fa86e; flex-shrink:0;">✓</span> {{ $doc }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div style="margin-top:32px; display:grid; grid-template-columns:1fr 1fr; gap:2px;" class="hmu-2col">
                        <div style="background:var(--ink-deep); color:#fff; padding:24px;"><div class="eyebrow" style="color:rgba(255,255,255,0.4); margin-bottom:8px;">September Intake</div><div style="font-family:'Instrument Serif',serif; font-size:24px; margin-bottom:6px;">Sep 2026</div><div style="font-size:13px; color:rgba(255,255,255,0.6);">Deadline: <strong style="color:#fff;">30 June 2026</strong></div></div>
                        <div style="background:var(--bg); border:1px solid var(--rule-soft); padding:24px;"><div class="eyebrow" style="margin-bottom:8px;">March Intake</div><div style="font-family:'Instrument Serif',serif; font-size:24px; margin-bottom:6px;">Mar 2027</div><div style="font-size:13px; color:var(--muted);">Deadline: <strong style="color:var(--ink);">30 November 2026</strong></div></div>
                    </div>
                </div>
            </div>

            {{-- TUITION & FEES --}}
            <div x-show="tab === 'fees'" style="background:var(--bg); color:var(--ink);">
                <div class="wrap" style="padding-top:48px; padding-bottom:48px;">
                    <div style="display:grid; grid-template-columns:2fr 1fr; gap:32px;" class="hmu-2col">
                        <div>
                            <div class="eyebrow" style="margin-bottom:16px;">Annual tuition fees (USD)</div>
                            <div style="border:1px solid var(--rule-soft); overflow:hidden;">
                                <div style="display:grid; grid-template-columns:1fr 1fr 1fr; background:var(--ink-deep); color:#fff; padding:12px 16px;">
                                    <div style="font-family:'JetBrains Mono',monospace; font-size:10px; text-transform:uppercase;">Programme</div>
                                    <div style="font-family:'JetBrains Mono',monospace; font-size:10px; text-transform:uppercase;">Language</div>
                                    <div style="font-family:'JetBrains Mono',monospace; font-size:10px; text-transform:uppercase;">Fee / Year</div>
                                </div>
                                @php $fees = [['MBBS (Clinical Medicine)','English','USD 4,000 – 6,000'],['Nursing / Pharmacy','English','USD 3,000 – 5,000'],['Other Undergrad','English','USD 3,000 – 5,000'],['Postgraduate (MSc)','English','USD 4,000 – 6,000'],['Chinese-taught programmes','Chinese','USD 2,500 – 4,000']]; @endphp
                                @foreach($fees as $i => $f)
                                <div style="display:grid; grid-template-columns:1fr 1fr 1fr; padding:12px 16px; {{ $i%2===0?'background:var(--paper);':'background:var(--bg);' }} border-top:1px solid var(--rule-soft);">
                                    <div style="font-size:13px; color:var(--ink);">{{ $f[0] }}</div>
                                    <div style="font-size:13px; color:var(--muted);">{{ $f[1] }}</div>
                                    <div style="font-size:13px; font-weight:500; color:var(--ink);">{{ $f[2] }}</div>
                                </div>
                                @endforeach
                            </div>
                            <p style="font-size:12px; color:var(--muted); margin-top:10px;">* Fees are indicative. Contact ITEA for confirmed figures.</p>
                        </div>
                        <div>
                            <div class="eyebrow" style="margin-bottom:14px;">Cost of living · Haikou</div>
                            <div style="display:flex; flex-direction:column; gap:2px;">
                                @php $living = [['Accommodation','RMB 800–2,000/mo'],['Meals (campus)','RMB 500–800/mo'],['Transport','RMB 100–200/mo'],['Books & materials','RMB 300–500/mo'],['Personal expenses','RMB 500–800/mo'],['Total estimate','RMB 2,200–4,300/mo']]; @endphp
                                @foreach($living as $i => $l)
                                <div style="display:flex; justify-content:space-between; padding:10px 14px; {{ $i===count($living)-1?'background:var(--ink-deep); color:#fff;':'background:var(--paper);' }}">
                                    <span style="font-size:13px;">{{ $l[0] }}</span><span style="font-size:13px; font-weight:500;">{{ $l[1] }}</span>
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
                    <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:2px; margin-bottom:24px;" class="hmu-prog-grid">
                        @php $rooms = [['Double Room','RMB 800–1,200/mo per person','Shared with one roommate. En-suite available.','Most popular'],['Single Room','RMB 1,200–2,000/mo','Private room with air conditioning and WiFi.','Limited'],['Deposit','RMB 1,000','One-time refundable deposit upon check-in.','Refundable']]; @endphp
                        @foreach($rooms as $r)
                        <div class="card" style="padding:24px;">
                            <div style="font-family:'JetBrains Mono',monospace; font-size:9px; letter-spacing:0.1em; text-transform:uppercase; color:var(--accent); margin-bottom:8px;">{{ $r[3] }}</div>
                            <h3 style="font-family:'Instrument Serif',serif; font-size:20px; font-weight:400; margin:0 0 6px; color:var(--ink);">{{ $r[0] }}</h3>
                            <div style="font-family:'Instrument Serif',serif; font-size:22px; color:var(--accent); margin-bottom:10px;">{{ $r[1] }}</div>
                            <p style="font-size:13px; line-height:1.6; color:var(--muted); margin:0;">{{ $r[2] }}</p>
                        </div>
                        @endforeach
                    </div>
                    <div style="background:var(--bg); padding:20px 24px; border-left:3px solid var(--accent); font-size:13px; color:var(--muted);">
                        International dormitories are on campus. Haikou's tropical climate means year-round warm weather. Campus includes cafeteria, gym, library, and is close to affiliated teaching hospitals for clinical rotations.
                    </div>
                </div>
            </div>

            {{-- SCHOLARSHIPS --}}
            <div x-show="tab === 'scholarships'" style="background:var(--bg); color:var(--ink);">
                <div class="wrap" style="padding-top:48px; padding-bottom:48px;">
                    <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:2px; margin-bottom:32px;" class="hmu-prog-grid">
                        @php $schols = [['Chinese Government Scholarship (CSC)','Full-ride','Covers tuition, accommodation, monthly stipend and insurance. Highly competitive for MBBS.','Full-ride'],['Hainan Government Scholarship','Partial','Provincial award for outstanding international students. Covers partial tuition.','Partial'],['HMU University Scholarship','Partial – Full','Merit-based award from year 2 onwards. Renewable annually based on academic results.','Merit']]; @endphp
                        @foreach($schols as $s)
                        <div class="card" style="padding:24px;">
                            <div style="font-family:'JetBrains Mono',monospace; font-size:9px; letter-spacing:0.1em; text-transform:uppercase; color:var(--accent); margin-bottom:8px;">{{ $s[3] }}</div>
                            <h3 style="font-family:'Instrument Serif',serif; font-size:18px; font-weight:400; margin:0 0 6px; color:var(--ink); line-height:1.3;">{{ $s[0] }}</h3>
                            <div style="font-size:13px; font-weight:500; color:var(--accent); margin-bottom:10px;">Coverage: {{ $s[1] }}</div>
                            <p style="font-size:13px; line-height:1.6; color:var(--muted); margin:0;">{{ $s[2] }}</p>
                        </div>
                        @endforeach
                    </div>
                    <div style="background:var(--ink-deep); color:#fff; padding:28px; display:grid; grid-template-columns:1fr auto; gap:24px; align-items:center;" class="hmu-2col">
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
    <div class="wrap hmu-2col" style="display:grid; grid-template-columns:1fr 1fr; gap:48px; align-items:center;">
        <div>
            <div class="eyebrow" style="color:rgba(255,255,255,0.6); margin-bottom:10px;">Ready to apply to HMU?</div>
            <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(26px,3vw,40px); font-weight:400; margin:0;">Let ITEA handle your<br><em>full application.</em></h2>
        </div>
        <div>
            <p style="font-size:15px; line-height:1.65; color:rgba(255,255,255,0.85); margin:0 0 24px;">From document prep to scholarship submission — our China desk manages every step.</p>
            <div style="display:flex; gap:14px; flex-wrap:wrap;">
                <a href="{{ route('application') }}#apply" style="background:#fff; color:var(--accent); padding:12px 28px; font-family:'JetBrains Mono',monospace; font-size:11px; letter-spacing:0.1em; text-transform:uppercase; text-decoration:none; font-weight:500;">Start my application →</a>
                <a href="{{ route('contact') }}" style="color:rgba(255,255,255,0.8); font-size:13px; text-decoration:underline; text-underline-offset:4px; align-self:center;">Or speak to a counsellor</a>
            </div>
        </div>
    </div>
</section>

<style>
.hmu-tab { padding:16px 20px; font-family:'JetBrains Mono',monospace; font-size:11px; letter-spacing:0.08em; text-transform:uppercase; color:rgba(255,255,255,0.45); background:none; border:none; border-bottom:2px solid transparent; cursor:pointer; transition:all 0.15s; white-space:nowrap; }
.hmu-tab:hover { color:rgba(255,255,255,0.8); }
.hmu-tab-active { color:#fff !important; border-bottom-color:var(--accent) !important; }
@media (max-width:900px) {
    .hmu-hero-grid { grid-template-columns:1fr !important; }
    .hmu-hero-grid > div:last-child { display:none !important; }
    .hmu-2col { grid-template-columns:1fr !important; }
    .hmu-prog-grid { grid-template-columns:1fr 1fr !important; }
}
@media (max-width:640px) { .hmu-prog-grid { grid-template-columns:1fr !important; } }
</style>

@endsection
