@extends('layouts.app')
@section('title', 'Application — ITEA EduAbroad')
@section('description', 'Apply to study in China, Malaysia or Indonesia through ITEA. 6-step process, transparent fees, end-to-end visa support and pre-departure briefing included.')
@section('nav_logo', 'assets/logo.jpeg')
@section('content')

<x-page-hero
    glow="sky"
    :breadcrumbs="[['href'=>route('home'),'label'=>'Home'],['href'=>route('application'),'label'=>'Application']]"
    label="Service desk · 6-step process"
    title="Application."
    zhTitle="申请"
    body="From shortlist to acceptance in twelve weeks. One service, every destination. ITEA handles programme matching, document prep, submission, scholarship parallel-tracking, visa applications and pre-departure briefing — start to plane."
    cta1Text="Start my application"
    cta1Href="#apply"
    cta2Text="Download application guide (PDF) ↓"
    cta2Href="#"
    factTitle="Application desk at a glance"
    :stats="[
        ['key'=>'Applications managed (lifetime)','val'=>'4,200','sup'=>'+'],
        ['key'=>'Acceptance rate','val'=>'99.8','sup'=>'%'],
        ['key'=>'Avg time to offer','val'=>'6','sup'=>' wks'],
        ['key'=>'Visa success rate','val'=>'99.4','sup'=>'%'],
        ['key'=>'Destinations supported','val'=>'3','sup'=>' + 2 soon'],
        ['key'=>'Service fee from','val'=>'RM 1.5','sup'=>'k'],
    ]"
/>

{{-- Quick nav --}}
<x-type-cards
    eyebrow="Jump to a section"
    title="Apply <em>your way.</em>"
    body="Six things you'll need to know to file a complete, scholarship-ready application. Tap any to jump there directly."
    :cards="[
        ['glyph'=>'申','zh'=>'申请流程','title'=>'How to Apply','count'=>'6 steps','body'=>'Step-by-step process','href'=>'#how'],
        ['glyph'=>'费','zh'=>'费用','title'=>'Fees','count'=>'Refundable','body'=>'Service fees & refund policy','href'=>'#fees'],
        ['glyph'=>'文','zh'=>'文件','title'=>'Documents','count'=>'By level','body'=>'Checklist for every programme','href'=>'#docs'],
        ['glyph'=>'签','zh'=>'签证','title'=>'Visa Guidance','count'=>'3 destinations','body'=>'End-to-end visa support','href'=>'#visa'],
        ['glyph'=>'行','zh'=>'行前','title'=>'Pre-Departure','count'=>'10 essentials','body'=>'Briefing before you travel','href'=>'#depart'],
        ['glyph'=>'立','zh'=>'立即申请','title'=>'Apply Now','count'=>'5-min form','body'=>'Start your application today','href'=>'#apply'],
    ]"
/>

{{-- How to apply timeline --}}
<section id="how" class="section" style="background:var(--bg); padding-top:80px;">
    <div class="wrap">
        <div style="background:var(--ink-deep); color:#fff; padding:40px 48px;">
            <div class="eyebrow" style="color:rgba(255,255,255,0.4); margin-bottom:14px;">How ITEA runs your application</div>
            <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(28px,3.5vw,42px); font-weight:400; margin:0 0 36px; line-height:1;">From form to flight in <em style="color:#78aae6;">twelve weeks.</em></h2>
            <div style="display:grid; grid-template-columns:repeat(6,1fr); gap:0;">
                @php
                $steps = [
                    ['mo'=>'WEEK 1','t'=>'Discovery','body'=>'Free 30-min consultation. We map your record, budget and ambition to programmes that fit.'],
                    ['mo'=>'WEEK 2','t'=>'Shortlist','body'=>'Up to 5 programmes + matching scholarships shortlisted across all destinations.'],
                    ['mo'=>'WEEK 3 – 4','t'=>'Prepare','body'=>'Documents, transcripts, essays, references and language tests pulled together.'],
                    ['mo'=>'WEEK 5 – 6','t'=>'Submit','body'=>'Parallel submission to all shortlisted universities via ITEA\'s partner portal.'],
                    ['mo'=>'WEEK 7 – 10','t'=>'Accept','body'=>'Offer review, deposit payment, contract signing — we negotiate scholarships where possible.'],
                    ['mo'=>'WEEK 11 – 12','t'=>'Depart','body'=>'Visa filed, EMGS or X1/X2 processed, pre-departure briefing, you board the plane.'],
                ];
                @endphp
                @foreach($steps as $i => $s)
                <div style="padding:0 {{ $loop->last ? '0' : '20px' }} 0 0; {{ !$loop->first ? 'border-left:1px solid rgba(255,255,255,0.1); padding-left:20px;' : '' }} opacity:{{ $i < 2 ? '1' : '0.55' }};">
                    <div style="width:28px; height:28px; border-radius:50%; background:{{ $i < 2 ? '#78aae6' : 'rgba(255,255,255,0.15)' }}; display:flex; align-items:center; justify-content:center; font-family:'JetBrains Mono',monospace; font-size:11px; margin-bottom:12px; color:{{ $i < 2 ? 'var(--ink-deep)' : '#fff' }};">{{ $i+1 }}</div>
                    <div class="eyebrow" style="color:rgba(255,255,255,0.4); margin-bottom:6px;">{{ $s['mo'] }}</div>
                    <h5 style="font-family:'Instrument Serif',serif; font-size:17px; font-weight:400; margin:0 0 6px;">{{ $s['t'] }}</h5>
                    <p style="font-size:13px; line-height:1.55; color:rgba(255,255,255,0.6); margin:0;">{{ $s['body'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- Fees --}}
<section id="fees" class="section" style="background:var(--paper);">
    <div class="wrap">
        <div style="display:flex; justify-content:space-between; align-items:end; margin-bottom:28px;">
            <div>
                <div class="eyebrow" style="margin-bottom:8px;">Fees · 费用</div>
                <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(28px,3.5vw,42px); font-weight:400; margin:0 0 10px;">Transparent <em style="color:var(--accent);">pricing.</em></h2>
                <p style="font-size:15px; color:var(--muted); margin:0; max-width:400px;">One quoted service fee. No hidden add-ons. Scholarship support and pre-departure briefing always included, free of charge.</p>
            </div>
            <div style="text-align:right;">
                <div style="font-family:'Instrument Serif',serif; font-size:42px; color:var(--ink);">RM 1,500</div>
                <div class="eyebrow" style="color:var(--muted);">Starting service fee · Updated May 2026</div>
            </div>
        </div>
        <div style="display:grid; grid-template-columns:1fr 320px; gap:24px;">
            <div style="border:1px solid var(--rule-soft);">
                <div style="display:grid; grid-template-columns:40px 1fr 1fr 120px; background:var(--ink-deep); color:#fff; padding:12px 16px; gap:16px;">
                    <div></div>
                    <div class="eyebrow" style="color:rgba(255,255,255,0.4);">Service</div>
                    <div class="eyebrow" style="color:rgba(255,255,255,0.4);">Description</div>
                    <div class="eyebrow" style="color:rgba(255,255,255,0.4); text-align:right;">Price</div>
                </div>
                @php
                $fees = [
                    ['idx'=>'01','name'=>'ITEA Service Fee','note'=>'One-time','desc'=>'End-to-end application management — counselling, document prep, submission, tracking and offer negotiation.','price'=>'RM 1,500 – 3,500','free'=>false],
                    ['idx'=>'02','name'=>'University Application Fees','note'=>'Per institution','desc'=>'Charged directly by each university for processing your application. Some universities waive this for ITEA partners.','price'=>'RM 200 – 800','free'=>false],
                    ['idx'=>'03','name'=>'Visa & Health Check','note'=>'Destination-dependent','desc'=>'Embassy fees, EMGS processing, medical examination, biometrics. Varies by destination and visa type.','price'=>'RM 600 – 1,200','free'=>false],
                    ['idx'=>'04','name'=>'Scholarship Support','note'=>'Always','desc'=>'Scholarship matching, essay coaching, parallel submission and interview prep across 42 active scholarships.','price'=>'Free','free'=>true],
                    ['idx'=>'05','name'=>'Pre-Departure Briefing','note'=>'With service','desc'=>'Two-hour group or one-on-one briefing covering arrival logistics, banking, SIM, housing and emergency contacts.','price'=>'Included','free'=>true],
                ];
                @endphp
                @foreach($fees as $f)
                <div style="display:grid; grid-template-columns:40px 1fr 1fr 120px; padding:14px 16px; gap:16px; border-top:1px solid var(--rule-soft); background:{{ $loop->even ? 'var(--bg)' : 'var(--paper)' }};">
                    <div class="eyebrow" style="color:var(--muted);">{{ $f['idx'] }}</div>
                    <div>
                        <div style="font-size:14px; font-weight:500; color:var(--ink);">{{ $f['name'] }}</div>
                        <div style="font-size:11px; color:var(--muted);">{{ $f['note'] }}</div>
                    </div>
                    <div style="font-size:13px; color:var(--muted); line-height:1.5;">{{ $f['desc'] }}</div>
                    <div style="font-family:'Instrument Serif',serif; font-size:18px; text-align:right; color:{{ $f['free'] ? '#2a8a6a' : 'var(--ink)' }};">{{ $f['price'] }}</div>
                </div>
                @endforeach
            </div>
            <div style="background:var(--ink-deep); color:#fff; padding:24px;">
                <div class="eyebrow" style="color:rgba(255,255,255,0.4); margin-bottom:12px;">Refund Policy</div>
                <h3 style="font-family:'Instrument Serif',serif; font-size:24px; font-weight:400; margin:0 0 18px; line-height:1.1;">Your money <em style="color:var(--gold);">back, fairly.</em></h3>
                <ul style="list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:12px;">
                    @foreach([['100%','Full refund of ITEA service fee if no offer is secured within 90 days of submission.'],['50%','Half refund of ITEA service fee if you voluntarily withdraw before submission to any university.'],['0%','No refund of service fee once visa application has been filed on your behalf.'],['N/A','University application fees are non-refundable per each institution\'s own policy.']] as [$pct,$text])
                    <li style="display:flex; gap:12px; align-items:baseline;">
                        <span style="font-family:'Instrument Serif',serif; font-size:24px; color:{{ $pct === '0%' ? '#d87070' : ($pct === 'N/A' ? 'rgba(255,255,255,0.3)' : 'var(--gold)') }}; flex-shrink:0; width:38px;">{{ $pct }}</span>
                        <span style="font-size:13px; color:rgba(255,255,255,0.65); line-height:1.4;">{{ $text }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- Documents --}}
<section id="docs" class="section" style="background:var(--bg);">
    <div class="wrap">
        <div style="margin-bottom:28px;">
            <div class="eyebrow" style="margin-bottom:8px;">Required documents · 所需文件</div>
            <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(28px,3.5vw,42px); font-weight:400; margin:0 0 12px;">What you need <em style="color:var(--accent);">by programme level.</em></h2>
            <p style="font-size:15px; color:var(--muted); max-width:600px; margin:0; line-height:1.6;">The base checklist. Top universities and scholarship-funded routes layer additional items. Your counsellor confirms the exact list during the profile review.</p>
        </div>
        <div style="border:1px solid var(--rule-soft);">
            <div style="display:grid; grid-template-columns:180px 1fr 220px; background:var(--ink-deep); color:#fff; padding:12px 16px; gap:16px;">
                @foreach(['Level','Required Documents','Notes'] as $h)
                <div class="eyebrow" style="color:rgba(255,255,255,0.4);">{{ $h }}</div>
                @endforeach
            </div>
            @php
            $docReqs = [
                ['lvl'=>'Foundation','items'=>'Passport · SPM / O-Level / UEC transcripts · 2 passport photos · Personal statement (short)','note'=>'From RM 30,000/yr · Aug intake'],
                ['lvl'=>'Diploma','items'=>'Passport · SPM / O-Level (3 credits min.) · 2 passport photos · Personal statement','note'=>'2 years · 4 intakes/yr'],
                ['lvl'=>'Undergraduate','items'=>'Passport · STPM / A-Level / UEC / Foundation · IELTS 5.5+ · SOP · 2 photos · Health declaration','note'=>'3 yrs · Feb / Aug intake'],
                ['lvl'=>'Master','items'=>'Passport · Bachelor\'s degree (CGPA 2.75+) · IELTS 6.0+ · 2 academic references · SOP · CV','note'=>'1–2 yrs · Sep intake'],
                ['lvl'=>'PhD','items'=>'Passport · Master\'s degree · IELTS 6.5+ · Research proposal (1,500+ words) · 2 academic refs · Publications','note'=>'3–5 yrs · Rolling intake'],
                ['lvl'=>'Mandarin / English','items'=>'Passport · Senior high-school certificate · Health declaration · 2 photos · Bank statement','note'=>'1 sem+ · Mar / Sep intake'],
            ];
            @endphp
            @foreach($docReqs as $r)
            <div style="display:grid; grid-template-columns:180px 1fr 220px; padding:14px 16px; gap:16px; border-top:1px solid var(--rule-soft); background:{{ $loop->even ? 'var(--bg-2)' : 'var(--paper)' }};">
                <div style="font-weight:600; font-size:14px; color:var(--ink);">{{ $r['lvl'] }}</div>
                <div style="font-size:14px; color:var(--ink-2);">{{ $r['items'] }}</div>
                <div class="eyebrow" style="color:var(--muted);">{{ $r['note'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Visa guidance --}}
<section id="visa" class="section" style="background:var(--paper);">
    <div class="wrap">
        <div style="display:flex; justify-content:space-between; align-items:end; margin-bottom:28px;">
            <div>
                <div class="eyebrow" style="margin-bottom:8px;">Visa guidance · 签证</div>
                <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(28px,3.5vw,42px); font-weight:400; margin:0;">End-to-end <em style="color:#78aae6;">visa support.</em></h2>
            </div>
            <p style="font-size:14px; color:var(--muted); max-width:340px; margin:0; text-align:right;">99.4% visa-success rate across China, Malaysia and Indonesia. We prepare the forms, schedule appointments, and stand with you at the embassy interview.</p>
        </div>
        <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:2px;">
            @php
            $visas = [
                ['code'=>'cn','country'=>'China','flag'=>'中','type'=>'X1 (Long-stay) / X2 (Short-stay) Student Visa','process'=>'2 – 3 weeks','fee'=>'RM 480 – 780','items'=>['JW202 admission notice','Foreigner Physical Examination Form','Bank statement (USD 5,000+)','Visa interview at Chinese embassy'],'soon'=>false],
                ['code'=>'my','country'=>'Malaysia','flag'=>'马','type'=>'Student Pass · via EMGS portal','process'=>'4 – 6 weeks','fee'=>'RM 1,060 – 2,500','items'=>['EMGS application + medical screening','eVAL approval letter','Single-entry visa at arrival','Renewal handled by ITEA each year'],'soon'=>false],
                ['code'=>'id','country'=>'Indonesia','flag'=>'印','type'=>'VITAS · Limited Stay Visa','process'=>'4 – 6 weeks','fee'=>'USD 200 – 400','items'=>['Available 2026','Available 2026','Available 2026','Available 2026'],'soon'=>true],
            ];
            @endphp
            @foreach($visas as $v)
            <div class="card" style="padding:28px; {{ $v['soon'] ? 'opacity:0.55;' : '' }}">
                <div style="font-family:'Noto Serif SC',serif; font-size:48px; color:var(--ink-2); opacity:0.2; line-height:1; margin-bottom:12px;">{{ $v['flag'] }}</div>
                <div class="eyebrow" style="margin-bottom:6px;">Destination · {{ $v['country'] }}</div>
                <h4 style="font-family:'Instrument Serif',serif; font-size:22px; font-weight:400; margin:0 0 6px; color:var(--ink);">{{ $v['country'] }} <em style="color:#78aae6;">visa</em></h4>
                <div style="font-size:13px; color:var(--muted); margin-bottom:16px; line-height:1.4;">{{ $v['type'] }}</div>
                <ul style="list-style:none; padding:0; margin:0 0 20px; display:flex; flex-direction:column; gap:8px;">
                    @foreach($v['items'] as $item)
                    <li style="display:flex; gap:8px; font-size:13px; color:{{ $v['soon'] ? 'var(--muted)' : 'var(--ink-2)' }};">
                        <span style="color:{{ $v['soon'] ? 'var(--muted)' : '#2a8a6a' }}; flex-shrink:0;">{{ $v['soon'] ? '○' : '✓' }}</span>
                        {{ $item }}
                    </li>
                    @endforeach
                </ul>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; border-top:1px solid var(--rule-soft); padding-top:16px;">
                    @foreach([['Processing',$v['process']],['Embassy fee',$v['fee']]] as [$k,$val])
                    <div>
                        <div class="eyebrow" style="margin-bottom:4px;">{{ $k }}</div>
                        <div style="font-family:'Instrument Serif',serif; font-size:18px; color:var(--ink);">{{ $val }}</div>
                    </div>
                    @endforeach
                </div>
                @if($v['soon'])
                <div style="margin-top:14px; text-align:center; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.12em; text-transform:uppercase; color:var(--muted); border:1px solid var(--rule-soft); padding:6px;">Coming Soon</div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Pre-departure --}}
<section id="depart" class="section" style="background:var(--bg-2);">
    <div class="wrap" style="display:grid; grid-template-columns:380px 1fr; gap:60px; align-items:start;">
        <div>
            <div class="eyebrow" style="margin-bottom:10px;">Pre-departure · 行前</div>
            <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(28px,3.5vw,42px); font-weight:400; margin:0 0 16px; line-height:1.1;">Ten things <em style="color:#78aae6;">handled</em> before you board.</h2>
            <p style="font-size:15px; line-height:1.65; color:var(--muted); margin:0 0 24px;">The two-hour briefing every ITEA student attends in the month before departure. Group session at our KL office, plus a 1-on-1 with your destination desk.</p>
            <div style="background:var(--ink-deep); color:#fff; padding:20px;">
                <div class="eyebrow" style="color:rgba(255,255,255,0.4); margin-bottom:8px;">INCLUDED FREE</div>
                <p style="font-size:13px; color:rgba(255,255,255,0.65); margin:0; line-height:1.5;">Every student receives the pre-departure briefing, an emergency-contact card, and a 30-day post-arrival check-in call.</p>
            </div>
        </div>
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:2px;">
            @php
            $predep = [
                ['num'=>'01','t'=>'Visa & insurance pickup','body'=>'Verified visa stamps, comprehensive medical insurance card, emergency repatriation cover.'],
                ['num'=>'02','t'=>'Flight booking advice','body'=>'Best routes, baggage allowances, layover guidance and group-discount options.'],
                ['num'=>'03','t'=>'Currency & banking','body'=>'How to open a local bank account, transfer caps, Alipay/WeChat (China) or Touch \'n Go (Malaysia) setup.'],
                ['num'=>'04','t'=>'SIM card & comms','body'=>'Pre-arranged eSIM activation, university wi-fi onboarding, family contact plan.'],
                ['num'=>'05','t'=>'Housing registration','body'=>'On-campus dormitory booking or off-campus rental shortlist, deposit handling and key collection.'],
                ['num'=>'06','t'=>'Airport pickup','body'=>'ITEA local team or partner-university driver meets you at arrivals — direct transfer to housing.'],
                ['num'=>'07','t'=>'Orientation week','body'=>'Programme registration, student-card collection, first-day class schedule, faculty introductions.'],
                ['num'=>'08','t'=>'Emergency contacts','body'=>'24/7 ITEA hotline card, embassy contacts, partner-uni international office, medical hotlines.'],
                ['num'=>'09','t'=>'Cultural briefing','body'=>'Social etiquette, food culture, public transport navigation, weather and packing essentials.'],
                ['num'=>'10','t'=>'First-month checkpoint','body'=>'Scheduled video call 30 days after arrival to debrief, fix issues and celebrate the start.'],
            ];
            @endphp
            @foreach($predep as $p)
            <div class="card" style="padding:18px;">
                <div style="font-family:'JetBrains Mono',monospace; font-size:11px; color:var(--muted); margin-bottom:6px;">{{ $p['num'] }}</div>
                <h5 style="font-family:'Instrument Serif',serif; font-size:17px; font-weight:400; margin:0 0 6px; color:var(--ink);">{{ $p['t'] }}</h5>
                <p style="font-size:13px; line-height:1.5; color:var(--muted); margin:0;">{{ $p['body'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Apply form --}}
<section id="apply" style="padding:72px 0; background:var(--bg);">
    <div class="wrap" style="display:grid; grid-template-columns:380px 1fr; gap:60px; align-items:start;">
        <div>
            <div class="eyebrow" style="margin-bottom:12px;">Apply now · 立即申请</div>
            <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(28px,3.5vw,42px); font-weight:400; margin:0 0 16px; line-height:1.1;">Start your <em style="color:#78aae6;">application.</em></h2>
            <p style="font-size:15px; line-height:1.65; color:var(--muted); margin:0 0 24px;">Five minutes is all it takes. A destination-desk counsellor calls you within 48 hours with a personalised shortlist and a clear next step.</p>
            <div style="display:flex; flex-direction:column; gap:12px;">
                @foreach(['<strong>Free initial consultation.</strong> Zero commitment, zero cost until you sign the service agreement.','<strong>Reply within 48 hours.</strong> Counsellor on WhatsApp, English / 中文 / BM — your choice.','<strong>Your data is private.</strong> Used only for your application. Never sold, never shared.'] as $promise)
                <div style="display:flex; gap:10px; align-items:flex-start; font-size:14px; color:var(--ink-2); line-height:1.5;">
                    <span style="width:7px; height:7px; border-radius:50%; background:var(--accent); flex-shrink:0; margin-top:5px;"></span>
                    <span>{!! $promise !!}</span>
                </div>
                @endforeach
            </div>
        </div>

        @if(session('enquiry_success'))
        <div style="background:var(--paper); border:1px solid var(--rule-soft); padding:32px; text-align:center;">
            <div class="eyebrow" style="color:#2a8a6a; margin-bottom:10px;">Received · 收到</div>
            <h3 style="font-family:'Instrument Serif',serif; font-size:28px; font-weight:400; margin:0 0 12px; color:var(--ink);">Thanks, <em style="color:#78aae6;">we'll be in touch.</em></h3>
            <p style="font-size:15px; color:var(--muted); margin:0;">A {{ session('destination', 'destination') }} desk counsellor will WhatsApp you within 48 hours. Keep an eye out for a message from <strong>+60 3 7890 0000</strong>.</p>
        </div>
        @else
        <div style="background:var(--paper); border:1px solid var(--rule-soft);">
            <div style="display:flex; justify-content:space-between; align-items:center; padding:16px 24px; border-bottom:1px solid var(--rule-soft);">
                <span class="eyebrow">Enquiry / Application form</span>
                <span style="background:var(--ink-deep); color:#fff; font-family:'JetBrains Mono',monospace; font-size:9px; letter-spacing:0.12em; text-transform:uppercase; padding:4px 10px;">REPLY · 48 HRS</span>
            </div>
            <form action="{{ route('enquiry.store') }}" method="POST" style="padding:24px;">
                @csrf
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-bottom:14px;">
                    <div>
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.12em; text-transform:uppercase; color:var(--muted); margin-bottom:5px;">Full name</label>
                        <input name="name" required value="{{ old('name') }}" placeholder="As shown on passport" style="width:100%; border:1px solid var(--rule-soft); background:var(--bg); padding:10px 12px; font-size:14px; box-sizing:border-box; color:var(--ink); outline:none;" onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='var(--rule-soft)'">
                    </div>
                    <div>
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.12em; text-transform:uppercase; color:var(--muted); margin-bottom:5px;">Email</label>
                        <input type="email" name="email" required value="{{ old('email') }}" placeholder="you@example.com" style="width:100%; border:1px solid var(--rule-soft); background:var(--bg); padding:10px 12px; font-size:14px; box-sizing:border-box; color:var(--ink); outline:none;" onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='var(--rule-soft)'">
                    </div>
                </div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-bottom:14px;">
                    <div>
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.12em; text-transform:uppercase; color:var(--muted); margin-bottom:5px;">WhatsApp</label>
                        <input name="whatsapp" required value="{{ old('whatsapp') }}" placeholder="+60 12 345 6789" style="width:100%; border:1px solid var(--rule-soft); background:var(--bg); padding:10px 12px; font-size:14px; box-sizing:border-box; color:var(--ink); outline:none;" onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='var(--rule-soft)'">
                    </div>
                    <div>
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.12em; text-transform:uppercase; color:var(--muted); margin-bottom:5px;">Destination of interest</label>
                        <select name="destination" style="width:100%; border:1px solid var(--rule-soft); background:var(--bg); padding:10px 12px; font-size:14px; box-sizing:border-box; color:var(--ink); outline:none;">
                            <option value="China" {{ old('destination') === 'China' ? 'selected' : '' }}>China</option>
                            <option value="Malaysia" {{ old('destination') === 'Malaysia' ? 'selected' : '' }}>Malaysia</option>
                            <option value="Indonesia (waitlist)" {{ old('destination') === 'Indonesia (waitlist)' ? 'selected' : '' }}>Indonesia (waitlist)</option>
                            <option value="Open to suggestions" {{ old('destination') === 'Open to suggestions' ? 'selected' : '' }}>Open to suggestions</option>
                        </select>
                    </div>
                </div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-bottom:14px;">
                    <div>
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.12em; text-transform:uppercase; color:var(--muted); margin-bottom:5px;">Programme level</label>
                        <select name="level" style="width:100%; border:1px solid var(--rule-soft); background:var(--bg); padding:10px 12px; font-size:14px; box-sizing:border-box; color:var(--ink); outline:none;">
                            @foreach(['Foundation','Diploma','Undergraduate','Master','PhD','Mandarin / English'] as $l)
                            <option value="{{ $l }}" {{ old('level') === $l ? 'selected' : '' }}>{{ $l }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.12em; text-transform:uppercase; color:var(--muted); margin-bottom:5px;">Intended intake</label>
                        <select name="intake" style="width:100%; border:1px solid var(--rule-soft); background:var(--bg); padding:10px 12px; font-size:14px; box-sizing:border-box; color:var(--ink); outline:none;">
                            @foreach(['Aug / Sep 2026','Feb / Mar 2027','Aug / Sep 2027','I\'m not sure yet'] as $opt)
                            <option value="{{ $opt }}" {{ old('intake') === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div style="margin-bottom:14px;">
                    <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.12em; text-transform:uppercase; color:var(--muted); margin-bottom:5px;">Anything we should know?</label>
                    <textarea name="message" rows="3" placeholder="Scholarship goals, preferred universities, family budget, language proficiency…" style="width:100%; border:1px solid var(--rule-soft); background:var(--bg); padding:10px 12px; font-size:14px; box-sizing:border-box; color:var(--ink); outline:none; resize:vertical;">{{ old('message') }}</textarea>
                </div>
                <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;">
                    <p style="font-size:12px; color:var(--muted); margin:0; max-width:320px; line-height:1.4;">By submitting this form, you agree to be contacted by ITEA EduAbroad. We never share your details.</p>
                    <button type="submit" class="btn-primary">Send enquiry →</button>
                </div>
            </form>
        </div>
        @endif
    </div>
</section>

{{-- FAQ --}}
<x-faq-accordion
    sideTitle="Common <em>questions.</em>"
    sideBody="Six of the most-asked. If yours isn't here, our application desk responds on WhatsApp within an hour."
    sideCta="Chat with application desk"
    sideCtaHref="https://wa.me/60123456789"
    :faqs="[
        ['q'=>'How long does the entire application take?','a'=>'From the first consultation to landing on campus, expect 10–14 weeks for most students. Foundation and Diploma intakes move fastest (8 weeks); PhD applications with research proposals can take 16+ weeks. Scholarship-funded applications follow the scholarship\'s own deadline calendar.'],
        ['q'=>'Do I need to be in Malaysia to apply?','a'=>'No. The entire ITEA process is remote-friendly — consultation by Zoom, document exchange via our secure portal, electronic signatures, and WhatsApp support throughout. Hundreds of our students apply from Indonesia, China, Vietnam and the Philippines without ever visiting our KL office.'],
        ['q'=>'Can I apply to multiple universities at the same time?','a'=>'Yes — and we strongly recommend it. Our standard service includes parallel submission to up to 5 universities. You compare offers when they arrive and accept the best one. No extra fees for additional applications within the same service tier.'],
        ['q'=>'What happens if I get rejected by all my universities?','a'=>'ITEA re-submits you to a second wave of universities at no additional service fee. If after 90 days no offer has been secured, our service fee is fully refundable. To date, that has happened to 8 out of 4,200+ students — a 99.8% placement rate.'],
        ['q'=>'Does ITEA handle the visa application itself?','a'=>'Yes. For China X1/X2, Malaysia EMGS Student Pass and Indonesia VITAS, we prepare and submit every form on your behalf, schedule embassy or medical appointments, and run a 99.4% visa success rate across the last three years. You only show up for biometrics.'],
        ['q'=>'What if I want to switch programmes after I\'ve started?','a'=>'Within the first semester, ITEA helps re-place you free of charge to another partner university (subject to admissions seat availability). After the first semester, transfer is at the discretion of the receiving university and any partial-tuition recovery depends on the original institution\'s policy.'],
    ]"
/>

@endsection
