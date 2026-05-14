@extends('layouts.app')
@section('title', 'Scholarships — ITEA EduAbroad')
@section('description', '42+ active scholarships across China and Malaysia. Full-ride, merit, need-based and research awards matched to your profile within 48 hours.')
@section('nav_logo', 'assets/logo.jpeg')
@section('content')

<x-page-hero
    glow="jade"
    :breadcrumbs="[['href'=>route('home'),'label'=>'Home'],['href'=>route('scholarship'),'label'=>'Scholarships']]"
    label="Funding desk · 42 active awards"
    title="Scholarships."
    zhTitle="奖学金"
    body="One conversation, every scholarship you qualify for. ITEA has placed 1,400+ Southeast Asian students into RM 65M of funded study since 2009 — across federal, university and industry awards."
    cta1Text="Find scholarships for me"
    :cta1Href="route('application').'#apply'"
    cta2Text="Download scholarship guide (PDF) ↓"
    cta2Href="#"
    factTitle="Scholarships at a glance"
    :stats="[
        ['key'=>'Active programmes','val'=>'42','sup'=>'+'],
        ['key'=>'Full-ride options','val'=>'12','sup'=>''],
        ['key'=>'Avg matches per student','val'=>'4.2','sup'=>''],
        ['key'=>'Funding placed (lifetime)','val'=>'RM65','sup'=>'M'],
        ['key'=>'Success rate (24/25)','val'=>'73','sup'=>'%'],
        ['key'=>'Application support','val'=>'Free','sup'=>''],
    ]"
/>

{{-- Scholarship types --}}
<x-type-cards
    eyebrow="Browse by scholarship type"
    title="What kind of <em>award?</em>"
    body="Six categories of funding. Click any to surface every scholarship in that bracket — across China, Malaysia and our growing destinations."
    :cards="[
        ['glyph'=>'全','zh'=>'全额','title'=>'Full-Ride','count'=>'12 programmes','body'=>'Tuition + housing + stipend','href'=>'#'],
        ['glyph'=>'减','zh'=>'学费减免','title'=>'Tuition Waiver','count'=>'85 universities','body'=>'Partial or full fee discount','href'=>'#'],
        ['glyph'=>'优','zh'=>'优秀','title'=>'Merit','count'=>'Most universities','body'=>'Awarded by academic excellence','href'=>'#'],
        ['glyph'=>'助','zh'=>'助学金','title'=>'Need-Based','count'=>'Federal + university','body'=>'Awarded by financial circumstance','href'=>'#'],
        ['glyph'=>'R','zh'=>'科研','title'=>'Research','count'=>'All disciplines','body'=>'Master & PhD researchers','href'=>'#'],
        ['glyph'=>'企','zh'=>'企业','title'=>'Industry','count'=>'Partner-funded','body'=>'Corporate-sponsored awards','href'=>'#'],
    ]"
/>

{{-- Why ITEA scholarship desk --}}
<section class="section" style="background:var(--bg);">
    <div class="wrap" style="display:grid; grid-template-columns:1fr 1fr; gap:60px; align-items:start;">
        <div>
            <div class="eyebrow" style="margin-bottom:10px;">Why ITEA's scholarship desk</div>
            <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(28px,3.5vw,44px); font-weight:400; margin:0 0 16px; line-height:1.1;">The fastest route between <em style="color:#2f9e6e;">your record</em> and an offer letter.</h2>
            <p style="font-size:15px; line-height:1.65; color:var(--muted); margin:0 0 24px;">Other agents charge for scholarship work; ITEA is paid by the universities. Our job is to map your record against every award, write the strongest applications you'll ever file, and stand behind you in panel interviews — in Mandarin, Bahasa or English, whichever lands the offer.</p>
            <div style="display:flex; gap:16px; align-items:center; background:var(--ink-deep); padding:16px 20px;">
                <div class="zh" style="font-size:52px; color:rgba(255,255,255,0.15); flex-shrink:0;">奖</div>
                <div style="color:rgba(255,255,255,0.75); font-size:13px; line-height:1.5;">
                    <strong style="display:block; color:#fff; margin-bottom:4px;">Jiǎng — award, recognition</strong>
                    The character on every Chinese scholarship certificate. The reward for academic ambition matched with the right application.
                </div>
            </div>
        </div>
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:2px;">
            @php
            $whys = [
                ['num'=>'01','t'=>'Free application support','body'=>'ITEA is paid by partner universities. No consultation, application or success fees on the scholarship desk — ever.'],
                ['num'=>'02','t'=>'Parallel submission','body'=>'We submit you for every award you qualify for in a single cycle. Most students apply to 4–6 scholarships at once.'],
                ['num'=>'03','t'=>'73% success rate','body'=>'73% of our 2024–25 candidates received at least one funded offer. Average award: 60% of total programme cost.'],
                ['num'=>'04','t'=>'Local advisors','body'=>'Our China desk and Malaysia desk write essays, prep interviews and lobby admissions in-language — not from a script.'],
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

{{-- Featured awards --}}
<section class="section" style="background:var(--paper);">
    <div class="wrap">
        <div style="display:flex; justify-content:space-between; align-items:end; margin-bottom:28px;">
            <div>
                <div class="eyebrow" style="margin-bottom:8px;">Featured awards</div>
                <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(24px,3vw,38px); font-weight:400; margin:0;">Scholarships <em style="color:#2f9e6e;">open right now.</em></h2>
            </div>
            <a href="#" class="btn-outline">See all 42 scholarships →</a>
        </div>
        <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:2px;">
            @php
            $awards = [
                ['lvl'=>'FULL-RIDE','uni'=>'China Scholarship Council','title'=>'CSC · Chinese Government Scholarship','meta'=>'All levels · Sep deadline · 5,000+ awarded','phA'=>'#a51717','phB'=>'#3d0808'],
                ['lvl'=>'FULL-RIDE','uni'=>'Government of Malaysia','title'=>'MIS · Malaysia International Scholarship','meta'=>'Master / PhD · Mar & Aug · Federal funded','phA'=>'#c98a1d','phB'=>'#5e3f10'],
                ['lvl'=>'TUITION','uni'=>'Jeffrey Cheah Foundation','title'=>'Sunway Group · Foundation Award','meta'=>'Undergraduate · Feb intake · Up to 100%','phA'=>'#1c3d5a','phB'=>'#0a1f3a'],
                ['lvl'=>'FULL-RIDE','uni'=>'Tsinghua University','title'=>'Schwarzman Scholars Programme','meta'=>'1-yr Master · Sep deadline · 200 places','phA'=>'#3a7a5a','phB'=>'#1a3d2c'],
            ];
            @endphp
            @foreach($awards as $a)
            <div class="card" style="overflow:hidden; cursor:pointer;">
                <div style="height:160px; background:linear-gradient(135deg,{{ $a['phA'] }},{{ $a['phB'] }}); position:relative; display:flex; align-items:flex-end; padding:10px;">
                    <span style="font-family:'JetBrains Mono',monospace; font-size:9px; letter-spacing:0.1em; text-transform:uppercase; background:rgba(0,0,0,0.45); color:rgba(255,255,255,0.85); padding:3px 8px;">{{ $a['lvl'] }}</span>
                </div>
                <div style="padding:16px;">
                    <div style="font-size:12px; color:var(--muted); margin-bottom:4px;">{{ $a['uni'] }}</div>
                    <h4 style="font-family:'Instrument Serif',serif; font-size:17px; font-weight:400; margin:0 0 6px; color:var(--ink);">{{ $a['title'] }}</h4>
                    <div style="font-size:12px; color:var(--muted); margin-bottom:10px;">{{ $a['meta'] }}</div>
                    <a href="#" style="font-size:12px; color:var(--accent); font-weight:500; text-decoration:none;">Check eligibility →</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Eligibility --}}
<x-requirements-table
    eyebrow="Eligibility"
    title="Who can <em>apply.</em>"
    body="Indicative baseline by scholarship type. Top awards (CSC, MIS, Schwarzman) layer additional language, leadership or research criteria. Your counsellor confirms exact thresholds during the profile review."
    :headers="['Type','Level / Age','Academic','Language','Other']"
    :rows="[
        ['lvl'=>'Full-Ride','age'=>'Under 35 (MA) · 40 (PhD)','edu'=>'Top 10% academic · CGPA 3.5+','lang'=>'IELTS 6.5+ / HSK 5+','docs'=>'Transcript · 2 academic refs · SOP'],
        ['lvl'=>'Tuition Waiver','age'=>'All levels','edu'=>'Top 30% · CGPA 3.3+','lang'=>'IELTS 6.0+ / MUET 4','docs'=>'Transcript · SOP · Interview'],
        ['lvl'=>'Merit','age'=>'All levels','edu'=>'Programme-required + above','lang'=>'Programme-required','docs'=>'Transcript · CV'],
        ['lvl'=>'Need-Based','age'=>'All levels','edu'=>'Programme-required (CGPA 2.75+)','lang'=>'Programme-required','docs'=>'Financial declaration · Income docs'],
        ['lvl'=>'Research','age'=>'Master & PhD','edu'=>'Recognised previous degree','lang'=>'IELTS 6.5+','docs'=>'Research proposal · Publications · 2 refs'],
    ]"
    langNote="Or programme-equivalent"
/>

{{-- Timeline --}}
<x-timeline-card
    eyebrow="How ITEA runs your application"
    title="From profile to offer in <em>under 13 weeks.</em>"
    :steps="[
        ['mo'=>'WEEK 1','t'=>'Profile Review','body'=>'1-on-1 review of your academic record, goals and budget.'],
        ['mo'=>'WEEK 2','t'=>'Shortlist','body'=>'We map every scholarship you qualify for across all destinations.'],
        ['mo'=>'WEEK 3 – 4','t'=>'Prep','body'=>'Essay drafting, reference outreach, supporting-document review.'],
        ['mo'=>'WEEK 5 – 6','t'=>'Submit','body'=>'Parallel submission of 4–6 applications via ITEA\'s portal.'],
        ['mo'=>'WEEK 7 – 12','t'=>'Interview','body'=>'Mock interviews, panel prep, and live coaching in-language.'],
        ['mo'=>'WEEK 13+','t'=>'Onboarding','body'=>'Acceptance, contract review, pre-departure briefing.'],
    ]"
/>

{{-- Docs + Events --}}
<x-docs-events
    eventsTitle="Upcoming <em>workshops &amp; bootcamps.</em>"
    :docs="[
        ['name'=>'Passport (valid 18+ months)','req'=>'Required'],
        ['name'=>'Academic transcripts (all levels)','req'=>'Required'],
        ['name'=>'Degree / diploma certificates','req'=>'Required'],
        ['name'=>'Language test (IELTS / HSK / MUET / TOEFL)','req'=>'Required'],
        ['name'=>'Recommendation letters (2)','req'=>'For Merit / Research'],
        ['name'=>'Personal statement / scholarship essay','req'=>'Required'],
        ['name'=>'CV / resume','req'=>'Required'],
        ['name'=>'Research proposal (1,500+ words)','req'=>'For Research / PhD'],
        ['name'=>'Financial declaration & income docs','req'=>'For Need-Based'],
        ['name'=>'Recent passport photos (2)','req'=>'Required'],
        ['name'=>'Citizenship / residency proof','req'=>'Required'],
    ]"
    :events="[
        ['d'=>'20','m'=>'May','title'=>'CSC Application Workshop · Step-by-step','meta'=>'Live · 7:30 PM (MYT) · Zoom','type'=>'webinar','label'=>'Webinar'],
        ['d'=>'30','m'=>'May','title'=>'Scholarship Essay Bootcamp · Live edits','meta'=>'In-person · ITEA HQ, KL','type'=>'roadshow','label'=>'Bootcamp'],
        ['d'=>'12','m'=>'Jun','title'=>'MIS Application Q&A with past recipient','meta'=>'Live · 8 PM (MYT) · Zoom','type'=>'webinar','label'=>'Webinar'],
        ['d'=>'28','m'=>'Jun','title'=>'Jeffrey Cheah Foundation · Info Session','meta'=>'In-person · Sunway University','type'=>'roadshow','label'=>'Info Session'],
    ]"
/>

{{-- FAQ --}}
<x-faq-accordion
    sideTitle="Common <em>questions.</em>"
    sideBody="Six of the most-asked. If yours isn't here, our scholarship desk responds on WhatsApp within an hour."
    sideCta="Chat with scholarship desk"
    sideCtaHref="https://wa.me/60123456789"
    :faqs="[
        ['q'=>'How many scholarships can I apply to at once?','a'=>'As many as you qualify for. ITEA runs parallel submissions, and most students apply to 4–6 scholarships in a single cycle. There\'s no penalty for applying widely; in fact, it\'s how we get to our 73% success rate.'],
        ['q'=>'Is ITEA\'s scholarship support really free?','a'=>'Yes. ITEA is paid by our partner universities, not by you. There are no consultation fees, no application fees, and no success fees on the scholarship desk. The only money you ever spend is what the scholarship issuer charges directly (e.g. CSC\'s small registration fee).'],
        ['q'=>'What is the realistic success rate?','a'=>'Across the 2024–25 intake, 73% of ITEA scholarship candidates received at least one funded offer. Average award value was 60% of total programme cost — 28% of candidates received full-ride awards covering tuition, housing and a monthly stipend.'],
        ['q'=>'When should I start my scholarship application?','a'=>'Aim 9–12 months before your intended intake. CSC opens January and closes April for September intake. MIS opens January and closes February. University-specific awards run on their own calendars — your counsellor will build a personalised timeline.'],
        ['q'=>'Can I apply for scholarships in multiple countries at the same time?','a'=>'Yes — and we recommend it. Many students secure both a China-side scholarship (e.g. CSC) and a Malaysia branch-campus award, then choose the best offer. There\'s no exclusivity clause unless you formally accept and sign.'],
        ['q'=>'Do scholarships cover flights, visa and insurance?','a'=>'Full-ride awards (CSC, MIS, Schwarzman) include tuition, accommodation, a monthly stipend and comprehensive medical insurance. Flight is usually not included — budget RM 1,200–2,500 for a one-way ticket. ITEA covers your visa-stage logistics free of charge.'],
    ]"
/>

{{-- CTA strip --}}
<section style="background:var(--ink-deep); color:#fff; padding:56px 0;">
    <div class="wrap" style="display:grid; grid-template-columns:1fr 1fr; gap:60px; align-items:center;">
        <div>
            <div class="eyebrow" style="color:rgba(255,255,255,0.4); margin-bottom:12px;">Ready when you are</div>
            <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(36px,4vw,56px); font-weight:400; margin:0; line-height:1;">Your future,<br><em style="color:#2f9e6e;">funded.</em></h2>
        </div>
        <div>
            <p style="font-size:16px; line-height:1.65; color:rgba(255,255,255,0.75); margin:0 0 24px;">One form gets you screened against 42 active scholarships. A funding-desk advisor calls you within 48 hours with a personalised shortlist — and walks you through every application, free of charge.</p>
            <div style="display:flex; gap:14px; align-items:center; flex-wrap:wrap;">
                <a href="{{ route('application') }}#apply" class="btn-primary">Start scholarship match →</a>
                <a href="#" style="color:rgba(255,255,255,0.6); font-size:14px; text-decoration:underline; text-underline-offset:4px;">Or download the scholarship guide ↓</a>
            </div>
        </div>
    </div>
</section>

@endsection
