<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — ITEA EduAbroad</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Geist:wght@300;400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { box-sizing: border-box; }
        body { margin:0; display:flex; min-height:100vh; background:#f0ede8; font-family:'Geist',sans-serif; }

        /* ── Sidebar ── */
        .adm-sidebar {
            width:240px; min-height:100vh; background:var(--ink-deep);
            display:flex; flex-direction:column; flex-shrink:0; position:fixed; top:0; left:0; bottom:0; z-index:10;
        }
        .adm-sidebar-brand {
            padding:24px 20px 20px; border-bottom:1px solid rgba(255,255,255,0.07);
        }
        .adm-sidebar-brand .eyebrow { font-family:'JetBrains Mono',monospace; font-size:9px; letter-spacing:0.15em; text-transform:uppercase; color:rgba(255,255,255,0.35); display:block; margin-bottom:4px; }
        .adm-sidebar-brand .logo-text { font-family:'Instrument Serif',serif; font-size:20px; color:#fff; font-weight:400; line-height:1.1; }
        .adm-sidebar-brand .logo-text em { color:var(--accent); font-style:italic; }

        .adm-nav { flex:1; padding:16px 0; overflow-y:auto; }
        .adm-nav-section { font-family:'JetBrains Mono',monospace; font-size:8.5px; letter-spacing:0.15em; text-transform:uppercase; color:rgba(255,255,255,0.2); padding:16px 20px 6px; }
        .adm-nav a {
            display:flex; align-items:center; gap:10px; padding:9px 20px;
            font-family:'JetBrains Mono',monospace; font-size:10.5px; letter-spacing:0.07em; text-transform:uppercase;
            color:rgba(255,255,255,0.5); text-decoration:none; transition:all 0.15s;
            border-left:2px solid transparent; position:relative;
        }
        .adm-nav a:hover { color:rgba(255,255,255,0.85); background:rgba(255,255,255,0.04); }
        .adm-nav a.active { color:#fff; background:rgba(255,255,255,0.07); border-left-color:var(--accent); }
        .adm-nav a .nav-icon { width:16px; text-align:center; flex-shrink:0; font-size:13px; }
        .adm-nav a .nav-badge { margin-left:auto; background:var(--accent); color:#fff; font-size:8px; padding:2px 6px; border-radius:999px; font-family:'JetBrains Mono',monospace; letter-spacing:0.05em; }

        .adm-sidebar-footer {
            padding:16px 20px; border-top:1px solid rgba(255,255,255,0.07);
            display:flex; align-items:center; gap:10px;
        }
        .adm-sidebar-footer .avatar {
            width:32px; height:32px; background:var(--accent); border-radius:50%;
            display:flex; align-items:center; justify-content:center;
            font-family:'Instrument Serif',serif; font-size:14px; color:#fff; flex-shrink:0;
        }
        .adm-sidebar-footer .user-info { flex:1; min-width:0; }
        .adm-sidebar-footer .user-name { font-size:12px; color:#fff; font-weight:500; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
        .adm-sidebar-footer .user-role { font-family:'JetBrains Mono',monospace; font-size:9px; letter-spacing:0.08em; text-transform:uppercase; color:rgba(255,255,255,0.35); }

        /* ── Main area ── */
        .adm-main { flex:1; margin-left:240px; display:flex; flex-direction:column; min-height:100vh; }

        /* ── Topbar ── */
        .adm-topbar {
            background:#fff; border-bottom:1px solid rgba(0,0,0,0.08);
            padding:0 32px; height:60px; display:flex; align-items:center; justify-content:space-between;
            position:sticky; top:0; z-index:5;
        }
        .adm-topbar-left { display:flex; align-items:center; gap:12px; }
        .adm-topbar-breadcrumb { display:flex; align-items:center; gap:8px; font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.08em; text-transform:uppercase; color:var(--muted); }
        .adm-topbar-breadcrumb a { color:var(--muted); text-decoration:none; }
        .adm-topbar-breadcrumb a:hover { color:var(--accent); }
        .adm-topbar-breadcrumb span.current { color:var(--ink); }
        .adm-topbar h1 { font-family:'Instrument Serif',serif; font-size:20px; font-weight:400; color:var(--ink); margin:0; }

        .adm-topbar-actions { display:flex; align-items:center; gap:12px; }
        .adm-topbar-actions form button {
            background:none; border:1px solid var(--rule-soft); padding:6px 14px;
            font-family:'JetBrains Mono',monospace; font-size:10px; letter-spacing:0.08em; text-transform:uppercase;
            color:var(--muted); cursor:pointer; transition:all 0.15s;
        }
        .adm-topbar-actions form button:hover { border-color:var(--ink); color:var(--ink); }

        /* ── Content ── */
        .adm-content { padding:28px 32px; flex:1; }

        /* ── Stat cards ── */
        .stat-grid { display:grid; gap:2px; margin-bottom:24px; }
        .stat-card {
            background:#fff; padding:24px 28px; position:relative; overflow:hidden;
            border:1px solid rgba(0,0,0,0.06);
        }
        .stat-card::before { content:''; position:absolute; top:0; left:0; right:0; height:3px; background:var(--accent); }
        .stat-card.blue::before   { background:#2563eb; }
        .stat-card.amber::before  { background:#d97706; }
        .stat-card.green::before  { background:#16a34a; }
        .stat-card.red::before    { background:#dc2626; }
        .stat-card.purple::before { background:#7c3aed; }
        .stat-card .val { font-family:'Instrument Serif',serif; font-size:42px; color:var(--ink); line-height:1; margin-bottom:6px; }
        .stat-card .lbl { font-family:'JetBrains Mono',monospace; font-size:9.5px; letter-spacing:0.12em; text-transform:uppercase; color:var(--muted); }
        .stat-card .icon { position:absolute; top:20px; right:20px; font-size:22px; opacity:0.15; }

        /* ── Table ── */
        .adm-table-wrap { background:#fff; border:1px solid rgba(0,0,0,0.06); overflow:hidden; }
        .adm-table-header { display:flex; justify-content:space-between; align-items:center; padding:16px 20px; border-bottom:1px solid var(--rule-soft); }
        .adm-table-header h2 { font-family:'JetBrains Mono',monospace; font-size:11px; letter-spacing:0.1em; text-transform:uppercase; color:var(--ink); margin:0; }
        table { width:100%; border-collapse:collapse; }
        thead tr { background:var(--ink-deep); }
        th { font-family:'JetBrains Mono',monospace; font-size:9.5px; letter-spacing:0.1em; text-transform:uppercase; color:rgba(255,255,255,0.6); padding:11px 16px; border-bottom:none; text-align:left; white-space:nowrap; }
        td { padding:13px 16px; border-bottom:1px solid var(--rule-soft); font-size:13px; color:var(--ink); vertical-align:middle; }
        tbody tr:last-child td { border-bottom:none; }
        tbody tr:hover td { background:#fafafa; }

        /* ── Badges ── */
        .badge { display:inline-flex; align-items:center; gap:5px; padding:3px 10px; border-radius:999px; font-family:'JetBrains Mono',monospace; font-size:9px; letter-spacing:0.08em; text-transform:uppercase; font-weight:500; }
        .badge::before { content:''; width:5px; height:5px; border-radius:50%; background:currentColor; flex-shrink:0; }
        .badge-draft     { background:#f3f4f6; color:#6b7280; }
        .badge-submitted { background:#dbeafe; color:#1d4ed8; }
        .badge-reviewing { background:#fef3c7; color:#92400e; }
        .badge-accepted  { background:#d1fae5; color:#065f46; }
        .badge-rejected  { background:#fee2e2; color:#991b1b; }
        .badge-result    { background:#ede9fe; color:#5b21b6; }
        .badge-active    { background:#d1fae5; color:#065f46; }
        .badge-inactive  { background:#f3f4f6; color:#6b7280; }

        /* ── Form ── */
        .adm-card { background:#fff; border:1px solid rgba(0,0,0,0.06); padding:24px; }
        .adm-form-group { margin-bottom:18px; }
        .adm-form-group label { display:block; font-family:'JetBrains Mono',monospace; font-size:9.5px; letter-spacing:0.1em; text-transform:uppercase; color:var(--muted); margin-bottom:7px; }
        .adm-form-group input,
        .adm-form-group select,
        .adm-form-group textarea {
            width:100%; padding:10px 13px; border:1px solid var(--rule-soft);
            background:#fff; color:var(--ink); font-size:14px; font-family:'Geist',sans-serif;
            outline:none; transition:border-color 0.15s;
        }
        .adm-form-group input:focus,
        .adm-form-group select:focus,
        .adm-form-group textarea:focus { border-color:var(--ink); }

        /* ── Alert ── */
        .adm-alert-success { background:#f0fdf4; border:1px solid #86efac; padding:12px 16px; margin-bottom:20px; font-size:13px; color:#166534; }
        .adm-alert-error   { background:#fff0f0; border:1px solid #fca5a5; padding:12px 16px; margin-bottom:20px; font-size:13px; color:#b91c1c; }

        /* ── Action link ── */
        .adm-link { font-size:12px; color:var(--accent); text-decoration:none; font-family:'JetBrains Mono',monospace; letter-spacing:0.06em; }
        .adm-link:hover { text-decoration:underline; }
        .adm-link-muted { font-size:12px; color:var(--muted); text-decoration:none; }

        /* Pagination override */
        nav[role="navigation"] { font-size:12px; }
    </style>
</head>
<body>

<!-- Sidebar -->
<aside class="adm-sidebar">
    <div class="adm-sidebar-brand">
        <span class="eyebrow">Admin Portal</span>
        <div class="logo-text">ITEA <em>EduAbroad</em></div>
    </div>

    <nav class="adm-nav">
        <div class="adm-nav-section">Overview</div>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="nav-icon">◈</span> Dashboard
        </a>

        <div class="adm-nav-section">Applications</div>
        <a href="{{ route('admin.applications') }}" class="{{ request()->routeIs('admin.applications*') ? 'active' : '' }}">
            <span class="nav-icon">≡</span> All Applications
        </a>

        <div class="adm-nav-section">Programmes</div>
        <a href="{{ route('admin.programs') }}" class="{{ request()->routeIs('admin.programs') ? 'active' : '' }}">
            <span class="nav-icon">◫</span> Manage Programmes
        </a>
        <a href="{{ route('admin.programs.create') }}" class="{{ request()->routeIs('admin.programs.create') ? 'active' : '' }}">
            <span class="nav-icon">+</span> Add Programme
        </a>

        <div class="adm-nav-section">Website</div>
        <a href="{{ route('home') }}" target="_blank">
            <span class="nav-icon">↗</span> View Website
        </a>
    </nav>

    <div class="adm-sidebar-footer">
        <div class="avatar">{{ strtoupper(substr(Auth::user()->name,0,1)) }}</div>
        <div class="user-info">
            <div class="user-name">{{ Auth::user()->name }}</div>
            <div class="user-role">Administrator</div>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" title="Log out" style="background:none;border:none;color:rgba(255,255,255,0.35);cursor:pointer;font-size:16px;padding:0;line-height:1;">⏻</button>
        </form>
    </div>
</aside>

<!-- Main -->
<div class="adm-main">
    <!-- Topbar -->
    <div class="adm-topbar">
        <div class="adm-topbar-left">
            <div>
                <div class="adm-topbar-breadcrumb">
                    <a href="{{ route('admin.dashboard') }}">Admin</a>
                    @hasSection('breadcrumb')
                    <span>·</span>
                    <span class="current">@yield('breadcrumb')</span>
                    @endif
                </div>
                <h1>@yield('title', 'Dashboard')</h1>
            </div>
        </div>
        <div class="adm-topbar-actions">
            @yield('topbar_actions')
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Log out</button>
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
