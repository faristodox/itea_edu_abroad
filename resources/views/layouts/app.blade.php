<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ITEA EduAbroad — Study in Asia')</title>
    <meta name="description" content="@yield('description', 'ITEA EduAbroad places Southeast Asian students into top universities across China, Malaysia and Indonesia — with scholarship matching, visa support and end-to-end counselling.')">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Geist:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&family=Noto+Serif+SC:wght@400;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body>

<!-- ── Utility bar ──────────────────────────────────────────── -->
<div class="utility-bar">
    <div class="wrap" style="display:flex; justify-content:space-between; align-items:center;">
        <div style="display:flex; gap:20px; align-items:center;">
            <span>+603 7890 0000</span>
            <span style="opacity:0.4;">·</span>
            <span>hello@iteaeduabroad.com</span>
            <span style="opacity:0.4;">·</span>
            <span>Kuala Lumpur · Beijing · Jakarta</span>
        </div>
        <div style="display:flex; gap:12px; align-items:center;">
            @auth
                @if(Auth::user()->is_admin)
                <a href="{{ route('admin.dashboard') }}" style="color:rgba(255,255,255,0.7); text-decoration:none; font-family:'JetBrains Mono',monospace; font-size:10.5px; letter-spacing:0.1em;">Admin Dashboard</a>
                @else
                <a href="{{ route('portal') }}" style="color:rgba(255,255,255,0.7); text-decoration:none; font-family:'JetBrains Mono',monospace; font-size:10.5px; letter-spacing:0.1em;">My Portal</a>
                @endif
            @else
                @if(app()->environment('local'))
                <a href="{{ route('login') }}" style="color:rgba(255,255,255,0.7); text-decoration:none; font-family:'JetBrains Mono',monospace; font-size:10.5px; letter-spacing:0.1em;">Sign In</a>
                @else
                <span style="color:rgba(255,255,255,0.7); font-family:'JetBrains Mono',monospace; font-size:10.5px; letter-spacing:0.1em;">Sign In</span>
                @endif
            @endauth
            <!-- <span class="lang-pill" style="color:rgba(255,255,255,0.75);">EN / 中文 / BM</span> -->
        </div>
    </div>
</div>

<!-- ── Main nav ──────────────────────────────────────────────── -->
<nav class="main-nav" x-data="{ mobileOpen: false }">
    <div class="wrap" style="display:flex; align-items:center; justify-content:space-between; padding-top:14px; padding-bottom:14px;">

        <!-- Logo — child views can override with @section('nav_logo', 'assets/logo-china.jpeg') -->
        <a href="{{ route('home') }}" class="nav-logo-wrap" style="display:flex; align-items:center; gap:10px; text-decoration:none; flex-shrink:0;">
            @hasSection('nav_logo')
                <img class="nav-logo-img" src="{{ asset(View::yieldContent('nav_logo')) }}" alt="ITEA EduAbroad-China">
            @else
                <img class="nav-logo-img" src="{{ asset('assets/logo.jpeg') }}" alt="ITEA EduAbroad">
            @endif
        </a>

        <!-- Desktop links -->
        <div style="display:flex; align-items:center; gap:4px; flex:1; justify-content:center;" class="nav-links">

            <a href="{{ route('home') }}"
               class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>

            <!-- Programmes dropdown -->
            <div class="nav-item" style="position:relative;">
                <button class="nav-link {{ request()->routeIs('programmes') ? 'active' : '' }}" style="background:none; border:none; cursor:pointer; display:flex; align-items:center; gap:4px;">
                    Programmes
                    <span class="nav-caret" style="font-size:10px;">▾</span>
                </button>
                <div class="mega-menu" style="width:220px; left:0; transform:translateY(6px);">
                    <div style="padding:16px;">
                        @php $progLevels = [
                            ['label'=>'Diploma',        'val'=>'DIPLOMA'],
                            ['label'=>'Undergraduate',  'val'=>'UG'],
                            ['label'=>'Postgraduate',   'val'=>'PG'],
                            ['label'=>'Mandarin Learning','val'=>'MANDARIN'],
                            ['label'=>'Short-term',     'val'=>'SHORT'],
                        ]; @endphp
                        @foreach($progLevels as $i => $pl)
                        <a href="{{ route('programmes') }}?level={{ $pl['val'] }}#prog-grid"
                           style="display:flex; justify-content:space-between; align-items:center; padding:10px 0; {{ $i < count($progLevels)-1 ? 'border-bottom:1px solid var(--rule-soft);' : '' }} text-decoration:none; color:var(--ink-2); font-size:14px;">
                            {{ $pl['label'] }}
                            <span style="color:var(--accent);">→</span>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Destinations dropdown -->
            <div class="nav-item" style="position:relative;">
                <button class="nav-link" style="background:none; border:none; cursor:pointer; display:flex; align-items:center; gap:4px;">
                    Destinations
                    <span class="nav-caret" style="font-size:10px;">▾</span>
                </button>

                <div class="mega-menu">
                    <div style="display:grid; grid-template-columns:60% 40%;">
                        <!-- Featured panel — dynamic based on current page -->
                        @if(request()->routeIs('malaysia'))
                        <div style="background:#7a4f10; padding:28px; color:#fff;">
                            <div class="eyebrow" style="color:rgba(255,255,255,0.5); margin-bottom:12px;">Current destination</div>
                            <div style="font-family:'Instrument Serif',serif; font-size:32px; line-height:1; margin-bottom:6px;">Study in <em style="color:#f5c842;">Malaysia</em></div>
                            <div class="zh" style="font-size:18px; color:rgba(255,255,255,0.5); margin-bottom:16px;">马来西亚留学</div>
                            <div style="display:flex; gap:24px; font-size:13px; color:rgba(255,255,255,0.7);">
                                <div><div style="font-family:'Instrument Serif',serif; font-size:22px; color:#fff;">90+</div><div>Partner unis</div></div>
                                <div><div style="font-family:'Instrument Serif',serif; font-size:22px; color:#fff;">88%</div><div>Scholarship match</div></div>
                                <div><div style="font-family:'Instrument Serif',serif; font-size:22px; color:#fff;">5</div><div>QS Top-200</div></div>
                            </div>
                        </div>
                        @else
                        <div style="background:var(--ink-deep); padding:28px; color:#fff;">
                            <div class="eyebrow" style="color:rgba(255,255,255,0.5); margin-bottom:12px;">Featured destination</div>
                            <div style="font-family:'Instrument Serif',serif; font-size:32px; line-height:1; margin-bottom:6px;">Study in <em style="color:var(--accent);">China</em></div>
                            <div class="zh" style="font-size:18px; color:rgba(255,255,255,0.5); margin-bottom:16px;">中国留学</div>
                            <div style="display:flex; gap:24px; font-size:13px; color:rgba(255,255,255,0.7);">
                                <div><div style="font-family:'Instrument Serif',serif; font-size:22px; color:#fff;">280+</div><div>Partner unis</div></div>
                                <div><div style="font-family:'Instrument Serif',serif; font-size:22px; color:#fff;">94%</div><div>Scholarship match</div></div>
                                <div><div style="font-family:'Instrument Serif',serif; font-size:22px; color:#fff;">11</div><div>QS Top-100</div></div>
                            </div>
                        </div>
                        @endif
                        <!-- Destinations list -->
                        <div style="padding:20px;">
                            <div class="eyebrow" style="margin-bottom:12px;">All destinations</div>
                            <a href="{{ route('china') }}" style="display:flex; justify-content:space-between; align-items:center; padding:10px 0; border-bottom:1px solid var(--rule-soft); text-decoration:none; color:var(--ink-2);">
                                <div>
                                    <div style="font-weight:500; font-size:14px;">Study in China</div>
                                    <div style="font-size:11px; color:var(--muted);">280+ universities · Open</div>
                                </div>
                                <span style="color:var(--accent);">→</span>
                            </a>
                            <a href="{{ route('malaysia') }}" style="display:flex; justify-content:space-between; align-items:center; padding:10px 0; border-bottom:1px solid var(--rule-soft); text-decoration:none; color:var(--ink-2);">
                                <div>
                                    <div style="font-weight:500; font-size:14px;">Study in Malaysia</div>
                                    <div style="font-size:11px; color:var(--muted);">90+ universities · Open</div>
                                </div>
                                <span style="color:var(--accent);">→</span>
                            </a>
                            <div style="display:flex; justify-content:space-between; align-items:center; padding:10px 0; border-bottom:1px solid var(--rule-soft); color:var(--muted);">
                                <div>
                                    <div style="font-size:14px;">Indonesia</div>
                                    <div style="font-size:11px;">Coming Soon · 2026</div>
                                </div>
                                <span style="font-size:10px; background:var(--bg-2); padding:2px 8px; border-radius:999px;">Soon</span>
                            </div>
                            <div style="display:flex; justify-content:space-between; align-items:center; padding:10px 0; color:var(--muted);">
                                <div>
                                    <div style="font-size:14px;">Future Destinations</div>
                                    <div style="font-size:11px;">Coming · 2027</div>
                                </div>
                                <span style="font-size:10px; background:var(--bg-2); padding:2px 8px; border-radius:999px;">Soon</span>
                            </div>
                            <div style="margin-top:14px; padding-top:14px; border-top:1px solid var(--rule-soft); font-size:12px; color:var(--muted);">
                                <span style="display:inline-block; width:7px; height:7px; border-radius:50%; background:#2fa86e; margin-right:6px;"></span>
                                Talk to an advisor — available now &nbsp;<a href="{{ route('contact') }}" style="color:var(--accent); text-decoration:none;">Book a call →</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{ route('scholarship') }}"
               class="nav-link {{ request()->routeIs('scholarship') ? 'active' : '' }}">Scholarship</a>

            <!-- Application dropdown -->
            <div class="nav-item" style="position:relative;">
                <button class="nav-link" style="background:none; border:none; cursor:pointer; display:flex; align-items:center; gap:4px;">
                    Application
                    <span class="nav-caret" style="font-size:10px;">▾</span>
                </button>
                <div class="mega-menu" style="width:320px; left:0; transform:translateY(6px);">
                    <div style="padding:16px;">
                        <a href="{{ route('application') }}" style="display:block; padding:10px 0; border-bottom:1px solid var(--rule-soft); text-decoration:none; color:var(--ink-2); font-size:14px;">How to Apply</a>
                        <a href="{{ route('application') }}#fees" style="display:block; padding:10px 0; border-bottom:1px solid var(--rule-soft); text-decoration:none; color:var(--ink-2); font-size:14px;">Fees &amp; Refund Policy</a>
                        <a href="{{ route('application') }}#docs" style="display:block; padding:10px 0; border-bottom:1px solid var(--rule-soft); text-decoration:none; color:var(--ink-2); font-size:14px;">Required Documents</a>
                        <a href="{{ route('application') }}#visa" style="display:block; padding:10px 0; border-bottom:1px solid var(--rule-soft); text-decoration:none; color:var(--ink-2); font-size:14px;">Visa Guidance</a>
                        <a href="{{ route('application') }}#depart" style="display:block; padding:10px 0; text-decoration:none; color:var(--ink-2); font-size:14px;">Pre-Departure Briefing</a>
                    </div>
                </div>
            </div>

            <!-- Events dropdown -->
            <div class="nav-item" style="position:relative;">
                <button class="nav-link {{ request()->routeIs('virtual-fair') ? 'active' : '' }}" style="background:none; border:none; cursor:pointer; display:flex; align-items:center; gap:4px;">
                    Events
                    <span class="nav-caret" style="font-size:10px;">▾</span>
                </button>
                <div class="mega-menu" style="width:280px; left:0; transform:translateY(6px);">
                    <div style="padding:16px;">
                        <a href="{{ route('virtual-fair') }}" style="display:flex; justify-content:space-between; align-items:center; padding:10px 0; text-decoration:none; color:var(--ink-2);">
                            <div>
                                <div style="font-weight:500; font-size:14px;">Virtual Education Fair</div>
                                <div style="font-size:11px; color:var(--muted);">7 Jun 2026 · Free · Online</div>
                            </div>
                            <span style="color:var(--accent);">→</span>
                        </a>
                    </div>
                </div>
            </div>

            <a href="https://iteajobs.com/" target="_blank" rel="noopener"
               class="nav-link">Find Your Career</a>

            <a href="{{ route('contact') }}"
               class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
        </div>

        <!-- CTA + Hamburger -->
        <div style="display:flex; align-items:center; gap:10px; flex-shrink:0;">
            <a href="{{ route('application') }}#apply" class="btn-primary nav-cta-btn" style="white-space:nowrap;">Apply Now</a>
            <!-- Hamburger (mobile only) -->
            <button @click="mobileOpen = !mobileOpen" class="hamburger-btn" aria-label="Toggle menu">
                <span class="hamburger-line" :class="mobileOpen ? 'rotate-45 translate-y' : ''"></span>
                <span class="hamburger-line" :class="mobileOpen ? 'opacity-0' : ''"></span>
                <span class="hamburger-line" :class="mobileOpen ? '-rotate-45 -translate-y' : ''"></span>
            </button>
        </div>
    </div>

    <!-- Mobile menu -->
    <div x-show="mobileOpen" x-transition class="mobile-menu">

        <a href="{{ route('home') }}" class="mob-link {{ request()->routeIs('home') ? 'mob-active' : '' }}">Home</a>
        {{-- Programmes collapsible --}}
        <div x-data="{ open: {{ request()->routeIs('programmes') ? 'true' : 'false' }} }">
            <button @click="open = !open" class="mob-link mob-toggle" style="width:100%; display:flex; justify-content:space-between; align-items:center; background:none; border:none; cursor:pointer; text-align:left;">
                <span>Programmes</span>
                <span style="font-size:16px; transition:transform 0.2s ease;" :style="open ? 'transform:rotate(180deg)' : ''">⌄</span>
            </button>
            <div x-show="open" x-collapse>
                <a href="{{ route('programmes') }}?level=DIPLOMA"    class="mob-link mob-sub">Diploma</a>
                <a href="{{ route('programmes') }}?level=UG"         class="mob-link mob-sub">Undergraduate</a>
                <a href="{{ route('programmes') }}?level=PG"         class="mob-link mob-sub">Postgraduate</a>
                <a href="{{ route('programmes') }}?level=MANDARIN"   class="mob-link mob-sub">Mandarin Learning</a>
                <a href="{{ route('programmes') }}?level=SHORT"      class="mob-link mob-sub">Short-term</a>
            </div>
        </div>

        {{-- Destinations collapsible --}}
        <div x-data="{ open: {{ request()->routeIs('china') || request()->routeIs('malaysia') ? 'true' : 'false' }} }">
            <button @click="open = !open" class="mob-link mob-toggle" style="width:100%; display:flex; justify-content:space-between; align-items:center; background:none; border:none; cursor:pointer; text-align:left;">
                <span>Destinations</span>
                <span style="font-size:16px; transition:transform 0.2s ease;" :style="open ? 'transform:rotate(180deg)' : ''">⌄</span>
            </button>
            <div x-show="open" x-collapse>
                <a href="{{ route('china') }}" class="mob-link mob-sub {{ request()->routeIs('china') ? 'mob-active' : '' }}">Study in China</a>
                <a href="{{ route('malaysia') }}" class="mob-link mob-sub {{ request()->routeIs('malaysia') ? 'mob-active' : '' }}">Study in Malaysia</a>
                <div class="mob-sub-item-muted">Indonesia · Coming 2026</div>
            </div>
        </div>

        <a href="{{ route('scholarship') }}" class="mob-link {{ request()->routeIs('scholarship') ? 'mob-active' : '' }}">Scholarship</a>

        {{-- Application collapsible --}}
        <div x-data="{ open: {{ request()->routeIs('application') ? 'true' : 'false' }} }">
            <button @click="open = !open" class="mob-link mob-toggle" style="width:100%; display:flex; justify-content:space-between; align-items:center; background:none; border:none; cursor:pointer; text-align:left;">
                <span>Application</span>
                <span style="font-size:16px; transition:transform 0.2s ease;" :style="open ? 'transform:rotate(180deg)' : ''">⌄</span>
            </button>
            <div x-show="open" x-collapse>
                <a href="{{ route('application') }}" class="mob-link mob-sub">How to Apply</a>
                <a href="{{ route('application') }}#fees" class="mob-link mob-sub">Fees &amp; Refund</a>
                <a href="{{ route('application') }}#docs" class="mob-link mob-sub">Required Documents</a>
                <a href="{{ route('application') }}#visa" class="mob-link mob-sub">Visa Guidance</a>
                <a href="{{ route('application') }}#depart" class="mob-link mob-sub">Pre-Departure</a>
            </div>
        </div>

        {{-- Events collapsible --}}
        <div x-data="{ open: {{ request()->routeIs('virtual-fair') ? 'true' : 'false' }} }">
            <button @click="open = !open" class="mob-link mob-toggle" style="width:100%; display:flex; justify-content:space-between; align-items:center; background:none; border:none; cursor:pointer; text-align:left;">
                <span>Events</span>
                <span style="font-size:16px; transition:transform 0.2s ease;" :style="open ? 'transform:rotate(180deg)' : ''">⌄</span>
            </button>
            <div x-show="open" x-collapse>
                <a href="{{ route('virtual-fair') }}" class="mob-link mob-sub {{ request()->routeIs('virtual-fair') ? 'mob-active' : '' }}">Virtual Education Fair</a>
            </div>
        </div>
        <a href="https://iteajobs.com/" target="_blank" rel="noopener" class="mob-link">Find Your Career ↗</a>
        <a href="{{ route('contact') }}" class="mob-link {{ request()->routeIs('contact') ? 'mob-active' : '' }}">Contact</a>

        <div style="padding:16px;">
            <a href="{{ route('application') }}#apply" class="btn-primary" style="display:block; text-align:center; width:100%; box-sizing:border-box;">Apply Now →</a>
        </div>
    </div>
</nav>

<style>
.nav-link {
    font-family: 'JetBrains Mono', monospace;
    font-size: 11px;
    font-weight: 500;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--ink-2);
    text-decoration: none;
    padding: 6px 12px;
    transition: color 0.15s ease;
}
.nav-link:hover,
.nav-link.active { color: var(--accent); }
.nav-links { display: flex; }
@media (max-width: 900px) { .nav-links { display: none; } }
</style>

<!-- ── Page content ──────────────────────────────────────────── -->
@yield('content')

<!-- ── Footer ───────────────────────────────────────────────── -->
@include('partials.footer')

@stack('scripts')
</body>
</html>
