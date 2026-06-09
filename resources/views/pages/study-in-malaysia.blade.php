@extends('layouts.app')
@section('title', 'Study in Malaysia — ITEA EduAbroad')
@section('description', '90+ partner universities in Malaysia. English-medium degrees with global branch campuses, affordable tuition and EMGS Student Pass support.')
@section('nav_logo', 'assets/logo-malaysia.jpeg')

@section('content')

<x-page-hero
    glow="gold"
    :breadcrumbs="[['href'=>route('home'),'label'=>'Home'],['href'=>'#','label'=>'Destinations'],['href'=>route('malaysia'),'label'=>'Study in Malaysia']]"
    label="Destination · 02 of 03"
    title="Study in <em style='color:var(--accent)'>Malaysia.</em>"
    body="ASEAN's most international education hub. UK and Australian branch campuses, English-medium teaching, and the most affordable route to a globally-recognised degree in tropical Southeast Asia."
    cta1Text="Match me to a programme"
    :cta1Href="$applyUrl"
    cta2Text="Download Malaysia guide (PDF) ↓"
    cta2Href="#"
    factTitle="Malaysia at a glance"
    :stats="[
        ['key'=>'Partner universities','val'=>'90','sup'=>'+'],
        ['key'=>'Programmes available','val'=>'850','sup'=>'+'],
        ['key'=>'QS Top 200 institutions','val'=>'5','sup'=>''],
        ['key'=>'English-taught programmes','val'=>'All','sup'=>''],
        ['key'=>'Average tuition (Master)','val'=>'RM38','sup'=>'k / yr'],
        ['key'=>'Scholarship match rate','val'=>'88','sup'=>'%'],
    ]"
/>

{{-- Programme types --}}
<x-type-cards
    eyebrow="Browse by programme type"
    title="What level <em>are you?</em>"
    body="Six routes into the Malaysian higher-education system — from foundation programmes to research doctorates."
    :cards="[
        ['glyph'=>'FD','title'=>'Foundation','count'=>'60 programmes','body'=>'1-year pre-degree pathway','href'=>route('programmes')],
        ['glyph'=>'D','title'=>'Diploma','count'=>'110 programmes','body'=>'2 years · vocational entry','href'=>route('programmes')],
        ['glyph'=>'UG','title'=>'Degree','count'=>'380 programmes','body'=>'Bachelor, 3 years','href'=>route('programmes')],
        ['glyph'=>'MA','title'=>'Master','count'=>'210 programmes','body'=>'Master\'s, 1–2 years','href'=>route('programmes')],
        ['glyph'=>'PhD','title'=>'PhD','count'=>'90 programmes','body'=>'Doctorate, 3–5 years','href'=>route('programmes')],
        ['glyph'=>'EN','title'=>'English','count'=>'Online + 4 cities','body'=>'Intensive English · MUET prep','href'=>route('programmes')],
    ]"
/>

{{-- Why Malaysia --}}
<section class="section" style="background:var(--bg);">
    <div class="wrap" style="display:grid; grid-template-columns:1fr 1fr; gap:60px; align-items:start;">
        <div>
            <div class="eyebrow" style="margin-bottom:10px;">Why Malaysia</div>
            <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(28px,3.5vw,44px); font-weight:400; margin:0 0 16px; line-height:1.1;">The smartest <em style="color:var(--accent);">shortcut</em> into a UK or Australian degree.</h2>
            <p style="font-size:15px; line-height:1.65; color:var(--muted); margin:0 0 24px;">Malaysia is the world's largest transnational-education host. Five UK universities, four Australian, and a layer of strong local institutions all operate full branch campuses in KL, Selangor, Penang and Sarawak. For a Malaysian, Indonesian or Chinese student, no destination offers more degree value per ringgit.</p>
            <div style="background:var(--ink-deep); padding:16px 20px;">
                <div style="color:rgba(255,255,255,0.75); font-size:13px; line-height:1.5;">
                    <strong style="display:block; color:#fff; margin-bottom:4px;">Ilmu — knowledge, learning.</strong>
                    The Malay word for learning. The motto of every Malaysian university and the foundation of the nation's education vision.
                </div>
            </div>
        </div>
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:2px;">
            @php
            $whys = [
                ['num'=>'01','t'=>'Global branch campuses','body'=>'Monash, Nottingham, Heriot-Watt, Curtin, Reading and Newcastle — earn an identical UK or Australian degree at home-campus parity.'],
                ['num'=>'02','t'=>'Taught entirely in English','body'=>'Every internationally-open programme runs fully in English. No Bahasa requirement — IELTS or MUET accepted.'],
                ['num'=>'03','t'=>'Half the cost of the UK or AU','body'=>'Tuition and living combined run at 40–50% of the parent-campus price for the same degree, same syllabus, same parchment.'],
                ['num'=>'04','t'=>'Multicultural & home-like','body'=>'Malay, Chinese, Indian and international students share campuses across KL, Penang and Johor — feels like home from day one.'],
            ];
            @endphp
            @foreach($whys as $w)
            <div class="card" style="padding:24px;">
                <div class="eyebrow" style="color:var(--muted); margin-bottom:8px;">{{ $w['num'] }}</div>
                <h4 style="font-family:'Instrument Serif',serif; font-size:19px; font-weight:400; margin:0 0 8px; color:var(--ink);">{{ $w['t'] }}</h4>
                <p style="font-size:13px; line-height:1.55; color:var(--muted); margin:0;">{{ $w['body'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Trending programmes --}}
<section class="section" style="background:var(--paper);">
    <div class="wrap">
        <div style="display:flex; justify-content:space-between; align-items:end; margin-bottom:28px;">
            <div>
                <div class="eyebrow" style="margin-bottom:8px;">Top trending in Malaysia</div>
                <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(24px,3vw,38px); font-weight:400; margin:0;">Programmes <em style="color:var(--accent);">students are picking</em> this month.</h2>
            </div>
            <a href="{{ route('programmes') }}" class="btn-outline">See all Malaysia programmes →</a>
        </div>
        <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:2px;">
            @php
            $trending = [
                ['lvl'=>'DEGREE','uni'=>'Monash University Malaysia','title'=>'B.Eng. Software Engineering','meta'=>'3 yrs · English · Feb / Jul intake','phA'=>'#1c3d5a','phB'=>'#0a1f3a'],
                ['lvl'=>'MASTER','uni'=>'University of Malaya','title'=>'M.Sc. Data Science & Analytics','meta'=>'1.5 yrs · English · Sep intake','phA'=>'#3a7a5a','phB'=>'#1a3d2c'],
                ['lvl'=>'DEGREE','uni'=>'Taylor\'s University','title'=>'B.A. Hospitality & Tourism Management','meta'=>'3 yrs · English · Aug intake','phA'=>'#c98a1d','phB'=>'#5e3f10'],
                ['lvl'=>'FOUNDATION','uni'=>'Sunway College','title'=>'Foundation in Business Studies','meta'=>'1 yr · English · 4 intakes / yr','phA'=>'#a51717','phB'=>'#3d0808'],
            ];
            @endphp
            @foreach($trending as $t)
            <div class="card" style="overflow:hidden; cursor:pointer;">
                <div style="height:160px; background:linear-gradient(135deg,{{ $t['phA'] }},{{ $t['phB'] }}); position:relative; display:flex; align-items:flex-end; padding:10px;">
                    <span style="font-family:'DM Mono',monospace; font-size:9.5px; letter-spacing:0.1em; text-transform:uppercase; background:rgba(0,0,0,0.45); color:rgba(255,255,255,0.85); padding:3px 8px;">{{ $t['lvl'] }}</span>
                </div>
                <div style="padding:16px;">
                    <div style="font-size:12px; color:var(--muted); margin-bottom:4px;">{{ $t['uni'] }}</div>
                    <h4 style="font-family:'Instrument Serif',serif; font-size:17px; font-weight:400; margin:0 0 6px; color:var(--ink);">{{ $t['title'] }}</h4>
                    <div style="font-size:12px; color:var(--muted);">{{ $t['meta'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Requirements --}}
<x-requirements-table
    eyebrow="Entry requirements"
    title="Who can <em>apply.</em>"
    body="Indicative baseline. Branch campuses (Monash, Nottingham, Heriot-Watt) and top local universities (UM, USM, UKM, UPM) often require above-baseline scores. Your counsellor will confirm exact thresholds."
    :rows="[
        ['lvl'=>'Foundation','age'=>'16+','edu'=>'SPM / O-Level / UEC','lang'=>'IELTS 5.0 or MUET Band 3','docs'=>'Transcript · Passport · Health'],
        ['lvl'=>'Diploma','age'=>'17+','edu'=>'SPM / O-Level (3 credits min.)','lang'=>'IELTS 5.0 or MUET Band 3','docs'=>'Transcript · Passport · Health'],
        ['lvl'=>'Degree','age'=>'18+','edu'=>'STPM / A-Level / UEC / Foundation','lang'=>'IELTS 5.5–6.0 or MUET Band 4','docs'=>'Transcript · SOP · Health · 2 photos'],
        ['lvl'=>'Master','age'=>'21+','edu'=>'Recognised Bachelor\'s (CGPA 2.75+)','lang'=>'IELTS 6.0–6.5','docs'=>'Degree · Transcript · 2 refs · SOP'],
        ['lvl'=>'PhD','age'=>'23+','edu'=>'Recognised Master\'s degree','lang'=>'IELTS 6.5','docs'=>'Research proposal · 2 refs · Publications'],
    ]"
    langNote="MUET or English alternative"
/>

{{-- Timeline --}}
<x-timeline-card
    eyebrow="When to apply"
    title="A typical timeline <em>for the August intake.</em>"
    :steps="[
        ['mo'=>'OCT – DEC','t'=>'Shortlist','body'=>'Consultation, programme matching and pre-application advice.'],
        ['mo'=>'JAN – FEB','t'=>'Apply','body'=>'Submit through ITEA. Most universities run rolling admissions.'],
        ['mo'=>'MAR – APR','t'=>'Offers','body'=>'Conditional and unconditional offer letters released.'],
        ['mo'=>'MAY – JUN','t'=>'Visa','body'=>'EMGS Student Pass application — medical, biometrics, eVAL.'],
        ['mo'=>'JULY','t'=>'Pre-Depart','body'=>'Pre-arrival briefing, housing booking, airport pickup.'],
        ['mo'=>'AUGUST','t'=>'Arrival','body'=>'On-campus registration, orientation week and term start.'],
    ]"
/>

{{-- Docs + Events --}}
<x-docs-events
    :docs="[
        ['name'=>'Passport (valid 18+ months)','req'=>'Required'],
        ['name'=>'SPM / O-Level / UEC certificate','req'=>'For Foundation / Diploma'],
        ['name'=>'STPM / A-Level / Foundation certificate','req'=>'For Degree'],
        ['name'=>'Bachelor\'s certificate & transcripts','req'=>'For Master / PhD'],
        ['name'=>'Master\'s certificate & transcripts','req'=>'For PhD only'],
        ['name'=>'Recommendation letters (2)','req'=>'For Master / PhD'],
        ['name'=>'Personal statement / Study plan','req'=>'Required'],
        ['name'=>'Research proposal (1,500+ words)','req'=>'For PhD only'],
        ['name'=>'IELTS / MUET / TOEFL certificate','req'=>'Required'],
        ['name'=>'EMGS medical examination form','req'=>'For Student Pass'],
        ['name'=>'Bank statement (USD 4,000+)','req'=>'For visa'],
    ]"
    :events="[
        ['d'=>'18','m'=>'May','title'=>'Monash University Malaysia · Virtual Open Day','meta'=>'Live · 7:30 PM (MYT) · Zoom','type'=>'webinar','label'=>'Webinar'],
        ['d'=>'02','m'=>'Jun','title'=>'Study in Malaysia · KL Roadshow','meta'=>'In-person · ITEA HQ, KL','type'=>'roadshow','label'=>'Roadshow'],
        ['d'=>'14','m'=>'Jun','title'=>'UM & USM · Application Workshop','meta'=>'Live · 8 PM (MYT) · Zoom','type'=>'webinar','label'=>'Webinar'],
        ['d'=>'26','m'=>'Jun','title'=>'Taylor\'s University · Alumni Q&A','meta'=>'Live · 7:30 PM (MYT) · Zoom','type'=>'webinar','label'=>'Webinar'],
    ]"
/>

{{-- FAQ --}}
<x-faq-accordion
    sideTitle="Common <em>questions.</em>"
    sideBody="Six of the most-asked. If yours isn't here, our Malaysia desk responds on WhatsApp within an hour."
    sideCta="Chat with Malaysia desk"
    sideCtaHref="https://wa.me/60123456789"
    :faqs="[
        ['q'=>'Do I need to speak Bahasa Melayu to study in Malaysia?','a'=>'No. English is the official medium of instruction at every Malaysian university open to international students. Bahasa Melayu is a single elective course, not a graduation requirement, and you\'ll pick up enough day-to-day to thrive in KL or Penang within a month.'],
        ['q'=>'How much does it cost to study in Malaysia?','a'=>'Tuition runs RM 30,000–65,000 per year. Local universities (UM, USM, UKM) and Taylor\'s / Sunway sit at the lower end; branch campuses (Monash, Nottingham, Heriot-Watt) at the higher. Living costs in KL average RM 1,500–2,000 per month for shared accommodation, food and transport.'],
        ['q'=>'What scholarships are available for Malaysia?','a'=>'The Malaysia International Scholarship (MIS) is the federal full-ride for Master and PhD. Most private universities — Taylor\'s, Sunway, Monash, Nottingham — offer 10–50% merit scholarships of their own. ITEA shortlists every scholarship you qualify for in one pass.'],
        ['q'=>'When should I start my application?','a'=>'Aim 6–9 months before your intended intake. Malaysia runs three main intakes — February, July and September — and most universities accept rolling applications, but scholarship deadlines fall earlier (typically January–February for September).'],
        ['q'=>'Can I work part-time on a Student Pass?','a'=>'Yes. The Student Pass permits up to 20 hours/week of part-time work during the semester and full-time during semester breaks, in approved sectors: restaurants, petrol kiosks, mini-markets and hotels. On-campus assistantships are also widely available.'],
        ['q'=>'Will my Malaysian degree be recognised back home?','a'=>'Yes. MQA-accredited programmes are recognised across ASEAN, by China\'s CSDGE, and globally. Twinning / 3+0 degrees from Monash, Nottingham, Heriot-Watt and others award the home-campus parchment — identical to graduating in Melbourne or Nottingham.'],
    ]"
/>

{{-- CTA strip --}}
<section style="background:var(--ink-deep); color:#fff; padding:56px 0;">
    <div class="wrap" style="display:grid; grid-template-columns:1fr 1fr; gap:60px; align-items:center;">
        <div>
            <div class="eyebrow" style="color:rgba(255,255,255,0.4); margin-bottom:12px;">Ready when you are</div>
            <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(36px,4vw,56px); font-weight:400; margin:0; line-height:1;">Your future,<br><em style="color:var(--accent);">studied in Malaysia.</em></h2>
        </div>
        <div>
            <p style="font-size:16px; line-height:1.65; color:rgba(255,255,255,0.75); margin:0 0 24px;">One form gets you matched to up to five programmes and screened against six scholarships. A Malaysia desk counsellor calls you within 48 hours.</p>
            <div style="display:flex; gap:14px; align-items:center; flex-wrap:wrap;">
                <a href="{{ $applyUrl }}" class="btn-primary">Start Malaysia application →</a>
                <a href="#" style="color:rgba(255,255,255,0.6); font-size:14px; text-decoration:underline; text-underline-offset:4px;">Or download the Malaysia guide ↓</a>
            </div>
        </div>
    </div>
</section>

@endsection
