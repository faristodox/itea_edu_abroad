@extends('layouts.app')

@section('title', 'ITEA EduAbroad — Study Abroad in China, Malaysia & Indonesia')
@section('description', 'ITEA EduAbroad places Southeast Asian students into top universities in China, Malaysia and Indonesia. Scholarship matching, visa support, and end-to-end counselling since 2009.')
@section('nav_logo', 'assets/logo.jpeg')

@section('content')

{{-- ── Hero Slider ─────────────────────────────────────────── --}}
<section style="position:relative; overflow:hidden; height:640px; color:#fff;" x-data="heroSlider()" x-init="start()" @mouseenter="stop()" @mouseleave="start()">

    {{-- ══ Layer 1: Background images — fade between slides ══ --}}

    {{-- Slide 0 bg --}}
    <div style="position:absolute; inset:0; transition:opacity 0.9s ease;" :style="current===0 ? 'opacity:1' : 'opacity:0'">
        <img src="{{ asset('assets/scholarship.jpg') }}" alt=""
             style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover; object-position:center center;">
        <div style="position:absolute; inset:0; background:linear-gradient(105deg, rgba(5,12,40,0.90) 0%, rgba(5,12,40,0.78) 38%, rgba(5,12,40,0.40) 60%, rgba(5,12,40,0.10) 100%);"></div>
    </div>

    {{-- Slide 1 bg --}}
    <div style="position:absolute; inset:0; transition:opacity 0.9s ease;" :style="current===1 ? 'opacity:1' : 'opacity:0'">
        <img src="{{ asset('assets/beijing.jpg') }}" alt=""
             style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover; object-position:center center;">
        <div style="position:absolute; inset:0; background:linear-gradient(105deg, rgba(5,12,40,0.90) 0%, rgba(5,12,40,0.78) 38%, rgba(5,12,40,0.40) 60%, rgba(5,12,40,0.10) 100%);"></div>
    </div>

    {{-- Slide 2 bg --}}
    <div style="position:absolute; inset:0; transition:opacity 0.9s ease;" :style="current===2 ? 'opacity:1' : 'opacity:0'">
        <img src="{{ asset('assets/slide-klcc.jpg') }}" alt=""
             style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover; object-position:center center;">
        <div style="position:absolute; inset:0; background:linear-gradient(105deg, rgba(5,12,40,0.90) 0%, rgba(5,12,40,0.78) 38%, rgba(5,12,40,0.40) 60%, rgba(5,12,40,0.10) 100%);"></div>
    </div>

    {{-- Slide 3 bg --}}
    <div style="position:absolute; inset:0; transition:opacity 0.9s ease;" :style="current===3 ? 'opacity:1' : 'opacity:0'">
        <img src="{{ asset('assets/ina.jpg') }}" alt=""
             style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover; object-position:center center;">
        <div style="position:absolute; inset:0; background:linear-gradient(105deg, rgba(5,12,40,0.90) 0%, rgba(5,12,40,0.78) 38%, rgba(5,12,40,0.40) 60%, rgba(5,12,40,0.10) 100%);"></div>
    </div>

    {{-- ══ Layer 2: Text content — always on top, switches via x-show ══ --}}
    <div style="position:absolute; inset:0; z-index:5; display:flex; align-items:center;">
        <div style="width:100%; max-width:var(--max-width-wrap); margin:0 auto; padding:0 40px;">

            {{-- Slide 0 text --}}
            <div x-show="current===0" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" style="max-width:560px;">
                <div style="display:flex; align-items:center; gap:10px; font-family:'DM Mono',monospace; font-size:10px; letter-spacing:0.18em; text-transform:uppercase; color:rgba(255,255,255,0.55); margin-bottom:20px;">
                    <span style="display:inline-block; width:28px; height:1px; background:var(--accent);"></span>
                    ITEA EDUABROAD
                </div>
                <h1 style="font-family:'Instrument Serif',serif; font-size:clamp(48px,5.2vw,80px); font-weight:400; line-height:0.95; letter-spacing:-0.02em; margin:0 0 24px;">
                    Your future,<br>
                    <em style="color:var(--accent);">studied abroad</em><br>
                    <span style="opacity:0.75;">in Asia.</span>
                </h1>
                <p style="font-size:16px; line-height:1.65; color:rgba(255,255,255,0.82); max-width:460px; margin:0 0 32px;">
                    ITEA EduAbroad places students from across Southeast Asia into top universities in China, Malaysia and Indonesia — with scholarship matching, visa support and a counsellor at every step.
                </p>
                <div style="display:flex; gap:14px; align-items:center; flex-wrap:wrap;">
                    <a href="{{ $applyUrl }}" class="btn-primary">Start your application →</a>
                </div>
            </div>

            {{-- Slide 1 text --}}
            <div x-show="current===1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" style="max-width:560px;">
                <div style="display:flex; align-items:center; gap:10px; font-family:'DM Mono',monospace; font-size:10px; letter-spacing:0.18em; text-transform:uppercase; color:rgba(255,255,255,0.55); margin-bottom:20px;">
                    <span style="display:inline-block; width:28px; height:1px; background:var(--accent);"></span>
                    DESTINATION 01 · CHINA
                </div>
                <h1 style="font-family:'Instrument Serif',serif; font-size:clamp(44px,4.8vw,74px); font-weight:400; line-height:0.97; letter-spacing:-0.02em; margin:0 0 22px;">
                    <em style="color:var(--accent); font-style:normal;">Study in China.</em><br>
                    World-class universities.
                </h1>
                <p style="font-size:16px; line-height:1.65; color:rgba(255,255,255,0.82); max-width:460px; margin:0 0 32px;">
                    Study at top Chinese universities with scholarships and dedicated support every step of the way.
                </p>
                <div style="display:flex; gap:14px; align-items:center; flex-wrap:wrap;">
                    <a href="{{ route('china') }}" class="btn-primary">Explore China programmes →</a>
                </div>
            </div>

            {{-- Slide 2 text --}}
            <div x-show="current===2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" style="max-width:560px;">
                <div style="display:flex; align-items:center; gap:10px; font-family:'DM Mono',monospace; font-size:10px; letter-spacing:0.18em; text-transform:uppercase; color:rgba(255,255,255,0.55); margin-bottom:20px;">
                    <span style="display:inline-block; width:28px; height:1px; background:var(--accent);"></span>
                    DESTINATION 02 · MALAYSIA
                </div>
                <h1 style="font-family:'Instrument Serif',serif; font-size:clamp(44px,4.8vw,74px); font-weight:400; line-height:0.97; letter-spacing:-0.02em; margin:0 0 22px;">
                    <em style="color:var(--accent); font-style:normal;">Study in Malaysia.</em><br>
                    Global learning.
                </h1>
                <p style="font-size:16px; line-height:1.65; color:rgba(255,255,255,0.82); max-width:460px; margin:0 0 32px;">
                    Global academic partnerships. English-medium education with a diverse campus experience.
                </p>
                <div style="display:flex; gap:14px; align-items:center; flex-wrap:wrap;">
                    <a href="{{ route('malaysia') }}" class="btn-primary">Explore Malaysia programmes →</a>
                </div>
            </div>

            {{-- Slide 3 text --}}
            <div x-show="current===3" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" style="max-width:560px;">
                <div style="display:flex; align-items:center; gap:10px; font-family:'DM Mono',monospace; font-size:10px; letter-spacing:0.18em; text-transform:uppercase; color:rgba(255,255,255,0.55); margin-bottom:20px;">
                    <span style="display:inline-block; width:28px; height:1px; background:var(--accent);"></span>
                    DESTINATION 03 · INDONESIA
                </div>
                <h1 style="font-family:'Instrument Serif',serif; font-size:clamp(44px,4.8vw,74px); font-weight:400; line-height:0.97; letter-spacing:-0.02em; margin:0 0 22px;">
                    <em style="color:var(--accent); font-style:normal;">Study in Indonesia.</em><br>
                    Emerging destination.
                </h1>
                <p style="font-size:16px; line-height:1.65; color:rgba(255,255,255,0.82); max-width:460px; margin:0 0 32px;">
                    Universities in key Indonesian cities — join the waitlist for early access.
                </p>
                <div style="display:flex; gap:14px; align-items:center; flex-wrap:wrap;">
                    <a href="{{ $applyUrl }}" class="btn-primary">Explore Indonesia programmes →</a>
                </div>
            </div>

        </div>
    </div>

    {{-- ══ Layer 3: Navigation controls ══ --}}

    {{-- Prev --}}
    <button @click="prev()" class="hero-nav-arrow"
            style="position:absolute; left:20px; top:50%; transform:translateY(-50%); z-index:10; background:rgba(255,255,255,0.12); border:1px solid rgba(255,255,255,0.25); color:#fff; width:44px; height:44px; border-radius:50%; cursor:pointer; font-size:22px; display:flex; align-items:center; justify-content:center; transition:background 0.2s;"
            onmouseenter="this.style.background='rgba(255,255,255,0.28)'" onmouseleave="this.style.background='rgba(255,255,255,0.12)'">‹</button>

    {{-- Next --}}
    <button @click="next()" class="hero-nav-arrow"
            style="position:absolute; right:20px; top:50%; transform:translateY(-50%); z-index:10; background:rgba(255,255,255,0.12); border:1px solid rgba(255,255,255,0.25); color:#fff; width:44px; height:44px; border-radius:50%; cursor:pointer; font-size:22px; display:flex; align-items:center; justify-content:center; transition:background 0.2s;"
            onmouseenter="this.style.background='rgba(255,255,255,0.28)'" onmouseleave="this.style.background='rgba(255,255,255,0.12)'">›</button>


{{-- Pill dots bottom-center --}}
    <div style="position:absolute; bottom:22px; left:50%; transform:translateX(-50%); z-index:10; display:flex; gap:8px; align-items:center;">
        @foreach([0,1,2,3] as $i)
        <button @click="goto({{ $i }})"
                style="border:none; cursor:pointer; border-radius:999px; padding:0; transition:all 0.3s ease;"
                :style="current==={{ $i }} ? 'width:28px;height:4px;background:#fff;' : 'width:8px;height:4px;background:rgba(255,255,255,0.4);'">
        </button>
        @endforeach
    </div>

</section>

{{-- ── Countries ──────────────────────────────────────────── --}}
<section class="section">
    <div class="wrap">

        {{-- Section header --}}
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:40px; align-items:end; margin-bottom:40px;">
            <div>
                <div class="eyebrow" style="margin-bottom:8px;">02 · Destinations</div>
                <h2 style="font-size:clamp(32px,4vw,52px); font-weight:700; margin:0; line-height:1;">Featured <em style="color:var(--accent); font-style:normal;">countries</em></h2>
            </div>
            <div>
                <p style="font-size:15px; line-height:1.6; color:var(--muted); margin:0;">Supporting your study journey with experienced global education advisors.</p>
            </div>
        </div>

        {{-- 3 Country Cards --}}
        <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:20px;">

            {{-- China --}}
            <a href="{{ route('china') }}" class="country-card" style="position:relative; display:block; height:380px; overflow:hidden; border-radius:4px; text-decoration:none; color:#fff;">
                <img src="{{ asset('assets/beijing.jpg') }}" alt="China"
                     style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover; object-position:center; transition:transform 0.5s ease;">
                <div style="position:absolute; inset:0; background:linear-gradient(to top, rgba(5,12,40,0.90) 0%, rgba(5,12,40,0.50) 50%, rgba(5,12,40,0.15) 100%);"></div>
                <div style="position:absolute; inset:0; display:flex; flex-direction:column; justify-content:flex-end; padding:28px;">
                    <div style="font-family:'DM Mono',monospace; font-size:10px; letter-spacing:0.18em; text-transform:uppercase; color:rgba(255,255,255,0.55); margin-bottom:8px;">
                        <span style="display:inline-block; width:18px; height:1px; background:var(--accent); vertical-align:middle; margin-right:8px;"></span>
                        Destination 01
                    </div>
                    <h3 style="font-size:clamp(32px,3.5vw,48px); font-weight:700; margin:0 0 8px; line-height:1;">China</h3>
                    <p style="font-size:13px; color:rgba(255,255,255,0.70); margin:0 0 18px; line-height:1.5;">Scholarships · 280+ universities · Full support</p>
                    <span style="font-family:'DM Mono',monospace; font-size:11px; letter-spacing:0.12em; text-transform:uppercase; color:var(--accent);">Explore →</span>
                </div>
            </a>

            {{-- Malaysia --}}
            <a href="{{ route('malaysia') }}" class="country-card" style="position:relative; display:block; height:380px; overflow:hidden; border-radius:4px; text-decoration:none; color:#fff;">
                <img src="{{ asset('assets/slide-klcc.jpg') }}" alt="Malaysia"
                     style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover; object-position:center; transition:transform 0.5s ease;">
                <div style="position:absolute; inset:0; background:linear-gradient(to top, rgba(5,12,40,0.90) 0%, rgba(5,12,40,0.50) 50%, rgba(5,12,40,0.15) 100%);"></div>
                <div style="position:absolute; inset:0; display:flex; flex-direction:column; justify-content:flex-end; padding:28px;">
                    <div style="font-family:'DM Mono',monospace; font-size:10px; letter-spacing:0.18em; text-transform:uppercase; color:rgba(255,255,255,0.55); margin-bottom:8px;">
                        <span style="display:inline-block; width:18px; height:1px; background:var(--accent); vertical-align:middle; margin-right:8px;"></span>
                        Destination 02
                    </div>
                    <h3 style="font-size:clamp(32px,3.5vw,48px); font-weight:700; margin:0 0 8px; line-height:1;">Malaysia</h3>
                    <p style="font-size:13px; color:rgba(255,255,255,0.70); margin:0 0 18px; line-height:1.5;">Global degrees · English-medium · Affordable</p>
                    <span style="font-family:'DM Mono',monospace; font-size:11px; letter-spacing:0.12em; text-transform:uppercase; color:var(--accent);">Explore →</span>
                </div>
            </a>

            {{-- Indonesia --}}
            <a href="{{ route('contact') }}" class="country-card" style="position:relative; display:block; height:380px; overflow:hidden; border-radius:4px; text-decoration:none; color:#fff;">
                <img src="{{ asset('assets/ina.jpg') }}" alt="Indonesia"
                     style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover; object-position:center; transition:transform 0.5s ease;">
                <div style="position:absolute; inset:0; background:linear-gradient(to top, rgba(5,12,40,0.90) 0%, rgba(5,12,40,0.50) 50%, rgba(5,12,40,0.15) 100%);"></div>
                <div style="position:absolute; inset:0; display:flex; flex-direction:column; justify-content:flex-end; padding:28px;">
                    <div style="font-family:'DM Mono',monospace; font-size:10px; letter-spacing:0.18em; text-transform:uppercase; color:rgba(255,255,255,0.55); margin-bottom:8px;">
                        <span style="display:inline-block; width:18px; height:1px; background:var(--accent); vertical-align:middle; margin-right:8px;"></span>
                        Destination 03
                    </div>
                    <h3 style="font-size:clamp(32px,3.5vw,48px); font-weight:700; margin:0 0 8px; line-height:1;">Indonesia</h3>
                    <p style="font-size:13px; color:rgba(255,255,255,0.70); margin:0 0 18px; line-height:1.5;">Emerging destination · Join the waitlist</p>
                    <span style="font-family:'DM Mono',monospace; font-size:11px; letter-spacing:0.12em; text-transform:uppercase; color:var(--accent);">Learn more →</span>
                </div>
            </a>

        </div>
    </div>
</section>

<style>
    .country-card:hover img { transform: scale(1.05); }
    @media (max-width: 768px) {
        .country-card { height: 280px !important; }
    }
    @media (max-width: 640px) {
        .country-card-grid { grid-template-columns: 1fr !important; }
    }
</style>

{{-- ── Universities grid ──────────────────────────────────── --}}
@php
$unis = [
    ['country'=>'CHINA','name'=>'Zhejiang Univ. of Science & Technology','city'=>'Hangzhou · Zhejiang','rank'=>'ZUST','progs'=>6,'intake'=>'Sep / Mar','phA'=>'#1c3d5a','phB'=>'#0a1f3a','image'=>'uni-zust.png','profile'=>route('china.zust')],
    ['country'=>'CHINA','name'=>'Shandong University of Technology','city'=>'Zibo · Shandong','rank'=>'SDUT','progs'=>4,'intake'=>'Sep / Mar','phA'=>'#34526e','phB'=>'#1a2a3e','image'=>'sdut.jpg','profile'=>route('china.sdut')],
    ['country'=>'CHINA','name'=>'Jiangxi Univ. of Finance & Economics','city'=>'Nanchang · Jiangxi','rank'=>'JUFE','progs'=>5,'intake'=>'Sep / Feb','phA'=>'#a51717','phB'=>'#3d0808','image'=>'jufe.jpg','profile'=>route('china.jufe')],
    ['country'=>'CHINA','name'=>'Hainan Medical University','city'=>'Haikou · Hainan','rank'=>'HMU','progs'=>4,'intake'=>'Sep / Mar','phA'=>'#2a8a6a','phB'=>'#0e3527','image'=>'hmu.jpg','profile'=>route('china.hmu')],
    ['country'=>'MALAYSIA','name'=>'Universiti Malaya','city'=>'Kuala Lumpur','rank'=>'QS #60','progs'=>31,'intake'=>'Sep / Feb','phA'=>'#0a1f5e','phB'=>'#061240','image'=>null,'profile'=>route('malaysia')],
    ['country'=>'MALAYSIA','name'=>'Taylor\'s University','city'=>'Subang Jaya','rank'=>'QS #251','progs'=>27,'intake'=>'Aug / Jan / May','phA'=>'#142a6e','phB'=>'#08164a','image'=>null,'profile'=>route('malaysia')],
    ['country'=>'MALAYSIA','name'=>'Monash University Malaysia','city'=>'Bandar Sunway','rank'=>'QS #44 Asia','progs'=>22,'intake'=>'Feb / Jul','phA'=>'#0c2670','phB'=>'#061240','image'=>null,'profile'=>route('malaysia')],
    ['country'=>'INDONESIA','name'=>'Universitas Indonesia','city'=>'Depok','rank'=>'QS #237','progs'=>18,'intake'=>'Sep / Feb','phA'=>'#c98a1d','phB'=>'#5e3f10','image'=>null,'profile'=>null],
];
@endphp

{{-- .uni-chip styles moved to app.css --}}

<section class="section" style="background:var(--paper); padding-top:48px;" x-data="{ filter: 'ALL' }">
    <div class="wrap">

        {{-- Section header + filters (single, unified) --}}
        <div style="display:flex; justify-content:space-between; align-items:end; margin-bottom:32px; flex-wrap:wrap; gap:16px;">
            <div>
                <div class="eyebrow" style="margin-bottom:8px;">03 · Featured</div>
                <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(28px,3.5vw,42px); font-weight:400; margin:0;">Hand-picked <em style="color:var(--accent);">universities</em></h2>
            </div>
            <div style="display:flex; gap:8px;">
                @foreach(['ALL','CHINA','MALAYSIA','INDONESIA'] as $f)
                <button @click="filter = '{{ $f }}'"
                        class="uni-chip"
                        :class="filter === '{{ $f }}' ? 'is-on' : ''">{{ $f }}</button>
                @endforeach
            </div>
        </div>

        {{-- Cards grid: 24px gap between cards --}}
        <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:24px;">
            @foreach($unis as $u)
            <div class="card" style="overflow:hidden;" x-show="filter === 'ALL' || filter === '{{ $u['country'] }}'">
                <div style="height:180px; background:linear-gradient(135deg,{{ $u['phA'] }},{{ $u['phB'] }}); position:relative;">
                    @if($u['image'])
                    <img src="{{ asset('assets/'.$u['image']) }}" alt="{{ $u['name'] }}"
                         style="position:absolute; inset:0; width:100%; height:100%; object-fit:cover;">
                    <div style="position:absolute; inset:0; background:linear-gradient(to top, rgba(0,0,0,0.55) 0%, transparent 55%);"></div>
                    @endif
                    <span style="position:absolute; top:10px; right:10px; background:rgba(0,0,0,0.45); color:rgba(255,255,255,0.9); font-family:'DM Mono',monospace; font-size:9.5px; letter-spacing:0.1em; padding:3px 8px; text-transform:uppercase;">{{ $u['rank'] }}</span>
                    <span style="position:absolute; bottom:10px; left:10px; font-family:'DM Mono',monospace; font-size:9.5px; letter-spacing:0.12em; text-transform:uppercase; color:rgba(255,255,255,0.55);">{{ strtoupper($u['city']) }}</span>
                </div>
                <div style="padding:18px 20px;">
                    <div class="eyebrow" style="margin-bottom:4px;">{{ $u['country'] }}</div>
                    <h4 style="font-family:'Instrument Serif',serif; font-size:18px; font-weight:400; margin:0 0 3px; color:var(--ink);">{{ $u['name'] }}</h4>
                    <div style="font-size:12px; color:var(--muted); margin-bottom:10px;">{{ $u['city'] }}</div>
                    <div style="display:flex; justify-content:space-between; align-items:center; font-size:12px; color:var(--muted);">
                        <div style="display:flex; gap:16px;">
                            <span><strong style="color:var(--ink);">{{ $u['progs'] }}</strong> programmes</span>
                            <span>Intake {{ $u['intake'] }}</span>
                        </div>
                        @if($u['profile'])
                        <a href="{{ $u['profile'] }}" style="font-size:12px; color:var(--accent); text-decoration:none; font-family:'DM Mono',monospace; letter-spacing:0.06em; white-space:nowrap; flex-shrink:0;">View →</a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div style="text-align:center; margin-top:40px;">
            <a href="{{ route('programmes') }}" class="btn-outline">Browse all 300+ universities →</a>
        </div>
    </div>
</section>

{{-- ── Scholarships ───────────────────────────────────────── --}}
<section class="section" style="background:var(--ink-deep); color:#fff;">
    <div class="wrap">
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:40px; align-items:end; margin-bottom:32px;">
            <div>
                <div class="eyebrow" style="color:rgba(255,255,255,0.4); margin-bottom:8px;">04 · Funding</div>
                <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(28px,3.5vw,42px); font-weight:400; margin:0; line-height:1; color:#fff;">Scholarship <em style="color:var(--accent);">opportunities</em></h2>
            </div>
            <p style="font-size:15px; line-height:1.6; color:rgba(255,255,255,0.65); margin:0;">Live, profile-matched scholarships from governments, universities and ITEA. Match runs nightly — your shortlist arrives within 48 hours.</p>
        </div>

        <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:2px; margin-bottom:20px;">
            @php
            $scholItems = [
                ['tag'=>'GOVERNMENT · CHINA','name'=>'Chinese Government Scholarship (CSC)','body'=>'Full tuition, accommodation, monthly stipend and medical insurance — for undergraduate through PhD students.','amt'=>'Up to 100%','note'=>'Tuition + Stipend','deadline'=>'Apr 15'],
                ['tag'=>'LANGUAGE · CHINA','name'=>'Confucius Institute Scholarship','body'=>'Mandarin learning scholarship covering language training, accommodation and a monthly living allowance.','amt'=>'RMB 2,500','note'=>'Per month','deadline'=>'May 30'],
                ['tag'=>'MERIT · ITEA','name'=>'ITEA Merit Award 2026','body'=>'Awarded to top 5% of ITEA applicants by academic and leadership merit. Stackable with country scholarships.','amt'=>'USD 4,000','note'=>'One-time','deadline'=>'Rolling'],
            ];
            @endphp
            @foreach($scholItems as $s)
            <div style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.08); padding:28px; display:flex; flex-direction:column; transition:background 0.18s;" onmouseenter="this.style.background='rgba(255,255,255,0.09)'" onmouseleave="this.style.background='rgba(255,255,255,0.05)'">
                <div class="eyebrow" style="color:var(--accent); margin-bottom:12px;">{{ $s['tag'] }}</div>
                <h4 style="font-family:'Instrument Serif',serif; font-size:22px; font-weight:400; margin:0 0 10px; color:#fff; line-height:1.2;">{{ $s['name'] }}</h4>
                <p style="font-size:14px; line-height:1.6; color:rgba(255,255,255,0.65); margin:0 0 20px; flex:1;">{{ $s['body'] }}</p>
                <div style="display:flex; justify-content:space-between; align-items:baseline; padding-top:16px; border-top:1px solid rgba(255,255,255,0.1);">
                    <div>
                        <div style="font-family:'Instrument Serif',serif; font-size:28px; color:#fff;">{{ $s['amt'] }} <small style="font-size:13px; opacity:0.6; font-family:'DM Sans',sans-serif;">{{ $s['note'] }}</small></div>
                    </div>
                    <div style="text-align:right;">
                        <div class="eyebrow" style="color:rgba(255,255,255,0.35); margin-bottom:4px;">Deadline</div>
                        <div style="font-family:'Instrument Serif',serif; font-size:20px;">{{ $s['deadline'] }}</div>
                    </div>
                </div>
                <a href="{{ route('scholarship') }}" style="margin-top:16px; color:var(--accent); font-size:13px; font-weight:500; text-decoration:none;">Check eligibility →</a>
            </div>
            @endforeach
        </div>
        <div style="background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.08); padding:16px 24px; display:flex; justify-content:space-between; align-items:center;">
            <span style="font-size:14px; color:rgba(255,255,255,0.65);">15 additional scholarships available across our network.</span>
            <a href="{{ route('scholarship') }}" style="color:var(--accent); font-size:14px; font-weight:500; text-decoration:none;">See all scholarships →</a>
        </div>
    </div>
</section>

{{-- ── Why ITEA ────────────────────────────────────────────── --}}
<section class="section">
    <div class="wrap">
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:40px; align-items:end; margin-bottom:32px;">
            <div>
                <div class="eyebrow" style="margin-bottom:8px;">05 · Why ITEA</div>
                <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(28px,3.5vw,42px); font-weight:400; margin:0;">Why <em style="color:var(--accent);">ITEA</em>?</h2>
            </div>
            <p style="font-size:15px; line-height:1.6; color:var(--muted); margin:0;">Sixteen years placing students from Malaysia, Indonesia and the Philippines into Asia's best universities. Here's what changes when you go through us.</p>
        </div>

        <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:2px;">
            @php
            $reasons = [
                ['num'=>'01','title'=>'End-to-end support','body'=>'From shortlist to airport pickup — a single counsellor across 7 stages of your journey.'],
                ['num'=>'02','title'=>'300+ partner institutions','body'=>'Direct MOUs with universities across China, Malaysia and Indonesia. No middlemen, no surprise fees.'],
                ['num'=>'03','title'=>'Scholarship matching','body'=>'Profile-matched to government, university and ITEA scholarships within 48 hours of enquiry.'],
                ['num'=>'04','title'=>'Mandarin from day one','body'=>'Free access to ITEA Learning — 12 weeks of online Mandarin before you fly. HSK-aligned.'],
                ['num'=>'05','title'=>'Career pathway','body'=>'ITEAJOBS connects you to internships and graduate placements across the ASEAN-China corridor.'],
                ['num'=>'06','title'=>'Alumni & community','body'=>'12,000+ students placed since 2009. Local WhatsApp groups in every city we serve.'],
            ];
            @endphp
            @foreach($reasons as $r)
            <div class="card" style="padding:28px;">
                <div style="font-family:'DM Mono',monospace; font-size:11px; color:var(--muted); margin-bottom:12px;">{{ $r['num'] }}</div>
                <h4 style="font-family:'Instrument Serif',serif; font-size:22px; font-weight:400; margin:0 0 10px; color:var(--ink);">{{ $r['title'] }}</h4>
                <p style="font-size:14px; line-height:1.6; color:var(--muted); margin:0;">{{ $r['body'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ── Application procedure ───────────────────────────────── --}}
<section class="section" style="background:var(--paper);">
    <div class="wrap">
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:40px; align-items:end; margin-bottom:32px;">
            <div>
                <div class="eyebrow" style="margin-bottom:8px;">06 · How it works</div>
                <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(28px,3.5vw,42px); font-weight:400; margin:0;">Application <em style="color:var(--accent);">procedure</em></h2>
            </div>
            <p style="font-size:15px; line-height:1.6; color:var(--muted); margin:0;">From first call to first day of class — most students complete the five-step journey in 8 to 14 weeks.</p>
        </div>
        <div style="display:grid; grid-template-columns:repeat(5,1fr); gap:2px;">
            @php
            $steps = [
                ['lbl'=>'Step 01','t'=>'Consultation','body'=>'Free 30-min counselling — online or at our KL office.'],
                ['lbl'=>'Step 02','t'=>'Shortlist','body'=>'We match you with 3-5 programmes that fit your profile and budget.'],
                ['lbl'=>'Step 03','t'=>'Application','body'=>'Submit one ITEA form — we forward to all your chosen universities.'],
                ['lbl'=>'Step 04','t'=>'Offer & Visa','body'=>'Receive offer letters and JW-202 / Visa Approval Letter through us.'],
                ['lbl'=>'Step 05','t'=>'Departure','body'=>'Pre-departure briefing, airport pickup, hostel setup — all handled.'],
            ];
            @endphp
            @foreach($steps as $i => $s)
            <div class="card" style="padding:24px; {{ $i === 0 ? 'border-left:3px solid var(--accent);' : '' }}">
                <div style="width:32px; height:32px; border-radius:50%; background:{{ $i === 0 ? 'var(--accent)' : 'var(--bg-2)' }}; display:flex; align-items:center; justify-content:center; font-family:'DM Mono',monospace; font-size:12px; margin-bottom:14px; color:{{ $i === 0 ? '#fff' : 'var(--ink)' }};">{{ $i+1 }}</div>
                <div class="eyebrow" style="margin-bottom:6px;">{{ $s['lbl'] }}</div>
                <h5 style="font-family:'Instrument Serif',serif; font-size:20px; font-weight:400; margin:0 0 8px; color:var(--ink);">{{ $s['t'] }}</h5>
                <p style="font-size:14px; line-height:1.55; color:var(--muted); margin:0;">{{ $s['body'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ── Apply CTA ───────────────────────────────────────────── --}}
<section style="background:var(--ink-deep); color:#fff; padding:64px 0;">
    <div class="wrap" style="display:grid; grid-template-columns:1fr 1fr; gap:60px; align-items:center;">
        <div>
            <div class="eyebrow" style="color:rgba(255,255,255,0.4); margin-bottom:12px;">07 · Apply now</div>
            <h2 style="font-family:'Instrument Serif',serif; font-size:clamp(36px,4.5vw,60px); font-weight:400; margin:0; line-height:1;">Begin your<br><em style="color:var(--accent);">journey east.</em></h2>
            <p style="max-width:400px; margin-top:20px; color:rgba(255,255,255,0.75); font-size:16px; line-height:1.6;">
                One form. We take it from here — programme matching, scholarship shortlist and a counsellor's call within 48 hours.
            </p>
        </div>

        <form action="{{ route('enquiry.store') }}" method="POST" style="background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.1); padding:28px;">
            @csrf
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-bottom:14px;">
                <div>
                    <label style="display:block; font-family:'DM Mono',monospace; font-size:10px; letter-spacing:0.12em; color:rgba(255,255,255,0.45); margin-bottom:6px; text-transform:uppercase;">Full name</label>
                    <input name="name" required placeholder="e.g. Aishah Rahman" style="width:100%; background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.15); padding:10px 12px; color:#fff; font-size:14px; box-sizing:border-box; outline:none;" onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='rgba(255,255,255,0.15)'">
                </div>
                <div>
                    <label style="display:block; font-family:'DM Mono',monospace; font-size:10px; letter-spacing:0.12em; color:rgba(255,255,255,0.45); margin-bottom:6px; text-transform:uppercase;">Email</label>
                    <input type="email" name="email" required placeholder="you@example.com" style="width:100%; background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.15); padding:10px 12px; color:#fff; font-size:14px; box-sizing:border-box; outline:none;" onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='rgba(255,255,255,0.15)'">
                </div>
            </div>
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-bottom:14px;">
                <div>
                    <label style="display:block; font-family:'DM Mono',monospace; font-size:10px; letter-spacing:0.12em; color:rgba(255,255,255,0.45); margin-bottom:6px; text-transform:uppercase;">Destination</label>
                    <select name="destination" style="width:100%; background:#1c2c5e; border:1px solid rgba(255,255,255,0.15); padding:10px 12px; color:#fff; font-size:14px; box-sizing:border-box; outline:none;">
                        <option value="China" style="background:#1c2c5e; color:#fff;">China</option>
                        <option value="Malaysia" style="background:#1c2c5e; color:#fff;">Malaysia</option>
                        <option value="Indonesia" style="background:#1c2c5e; color:#fff;">Indonesia</option>
                        <option value="Undecided" style="background:#1c2c5e; color:#fff;">Undecided</option>
                    </select>
                </div>
                <div>
                    <label style="display:block; font-family:'DM Mono',monospace; font-size:10px; letter-spacing:0.12em; color:rgba(255,255,255,0.45); margin-bottom:6px; text-transform:uppercase;">Level</label>
                    <select name="level" style="width:100%; background:#1c2c5e; border:1px solid rgba(255,255,255,0.15); padding:10px 12px; color:#fff; font-size:14px; box-sizing:border-box; outline:none;">
                        <option style="background:#1c2c5e; color:#fff;">Diploma</option>
                        <option selected style="background:#1c2c5e; color:#fff;">Undergraduate</option>
                        <option style="background:#1c2c5e; color:#fff;">Postgraduate</option>
                        <option style="background:#1c2c5e; color:#fff;">Mandarin</option>
                        <option style="background:#1c2c5e; color:#fff;">Short-term</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn-primary" style="width:100%; justify-content:center; padding:13px;">Send enquiry →</button>
            <p style="margin:12px 0 0; font-size:12px; color:rgba(255,255,255,0.4); text-align:center;">Or chat on WhatsApp · +60 12 345 6789</p>
        </form>
    </div>
</section>

@endsection
