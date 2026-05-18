@extends('layouts.app')
@section('title', 'ZUST — Zhejiang University of Science & Technology | ITEA EduAbroad')
@section('description', 'Study at Zhejiang University of Science and Technology (ZUST) in Hangzhou, China. 12 English-taught programmes, CSC scholarships up to 100% tuition, 1,600+ international students.')
@section('nav_logo', 'assets/logo-china.png')

@section('content')

{{-- ── Hero ─────────────────────────────────────────────────── --}}
<section style="background:var(--ink-deep); color:#fff; padding:72px 0 0; position:relative; overflow:hidden;">
    <div style="position:absolute; inset:0; background:linear-gradient(135deg,#1c3d5a,#0a1f3a); opacity:0.95;"></div>
    @if(file_exists(public_path('assets/uni-zust.png')))
    <div style="position:absolute; inset:0; background:url('{{ asset('assets/uni-zust.png') }}') center/cover no-repeat; opacity:0.12;"></div>
    @endif

    <div class="wrap" style="position:relative;">
        {{-- Breadcrumb --}}
        <div style="display:flex; align-items:center; gap:8px; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:rgba(255,255,255,0.4); margin-bottom:28px; flex-wrap:wrap;">
            <a href="{{ route('home') }}" style="color:inherit; text-decoration:none;">Home</a>
            <span>·</span>
            <a href="{{ route('china') }}" style="color:inherit; text-decoration:none;">Study in China</a>
            <span>·</span>
            <span style="color:rgba(255,255,255,0.7);">ZUST</span>
        </div>

        <div style="display:grid; grid-template-columns:1fr 300px; gap:48px; align-items:end; padding-bottom:48px;" class="zust-hero-grid">
            <div>
                <div style="display:inline-flex; align-items:center; gap:8px; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:rgba(255,255,255,0.5); border:1px solid rgba(255,255,255,0.15); padding:4px 12px; border-radius:999px; margin-bottom:20px;">
                    Public University · Hangzhou, Zhejiang
                </div>
                <h1 style="font-family:'Instrument Serif',serif; font-size:clamp(28px,4vw,56px); font-weight:400; margin:0 0 6px; line-height:1.05;">Zhejiang University of<br><em style="color:#7eb8e8;">Science & Technology</em></h1>
                <div class="zh" style="font-size:20px; color:rgba(255,255,255,0.25); margin-bottom:20px;">浙江科技大学 · ZUST</div>
                <p style="font-size:15px; line-height:1.65; color:rgba(255,255,255,0.65); max-width:560px; margin:0 0 28px;">A Sino-German cooperative university in Hangzhou — blending German engineering rigour with Chinese academic scale. 22,000 students, 1,600 international, two campuses across Hangzhou and Anji.</p>
                <div style="display:flex; gap:12px; flex-wrap:wrap;">
                    <a href="#apply" class="btn-primary">Apply to ZUST →</a>
                    <a href="#programmes" style="color:rgba(255,255,255,0.7); font-size:13px; font-family:'JetBrains Mono',monospace; letter-spacing:0.06em; text-decoration:underline; text-underline-offset:4px; align-self:center;">View programmes ↓</a>
                </div>
            </div>

            {{-- Quick facts --}}
            <div style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1); padding:24px;">
                <div style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:rgba(255,255,255,0.4); margin-bottom:16px;">At a glance</div>
                @php $facts = [
                    ['label'=>'Founded',           'val'=>'1980'],
                    ['label'=>'Total students',    'val'=>'22,000'],
                    ['label'=>'International students', 'val'=>'1,600'],
                    ['label'=>'English programmes','val'=>'12'],
                    ['label'=>'Campus size',       'val'=>'2,900+ acres'],
                    ['label'=>'Application fee',   'val'=>'¥400'],
                ]; @endphp
                @foreach($facts as $i => $f)
                <div style="display:flex; justify-content:space-between; padding:8px 0; {{ $i < count($facts)-1 ? 'border-bottom:1px solid rgba(255,255,255,0.07);' : '' }}">
                    <span style="font-size:12px; color:rgba(255,255,255,0.45);">{{ $f['label'] }}</span>
                    <span style="font-size:13px; font-weight:500; color:#fff;">{{ $f['val'] }}</span>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Tab nav --}}
        <div x-data="{ tab: 'overview' }" id="tabs" style="position:relative;">
            <div style="display:flex; gap:0; border-top:1px solid rgba(255,255,255,0.1); overflow-x:auto;" class="zust-tab-nav">
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
                    :class="tab === '{{ $t['id'] }}' ? 'zust-tab-active' : ''"
                    class="zust-tab"
                    style="flex-shrink:0;">
                    {{ $t['label'] }}
                </button>
                @endforeach
            </div>

            {{-- ── OVERVIEW ── --}}
            <div x-show="tab === 'overview'" style="background:var(--paper); color:var(--ink);">
                <div class="wrap" style="display:grid; grid-template-columns:1fr 1fr; gap:48px; padding-top:48px; padding-bottom:48px;" class="zust-2col">
                    <div>
                        <div class="eyebrow" style="margin-bottom:12px;">About ZUST</div>
                        <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(22px,2.5vw,32px); font-weight:400; margin:0 0 16px;">Engineering excellence,<br><em style="color:var(--accent);">Sino-German style.</em></h2>
                        <p style="font-size:14px; line-height:1.75; color:var(--muted); margin:0 0 16px;">Zhejiang University of Science and Technology was established in 1980 with a unique Sino-German cooperative model. The university maintains strong academic ties with German institutions, blending European engineering rigour with China's world-class research infrastructure.</p>
                        <p style="font-size:14px; line-height:1.75; color:var(--muted); margin:0 0 24px;">Located in Hangzhou — one of China's most liveable cities and home to Alibaba headquarters — ZUST offers students an unmatched combination of academic quality, career opportunity and cultural immersion.</p>
                        <div style="background:var(--bg); padding:20px; border-left:3px solid var(--accent);">
                            <div style="font-size:13px; font-weight:500; color:var(--ink); margin-bottom:6px;">"Strong engineering programs and international focus"</div>
                            <div style="font-size:12px; color:var(--muted);">Two campuses — Hangzhou (main) and Anji — across 2,900+ acres of modern facilities.</div>
                        </div>
                    </div>
                    <div>
                        <div class="eyebrow" style="margin-bottom:12px;">Popular fields of study</div>
                        @php $majors = [
                            ['name'=>'Computer Science & AI',         'tag'=>'High demand'],
                            ['name'=>'Data Science',                  'tag'=>'English'],
                            ['name'=>'Mechanical Engineering',        'tag'=>'Flagship'],
                            ['name'=>'Civil & Structural Engineering','tag'=>'English'],
                            ['name'=>'Robotics & Automation',         'tag'=>'English'],
                            ['name'=>'International Business',        'tag'=>'English'],
                            ['name'=>'Architecture & Design',         'tag'=>'Studio-based'],
                            ['name'=>'Chemical Engineering',          'tag'=>''],
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

            {{-- ── PROGRAMMES ── --}}
            <div x-show="tab === 'programmes'" id="programmes" style="background:var(--bg); color:var(--ink);">
                <div class="wrap" style="padding-top:48px; padding-bottom:48px;">
                    <div x-data="{ ptype: 'ug_en' }">
                        <div style="display:flex; gap:8px; flex-wrap:wrap; margin-bottom:32px;">
                            @php $ptypes = [
                                ['id'=>'ug_en',  'label'=>'Undergrad · English (12)'],
                                ['id'=>'ug_zh',  'label'=>'Undergrad · Chinese (22)'],
                                ['id'=>'pg_en',  'label'=>'Postgrad · English (12)'],
                                ['id'=>'pg_zh',  'label'=>'Postgrad · Chinese (7)'],
                                ['id'=>'nondeg', 'label'=>'Non-degree'],
                            ]; @endphp
                            @foreach($ptypes as $pt)
                            <button @click="ptype = '{{ $pt['id'] }}'"
                                :class="ptype === '{{ $pt['id'] }}' ? 'is-on' : ''"
                                class="uni-chip">{{ $pt['label'] }}</button>
                            @endforeach
                        </div>

                        {{-- Undergrad English --}}
                        <div x-show="ptype === 'ug_en'">
                            <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:2px;" class="zust-prog-grid">
                                @php $ug_en = [
                                    ['name'=>'Computer Science','dur'=>'4 yrs','lang'=>'English','fee'=>'CNY 18–25k/yr'],
                                    ['name'=>'Artificial Intelligence','dur'=>'4 yrs','lang'=>'English','fee'=>'CNY 18–25k/yr'],
                                    ['name'=>'Data Science','dur'=>'4 yrs','lang'=>'English','fee'=>'CNY 18–25k/yr'],
                                    ['name'=>'Robotics & Automation','dur'=>'4 yrs','lang'=>'English','fee'=>'CNY 18–25k/yr'],
                                    ['name'=>'Mechanical Engineering','dur'=>'4 yrs','lang'=>'English','fee'=>'CNY 18–25k/yr'],
                                    ['name'=>'Civil Engineering','dur'=>'4 yrs','lang'=>'English','fee'=>'CNY 18–25k/yr'],
                                    ['name'=>'Architecture','dur'=>'5 yrs','lang'=>'English','fee'=>'CNY 18–25k/yr'],
                                    ['name'=>'Electrical Engineering','dur'=>'4 yrs','lang'=>'English','fee'=>'CNY 18–25k/yr'],
                                    ['name'=>'Chemical Engineering','dur'=>'4 yrs','lang'=>'English','fee'=>'CNY 18–25k/yr'],
                                    ['name'=>'International Business','dur'=>'4 yrs','lang'=>'English','fee'=>'CNY 18–25k/yr'],
                                    ['name'=>'Design','dur'=>'4 yrs','lang'=>'English','fee'=>'CNY 18–25k/yr'],
                                    ['name'=>'Logistics Management','dur'=>'4 yrs','lang'=>'English','fee'=>'CNY 18–25k/yr'],
                                ]; @endphp
                                @foreach($ug_en as $prog)
                                <div class="card" style="padding:20px;">
                                    <div style="font-size:15px; font-weight:500; color:var(--ink); margin-bottom:8px;">{{ $prog['name'] }}</div>
                                    <div style="display:flex; gap:12px; flex-wrap:wrap;">
                                        <span style="font-family:'JetBrains Mono',monospace; font-size:10px; color:var(--muted);">{{ $prog['dur'] }}</span>
                                        <span style="font-family:'JetBrains Mono',monospace; font-size:10px; color:var(--accent);">{{ $prog['lang'] }}</span>
                                    </div>
                                    <div style="margin-top:8px; font-size:12px; color:var(--muted);">{{ $prog['fee'] }}</div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Undergrad Chinese --}}
                        <div x-show="ptype === 'ug_zh'">
                            <div style="background:var(--paper); border:1px solid var(--rule-soft); padding:24px; margin-bottom:16px;">
                                <div style="font-size:14px; color:var(--muted); margin-bottom:4px;"><strong style="color:var(--ink);">22 programmes</strong> taught in Mandarin Chinese.</div>
                                <div style="font-size:13px; color:var(--muted);">Prerequisite: HSK Level 4 (score ≥ 180). Covers engineering, design, arts, economics and management disciplines.</div>
                            </div>
                            <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:2px;" class="zust-prog-grid">
                                @php $ug_zh = ['Mechanical Engineering','Electrical Engineering','Civil Engineering','Architecture','Computer Science','Software Engineering','Chemical Engineering','Environmental Engineering','Industrial Design','Visual Communication','Business Administration','Accounting','Finance','Marketing','International Economics & Trade','Law','Chinese Language & Literature','Logistics Management','Materials Science','Food Science','Landscape Architecture','Urban Planning']; @endphp
                                @foreach($ug_zh as $prog)
                                <div class="card" style="padding:16px;">
                                    <div style="font-size:14px; color:var(--ink); margin-bottom:4px;">{{ $prog }}</div>
                                    <span style="font-family:'JetBrains Mono',monospace; font-size:9px; color:var(--muted); text-transform:uppercase; letter-spacing:0.08em;">Mandarin · 4 yrs</span>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Postgrad English --}}
                        <div x-show="ptype === 'pg_en'">
                            <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:2px;" class="zust-prog-grid">
                                @php $pg_en = [
                                    ['name'=>'Mechanical Engineering (MSc)','dur'=>'2–3 yrs','fee'=>'CNY 21–25k/yr'],
                                    ['name'=>'Artificial Intelligence (MSc)','dur'=>'2–3 yrs','fee'=>'CNY 21–25k/yr'],
                                    ['name'=>'Civil Engineering (MSc)','dur'=>'2–3 yrs','fee'=>'CNY 21–25k/yr'],
                                    ['name'=>'Computer Science (MSc)','dur'=>'2–3 yrs','fee'=>'CNY 21–25k/yr'],
                                    ['name'=>'Architecture (MSc)','dur'=>'2–3 yrs','fee'=>'CNY 21–25k/yr'],
                                    ['name'=>'Electrical Engineering (MSc)','dur'=>'2–3 yrs','fee'=>'CNY 21–25k/yr'],
                                    ['name'=>'Chemical Engineering (MSc)','dur'=>'2–3 yrs','fee'=>'CNY 21–25k/yr'],
                                    ['name'=>'Data Science (MSc)','dur'=>'2–3 yrs','fee'=>'CNY 21–25k/yr'],
                                    ['name'=>'Business Administration (MBA)','dur'=>'2 yrs','fee'=>'CNY 21–25k/yr'],
                                    ['name'=>'International Business (MSc)','dur'=>'2 yrs','fee'=>'CNY 21–25k/yr'],
                                    ['name'=>'Environmental Engineering (MSc)','dur'=>'2–3 yrs','fee'=>'CNY 21–25k/yr'],
                                    ['name'=>'Industrial Design (MSc)','dur'=>'2–3 yrs','fee'=>'CNY 21–25k/yr'],
                                ]; @endphp
                                @foreach($pg_en as $prog)
                                <div class="card" style="padding:20px;">
                                    <div style="font-size:15px; font-weight:500; color:var(--ink); margin-bottom:8px;">{{ $prog['name'] }}</div>
                                    <div style="font-family:'JetBrains Mono',monospace; font-size:10px; color:var(--accent);">English · {{ $prog['dur'] }}</div>
                                    <div style="margin-top:6px; font-size:12px; color:var(--muted);">{{ $prog['fee'] }}</div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Postgrad Chinese --}}
                        <div x-show="ptype === 'pg_zh'">
                            <div style="background:var(--paper); border:1px solid var(--rule-soft); padding:24px; margin-bottom:16px;">
                                <div style="font-size:14px; color:var(--muted);"><strong style="color:var(--ink);">7 postgraduate programmes</strong> taught in Mandarin. Requires HSK 5+.</div>
                            </div>
                            <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:2px;" class="zust-prog-grid">
                                @php $pg_zh = ['Mechanical Engineering (PhD/MSc)','Civil Engineering (MSc)','Computer Science (MSc)','Chemical Engineering (MSc)','Architecture (MSc)','Business Administration (MBA)','Design Studies (MSc)']; @endphp
                                @foreach($pg_zh as $prog)
                                <div class="card" style="padding:16px;">
                                    <div style="font-size:14px; color:var(--ink); margin-bottom:4px;">{{ $prog }}</div>
                                    <span style="font-family:'JetBrains Mono',monospace; font-size:9px; color:var(--muted); text-transform:uppercase; letter-spacing:0.08em;">Mandarin</span>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Non-degree --}}
                        <div x-show="ptype === 'nondeg'">
                            <div style="display:grid; grid-template-columns:1fr 1fr; gap:2px;" class="zust-prog-grid">
                                <div class="card" style="padding:24px;">
                                    <div class="eyebrow" style="margin-bottom:8px;">Chinese Language Programme</div>
                                    <h3 style="font-family:'Instrument Serif',serif; font-size:20px; font-weight:400; margin:0 0 10px;">Mandarin Intensive</h3>
                                    <p style="font-size:13px; line-height:1.6; color:var(--muted); margin:0 0 12px;">Full-year or semester Chinese language immersion. Suitable for beginners to advanced learners. HSK exam preparation included.</p>
                                    <div style="font-size:13px; color:var(--muted);">Fee: CNY 7,500–15,000 / year</div>
                                </div>
                                <div class="card" style="padding:24px;">
                                    <div class="eyebrow" style="margin-bottom:8px;">Student Mobility</div>
                                    <h3 style="font-family:'Instrument Serif',serif; font-size:20px; font-weight:400; margin:0 0 10px;">Exchange & Mobility</h3>
                                    <p style="font-size:13px; line-height:1.6; color:var(--muted); margin:0 0 12px;">Semester exchange for students currently enrolled at a partner university. Credits transferable. Open to all disciplines.</p>
                                    <div style="font-size:13px; color:var(--muted);">Duration: 1 or 2 semesters</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── ADMISSION ── --}}
            <div x-show="tab === 'admission'" style="background:var(--paper); color:var(--ink);">
                <div class="wrap" style="padding-top:48px; padding-bottom:48px;">
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:32px;" class="zust-2col">
                        {{-- Academic requirements --}}
                        <div>
                            <div class="eyebrow" style="margin-bottom:14px;">Academic requirements</div>
                            <div style="display:flex; flex-direction:column; gap:2px;">
                                @php $reqs = [
                                    ['level'=>'Undergraduate','req'=>'High school diploma / SPM / A-Level or equivalent. Minimum age 17.'],
                                    ['level'=>'Postgraduate (MSc)','req'=>'Bachelor\'s degree in a relevant field. CGPA 3.0+ preferred.'],
                                    ['level'=>'PhD','req'=>'Master\'s degree in relevant field. Research proposal required.'],
                                    ['level'=>'Non-degree / Language','req'=>'High school diploma or above. No prior Chinese required for beginner level.'],
                                ]; @endphp
                                @foreach($reqs as $r)
                                <div style="padding:16px; background:var(--bg);">
                                    <div style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.08em; text-transform:uppercase; color:var(--accent); margin-bottom:6px;">{{ $r['level'] }}</div>
                                    <div style="font-size:13px; line-height:1.6; color:var(--ink);">{{ $r['req'] }}</div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Language requirements --}}
                        <div>
                            <div class="eyebrow" style="margin-bottom:14px;">Language requirements</div>
                            <div style="display:flex; flex-direction:column; gap:2px; margin-bottom:24px;">
                                <div style="padding:16px; background:var(--bg);">
                                    <div style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.08em; color:var(--accent); text-transform:uppercase; margin-bottom:6px;">English-taught programmes</div>
                                    <div style="font-size:13px; color:var(--ink);">IELTS ≥ 5.5 &nbsp;·&nbsp; TOEFL ≥ 80 &nbsp;·&nbsp; or equivalent</div>
                                </div>
                                <div style="padding:16px; background:var(--bg);">
                                    <div style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.08em; color:var(--accent); text-transform:uppercase; margin-bottom:6px;">Chinese-taught programmes</div>
                                    <div style="font-size:13px; color:var(--ink);">HSK Level 4 &nbsp;·&nbsp; score ≥ 180 points</div>
                                </div>
                                <div style="padding:16px; background:var(--bg);">
                                    <div style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.08em; color:var(--accent); text-transform:uppercase; margin-bottom:6px;">Language programme</div>
                                    <div style="font-size:13px; color:var(--ink);">No language prerequisite for beginner level</div>
                                </div>
                            </div>

                            <div class="eyebrow" style="margin-bottom:14px;">Required documents</div>
                            <div style="display:flex; flex-direction:column; gap:6px;">
                                @php $docs = ['Valid passport (18+ months)','Academic transcripts (all levels)','Highest qualification certificate','Language test certificate (IELTS/TOEFL/HSK)','Personal statement / motivation letter','Passport-size photos (2)','Physical examination report','No criminal record certificate']; @endphp
                                @foreach($docs as $doc)
                                <div style="display:flex; align-items:center; gap:10px; font-size:13px; color:var(--ink);">
                                    <span style="color:#2fa86e; flex-shrink:0;">✓</span> {{ $doc }}
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Intake --}}
                    <div style="margin-top:32px; display:grid; grid-template-columns:1fr 1fr; gap:2px;" class="zust-2col">
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

            {{-- ── TUITION & FEES ── --}}
            <div x-show="tab === 'fees'" style="background:var(--bg); color:var(--ink);">
                <div class="wrap" style="padding-top:48px; padding-bottom:48px;">
                    <div style="display:grid; grid-template-columns:2fr 1fr; gap:32px; align-items:start;" class="zust-2col">
                        <div>
                            <div class="eyebrow" style="margin-bottom:16px;">Annual tuition fees (USD)</div>
                            <div style="border:1px solid var(--rule-soft); overflow:hidden;">
                                <div style="display:grid; grid-template-columns:1fr 1fr 1fr; background:var(--ink-deep); color:#fff; padding:12px 16px;">
                                    <div style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.08em; text-transform:uppercase;">Programme</div>
                                    <div style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.08em; text-transform:uppercase;">Language</div>
                                    <div style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.08em; text-transform:uppercase;">Fee / Year</div>
                                </div>
                                @php $fees = [
                                    ['prog'=>'Undergraduate','lang'=>'English','fee'=>'USD 18,000 – 25,000'],
                                    ['prog'=>'Undergraduate','lang'=>'Chinese','fee'=>'USD 17,000 – 20,000'],
                                    ['prog'=>'Postgraduate (MSc)','lang'=>'English','fee'=>'USD 21,000 – 25,000'],
                                    ['prog'=>'Postgraduate (MSc)','lang'=>'Chinese','fee'=>'USD 18,000 – 22,000'],
                                    ['prog'=>'Chinese Language','lang'=>'Mandarin','fee'=>'USD 7,500 – 15,000'],
                                    ['prog'=>'Application fee','lang'=>'One-time','fee'=>'CNY 400 (≈ USD 55)'],
                                ]; @endphp
                                @foreach($fees as $i => $f)
                                <div style="display:grid; grid-template-columns:1fr 1fr 1fr; padding:12px 16px; {{ $i % 2 === 0 ? 'background:var(--paper);' : 'background:var(--bg);' }} border-top:1px solid var(--rule-soft);">
                                    <div style="font-size:13px; color:var(--ink);">{{ $f['prog'] }}</div>
                                    <div style="font-size:13px; color:var(--muted);">{{ $f['lang'] }}</div>
                                    <div style="font-size:13px; font-weight:500; color:var(--ink);">{{ $f['fee'] }}</div>
                                </div>
                                @endforeach
                            </div>
                            <p style="font-size:12px; color:var(--muted); margin-top:10px;">* Fees are indicative and subject to change. Contact ITEA for the latest confirmed figures before applying.</p>
                        </div>

                        <div>
                            <div class="eyebrow" style="margin-bottom:14px;">Cost of living · Hangzhou</div>
                            <div style="display:flex; flex-direction:column; gap:2px;">
                                @php $living = [
                                    ['item'=>'Accommodation','cost'=>'CNY 600–1,200/mo'],
                                    ['item'=>'Meals (campus)','cost'=>'CNY 600–800/mo'],
                                    ['item'=>'Transport','cost'=>'CNY 100–200/mo'],
                                    ['item'=>'Books & materials','cost'=>'CNY 200–400/mo'],
                                    ['item'=>'Personal expenses','cost'=>'CNY 500–800/mo'],
                                    ['item'=>'Total estimate','cost'=>'CNY 2,000–3,400/mo'],
                                ]; @endphp
                                @foreach($living as $i => $l)
                                <div style="display:flex; justify-content:space-between; padding:10px 14px; {{ $i === count($living)-1 ? 'background:var(--ink-deep); color:#fff;' : 'background:var(--paper);' }}">
                                    <span style="font-size:13px;">{{ $l['item'] }}</span>
                                    <span style="font-size:13px; font-weight:500;">{{ $l['cost'] }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── ACCOMMODATION ── --}}
            <div x-show="tab === 'accommodation'" style="background:var(--paper); color:var(--ink);">
                <div class="wrap" style="padding-top:48px; padding-bottom:48px;">
                    <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:2px; margin-bottom:32px;" class="zust-prog-grid">
                        @php $rooms = [
                            ['type'=>'Double Room','price'=>'CNY 600/mo per person','note'=>'Shared with one roommate. En-suite or shared bathroom options available.','tag'=>'Most popular'],
                            ['type'=>'Single Room','price'=>'CNY 1,200/mo','note'=>'Private room. Limited availability — apply early to secure.','tag'=>'Limited'],
                            ['type'=>'Deposit','price'=>'CNY 1,000','note'=>'One-time refundable deposit payable upon check-in.','tag'=>'Refundable'],
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
                        International student dormitories are located within the campus. All rooms include WiFi, air conditioning, and heating. Canteen, gymnasium, library and medical clinic are available on campus.
                    </div>
                </div>
            </div>

            {{-- ── SCHOLARSHIPS ── --}}
            <div x-show="tab === 'scholarships'" style="background:var(--bg); color:var(--ink);">
                <div class="wrap" style="padding-top:48px; padding-bottom:48px;">
                    <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:2px; margin-bottom:32px;" class="zust-prog-grid">
                        @php $schols = [
                            ['name'=>'Chinese Government Scholarship (CSC)','coverage'=>'Full-ride','detail'=>'Covers tuition, accommodation, monthly stipend (CNY 2,500) and comprehensive medical insurance. Highly competitive — apply through ITEA for guidance.','tag'=>'Full-ride'],
                            ['name'=>'Zhejiang Provincial Scholarship','coverage'=>'Partial','detail'=>'Provincial government award covering partial tuition. Available to students with strong academic records. Awarded upon enrolment.','tag'=>'Partial'],
                            ['name'=>'ZUST Outstanding Student Award','coverage'=>'Up to 100%','detail'=>'University-level merit award. Available from year 2 onwards based on GPA performance. Renewable annually.','tag'=>'Merit'],
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
                    <div style="background:var(--ink-deep); color:#fff; padding:28px; display:grid; grid-template-columns:1fr auto; gap:24px; align-items:center;" class="zust-2col">
                        <div>
                            <div class="eyebrow" style="color:rgba(255,255,255,0.4); margin-bottom:8px;">ITEA scholarship support</div>
                            <div style="font-family:'Instrument Serif',serif; font-size:22px; margin-bottom:8px;">We submit you for every scholarship you qualify for — free of charge.</div>
                            <div style="font-size:13px; color:rgba(255,255,255,0.6);">73% of ITEA candidates receive at least one funded offer. Our China desk manages the full CSC application process.</div>
                        </div>
                        <a href="{{ route('scholarship') }}" style="white-space:nowrap; background:#fff; color:var(--ink); padding:12px 24px; font-family:'JetBrains Mono',monospace; font-size:11px; letter-spacing:0.08em; text-transform:uppercase; text-decoration:none; flex-shrink:0;">View all scholarships →</a>
                    </div>
                </div>
            </div>

        </div>{{-- end x-data tabs --}}
        <div style="height:48px;"></div>
    </div>{{-- end wrap --}}
</section>

{{-- ── Apply CTA ─────────────────────────────────────────────── --}}
<section id="apply" style="background:var(--accent); color:#fff; padding:56px 0;">
    <div class="wrap zust-2col" style="display:grid; grid-template-columns:1fr 1fr; gap:48px; align-items:center;">
        <div>
            <div class="eyebrow" style="color:rgba(255,255,255,0.6); margin-bottom:10px;">Ready to apply to ZUST?</div>
            <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(26px,3vw,40px); font-weight:400; margin:0;">Let ITEA handle your<br><em>full application.</em></h2>
        </div>
        <div>
            <p style="font-size:15px; line-height:1.65; color:rgba(255,255,255,0.85); margin:0 0 24px;">From document prep to scholarship submission — our China desk manages every step. Intake: September 2026 (deadline 30 June).</p>
            <div style="display:flex; gap:14px; flex-wrap:wrap;">
                <a href="{{ route('application') }}#apply" style="background:#fff; color:var(--accent); padding:12px 28px; font-family:'JetBrains Mono',monospace; font-size:11px; letter-spacing:0.1em; text-transform:uppercase; text-decoration:none; font-weight:500;">Start my application →</a>
                <a href="{{ route('contact') }}" style="color:rgba(255,255,255,0.8); font-size:13px; text-decoration:underline; text-underline-offset:4px; align-self:center;">Or speak to a counsellor</a>
            </div>
        </div>
    </div>
</section>

<style>
.zust-tab {
    padding: 16px 20px;
    font-family: 'JetBrains Mono', monospace;
    font-size: 11px;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: rgba(255,255,255,0.45);
    background: none;
    border: none;
    border-bottom: 2px solid transparent;
    cursor: pointer;
    transition: all 0.15s;
    white-space: nowrap;
}
.zust-tab:hover { color: rgba(255,255,255,0.8); }
.zust-tab-active { color: #fff !important; border-bottom-color: var(--accent) !important; }

@media (max-width: 900px) {
    .zust-hero-grid { grid-template-columns: 1fr !important; }
    .zust-hero-grid > div:last-child { display: none !important; }
    .zust-2col { grid-template-columns: 1fr !important; }
    .zust-prog-grid { grid-template-columns: 1fr 1fr !important; }
    .zust-tab-nav { overflow-x: auto; -webkit-overflow-scrolling: touch; }
}
@media (max-width: 640px) {
    .zust-prog-grid { grid-template-columns: 1fr !important; }
}
</style>

@endsection
