<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Administration') — ISCME 2027</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/scss/app.scss', 'resources/js/admin.js'])
    <style>
        :root { --admin-navy:#071e3d; --admin-blue:#1769aa; --admin-soft:#edf4fa; --admin-ink:#172b4d; --admin-muted:#6b7a90; }
        body.admin-body { background:#f5f7fb; color:var(--admin-ink); font-family:Inter,system-ui,sans-serif; }
        .admin-shell { min-height:100vh; display:flex; }
        .admin-sidebar { width:264px; flex:0 0 264px; background:linear-gradient(180deg,#071e3d 0%,#0a315d 100%); color:#fff; padding:22px 14px; display:flex; flex-direction:column; position:sticky; top:0; height:100vh; }
        .admin-brand { display:flex; gap:11px; align-items:center; color:#fff!important; text-decoration:none!important; padding:4px 10px 26px; }
        .admin-brand-mark { width:34px;height:34px;border-radius:10px;display:grid;place-items:center;background:linear-gradient(135deg,#46a4e9,#1a5a9b);font-weight:800;box-shadow:0 8px 18px rgba(0,0,0,.22); }
        .admin-brand span { font-weight:800;letter-spacing:-.02em;font-size:1.1rem; }
        .admin-section-label { color:#8fabca;font-size:.68rem;font-weight:800;letter-spacing:.12em;text-transform:uppercase;padding:0 12px;margin:16px 0 7px; }
        .admin-body .admin-nav-link { color:#bdd0e4!important; display:flex;align-items:center;gap:12px;border-radius:9px;padding:11px 12px;margin:3px 0;text-decoration:none!important;font-size:.91rem;font-weight:600;transition:.2s ease; }
        .admin-body .admin-nav-link i { width:18px;font-size:1rem;text-align:center; }
        .admin-body .admin-nav-link:hover { color:#fff!important;background:rgba(255,255,255,.09);transform:none; }
        .admin-body .admin-nav-link.active { color:#fff!important;background:linear-gradient(90deg,rgba(47,143,213,.48),rgba(47,143,213,.18));box-shadow:inset 3px 0 0 #64b5f6; }
        .admin-sidebar-footer { margin-top:auto; border-top:1px solid rgba(255,255,255,.1);padding:18px 8px 2px; }
        .admin-user-toggle { color:#fff!important;text-decoration:none!important;display:flex;align-items:center;gap:10px; }
        .admin-avatar { width:34px;height:34px;border-radius:50%;display:grid;place-items:center;background:#2c6698;color:#fff;font-size:.82rem;font-weight:800; }
        .admin-role { display:block;font-size:.68rem;color:#9bb6ce;text-transform:capitalize;margin-top:1px; }
        .admin-main { width:calc(100% - 264px);min-width:0; }
        .admin-topbar { height:76px;background:#fff;border-bottom:1px solid #e8edf3;display:flex;align-items:center;justify-content:space-between;padding:0 34px; }
        .admin-topbar-title { font-size:.85rem;color:var(--admin-muted);margin:0; }
        .admin-content { padding:34px;max-width:1600px;margin:0 auto; }
        .admin-btn { border-radius:9px;font-weight:700;padding:.62rem 1rem;box-shadow:0 5px 14px rgba(0,61,108,.14); }
        .admin-page-title { font-size:1.7rem;letter-spacing:-.035em;font-weight:800;color:var(--admin-ink);margin:0; }
        .admin-subtitle { color:var(--admin-muted);font-size:.92rem;margin:.35rem 0 0; }
        .admin-card { border:1px solid #e6ecf2;border-radius:14px;box-shadow:0 8px 24px rgba(16,42,67,.055);background:#fff;overflow:hidden; }
        .admin-card-header { padding:18px 20px;border-bottom:1px solid #edf0f4;display:flex;align-items:center;justify-content:space-between;gap:15px; }
        .admin-table { margin:0; }
        .admin-table thead th { color:#748196;background:#fafbfd;font-size:.7rem;font-weight:800;letter-spacing:.07em;text-transform:uppercase;border-bottom:1px solid #e9edf2;padding:13px 20px;white-space:nowrap; }
        .admin-table tbody td { padding:16px 20px;border-color:#edf0f4;vertical-align:middle; }
        .admin-table tbody tr:hover { background:#fbfdff; }
        .admin-status { border-radius:999px;padding:.4rem .66rem;font-size:.72rem;font-weight:800;display:inline-flex;align-items:center;gap:.35rem; }
        .admin-status.live { color:#13795b;background:#dcf7eb; }.admin-status.draft { color:#7a5c12;background:#fff3cd; }
        .admin-icon-button { width:34px;height:34px;display:inline-grid;place-items:center;border:1px solid #e4e9ef;border-radius:8px;background:#fff;color:#52657d;text-decoration:none!important; }
        .admin-icon-button:hover { color:#0b5d9a;border-color:#a7cce8;background:#f1f8fd; }
        .admin-search { max-width:300px;position:relative; }.admin-search i { position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#8d9bab; }.admin-search input { padding-left:34px;border-radius:8px;border-color:#e1e7ee;font-size:.86rem; }
        @media (max-width: 991px) { .admin-sidebar { position:fixed;z-index:1045;transform:translateX(-100%);transition:transform .22s;width:264px; }.admin-sidebar.is-open{transform:translateX(0)}.admin-main{width:100%}.admin-topbar{padding:0 18px}.admin-content{padding:24px 18px}.admin-sidebar-backdrop{display:none;position:fixed;inset:0;background:rgba(7,30,61,.42);z-index:1040}.admin-sidebar-backdrop.is-open{display:block}.admin-desktop-only{display:none!important;} }
    </style>
</head>
<body class="admin-body">
    <div class="admin-sidebar-backdrop" data-admin-sidebar-backdrop></div>
    <div class="admin-shell">
        <aside class="admin-sidebar" data-admin-sidebar>
            <a href="{{ route('admin.dashboard') }}" class="admin-brand"><span class="admin-brand-mark">I</span><span>ISCME Admin</span></a>
            <nav>
                <div class="admin-section-label">Overview</div>
                <a href="{{ route('admin.dashboard') }}" class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="bi bi-grid-1x2"></i>Dashboard</a>
                <div class="admin-section-label">Website</div>
                <a href="{{ route('admin.pages.index') }}" class="admin-nav-link {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}"><i class="bi bi-window-stack"></i>Pages</a>
                <div class="admin-section-label">Conference content</div>
                <a href="{{ route('admin.speakers.index') }}" class="admin-nav-link {{ request()->routeIs('admin.speakers.*') ? 'active' : '' }}"><i class="bi bi-mic"></i>Speakers</a>
                <a href="{{ route('admin.sponsors.index') }}" class="admin-nav-link {{ request()->routeIs('admin.sponsors.*') ? 'active' : '' }}"><i class="bi bi-stars"></i>Sponsors & Partners</a>
                <a href="{{ route('admin.faqs.index') }}" class="admin-nav-link {{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}"><i class="bi bi-patch-question"></i>FAQs</a>
            </nav>
            <div class="admin-sidebar-footer dropdown">
                <a href="#" class="admin-user-toggle dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><span class="admin-avatar">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</span><span class="text-truncate"><strong class="d-block small">{{ auth()->user()->name }}</strong><span class="admin-role">{{ str_replace('_',' ',auth()->user()->role) }}</span></span></a>
                <ul class="dropdown-menu dropdown-menu-dark shadow"><li><form method="POST" action="{{ route('admin.logout') }}">@csrf<button type="submit" class="dropdown-item">Sign out</button></form></li></ul>
            </div>
        </aside>
        <main class="admin-main">
            <header class="admin-topbar"><div class="d-flex align-items-center gap-3"><button type="button" class="btn btn-light d-lg-none" data-admin-sidebar-toggle aria-label="Open navigation"><i class="bi bi-list"></i></button><p class="admin-topbar-title admin-desktop-only">Conference management workspace</p></div><div class="d-flex align-items-center gap-3"><a href="/" target="_blank" class="btn btn-outline-primary btn-sm rounded-3"><i class="bi bi-box-arrow-up-right me-1"></i>View website</a></div></header>
            <div class="admin-content">@yield('content')</div>
        </main>
    </div>
</body>
</html>
