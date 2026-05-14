@extends('layouts.app')
@section('title', 'Contact — ITEA EduAbroad')
@section('description', 'Reach ITEA EduAbroad by WhatsApp, email or phone. Offices in Kuala Lumpur, Beijing and Jakarta. Real humans, replying in under an hour.')
@section('nav_logo', 'assets/logo.jpeg')
@section('content')

<x-page-hero
    glow="lavender"
    :breadcrumbs="[['href'=>route('home'),'label'=>'Home'],['href'=>route('contact'),'label'=>'Contact']]"
    label="Talk to ITEA · 3 offices, 5 languages"
    title="Let's talk."
    zhTitle="联系我们"
    body="WhatsApp the desk, email the team, or walk into one of our offices in Kuala Lumpur, Beijing or Jakarta. Real humans, replying in under an hour during business hours."
    cta1Text="WhatsApp us now"
    cta1Href="https://wa.me/60123456789"
    cta2Text="Or send a message ↓"
    cta2Href="#form"
    factTitle="Contact at a glance"
    :stats="[
        ['key'=>'WhatsApp response','val'=>'<1','sup'=>'hr avg'],
        ['key'=>'Email response','val'=>'<24','sup'=>'hr'],
        ['key'=>'Phone hours','val'=>'9 – 7','sup'=>' MYT'],
        ['key'=>'Offices','val'=>'3','sup'=>' cities'],
        ['key'=>'Languages','val'=>'5','sup'=>''],
        ['key'=>'Counselling','val'=>'Free','sup'=>''],
    ]"
/>

{{-- Channels --}}
{{-- To re-show Office Visit / Book a Call / Live Chat, remove the 'hidden'=>true flags below --}}
<x-type-cards
    eyebrow="Choose your channel"
    title="Three ways <em>to reach us.</em>"
    body="WhatsApp is fastest. Email is best for formal documents. Phone is open during MYT business hours."
    :cards="[
        ['glyph'=>'💬','zh'=>'微信','title'=>'WhatsApp','count'=>'<1 hr reply','body'=>'Fastest. Real human, business hours','href'=>'https://wa.me/60123456789'],
        ['glyph'=>'✉','zh'=>'电邮','title'=>'Email','count'=>'<24 hr reply','body'=>'hello@iteaeduabroad.com','href'=>'mailto:hello@iteaeduabroad.com'],
        ['glyph'=>'☎','zh'=>'电话','title'=>'Phone','count'=>'9am – 7pm MYT','body'=>'+603 7890 0000 · Mon–Fri','href'=>'tel:+60378900000'],
        ['glyph'=>'🏢','zh'=>'办公室','title'=>'Office Visit','count'=>'3 cities','body'=>'Walk-ins welcomed, appointment preferred','href'=>'#offices','hidden'=>true],
        ['glyph'=>'📅','zh'=>'预约','title'=>'Book a Call','count'=>'30-min slots','body'=>'Zoom consultation with a counsellor','href'=>'#form','hidden'=>true],
        ['glyph'=>'💻','zh'=>'在线','title'=>'Live Chat','count'=>'On-site widget','body'=>'Quick questions, no commitment','href'=>'#','hidden'=>true],
    ]"
/>

{{-- Offices --}}
<section id="offices" class="section" style="background:var(--paper);">
    <div class="wrap">
        <div style="display:flex; justify-content:space-between; align-items:end; margin-bottom:28px;">
            <div>
                <div class="eyebrow" style="margin-bottom:8px;">Offices · 办公室</div>
                <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(28px,3.5vw,42px); font-weight:400; margin:0;">Three cities, <em style="color:#aa87dc;">one team.</em></h2>
            </div>
            <p style="font-size:14px; color:var(--muted); max-width:360px; margin:0; text-align:right;">Drop by any of our offices for a face-to-face consultation. Counsellors at every location speak English, Mandarin and the local language.</p>
        </div>
        <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:24px;">
            @php
            $offices = [
                ['id'=>'kl','badge'=>'HQ','city'=>'Kuala Lumpur','country'=>'Malaysia','addr'=>'Suite 12-A, Menara KLH, Jalan Sultan Ismail, 50250 Kuala Lumpur, Wilayah Persekutuan','rows'=>[['k'=>'Hours','v'=>'Mon – Fri · 9 AM – 7 PM MYT'],['k'=>'Phone','v'=>'+603 7890 0000'],['k'=>'WhatsApp','v'=>'+60 12 345 6789'],['k'=>'Email','v'=>'kl@iteaeduabroad.com']]],
                ['id'=>'bj','badge'=>'ASIA HUB','city'=>'Beijing','country'=>'China','addr'=>'Room 808, Tower B, China World Trade Center, Jianguomenwai Avenue, Chaoyang District, Beijing 100004','rows'=>[['k'=>'Hours','v'=>'Mon – Fri · 9 AM – 6 PM CST'],['k'=>'Phone','v'=>'+86 10 8888 0000'],['k'=>'WeChat','v'=>'ITEA-EduAbroad'],['k'=>'Email','v'=>'beijing@iteaeduabroad.com']]],
                ['id'=>'jkt','badge'=>'SE ASIA','city'=>'Jakarta','country'=>'Indonesia','addr'=>'Floor 18, World Trade Center 5, Jl. Jenderal Sudirman Kav. 29–31, Jakarta 12920','rows'=>[['k'=>'Hours','v'=>'Mon – Fri · 9 AM – 6 PM WIB'],['k'=>'Phone','v'=>'+62 21 5555 0000'],['k'=>'WhatsApp','v'=>'+62 812 3456 7890'],['k'=>'Email','v'=>'jakarta@iteaeduabroad.com']]],
            ];
            @endphp
            @foreach($offices as $o)
            <div class="card" style="overflow:hidden;">
                {{-- Map placeholder --}}
                <div style="height:180px; background:var(--ink-deep); position:relative; overflow:hidden;">
                    {{-- Grid overlay --}}
                    <div style="position:absolute; inset:0; background-image:linear-gradient(rgba(255,255,255,0.04) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.04) 1px, transparent 1px); background-size:32px 32px;"></div>
                    {{-- Pin --}}
                    <div style="position:absolute; left:50%; top:50%; transform:translate(-50%,-50%); z-index:2;">
                        <div style="width:10px; height:10px; border-radius:50%; background:var(--accent); border:2px solid #fff; margin:0 auto;"></div>
                        <div style="width:1px; height:20px; background:rgba(255,255,255,0.4); margin:0 auto;"></div>
                    </div>
                    <span style="position:absolute; top:10px; left:10px; font-family:'JetBrains Mono',monospace; font-size:9px; letter-spacing:0.12em; text-transform:uppercase; background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.15); padding:4px 8px; color:rgba(255,255,255,0.7);">{{ $o['badge'] }}</span>
                    <div style="position:absolute; bottom:10px; left:12px;">
                        <div style="font-family:'Instrument Serif',serif; font-size:20px; color:#fff;">{{ $o['city'] }}</div>
                        <div style="font-size:11px; color:rgba(255,255,255,0.4);">{{ $o['country'] }}</div>
                    </div>
                </div>
                <div style="padding:20px;">
                    <div style="font-size:13px; color:var(--muted); line-height:1.5; margin-bottom:14px; padding-bottom:14px; border-bottom:1px solid var(--rule-soft);">{{ $o['addr'] }}</div>
                    <div style="display:flex; flex-direction:column; gap:8px;">
                        @foreach($o['rows'] as $r)
                        <div style="display:flex; justify-content:space-between; gap:12px; font-size:13px;">
                            <span class="eyebrow" style="color:var(--muted);">{{ $r['k'] }}</span>
                            <span style="color:var(--ink-2); text-align:right;">{{ $r['v'] }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Department directory --}}
<section class="section" style="background:var(--bg);">
    <div class="wrap">
        <div style="margin-bottom:24px;">
            <div class="eyebrow" style="margin-bottom:8px;">Department directory · 部门索引</div>
            <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(28px,3.5vw,42px); font-weight:400; margin:0 0 10px;">Email <em style="color:#aa87dc;">the right desk.</em></h2>
            <p style="font-size:15px; color:var(--muted); max-width:600px; margin:0; line-height:1.6;">Routing to a specific desk gets you a faster, more specialised reply. Not sure where to start? Admissions handles intake and forwards anywhere it needs to go.</p>
        </div>
        <div style="border:1px solid var(--rule-soft);">
            <div style="display:grid; grid-template-columns:1fr 1fr 200px; background:var(--ink-deep); color:#fff; padding:12px 16px; gap:16px;">
                @foreach(['Desk','Email','Languages'] as $h)
                <div class="eyebrow" style="color:rgba(255,255,255,0.4);">{{ $h }}</div>
                @endforeach
            </div>
            @php
            $directory = [
                ['desk'=>'Admissions Desk','code'=>'General · 综合','email'=>'admissions@iteaeduabroad.com','lang'=>'EN · 中文 · BM','sla'=>'Reply · 24h'],
                ['desk'=>'China Desk','code'=>'China · 中国','email'=>'china@iteaeduabroad.com','lang'=>'EN · 中文 · Cantonese','sla'=>'Reply · 12h'],
                ['desk'=>'Malaysia Desk','code'=>'Malaysia · 马来西亚','email'=>'malaysia@iteaeduabroad.com','lang'=>'EN · BM · 中文','sla'=>'Reply · 12h'],
                ['desk'=>'Scholarship Desk','code'=>'Funding · 奖学金','email'=>'scholarships@iteaeduabroad.com','lang'=>'EN · 中文 · BM','sla'=>'Reply · 24h'],
                ['desk'=>'Visa Desk','code'=>'Visa · 签证','email'=>'visa@iteaeduabroad.com','lang'=>'EN · 中文','sla'=>'Reply · 24h'],
                ['desk'=>'Partners & Agents','code'=>'B2B · 合作伙伴','email'=>'partners@iteaeduabroad.com','lang'=>'EN · 中文 · BM','sla'=>'Reply · 48h'],
                ['desk'=>'Media & PR','code'=>'Press · 媒体','email'=>'press@iteaeduabroad.com','lang'=>'EN · 中文','sla'=>'Reply · 48h'],
            ];
            @endphp
            @foreach($directory as $d)
            <div style="display:grid; grid-template-columns:1fr 1fr 200px; padding:14px 16px; gap:16px; border-top:1px solid var(--rule-soft); background:{{ $loop->even ? 'var(--bg-2)' : 'var(--paper)' }};">
                <div>
                    <div style="font-size:14px; font-weight:500; color:var(--ink);">{{ $d['desk'] }}</div>
                    <div class="zh" style="font-size:11px; color:var(--muted);">{{ $d['code'] }}</div>
                </div>
                <a href="mailto:{{ $d['email'] }}" style="font-size:14px; color:var(--accent); text-decoration:none; align-self:center; font-family:'JetBrains Mono',monospace; font-size:12px; letter-spacing:0.05em;">{{ $d['email'] }}</a>
                <div style="font-size:13px; color:var(--muted); align-self:center;">{{ $d['lang'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Contact form --}}
<section id="form" style="padding:72px 0; background:var(--bg-2);">
    <div class="wrap" style="display:grid; grid-template-columns:380px 1fr; gap:60px; align-items:start;">
        <div>
            <div class="eyebrow" style="margin-bottom:12px;">Send a message · 留言</div>
            <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(28px,3.5vw,42px); font-weight:400; margin:0 0 16px; line-height:1.1;">Drop us <em style="color:#aa87dc;">a line.</em></h2>
            <p style="font-size:15px; line-height:1.65; color:var(--muted); margin:0 0 24px;">Anything you'd like to ask — programme advice, scholarship eligibility, fees, visa, partnership — write it in here and the right desk picks it up.</p>
            <div style="display:flex; flex-direction:column; gap:12px;">
                @foreach(['<strong>Routed automatically.</strong> Your topic flags the right desk — China, Malaysia, scholarship, visa or partner.','<strong>Reply within 24 hours.</strong> Or under one hour during MYT business hours if marked urgent.','<strong>Your data stays here.</strong> Used only to reply. Never sold, never shared with third parties.'] as $promise)
                <div style="display:flex; gap:10px; align-items:flex-start; font-size:14px; color:var(--ink-2); line-height:1.5;">
                    <span style="width:7px; height:7px; border-radius:50%; background:var(--accent); flex-shrink:0; margin-top:5px;"></span>
                    <span>{!! $promise !!}</span>
                </div>
                @endforeach
            </div>
        </div>

        @if(session('contact_success'))
        <div style="background:var(--paper); border:1px solid var(--rule-soft); padding:32px; text-align:center;">
            <div class="eyebrow" style="color:#2a8a6a; margin-bottom:10px;">Received · 收到</div>
            <h3 style="font-family:'Instrument Serif',serif; font-size:28px; font-weight:400; margin:0 0 12px; color:var(--ink);">Got it, <em style="color:#aa87dc;">thanks for writing.</em></h3>
            <p style="font-size:15px; color:var(--muted); margin:0;">Your message has been routed to the right desk. We'll reply within 24 hours.</p>
        </div>
        @else
        <div style="background:var(--paper); border:1px solid var(--rule-soft);">
            <div style="display:flex; justify-content:space-between; align-items:center; padding:16px 24px; border-bottom:1px solid var(--rule-soft);">
                <span class="eyebrow">General message form</span>
                <span style="background:var(--ink-deep); color:#fff; font-family:'JetBrains Mono',monospace; font-size:9px; letter-spacing:0.12em; text-transform:uppercase; padding:4px 10px;">REPLY · 24 HRS</span>
            </div>
            <form action="{{ route('contact.store') }}" method="POST" style="padding:24px;">
                @csrf
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-bottom:14px;">
                    <div>
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.12em; text-transform:uppercase; color:var(--muted); margin-bottom:5px;">Full name</label>
                        <input name="name" required value="{{ old('name') }}" placeholder="Your name" style="width:100%; border:1px solid var(--rule-soft); background:var(--bg); padding:10px 12px; font-size:14px; box-sizing:border-box; color:var(--ink); outline:none;" onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='var(--rule-soft)'">
                    </div>
                    <div>
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.12em; text-transform:uppercase; color:var(--muted); margin-bottom:5px;">Email</label>
                        <input type="email" name="email" required value="{{ old('email') }}" placeholder="you@example.com" style="width:100%; border:1px solid var(--rule-soft); background:var(--bg); padding:10px 12px; font-size:14px; box-sizing:border-box; color:var(--ink); outline:none;" onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='var(--rule-soft)'">
                    </div>
                </div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-bottom:14px;">
                    <div>
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.12em; text-transform:uppercase; color:var(--muted); margin-bottom:5px;">WhatsApp (optional)</label>
                        <input name="whatsapp" value="{{ old('whatsapp') }}" placeholder="+60 12 345 6789" style="width:100%; border:1px solid var(--rule-soft); background:var(--bg); padding:10px 12px; font-size:14px; box-sizing:border-box; color:var(--ink); outline:none;" onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='var(--rule-soft)'">
                    </div>
                    <div>
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.12em; text-transform:uppercase; color:var(--muted); margin-bottom:5px;">Topic</label>
                        <select name="topic" style="width:100%; border:1px solid var(--rule-soft); background:var(--bg); padding:10px 12px; font-size:14px; box-sizing:border-box; color:var(--ink); outline:none;">
                            @foreach(['General enquiry','Study in China','Study in Malaysia','Scholarships','Application / Visa','Partnership / B2B','Media / Press'] as $opt)
                            <option value="{{ $opt }}" {{ old('topic') === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div style="margin-bottom:14px;">
                    <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.12em; text-transform:uppercase; color:var(--muted); margin-bottom:5px;">Preferred office</label>
                    <select name="office" style="width:100%; border:1px solid var(--rule-soft); background:var(--bg); padding:10px 12px; font-size:14px; box-sizing:border-box; color:var(--ink); outline:none;">
                        @foreach(['Kuala Lumpur','Beijing','Jakarta','No preference'] as $opt)
                        <option value="{{ $opt }}" {{ old('office') === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                        @endforeach
                    </select>
                </div>
                <div style="margin-bottom:14px;">
                    <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.12em; text-transform:uppercase; color:var(--muted); margin-bottom:5px;">Your message</label>
                    <textarea name="message" required rows="4" placeholder="Tell us what's on your mind…" style="width:100%; border:1px solid var(--rule-soft); background:var(--bg); padding:10px 12px; font-size:14px; box-sizing:border-box; color:var(--ink); outline:none; resize:vertical;">{{ old('message') }}</textarea>
                </div>
                <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;">
                    <p style="font-size:12px; color:var(--muted); margin:0; max-width:320px; line-height:1.4;">By sending this form, you agree to be contacted by ITEA EduAbroad. We never share your details with anyone outside our offices.</p>
                    <button type="submit" class="btn-primary">Send message →</button>
                </div>
            </form>
        </div>
        @endif
    </div>
</section>

{{-- FAQ --}}
<x-faq-accordion
    sideTitle="Quick <em>answers.</em>"
    sideBody="Six of the most-asked contact questions. If yours isn't here, WhatsApp the team — they're real humans and they answer fast."
    sideCta="Open WhatsApp"
    sideCtaHref="https://wa.me/60123456789"
    :faqs="[
        ['q'=>'What\'s the fastest way to reach you?','a'=>'WhatsApp. Our team monitors +60 12 345 6789 during business hours (9 AM – 7 PM MYT, Mon–Fri) with under-one-hour average response. For after-hours or weekends, send an email and we\'ll get back to you on the next business day — or sooner if our on-call counsellor is around.'],
        ['q'=>'Do I need to make an appointment to visit?','a'=>'Walk-ins are welcome, but a quick WhatsApp ahead means your destination-specific counsellor is in office and ready. Each KL appointment is a 60-minute slot with a private consultation room, complimentary tea, and a written summary emailed afterwards.'],
        ['q'=>'I\'m overseas — can I still consult ITEA?','a'=>'Yes. Hundreds of our students never set foot in our offices. We run Zoom and Google Meet consultations in English, Mandarin and Bahasa Melayu. Documents flow through our secure portal; signatures are electronic. The only in-person touchpoint is the visa biometrics at your local embassy.'],
        ['q'=>'Is the initial consultation really free?','a'=>'Yes. Discovery calls, programme matching, scholarship shortlisting and the first round of document review are all free of charge. ITEA\'s service fee only kicks in once you sign the formal service agreement and we begin submitting applications on your behalf.'],
        ['q'=>'What languages do you support?','a'=>'Counselling is delivered in English, Mandarin (普通话 and 广东话), and Bahasa Melayu by default. Our China desk additionally supports Hokkien; our Jakarta office supports Bahasa Indonesia. For other languages, we use professional interpreters at no charge to you.'],
        ['q'=>'Can I just call to ask one quick question?','a'=>'Absolutely — +603 7890 0000 reaches our front desk and they\'ll route you to whoever can answer fastest. Most quick questions (eligibility, fees, deadlines) are answered in under five minutes. Longer scholarship or programme-matching conversations are booked as a separate slot.'],
    ]"
/>

@endsection
