<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Portal') — ITEA EduAbroad</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=DM+Sans:wght@300;400;500;600;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; display: flex; min-height: 100vh; background: #f0f4f8; font-family: 'DM Sans', sans-serif; }

        /* ── Sidebar ── */
        .adm-sidebar {
            width: 256px; min-height: 100vh;
            background: linear-gradient(180deg, #061240 0%, #091a52 100%);
            display: flex; flex-direction: column; flex-shrink: 0;
            position: fixed; top: 0; left: 0; bottom: 0; z-index: 10;
            box-shadow: 4px 0 24px rgba(6, 18, 64, 0.18);
        }
        .adm-sidebar-brand {
            padding: 24px 20px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }

        .adm-nav { flex: 1; padding: 12px; overflow-y: auto; }
        .adm-nav-section {
            font-family: 'DM Mono', monospace; font-size: 8px;
            letter-spacing: 0.18em; text-transform: uppercase;
            color: rgba(255,255,255,0.2); padding: 18px 8px 6px;
        }
        .adm-nav a {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 10px; font-family: 'DM Sans', sans-serif;
            font-size: 13.5px; font-weight: 400;
            color: rgba(255,255,255,0.52); text-decoration: none;
            transition: all 0.18s; border-radius: 10px; margin-bottom: 1px;
        }
        .adm-nav a:hover { color: rgba(255,255,255,0.88); background: rgba(255,255,255,0.07); }
        .adm-nav a.active {
            color: #fff; background: rgba(216, 31, 31, 0.18);
            box-shadow: inset 0 0 0 1px rgba(216, 31, 31, 0.28);
        }
        .adm-nav a .nav-icon {
            width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;
            border-radius: 8px; background: rgba(255,255,255,0.05);
            flex-shrink: 0; transition: background 0.18s;
        }
        .adm-nav a.active .nav-icon { background: rgba(216, 31, 31, 0.28); }
        .adm-nav a:hover .nav-icon { background: rgba(255,255,255,0.1); }
        .adm-nav a .nav-icon svg { width: 15px; height: 15px; }
        .adm-nav a .nav-badge {
            margin-left: auto; background: #d81f1f; color: #fff;
            font-size: 10px; padding: 2px 7px; border-radius: 999px;
            font-family: 'DM Sans', sans-serif; font-weight: 600;
        }

        .adm-sidebar-footer { padding: 12px; border-top: 1px solid rgba(255,255,255,0.06); }
        .adm-sidebar-footer-inner {
            display: flex; align-items: center; gap: 10px;
            background: rgba(255,255,255,0.05); border-radius: 10px; padding: 10px 12px;
        }
        .adm-sidebar-footer .avatar {
            width: 34px; height: 34px;
            background: linear-gradient(135deg, #d81f1f, #3d52b8);
            border-radius: 9px; display: flex; align-items: center; justify-content: center;
            font-family: 'DM Sans', sans-serif; font-size: 16px; color: #fff; flex-shrink: 0;
        }
        .adm-sidebar-footer .user-info { flex: 1; min-width: 0; }
        .adm-sidebar-footer .user-name {
            font-size: 12.5px; color: #fff; font-weight: 500;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .adm-sidebar-footer .user-role { font-size: 10.5px; color: rgba(255,255,255,0.32); margin-top: 1px; }

        /* ── Main area ── */
        .adm-main { flex: 1; margin-left: 256px; display: flex; flex-direction: column; min-height: 100vh; }

        /* ── Topbar ── */
        .adm-topbar {
            background: #fff; border-bottom: 1px solid #e4e9f2;
            padding: 0 32px; height: 66px;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 5;
            box-shadow: 0 1px 3px rgba(6,18,64,0.04);
        }
        .adm-topbar-left { display: flex; align-items: center; gap: 14px; }
        .adm-topbar-breadcrumb { font-size: 11.5px; color: #8a94b0; margin-bottom: 3px; }
        .adm-topbar-breadcrumb a { color: #8a94b0; text-decoration: none; }
        .adm-topbar-breadcrumb a:hover { color: #d81f1f; }
        .adm-topbar-breadcrumb .sep { margin: 0 5px; opacity: 0.4; }
        .adm-topbar-breadcrumb .current { color: #1a1a2e; font-weight: 500; }
        .adm-topbar h1 {
            font-family: 'Outfit', sans-serif; font-size: 17px;
            font-weight: 600; color: #1a1a2e; margin: 0;
        }
        .adm-topbar-actions { display: flex; align-items: center; gap: 8px; }
        .adm-topbar-icon-btn {
            width: 36px; height: 36px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 9px; background: #f4f6fb; border: 1px solid #e4e9f2;
            cursor: pointer; color: #8a94b0; transition: all 0.15s; text-decoration: none;
        }
        .adm-topbar-icon-btn:hover { background: #eaeff8; color: #1a1a2e; border-color: #cdd5e8; }
        .adm-topbar-icon-btn svg { width: 16px; height: 16px; }
        .adm-logout-btn {
            display: flex; align-items: center; gap: 6px;
            padding: 8px 14px; border-radius: 9px;
            background: #f4f6fb; border: 1px solid #e4e9f2;
            font-size: 12.5px; font-family: 'DM Sans', sans-serif; font-weight: 500;
            color: #8a94b0; cursor: pointer; transition: all 0.15s;
        }
        .adm-logout-btn:hover { background: #fee2e2; border-color: #fca5a5; color: #dc2626; }
        .adm-logout-btn svg { width: 14px; height: 14px; }

        /* ── Content ── */
        .adm-content { padding: 28px 32px; flex: 1; }

        /* ── Stat cards ── */
        .stat-grid { display: grid; gap: 16px; margin-bottom: 20px; }
        .stat-card {
            background: #fff; padding: 22px 24px; border-radius: 16px;
            border: 1px solid #e4e9f2;
            box-shadow: 0 1px 4px rgba(6,18,64,0.04), 0 4px 16px rgba(6,18,64,0.03);
            position: relative; overflow: hidden;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(6,18,64,0.08), 0 8px 32px rgba(6,18,64,0.04);
        }
        .stat-card-top { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 14px; }
        .stat-card .stat-icon {
            width: 44px; height: 44px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .stat-card .stat-icon svg { width: 22px; height: 22px; }
        .stat-card .val {
            font-family: 'Outfit', sans-serif; font-size: 38px;
            color: #1a1a2e; line-height: 1;
        }
        .stat-card .lbl { font-size: 12px; color: #8a94b0; margin-top: 4px; font-weight: 400; }

        .icon-blue   { background: #dbeafe; color: #1d4ed8; }
        .icon-green  { background: #d1fae5; color: #047857; }
        .icon-purple { background: #ede9fe; color: #6d28d9; }
        .icon-red    { background: #fee2e2; color: #dc2626; }
        .icon-amber  { background: #fef3c7; color: #b45309; }
        .icon-gray   { background: #f3f4f6; color: #4b5563; }

        /* ── Card ── */
        .adm-card {
            background: #fff; border: 1px solid #e4e9f2;
            border-radius: 16px; padding: 24px;
            box-shadow: 0 1px 4px rgba(6,18,64,0.04);
        }
        .adm-section-title {
            font-family: 'DM Mono', monospace; font-size: 9px;
            letter-spacing: 0.14em; text-transform: uppercase;
            color: #8a94b0; margin-bottom: 16px;
        }

        /* ── Table ── */
        .adm-table-wrap {
            background: #fff; border: 1px solid #e4e9f2;
            border-radius: 16px; overflow: hidden;
            box-shadow: 0 1px 4px rgba(6,18,64,0.04);
        }
        .adm-table-header {
            display: flex; justify-content: space-between; align-items: center;
            padding: 20px 24px; border-bottom: 1px solid #e4e9f2;
        }
        .adm-table-header h2 {
            font-family: 'Outfit', sans-serif; font-size: 15px;
            font-weight: 600; color: #1a1a2e; margin: 0;
        }
        table { width: 100%; border-collapse: collapse; }
        thead tr { background: #f8fafd; }
        th {
            font-family: 'DM Sans', sans-serif; font-size: 11px; font-weight: 600;
            letter-spacing: 0.04em; text-transform: uppercase;
            color: #8a94b0; padding: 12px 16px;
            border-bottom: 1px solid #e4e9f2; text-align: left; white-space: nowrap;
        }
        td {
            padding: 13px 16px; border-bottom: 1px solid #f0f3f9;
            font-size: 13px; color: #1a1a2e; vertical-align: middle;
        }
        tbody tr:last-child td { border-bottom: none; }
        tbody tr:hover td { background: #f8fafd; }

        /* ── Badges ── */
        .badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 4px 10px; border-radius: 6px;
            font-size: 11px; font-weight: 500; letter-spacing: 0.02em;
        }
        .badge::before { content: ''; width: 6px; height: 6px; border-radius: 50%; background: currentColor; flex-shrink: 0; opacity: 0.7; }
        .badge-draft     { background: #f3f4f6; color: #6b7280; }
        .badge-submitted { background: #dbeafe; color: #1d4ed8; }
        .badge-reviewing { background: #fef3c7; color: #92400e; }
        .badge-accepted  { background: #d1fae5; color: #065f46; }
        .badge-rejected  { background: #fee2e2; color: #991b1b; }
        .badge-result    { background: #ede9fe; color: #5b21b6; }

        /* ── Form ── */
        .adm-form-group { margin-bottom: 18px; }
        .adm-form-group label {
            display: block; font-family: 'DM Mono', monospace;
            font-size: 10px; letter-spacing: 0.12em; text-transform: uppercase;
            color: #8a94b0; margin-bottom: 7px;
        }
        .adm-form-group input,
        .adm-form-group select,
        .adm-form-group textarea {
            width: 100%; padding: 10px 13px; border: 1px solid #e4e9f2;
            border-radius: 8px; background: #fff; color: #1a1a2e;
            font-size: 14px; font-family: 'DM Sans', sans-serif;
            outline: none; transition: border-color 0.15s, box-shadow 0.15s;
        }
        .adm-form-group input:focus,
        .adm-form-group select:focus,
        .adm-form-group textarea:focus {
            border-color: #d81f1f;
            box-shadow: 0 0 0 3px rgba(216, 31, 31, 0.08);
        }

        /* ── Alert ── */
        .adm-alert-success {
            background: #f0fdf4; border: 1px solid #86efac; border-radius: 10px;
            padding: 13px 16px; margin-bottom: 20px; font-size: 13px; color: #166534;
            display: flex; align-items: center; gap: 8px;
        }
        .adm-alert-error {
            background: #fff0f0; border: 1px solid #fca5a5; border-radius: 10px;
            padding: 13px 16px; margin-bottom: 20px; font-size: 13px; color: #b91c1c;
        }

        /* ── Action link ── */
        .adm-link {
            font-size: 12.5px; font-weight: 500; color: #d81f1f;
            text-decoration: none; display: inline-flex; align-items: center; gap: 4px;
        }
        .adm-link:hover { text-decoration: underline; }
        .adm-link-muted { font-size: 12px; color: #8a94b0; text-decoration: none; }

        /* ── Primary button ── */
        .prt-btn {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 10px 20px; background: #d81f1f; color: #fff;
            border: none; border-radius: 8px; font-family: 'DM Sans', sans-serif;
            font-size: 13px; font-weight: 500; cursor: pointer; text-decoration: none;
            transition: background 0.15s;
        }
        .prt-btn:hover { background: #b91c1c; }
        .prt-btn-outline {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 10px 20px; background: transparent; color: #1a1a2e;
            border: 1px solid #e4e9f2; border-radius: 8px;
            font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 500;
            cursor: pointer; text-decoration: none; transition: all 0.15s;
        }
        .prt-btn-outline:hover { background: #f4f6fb; border-color: #cdd5e8; }
    </style>
</head>
<body>

<!-- Sidebar -->
<aside class="adm-sidebar">
    <div class="adm-sidebar-brand">
        <a href="{{ route('portal') }}" style="display:inline-flex; align-items:center; text-decoration:none; background:#fff; border-radius:10px; padding:8px 12px;">
            <img src="{{ asset('assets/logo.png') }}" alt="ITEA EduAbroad"
                 style="height:52px; width:auto; display:block;">
        </a>
        <div style="font-family:'DM Mono',monospace; font-size:9px; letter-spacing:0.16em; text-transform:uppercase; color:rgba(255,255,255,0.3); margin-top:10px;">Applicant Portal</div>
    </div>

    <nav class="adm-nav">
        <div class="adm-nav-section">Overview</div>
        <a href="{{ route('portal') }}" class="{{ request()->routeIs('portal') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                </svg>
            </span>
            Dashboard
        </a>

        <div class="adm-nav-section">Applications</div>
        <a href="{{ route('portal.apply') }}" class="{{ request()->routeIs('portal.apply*') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </span>
            New Application
        </a>
        <a href="{{ route('portal') }}" class="{{ request()->routeIs('portal.application*') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z" />
                </svg>
            </span>
            My Applications
        </a>

        <div class="adm-nav-section">Account</div>
        <a href="{{ route('portal.profile') }}" class="{{ request()->routeIs('portal.profile*') ? 'active' : '' }}">
            <span class="nav-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
            </span>
            My Profile
        </a>

        <div class="adm-nav-section">Resources</div>
        <a href="{{ route('programmes') }}" target="_blank">
            <span class="nav-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                </svg>
            </span>
            Browse Programmes
        </a>
        <a href="{{ route('scholarship') }}" target="_blank">
            <span class="nav-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                </svg>
            </span>
            Scholarships
        </a>
        <a href="{{ route('home') }}" target="_blank">
            <span class="nav-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                </svg>
            </span>
            View Website
        </a>
    </nav>

    <div class="adm-sidebar-footer">
        <div class="adm-sidebar-footer-inner">
            <div class="avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <div class="user-info">
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-role">Applicant</div>
            </div>
            <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                @csrf
                <button type="submit" title="Log out" style="background:none;border:none;color:rgba(255,255,255,0.28);cursor:pointer;padding:4px;line-height:1;display:flex;align-items:center;transition:color 0.15s;" onmouseover="this.style.color='rgba(255,255,255,0.7)'" onmouseout="this.style.color='rgba(255,255,255,0.28)'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</aside>

<!-- Main -->
<div class="adm-main">
    <!-- Topbar -->
    <div class="adm-topbar">
        <div class="adm-topbar-left">
            <div>
                <div class="adm-topbar-breadcrumb">
                    <a href="{{ route('portal') }}">My Portal</a>
                    @hasSection('breadcrumb')
                    <span class="sep">/</span>
                    <span class="current">@yield('breadcrumb')</span>
                    @endif
                </div>
                <h1>@yield('title', 'Dashboard')</h1>
            </div>
        </div>
        <div class="adm-topbar-actions">
            @yield('topbar_actions')
            <a href="{{ route('portal.apply') }}" class="prt-btn" style="font-size:12px; padding:8px 16px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                New Application
            </a>
            <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                @csrf
                <button type="submit" class="adm-logout-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                    </svg>
                    Log out
                </button>
            </form>
        </div>
    </div>

    <!-- Page content -->
    <div class="adm-content">
        @yield('content')
    </div>
</div>

</body>
</html>
