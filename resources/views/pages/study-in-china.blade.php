@extends('layouts.app')
@section('title', 'Study in China — ITEA EduAbroad')
@section('description', '280+ partner universities in China. Degree, Master, PhD and Mandarin programmes with scholarship matching and end-to-end support.')
@section('nav_logo', 'assets/logo-china.png')

@section('content')

<x-page-hero
    glow="red"
    :breadcrumbs="[['href'=>route('home'),'label'=>'Home'],['href'=>'#','label'=>'Destinations'],['href'=>route('china'),'label'=>'Study in China']]"
    label="Destination · 01 of 03"
    title="Study in <em style='color:var(--accent)'>China.</em>"
    zhTitle="中国留学"
    body="The largest higher-education system in the world. World-class research, the most generous scholarships in Asia, and a graduate-employment network spanning 280+ partner universities."
    cta1Text="Match me to a programme"
    :cta1Href="route('application').'#apply'"
    cta2Text="Download China guide (PDF) ↓"
    cta2Href="#"
    factTitle="China at a glance"
    :stats="[
        ['key'=>'Partner universities','val'=>'280','sup'=>'+'],
        ['key'=>'Programmes available','val'=>'1,200','sup'=>'+'],
        ['key'=>'QS Top 100 institutions','val'=>'11','sup'=>''],
        ['key'=>'English-taught programmes','val'=>'1,200','sup'=>'+'],
        ['key'=>'Average tuition (Master)','val'=>'¥32','sup'=>'k / yr'],
        ['key'=>'Scholarship match rate','val'=>'94','sup'=>'%'],
    ]"
/>

{{-- Programme types --}}
<x-type-cards
    eyebrow="Browse by programme type"
    title="What level <em>are you?</em>"
    body="Six routes into the Chinese higher-education system. Click any to jump into the matching programmes."
    :cards="[
        ['glyph'=>'大专','zh'=>'大专','title'=>'Diploma','count'=>'85 programmes','body'=>'2–3 year vocational entry','href'=>route('programmes')],
        ['glyph'=>'本科','zh'=>'本科','title'=>'Degree','count'=>'320 programmes','body'=>'Bachelor, 4 years','href'=>route('programmes')],
        ['glyph'=>'硕士','zh'=>'硕士','title'=>'Master','count'=>'240 programmes','body'=>'Master\'s, 2–3 years','href'=>route('programmes')],
        ['glyph'=>'博士','zh'=>'博士','title'=>'PhD','count'=>'120 programmes','body'=>'Doctorate, 3–4 years','href'=>route('programmes')],
        ['glyph'=>'文','zh'=>'汉语','title'=>'Mandarin','count'=>'Online + 6 cities','body'=>'HSK 1 to 6, immersion','href'=>route('programmes')],
        ['glyph'=>'交','zh'=>'交流','title'=>'Exchange','count'=>'1 sem · 1 yr','body'=>'Student exchange · visiting','href'=>route('programmes')],
    ]"
/>

{{-- Why China --}}
<section class="section" style="background:var(--bg);">
    <div class="wrap" style="display:grid; grid-template-columns:1fr 1fr; gap:60px; align-items:start;">
        <div>
            <div class="eyebrow" style="margin-bottom:10px;">Why China</div>
            <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(28px,3.5vw,44px); font-weight:400; margin:0 0 16px; line-height:1.1;">The most ambitious place <em style="color:var(--accent);">to study</em> in Asia.</h2>
            <p style="font-size:15px; line-height:1.65; color:var(--muted); margin:0 0 24px;">Forty years ago, China had three globally-ranked universities. Today it has eleven in the QS Top 100 and a research output that surpasses the United States. For a Malaysian or Indonesian student, no other destination combines this scale of opportunity with this level of scholarship support.</p>
            <div style="display:flex; gap:16px; align-items:center; background:var(--ink-deep); padding:16px 20px;">
                <div class="zh" style="font-size:52px; color:rgba(255,255,255,0.15); flex-shrink:0;">学</div>
                <div style="color:rgba(255,255,255,0.75); font-size:13px; line-height:1.5;">
                    <strong style="display:block; color:#fff; margin-bottom:4px;">Xué — to study, to learn</strong>
                    The seal of the scholar; the first character every student of China learns.
                </div>
            </div>
        </div>
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:2px;">
            @php
            $whys = [
                ['num'=>'01','t'=>'World-class institutions','body'=>'11 universities in QS Top 100. Tsinghua and Peking sit at #20 and #14 globally — ahead of most US Ivies.'],
                ['num'=>'02','t'=>'Generous scholarships','body'=>'Chinese Government Scholarship (CSC) covers full tuition, hostel, monthly stipend and insurance.'],
                ['num'=>'03','t'=>'English-taught options','body'=>'Over 1,200 programmes taught entirely in English. Mandarin is optional, not required.'],
                ['num'=>'04','t'=>'Tier-1 city living','body'=>'Beijing, Shanghai, Shenzhen — global cities at a fraction of London or Sydney prices.'],
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

{{-- Partner universities --}}
<section class="section" style="background:var(--paper);">
    <div class="wrap">
        <div style="display:flex; justify-content:space-between; align-items:end; margin-bottom:28px;">
            <div>
                <div class="eyebrow" style="margin-bottom:8px;">Our China partner universities</div>
                <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(24px,3vw,38px); font-weight:400; margin:0;">Four universities <em style="color:var(--accent);">placing our students.</em></h2>
            </div>
            <a href="{{ route('programmes') }}" class="btn-outline">See all China programmes →</a>
        </div>

        @php
        $partners = [
            ['abbr'=>'ZUST','uni'=>'Zhejiang University of Science and Technology','zh'=>'浙江科技大学','crest'=>'浙','type'=>'Public','location'=>'Hangzhou · Zhejiang','founded'=>'1980','students'=>'22k','intl'=>'1,600','popular'=>'Computer Science · Robotics · Artificial Intelligence · Civil Engineering','tuition'=>'CNY 18 – 25k','tag'=>'Sino-German','website'=>'https://www.zust.edu.cn/','logo'=>'uni-zust.png','phA'=>'#1c3d5a','phB'=>'#0a1f3a'],
            ['abbr'=>'SDUT','uni'=>'Shandong University of Technology','zh'=>'山东理工大学','crest'=>'山理','type'=>'Public','location'=>'Zibo · Shandong','founded'=>'1956','students'=>'34k','intl'=>'1,000','popular'=>'Mechanical Engineering · Electrical · Computer Science · Chemical Engineering','tuition'=>'USD 2.5 – 4.5k','tag'=>'Engineering','website'=>'https://www.sdut.edu.cn/','logo'=>'sdut.jpg','phA'=>'#34526e','phB'=>'#1a2a3e'],
            ['abbr'=>'JUFE','uni'=>'Jiangxi University of Finance and Economics','zh'=>'江西财经大学','crest'=>'江财','type'=>'Public','location'=>'Nanchang · Jiangxi','founded'=>'1923','students'=>'40k','intl'=>'1,500','popular'=>'Finance · Accounting · International Business · Economics','tuition'=>'USD 3 – 6k','tag'=>'Finance · Business','website'=>'https://www.jxufe.edu.cn/','logo'=>'jufe.jpg','phA'=>'#a51717','phB'=>'#3d0808'],
            ['abbr'=>'HMU','uni'=>'Hainan Medical University','zh'=>'海南医科大学','crest'=>'海医','type'=>'Public','location'=>'Haikou · Hainan','founded'=>'1947','students'=>'15k','intl'=>'1,200','popular'=>'MBBS (English) · Clinical Medicine · Nursing · Pharmacy','tuition'=>'USD 3 – 6k','tag'=>'Medical · MBBS','website'=>'https://www.hainmc.edu.cn/','logo'=>'hmu.jpg','phA'=>'#2a8a6a','phB'=>'#0e3527'],
        ];
        @endphp

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:2px;">
            @foreach($partners as $u)
            <a href="{{ $u['website'] }}" target="_blank" rel="noopener" class="card" style="display:grid; grid-template-columns:180px 1fr; overflow:hidden; text-decoration:none; color:inherit;">
                {{-- Crest panel --}}
                <div style="background:linear-gradient(160deg, {{ $u['phA'] }}, {{ $u['phB'] }}); position:relative; display:flex; align-items:center; justify-content:center;">
                    <span style="position:absolute; top:10px; left:10px; font-family:'JetBrains Mono',monospace; font-size:9px; letter-spacing:0.1em; padding:3px 8px; border:1px solid rgba(255,255,255,0.25); color:rgba(255,255,255,0.7); text-transform:uppercase;">{{ $u['tag'] }}</span>
                    @if($u['logo'])
                    <img src="{{ asset('assets/'.$u['logo']) }}" alt="{{ $u['uni'] }}" style="width:100%; height:100%; object-fit:cover; position:absolute; inset:0;">
                    <div style="position:absolute; inset:0; background:linear-gradient(to right, transparent 60%, {{ $u['phB'] }});"></div>
                    @else
                    <span class="zh" style="font-size:48px; color:rgba(255,255,255,0.35); font-weight:700;">{{ $u['crest'] }}</span>
                    @endif
                    <span style="position:absolute; bottom:10px; left:10px; font-family:'JetBrains Mono',monospace; font-size:9px; color:rgba(255,255,255,0.45); letter-spacing:0.1em;">{{ $u['abbr'] }} · 中国</span>
                </div>
                {{-- Body --}}
                <div style="padding:20px;">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px;">
                        <span style="font-family:'JetBrains Mono',monospace; font-size:11px; color:var(--accent); letter-spacing:0.08em;">{{ $u['abbr'] }}</span>
                        <span class="eyebrow" style="color:var(--muted);">{{ $u['type'] }}</span>
                    </div>
                    <h4 style="font-family:'Instrument Serif',serif; font-size:18px; font-weight:400; margin:0 0 3px; color:var(--ink); line-height:1.25;">{{ $u['uni'] }}</h4>
                    <div class="zh" style="font-size:13px; color:var(--muted); margin-bottom:6px;">{{ $u['zh'] }}</div>
                    <div style="font-size:12px; color:var(--muted); margin-bottom:10px;">{{ $u['location'] }} · Founded {{ $u['founded'] }}</div>
                    <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:8px; margin-bottom:10px;">
                        @foreach([['Students',$u['students']],['International',$u['intl']],['Founded',$u['founded']]] as [$k,$v])
                        <div>
                            <div style="font-size:10px; color:var(--muted); font-family:'JetBrains Mono',monospace; letter-spacing:0.08em;">{{ $k }}</div>
                            <div style="font-family:'Instrument Serif',serif; font-size:18px; color:var(--ink);">{{ $v }}</div>
                        </div>
                        @endforeach
                    </div>
                    <div style="font-size:12px; color:var(--muted); margin-bottom:10px; line-height:1.4;">
                        <strong style="color:var(--ink-2);">Popular majors</strong><br>{{ $u['popular'] }}
                    </div>
                    <div style="display:flex; justify-content:space-between; align-items:center;">
                        <span style="font-family:'Instrument Serif',serif; font-size:20px; color:var(--ink);">{{ $u['tuition'] }}<small style="font-family:'Geist',sans-serif; font-size:11px; color:var(--muted);">/ year</small></span>
                        <span style="font-size:12px; color:var(--accent); font-weight:500;">View university →</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- Requirements --}}
<x-requirements-table
    eyebrow="Entry requirements"
    title="Who can <em>apply.</em>"
    body="Indicative baseline. Top universities (Tsinghua, Peking, Fudan, Zhejiang) often require above-baseline scores. Your counsellor will confirm exact thresholds for the programmes you shortlist."
    :rows="[
        ['lvl'=>'Diploma','age'=>'16+','edu'=>'Senior High School · SPM / O-Level / equivalent','lang'=>'HSK 3 or IELTS 5.0','docs'=>'Transcript · Passport · Health'],
        ['lvl'=>'Degree','age'=>'18+','edu'=>'Senior High School · STPM / A-Level / UEC','lang'=>'HSK 4 or IELTS 5.5–6.0','docs'=>'Transcript · Passport · Health · 2 photos'],
        ['lvl'=>'Master','age'=>'Under 40','edu'=>'Recognised Bachelor\'s degree (CGPA 2.75+)','lang'=>'HSK 5 or IELTS 6.5','docs'=>'Degree · Transcript · 2 references · SOP'],
        ['lvl'=>'PhD','age'=>'Under 45','edu'=>'Recognised Master\'s degree','lang'=>'HSK 6 or IELTS 7.0','docs'=>'Research proposal · 2 academic refs · Publications'],
        ['lvl'=>'Mandarin','age'=>'16+','edu'=>'Senior High School','lang'=>'None required','docs'=>'Passport · Health · Photos'],
    ]"
    langNote="HSK or English alternative"
/>

{{-- Timeline --}}
<x-timeline-card
    eyebrow="When to apply"
    title="A typical timeline <em>for the September intake.</em>"
    :steps="[
        ['mo'=>'OCT – DEC','t'=>'Shortlist','body'=>'Consultation, programme matching and pre-application advice.'],
        ['mo'=>'JAN – FEB','t'=>'Apply','body'=>'Submit applications via ITEA. Most universities accept rolling applications.'],
        ['mo'=>'MAR – APR','t'=>'Offers','body'=>'Conditional and unconditional offer letters released by host universities.'],
        ['mo'=>'MAY – JUN','t'=>'Visa','body'=>'JW-202 form issued. Apply for X1/X2 student visa at Chinese embassy.'],
        ['mo'=>'JUL – AUG','t'=>'Pre-Depart','body'=>'Pre-departure briefing, hostel booking, airport pickup arranged.'],
        ['mo'=>'SEPTEMBER','t'=>'Arrival','body'=>'On-campus registration, orientation and the start of the academic year.'],
    ]"
/>

{{-- Docs + Events --}}
<x-docs-events
    :docs="[
        ['name'=>'Passport (valid 18+ months)','req'=>'Required'],
        ['name'=>'High school transcripts & certificate','req'=>'Required'],
        ['name'=>'Bachelor\'s certificate & transcripts','req'=>'For Master/PhD'],
        ['name'=>'Master\'s certificate & transcripts','req'=>'For PhD only'],
        ['name'=>'Recommendation letters (2)','req'=>'For Master/PhD'],
        ['name'=>'Personal statement / Study plan','req'=>'Required'],
        ['name'=>'Research proposal (1,500+ words)','req'=>'For PhD only'],
        ['name'=>'HSK / IELTS / TOEFL certificate','req'=>'If applicable'],
        ['name'=>'Physical examination form (JW202)','req'=>'Required'],
        ['name'=>'Bank statement (USD 5,000+)','req'=>'For visa'],
    ]"
    :events="[
        ['d'=>'22','m'=>'May','title'=>'Tsinghua University · Online Open Day','meta'=>'Live · 8 PM (MYT) · Zoom','type'=>'webinar','label'=>'Webinar'],
        ['d'=>'05','m'=>'Jun','title'=>'Study in China · KL Roadshow','meta'=>'In-person · ITEA HQ, KL','type'=>'roadshow','label'=>'Roadshow'],
        ['d'=>'12','m'=>'Jun','title'=>'CSC Scholarship · Application Workshop','meta'=>'Live · 7:30 PM (MYT) · Zoom','type'=>'webinar','label'=>'Webinar'],
        ['d'=>'28','m'=>'Jun','title'=>'Peking University · Alumni Q&A','meta'=>'Live · 8 PM (MYT) · Zoom','type'=>'webinar','label'=>'Webinar'],
    ]"
/>

{{-- FAQ --}}
<x-faq-accordion
    sideTitle="Common <em>questions.</em>"
    sideBody="Six of the most-asked. If yours isn't here, our China desk responds on WhatsApp within an hour."
    sideCta="Chat with China desk"
    sideCtaHref="https://wa.me/60123456789"
    :faqs="[
        ['q'=>'Do I need to speak Mandarin to study in China?','a'=>'No. Over 1,200 programmes across all levels are taught entirely in English — from undergraduate engineering to PhD in AI. Many students arrive with zero Mandarin and pick it up casually over their degree. If you want, ITEA Learning gives you 12 free HSK-aligned online levels before you fly.'],
        ['q'=>'How much does it cost to study in China?','a'=>'Tuition ranges from RMB 18,000–45,000 per year (roughly RM 11,000–28,000), depending on the programme and university. On-campus accommodation is RMB 800–2,500/month. Living costs in Tier-1 cities like Beijing or Shanghai average RMB 2,500/month. Scholarships can bring this to zero.'],
        ['q'=>'What is the Chinese Government Scholarship (CSC)?','a'=>'CSC is a full-ride scholarship from the Ministry of Education: tuition + on-campus accommodation + monthly stipend (RMB 2,500–3,500) + comprehensive medical insurance. It is open to undergraduate, Master and PhD students. ITEA helps prepare and submit your CSC application.'],
        ['q'=>'When should I start my application?','a'=>'Aim to start 9–12 months before your intended intake. For the September intake, ideal start is October–December of the previous year. Many universities accept applications until March–April but scholarships have earlier deadlines (typically February).'],
        ['q'=>'Can I work part-time as a student in China?','a'=>'On-campus part-time work and approved internships are permitted with university authorisation. Off-campus paid work is restricted under student visa regulations. Many students take research-assistant or teaching-assistant roles within their faculty.'],
        ['q'=>'Will my degree be recognised back home?','a'=>'Yes. Most Chinese Double First-Class universities are recognised by the Malaysian Qualifications Agency (MQA), Indonesian DIKTI and most ASEAN regulators. ITEA confirms recognition for your specific programme before you apply.'],
    ]"
/>

{{-- CTA strip --}}
<section style="background:var(--ink-deep); color:#fff; padding:56px 0;">
    <div class="wrap" style="display:grid; grid-template-columns:1fr 1fr; gap:60px; align-items:center;">
        <div>
            <div class="eyebrow" style="color:rgba(255,255,255,0.4); margin-bottom:12px;">Ready when you are</div>
            <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(36px,4vw,56px); font-weight:400; margin:0; line-height:1;">Your future,<br><em style="color:var(--accent);">studied in China.</em></h2>
        </div>
        <div>
            <p style="font-size:16px; line-height:1.65; color:rgba(255,255,255,0.75); margin:0 0 24px;">One form gets you matched to up to five programmes and screened against six scholarships. A China desk counsellor calls you within 48 hours.</p>
            <div style="display:flex; gap:14px; align-items:center; flex-wrap:wrap;">
                <a href="{{ route('application') }}#apply" class="btn-primary">Start China application →</a>
                <a href="#" style="color:rgba(255,255,255,0.6); font-size:14px; text-decoration:underline; text-underline-offset:4px;">Or download the China guide ↓</a>
            </div>
        </div>
    </div>
</section>

@endsection
