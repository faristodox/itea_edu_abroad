@extends('layouts.app')
@section('title', 'Virtual Education Fair — ITEA EduAbroad')
@section('description', 'Meet 20+ partner universities live from your home. Book a 1-on-1 counselling slot, attend scholarship briefings, and get your questions answered — all in one day.')

@section('content')

{{-- ── Hero ─────────────────────────────────────────────────── --}}
<section class="fair-hero-section" style="background:var(--ink-deep); color:#fff; padding:80px 0 60px; position:relative; overflow:hidden;">
    {{-- subtle grid bg --}}
    <div style="position:absolute; inset:0; background-image:linear-gradient(rgba(255,255,255,0.03) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.03) 1px,transparent 1px); background-size:48px 48px; pointer-events:none;"></div>

    <div class="wrap" style="position:relative;">
        {{-- breadcrumb --}}
        <div style="display:flex; align-items:center; gap:8px; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:rgba(255,255,255,0.4); margin-bottom:32px;">
            <a href="{{ route('home') }}" style="color:inherit; text-decoration:none;">Home</a>
            <span>·</span>
            <span style="color:rgba(255,255,255,0.7);">Virtual Education Fair</span>
        </div>

        <div class="fair-hero-grid" style="display:grid; grid-template-columns:1fr 380px; gap:60px; align-items:center;">
            {{-- left --}}
            <div>
                <div style="display:inline-flex; align-items:center; gap:8px; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.12em; text-transform:uppercase; color:rgba(255,255,255,0.5); border:1px solid rgba(255,255,255,0.12); padding:5px 12px; border-radius:999px; margin-bottom:24px;">
                    <span style="display:inline-block; width:7px; height:7px; border-radius:50%; background:#2fa86e; animation:pulse 2s infinite;"></span>
                    Next event · 7 June 2026 · 10 AM – 5 PM (MYT)
                </div>

                <h1 style="font-family:'Instrument Serif',serif; font-size:clamp(36px,5vw,72px); font-weight:400; margin:0 0 8px; line-height:1.05;">Virtual<br><em style="color:var(--accent);">Education Fair.</em></h1>
                <div class="zh" style="font-size:22px; color:rgba(255,255,255,0.2); margin-bottom:20px;">网上教育博览会</div>
                <p style="font-size:16px; line-height:1.65; color:rgba(255,255,255,0.65); margin:0 0 32px; max-width:520px;">Meet 20+ partner universities live — from your home. Chat with admissions teams, book a 1-on-1 counselling slot, and get your scholarship questions answered in a single day.</p>
                <div style="display:flex; gap:14px; flex-wrap:wrap;">
                    <a href="#register" class="btn-primary">Register Free →</a>
                    <a href="#schedule" style="color:rgba(255,255,255,0.6); font-size:14px; font-family:'JetBrains Mono',monospace; letter-spacing:0.06em; text-decoration:underline; text-underline-offset:4px; align-self:center;">View full schedule ↓</a>
                </div>
            </div>

            {{-- countdown --}}
            <div
                x-data="{
                    days: 0, hours: 0, mins: 0, secs: 0,
                    target: new Date('2026-06-07T10:00:00+08:00'),
                    init() { this.tick(); setInterval(() => this.tick(), 1000); },
                    tick() {
                        const diff = this.target - new Date();
                        if (diff <= 0) { this.days = this.hours = this.mins = this.secs = 0; return; }
                        this.days  = Math.floor(diff / 86400000);
                        this.hours = Math.floor((diff % 86400000) / 3600000);
                        this.mins  = Math.floor((diff % 3600000) / 60000);
                        this.secs  = Math.floor((diff % 60000) / 1000);
                    },
                    pad(n) { return String(n).padStart(2,'0'); }
                }"
                style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1); padding:32px; text-align:center;"
            >
                <div style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.12em; text-transform:uppercase; color:rgba(255,255,255,0.4); margin-bottom:20px;">Starts in</div>
                <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:12px; margin-bottom:24px;">
                    <div>
                        <div x-text="pad(days)" style="font-family:'Instrument Serif',serif; font-size:clamp(28px,3vw,44px); color:#fff; line-height:1;"></div>
                        <div style="font-family:'JetBrains Mono',monospace; font-size:9px; letter-spacing:0.1em; color:rgba(255,255,255,0.35); margin-top:4px; text-transform:uppercase;">Days</div>
                    </div>
                    <div>
                        <div x-text="pad(hours)" style="font-family:'Instrument Serif',serif; font-size:clamp(28px,3vw,44px); color:#fff; line-height:1;"></div>
                        <div style="font-family:'JetBrains Mono',monospace; font-size:9px; letter-spacing:0.1em; color:rgba(255,255,255,0.35); margin-top:4px; text-transform:uppercase;">Hours</div>
                    </div>
                    <div>
                        <div x-text="pad(mins)" style="font-family:'Instrument Serif',serif; font-size:clamp(28px,3vw,44px); color:#fff; line-height:1;"></div>
                        <div style="font-family:'JetBrains Mono',monospace; font-size:9px; letter-spacing:0.1em; color:rgba(255,255,255,0.35); margin-top:4px; text-transform:uppercase;">Mins</div>
                    </div>
                    <div>
                        <div x-text="pad(secs)" style="font-family:'Instrument Serif',serif; font-size:clamp(28px,3vw,44px); color:var(--accent); line-height:1;"></div>
                        <div style="font-family:'JetBrains Mono',monospace; font-size:9px; letter-spacing:0.1em; color:rgba(255,255,255,0.35); margin-top:4px; text-transform:uppercase;">Secs</div>
                    </div>
                </div>
                <div style="border-top:1px solid rgba(255,255,255,0.08); padding-top:16px; font-size:12px; color:rgba(255,255,255,0.4);">
                    Sun 7 Jun 2026 · 10:00 AM – 5:00 PM (MYT)<br>
                    Platform: Zoom + Live Chat
                </div>
            </div>
        </div>

        {{-- stat strip --}}
        <div class="fair-stats-grid" style="display:grid; grid-template-columns:repeat(4,1fr); gap:2px; margin-top:48px;">
            @php $stats = [
                ['val'=>'20+','label'=>'Universities attending'],
                ['val'=>'500','label'=>'Seats available'],
                ['val'=>'Free','label'=>'Registration'],
                ['val'=>'1-on-1','label'=>'Counselling slots'],
            ]; @endphp
            @foreach($stats as $s)
            <div style="background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.07); padding:20px 24px;">
                <div style="font-family:'Instrument Serif',serif; font-size:32px; color:#fff; margin-bottom:4px;">{{ $s['val'] }}</div>
                <div style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; text-transform:uppercase; color:rgba(255,255,255,0.4);">{{ $s['label'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<style>
@keyframes pulse { 0%,100%{opacity:1} 50%{opacity:0.4} }

/* Tablet */
@media (max-width:900px) {
    .fair-hero-grid { grid-template-columns:1fr !important; }
    .fair-hero-grid > div:last-child { display:none !important; }
    .fair-register-grid { grid-template-columns:1fr !important; }
    .fair-what-grid  { grid-template-columns:1fr 1fr !important; }
    .fair-unis-grid  { grid-template-columns:1fr 1fr !important; }
    .fair-steps-grid { grid-template-columns:1fr !important; }
    .fair-stats-grid { grid-template-columns:1fr 1fr !important; }
    .fair-schedule-row { grid-template-columns:70px 1fr !important; }
    .fair-schedule-label { display:none !important; }
}

/* Mobile */
@media (max-width:640px) {
    .fair-hero-section { padding:48px 0 36px !important; }
    .fair-what-grid  { grid-template-columns:1fr !important; }
    .fair-unis-grid  { grid-template-columns:1fr 1fr !important; }
    .fair-cta-strip  { flex-direction:column !important; align-items:flex-start !important; }
    .fair-stats-grid { grid-template-columns:1fr 1fr !important; }
}
</style>

{{-- ── What to expect ───────────────────────────────────────── --}}
<section class="section" style="background:var(--paper);">
    <div class="wrap">
        <div style="text-align:center; max-width:540px; margin:0 auto 40px;">
            <div class="eyebrow" style="margin-bottom:10px;">What to expect</div>
            <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(26px,3.5vw,42px); font-weight:400; margin:0;">Everything you need, <em style="color:var(--accent);">in one day.</em></h2>
        </div>
        <div class="fair-what-grid" style="display:grid; grid-template-columns:repeat(4,1fr); gap:2px;">
            @php $expects = [
                ['glyph'=>'🏛','title'=>'Live University Booths','body'=>'Chat directly with admissions officers from ZUST, SDUT, JUFE, HMU, UTM, Taylor\'s and more — in real time.'],
                ['glyph'=>'💬','title'=>'1-on-1 Counselling','body'=>'Book a private 20-min slot with an ITEA counsellor. Review your profile, clarify programme options and plan your intake.'],
                ['glyph'=>'🎓','title'=>'Scholarship Briefings','body'=>'Live deep-dives into CSC, MIS, Jeffrey Cheah Foundation and university-specific awards — with eligibility Q&A.'],
                ['glyph'=>'📋','title'=>'Application Workshop','body'=>'Step-by-step walkthrough of the application process, document checklist and common mistakes to avoid.'],
            ]; @endphp
            @foreach($expects as $e)
            <div class="card" style="padding:28px; text-align:center;">
                <div style="font-size:36px; margin-bottom:16px;">{{ $e['glyph'] }}</div>
                <h3 style="font-family:'Instrument Serif',serif; font-size:19px; font-weight:400; margin:0 0 10px; color:var(--ink);">{{ $e['title'] }}</h3>
                <p style="font-size:13px; line-height:1.6; color:var(--muted); margin:0;">{{ $e['body'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ── Participating universities ───────────────────────────── --}}
<section class="section" style="background:var(--bg);">
    <div class="wrap">
        <div style="display:flex; justify-content:space-between; align-items:end; margin-bottom:28px;">
            <div>
                <div class="eyebrow" style="margin-bottom:8px;">Attending universities</div>
                <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(24px,3vw,38px); font-weight:400; margin:0;">20+ universities, <em style="color:var(--accent);">one platform.</em></h2>
            </div>
        </div>
        <div class="fair-unis-grid" style="display:grid; grid-template-columns:repeat(4,1fr); gap:20px;">
            @php $unis = [
                ['abbr'=>'ZUST','name'=>'Zhejiang Univ. of Sci. & Tech.','location'=>'Hangzhou · China','tag'=>'Engineering · CS · Architecture','phA'=>'#1c3d5a','phB'=>'#0a1f3a','slots'=>8],
                ['abbr'=>'SDUT','name'=>'Shandong University of Technology','location'=>'Zibo · China','tag'=>'Mechanical · Electrical · CS','phA'=>'#34526e','phB'=>'#1a2a3e','slots'=>6],
                ['abbr'=>'JUFE','name'=>'Jiangxi Univ. of Finance & Econ.','location'=>'Nanchang · China','tag'=>'Finance · Business · Economics','phA'=>'#a51717','phB'=>'#3d0808','slots'=>6],
                ['abbr'=>'HMU','name'=>'Hainan Medical University','location'=>'Haikou · China','tag'=>'MBBS · Nursing · Pharmacy','phA'=>'#2a8a6a','phB'=>'#0e3527','slots'=>8],
                ['abbr'=>'UTM','name'=>'Universiti Teknologi Malaysia','location'=>'Johor Bahru · Malaysia','tag'=>'Engineering · ICT · Architecture','phA'=>'#c98a1d','phB'=>'#5e3f10','slots'=>6],
                ['abbr'=>'UM','name'=>'Universiti Malaya','location'=>'Kuala Lumpur · Malaysia','tag'=>'Medicine · Law · Business','phA'=>'#1c3d5a','phB'=>'#10204a','slots'=>4],
                ['abbr'=>'Taylor\'s','name'=>'Taylor\'s University','location'=>'Subang Jaya · Malaysia','tag'=>'Hospitality · Business · Design','phA'=>'#2f5c8a','phB'=>'#16304e','slots'=>6],
                ['abbr'=>'APU','name'=>'Asia Pacific University','location'=>'Kuala Lumpur · Malaysia','tag'=>'Technology · Computing · Engineering','phA'=>'#4a2a7a','phB'=>'#1f0e3d','slots'=>6],
            ]; @endphp
            @foreach($unis as $u)
            <div class="card" style="overflow:hidden;">
                <div style="height:100px; background:linear-gradient(135deg,{{ $u['phA'] }},{{ $u['phB'] }}); display:flex; align-items:center; justify-content:center; padding:12px; position:relative;">
                    <div style="font-family:'Noto Serif SC',serif; font-size:28px; color:rgba(255,255,255,0.15); position:absolute; right:12px; bottom:6px;">{{ $u['abbr'] }}</div>
                    <div style="font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.1em; color:rgba(255,255,255,0.6); text-transform:uppercase; position:absolute; top:10px; left:10px;">{{ $u['slots'] }} slots left</div>
                    <span style="font-family:'Instrument Serif',serif; font-size:22px; color:#fff; font-weight:400; position:relative;">{{ $u['abbr'] }}</span>
                </div>
                <div style="padding:14px;">
                    <div style="font-weight:500; font-size:13px; color:var(--ink); margin-bottom:3px; line-height:1.3;">{{ $u['name'] }}</div>
                    <div style="font-size:11px; color:var(--muted); margin-bottom:6px;">{{ $u['location'] }}</div>
                    <div style="font-family:'JetBrains Mono',monospace; font-size:9px; letter-spacing:0.06em; color:var(--accent);">{{ $u['tag'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
        <p style="margin-top:16px; font-size:13px; color:var(--muted); text-align:center;">+ 12 more universities confirmed. Full list sent upon registration.</p>
    </div>
</section>

{{-- ── Schedule ─────────────────────────────────────────────── --}}
<section id="schedule" class="section" style="background:var(--paper);">
    <div class="wrap">
        <div style="margin-bottom:32px;">
            <div class="eyebrow" style="margin-bottom:10px;">Event schedule · 7 June 2026</div>
            <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(24px,3vw,38px); font-weight:400; margin:0;">Your day at <em style="color:var(--accent);">the fair.</em></h2>
        </div>
        <div style="border:1px solid var(--rule-soft);">
            @php $agenda = [
                ['time'=>'9:30 AM',  'type'=>'pre',      'label'=>'Pre-Event',    'title'=>'Early check-in & platform walkthrough', 'meta'=>'Zoom · All attendees', 'color'=>'var(--muted)'],
                ['time'=>'10:00 AM', 'type'=>'opening',  'label'=>'Opening',      'title'=>'Welcome address & ITEA overview',       'meta'=>'Zoom Webinar · ITEA Director', 'color'=>'var(--accent)'],
                ['time'=>'10:30 AM', 'type'=>'booths',   'label'=>'Booths Open',  'title'=>'China universities booth session',      'meta'=>'Breakout rooms · ZUST · SDUT · JUFE · HMU', 'color'=>'#1c3d5a'],
                ['time'=>'11:30 AM', 'type'=>'briefing', 'label'=>'Briefing',     'title'=>'CSC Scholarship deep-dive',             'meta'=>'Zoom Webinar · ITEA Scholarship Desk', 'color'=>'#c98a1d'],
                ['time'=>'12:00 PM', 'type'=>'break',    'label'=>'Break',        'title'=>'Lunch break — 30 minutes',             'meta'=>'', 'color'=>'var(--muted)'],
                ['time'=>'12:30 PM', 'type'=>'booths',   'label'=>'Booths Open',  'title'=>'Malaysia universities booth session',   'meta'=>'Breakout rooms · UTM · UM · Taylor\'s · APU', 'color'=>'#c98a1d'],
                ['time'=>'1:30 PM',  'type'=>'workshop', 'label'=>'Workshop',     'title'=>'Application & documents workshop',      'meta'=>'Zoom Webinar · Step-by-step walkthrough', 'color'=>'#2a8a6a'],
                ['time'=>'2:30 PM',  'type'=>'briefing', 'label'=>'Briefing',     'title'=>'MIS & Jeffrey Cheah Foundation awards', 'meta'=>'Zoom Webinar · Malaysia scholarship Q&A', 'color'=>'#c98a1d'],
                ['time'=>'3:00 PM',  'type'=>'1on1',     'label'=>'1-on-1',       'title'=>'Private counselling slots',             'meta'=>'Zoom calls · Pre-booked only — register to secure a slot', 'color'=>'var(--accent)'],
                ['time'=>'4:30 PM',  'type'=>'qa',       'label'=>'Open Q&A',     'title'=>'Panel Q&A — all universities',          'meta'=>'Zoom Webinar · All attendees', 'color'=>'#1c3d5a'],
                ['time'=>'5:00 PM',  'type'=>'close',    'label'=>'Close',        'title'=>'Closing & next steps',                  'meta'=>'Recording link sent within 24 hours', 'color'=>'var(--muted)'],
            ]; @endphp
            @foreach($agenda as $i => $item)
            <div class="fair-schedule-row" style="display:grid; grid-template-columns:110px 80px 1fr; gap:0; border-bottom:{{ $i < count($agenda)-1 ? '1px solid var(--rule-soft)' : 'none' }};">
                <div style="padding:16px; font-family:'JetBrains Mono',monospace; font-size:11px; color:var(--muted); border-right:1px solid var(--rule-soft); display:flex; align-items:center;">{{ $item['time'] }}</div>
                <div class="fair-schedule-label" style="padding:16px; border-right:1px solid var(--rule-soft); display:flex; align-items:center;">
                    <span style="font-family:'JetBrains Mono',monospace; font-size:9px; letter-spacing:0.08em; text-transform:uppercase; color:{{ $item['color'] }}; white-space:nowrap;">{{ $item['label'] }}</span>
                </div>
                <div style="padding:16px;">
                    <div style="font-size:14px; font-weight:500; color:var(--ink); margin-bottom:{{ $item['meta'] ? '3px' : '0' }};">{{ $item['title'] }}</div>
                    @if($item['meta'])
                    <div style="font-size:12px; color:var(--muted);">{{ $item['meta'] }}</div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        <p style="margin-top:12px; font-size:12px; color:var(--muted);">All times in Malaysia Time (MYT / UTC+8). Schedule subject to minor adjustments.</p>
    </div>
</section>

{{-- ── How it works ─────────────────────────────────────────── --}}
<section class="section" style="background:var(--bg);">
    <div class="wrap">
        <div style="text-align:center; max-width:480px; margin:0 auto 40px;">
            <div class="eyebrow" style="margin-bottom:10px;">How it works</div>
            <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(24px,3vw,38px); font-weight:400; margin:0;">Three steps to <em style="color:var(--accent);">attend.</em></h2>
        </div>
        <div class="fair-steps-grid" style="display:grid; grid-template-columns:repeat(3,1fr); gap:2px;">
            @php $steps = [
                ['num'=>'01','title'=>'Register free','body'=>'Fill in the short form below. You\'ll receive a confirmation email with your Zoom link and a personalised session guide within 24 hours.'],
                ['num'=>'02','title'=>'Book your slots','body'=>'Log in to the attendee portal to select university booths, reserve a 1-on-1 counselling slot and RSVP for the sessions that matter most to you.'],
                ['num'=>'03','title'=>'Attend & decide','body'=>'Join on June 7 from any device. Ask questions, compare offers, and walk away with a personalised shortlist and clear next steps.'],
            ]; @endphp
            @foreach($steps as $s)
            <div class="card" style="padding:32px; position:relative; overflow:hidden;">
                <div style="position:absolute; top:-10px; right:12px; font-family:'Instrument Serif',serif; font-size:80px; color:rgba(0,0,0,0.04); font-weight:400; pointer-events:none; line-height:1;">{{ $s['num'] }}</div>
                <div class="eyebrow" style="color:var(--accent); margin-bottom:12px;">Step {{ $s['num'] }}</div>
                <h3 style="font-family:'Instrument Serif',serif; font-size:22px; font-weight:400; margin:0 0 10px; color:var(--ink);">{{ $s['title'] }}</h3>
                <p style="font-size:14px; line-height:1.65; color:var(--muted); margin:0;">{{ $s['body'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ── Registration form ────────────────────────────────────── --}}
<section id="register" class="section" style="background:var(--ink-deep); color:#fff;">
    <div class="wrap fair-register-grid" style="display:grid; grid-template-columns:1fr 1fr; gap:60px; align-items:start;">
        {{-- left copy --}}
        <div>
            <div class="eyebrow" style="color:rgba(255,255,255,0.4); margin-bottom:12px;">Secure your seat</div>
            <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(28px,3.5vw,48px); font-weight:400; margin:0 0 16px; line-height:1.1;">Register <em style="color:var(--accent);">free.</em></h2>
            <p style="font-size:15px; line-height:1.65; color:rgba(255,255,255,0.6); margin:0 0 32px;">500 seats available. Registration closes 4 June 2026 or when seats run out. You'll receive your Zoom link and session guide by email.</p>

            <div style="display:flex; flex-direction:column; gap:14px;">
                @php $perks = [
                    'Zoom link + calendar invite sent immediately',
                    'Personalised session guide based on your profile',
                    '1-on-1 counselling slot reservation (limited)',
                    'Event recording access for 30 days',
                ]; @endphp
                @foreach($perks as $p)
                <div style="display:flex; align-items:center; gap:12px; font-size:14px; color:rgba(255,255,255,0.7);">
                    <span style="color:#2fa86e; font-size:16px; flex-shrink:0;">✓</span>
                    {{ $p }}
                </div>
                @endforeach
            </div>
        </div>

        {{-- form --}}
        <div style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1); padding:32px;">
            @if(session('enquiry_success'))
            <div style="text-align:center; padding:24px 0;">
                <div style="font-size:40px; margin-bottom:12px;">🎉</div>
                <h3 style="font-family:'Instrument Serif',serif; font-size:24px; font-weight:400; color:#fff; margin:0 0 8px;">You're registered, {{ session('enquiry_name') }}!</h3>
                <p style="font-size:14px; color:rgba(255,255,255,0.6); margin:0;">Check your email for the Zoom link and your session guide. We'll see you on 7 June!</p>
            </div>
            @else
            <form action="{{ route('enquiry.store') }}" method="POST" style="display:flex; flex-direction:column; gap:16px;">
                @csrf
                <input type="hidden" name="intake" value="Virtual Fair · Jun 2026">
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px;">
                    <div>
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.12em; color:rgba(255,255,255,0.45); margin-bottom:6px; text-transform:uppercase;">Full Name *</label>
                        <input type="text" name="name" required placeholder="Your full name"
                            style="width:100%; background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.15); padding:10px 12px; color:#fff; font-size:14px; box-sizing:border-box; outline:none;"
                            onfocus="this.style.borderColor='rgba(255,255,255,0.4)'" onblur="this.style.borderColor='rgba(255,255,255,0.15)'">
                    </div>
                    <div>
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.12em; color:rgba(255,255,255,0.45); margin-bottom:6px; text-transform:uppercase;">Email *</label>
                        <input type="email" name="email" required placeholder="you@email.com"
                            style="width:100%; background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.15); padding:10px 12px; color:#fff; font-size:14px; box-sizing:border-box; outline:none;"
                            onfocus="this.style.borderColor='rgba(255,255,255,0.4)'" onblur="this.style.borderColor='rgba(255,255,255,0.15)'">
                    </div>
                </div>
                <div>
                    <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.12em; color:rgba(255,255,255,0.45); margin-bottom:6px; text-transform:uppercase;">WhatsApp Number</label>
                    <input type="text" name="whatsapp" placeholder="+60 12 345 6789"
                        style="width:100%; background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.15); padding:10px 12px; color:#fff; font-size:14px; box-sizing:border-box; outline:none;"
                        onfocus="this.style.borderColor='rgba(255,255,255,0.4)'" onblur="this.style.borderColor='rgba(255,255,255,0.15)'">
                </div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px;">
                    <div>
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.12em; color:rgba(255,255,255,0.45); margin-bottom:6px; text-transform:uppercase;">Destination Interest</label>
                        <select name="destination" style="width:100%; background:#1c2c5e; border:1px solid rgba(255,255,255,0.15); padding:10px 12px; color:#fff; font-size:14px; box-sizing:border-box; outline:none;">
                            <option style="background:#1c2c5e; color:#fff;">China</option>
                            <option style="background:#1c2c5e; color:#fff;">Malaysia</option>
                            <option style="background:#1c2c5e; color:#fff;">Both</option>
                            <option style="background:#1c2c5e; color:#fff;">Undecided</option>
                        </select>
                    </div>
                    <div>
                        <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.12em; color:rgba(255,255,255,0.45); margin-bottom:6px; text-transform:uppercase;">Study Level</label>
                        <select name="level" style="width:100%; background:#1c2c5e; border:1px solid rgba(255,255,255,0.15); padding:10px 12px; color:#fff; font-size:14px; box-sizing:border-box; outline:none;">
                            <option style="background:#1c2c5e; color:#fff;">Diploma</option>
                            <option style="background:#1c2c5e; color:#fff;" selected>Undergraduate</option>
                            <option style="background:#1c2c5e; color:#fff;">Postgraduate</option>
                            <option style="background:#1c2c5e; color:#fff;">Mandarin</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label style="display:block; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.12em; color:rgba(255,255,255,0.45); margin-bottom:6px; text-transform:uppercase;">Anything you'd like to focus on? (optional)</label>
                    <textarea name="message" rows="3" placeholder="e.g. MBBS programme, scholarship eligibility, housing..."
                        style="width:100%; background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.15); padding:10px 12px; color:#fff; font-size:14px; box-sizing:border-box; outline:none; resize:vertical; font-family:inherit;"
                        onfocus="this.style.borderColor='rgba(255,255,255,0.4)'" onblur="this.style.borderColor='rgba(255,255,255,0.15)'"></textarea>
                </div>
                <button type="submit" class="btn-primary" style="width:100%; justify-content:center; padding:13px;">Secure my free seat →</button>
                <p style="margin:0; font-size:12px; color:rgba(255,255,255,0.35); text-align:center;">No spam. You can unsubscribe any time. Registration closes 4 June 2026.</p>
            </form>
            @endif
        </div>
    </div>
</section>

{{-- ── FAQ ───────────────────────────────────────────────────── --}}
<x-faq-accordion
    sideTitle="Common <em>questions.</em>"
    sideBody="Everything you need to know about the fair. More questions? WhatsApp us — we respond within the hour."
    sideCta="Chat on WhatsApp"
    sideCtaHref="https://wa.me/60123456789"
    :faqs="[
        ['q'=>'Is the Virtual Education Fair free to attend?','a'=>'Yes, completely free. There is no registration fee, no deposit and no obligation to apply anywhere after attending. ITEA is funded by our partner universities.'],
        ['q'=>'What platform does the fair run on?','a'=>'The fair uses Zoom for webinars and 1-on-1 sessions, and a private chat board for university booths. You\'ll receive detailed instructions and a platform guide after registering.'],
        ['q'=>'Can I attend multiple university booths?','a'=>'Yes — you can join as many booths as you like throughout the day. We recommend shortlisting 3–4 universities before the fair so you can ask focused questions in each session.'],
        ['q'=>'How do I book a 1-on-1 counselling slot?','a'=>'After registering, you\'ll receive a link to the attendee portal where you can select a 20-minute private slot with an ITEA counsellor. Slots are limited and allocated on a first-come basis.'],
        ['q'=>'Will the sessions be recorded?','a'=>'Yes. All Zoom webinar sessions will be recorded and made available to registered attendees for 30 days after the event. Breakout booth sessions and 1-on-1 calls are not recorded.'],
        ['q'=>'I can\'t attend live — can I still register?','a'=>'Yes. Register and you\'ll receive the recordings and a follow-up with all session materials. We\'ll also match you with a counsellor for a separate 1-on-1 call at a time that works for you.'],
    ]"
/>

{{-- ── CTA strip ────────────────────────────────────────────── --}}
<section style="background:var(--accent); color:#fff; padding:48px 0;">
    <div class="wrap fair-cta-strip" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:24px;">
        <div>
            <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(24px,3vw,38px); font-weight:400; margin:0 0 6px;">500 seats. Free. One day.</h2>
            <p style="margin:0; font-size:15px; color:rgba(255,255,255,0.8);">Don't miss the June 7 Virtual Education Fair — seats fill fast.</p>
        </div>
        <a href="#register" style="background:#fff; color:var(--accent); padding:13px 28px; font-family:'JetBrains Mono',monospace; font-size:11px; letter-spacing:0.1em; text-transform:uppercase; text-decoration:none; font-weight:500; white-space:nowrap; flex-shrink:0;">Register now — it's free →</a>
    </div>
</section>

@endsection
