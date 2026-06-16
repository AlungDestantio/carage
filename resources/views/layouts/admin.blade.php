<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — Carage Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,700;12..96,800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* ── TOKENS ─────────────────────────────────────────── */
        :root {
            --blue-50:#EFF6FF;--blue-100:#DBEAFE;--blue-200:#BFDBFE;
            --blue-400:#60A5FA;--blue-500:#3B82F6;--blue-600:#2563EB;
            --blue-700:#1D4ED8;--blue-800:#1E40AF;--blue-900:#1E3A8A;
            --slate-50:#F8FAFC;--slate-100:#F1F5F9;--slate-200:#E2E8F0;
            --slate-300:#CBD5E1;--slate-400:#94A3B8;--slate-500:#64748B;
            --slate-600:#475569;--slate-700:#334155;--slate-900:#0F172A;
            --bg-page:#F0F4FF;--accent:#F97316;
            --font-display:'Bricolage Grotesque',sans-serif;
            --font-body:'Plus Jakarta Sans',sans-serif;
            --radius-sm:8px;--radius-md:10px;--radius-lg:14px;--radius-xl:18px;
            --sidebar-w:240px;
        }
        *,*::before,*::after { box-sizing:border-box; }
        body {
            font-family: var(--font-body);
            background: var(--bg-page);
            color: var(--slate-900);
            -webkit-font-smoothing: antialiased;
            margin: 0;
        }

        /* ══════════════════════════════════════════════════════
           SIDEBAR
        ══════════════════════════════════════════════════════ */
        .admin-sidebar {
            background: #fff;
            width: var(--sidebar-w);
            position: fixed; left: 0; top: 0; bottom: 0;
            z-index: 200;
            display: flex; flex-direction: column;
            border-right: 1px solid var(--slate-200);
        }

        /* ── Brand ── */
        .sidebar-brand {
            padding: 22px 20px 18px;
            flex-shrink: 0;
        }
        .sidebar-brand a { text-decoration: none; display: flex; align-items: center; gap: 10px; }
        .brand-icon {
            width: 34px; height: 34px;
            background: var(--blue-600);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .brand-icon i { color: white; font-size: 1rem; }
        .brand-text {}
        .brand-name {
            font-family: var(--font-display);
            font-weight: 800; font-size: 1.1rem;
            color: var(--slate-900); letter-spacing: -0.5px; line-height: 1;
        }
        .brand-name span { color: var(--blue-600); }
        .brand-sub {
            display: block; font-size: .58rem; color: var(--slate-400);
            font-weight: 700; text-transform: uppercase; letter-spacing: 2px; margin-top: 2px;
        }

        /* ── Nav ── */
        .sidebar-nav {
            flex: 1; overflow-y: auto; padding: 4px 12px 12px;
        }
        .sidebar-nav::-webkit-scrollbar { width: 0; }

        .nav-section {
            font-size: .58rem; font-weight: 700; text-transform: uppercase;
            letter-spacing: 1.8px; color: var(--slate-400);
            padding: 16px 8px 6px;
        }

        .sidebar-nav-item a {
            display: flex; align-items: center; gap: 9px;
            padding: 9px 12px;
            margin-bottom: 2px;
            color: var(--slate-600); text-decoration: none;
            font-weight: 600; font-size: .82rem;
            border-radius: var(--radius-md);
            transition: all .15s;
        }
        .sidebar-nav-item a:hover {
            background: var(--slate-100);
            color: var(--slate-900);
        }

        /* ✦ ACTIVE — filled blue button style */
        .sidebar-nav-item a.active {
            background: var(--blue-600);
            color: #fff;
            font-weight: 700;
            box-shadow: 0 2px 10px rgba(37,99,235,0.25);
        }
        .sidebar-nav-item a.active i {
            color: rgba(255,255,255,0.9);
        }

        .sidebar-nav-item a i {
            font-size: .9rem; width: 16px; text-align: center;
            flex-shrink: 0; color: var(--slate-400);
            transition: color .15s;
        }
        .sidebar-nav-item a:hover i { color: var(--slate-600); }

        /* nav badge */
        .nav-badge {
            margin-left: auto;
            background: rgba(255,255,255,0.25);
            color: #fff;
            font-size: .58rem; font-weight: 800;
            padding: 2px 7px; border-radius: 100px;
        }
        .sidebar-nav-item a:not(.active) .nav-badge {
            background: var(--blue-100);
            color: var(--blue-700);
        }

        /* ── Sidebar footer ── */
        .sidebar-footer {
            flex-shrink: 0;
            padding: 12px;
            border-top: 1px solid var(--slate-100);
        }

        /* User row inside footer */
        .sidebar-user {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 12px;
            border-radius: var(--radius-lg);
            background: var(--slate-50);
            margin-bottom: 8px;
        }
        .sidebar-avatar {
            width: 32px; height: 32px; border-radius: 50%;
            background: var(--blue-600); color: white;
            font-family: var(--font-display); font-weight: 800;
            font-size: .8rem; display: flex; align-items: center;
            justify-content: center; flex-shrink: 0;
        }
        .sidebar-user-name {
            font-weight: 700; font-size: .78rem; color: var(--slate-800);
            line-height: 1.2;
        }
        .sidebar-user-role {
            font-size: .58rem; color: var(--slate-400);
            font-weight: 600; letter-spacing: .5px;
        }

        .btn-logout {
            width: 100%; background: transparent;
            border: 1px solid var(--slate-200);
            color: var(--slate-500); border-radius: var(--radius-md);
            padding: 8px 14px; font-weight: 600; font-size: .78rem;
            cursor: pointer; font-family: var(--font-body);
            display: flex; align-items: center; justify-content: center; gap: 7px;
            transition: all .15s;
        }
        .btn-logout:hover {
            background: #FEF2F2;
            color: #DC2626; border-color: #FECACA;
        }

        /* ══════════════════════════════════════════════════════
           MAIN CONTENT
        ══════════════════════════════════════════════════════ */
        .admin-content {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            background: var(--bg-page);
            display: flex; flex-direction: column;
        }

        /* ── Topbar ── */
        .admin-topbar {
            background: white;
            border-bottom: 1px solid var(--slate-200);
            padding: 0 24px;
            height: 56px;
            display: flex; justify-content: space-between; align-items: center;
            position: sticky; top: 0; z-index: 100;
        }

        /* Left: breadcrumb */
        .topbar-breadcrumb {
            display: flex; align-items: center; gap: 6px;
            font-size: .78rem; color: var(--slate-400); font-weight: 600;
        }
        .topbar-breadcrumb .bc-sep { color: var(--slate-300); font-size: .7rem; }
        .topbar-breadcrumb .bc-current { color: var(--slate-700); font-weight: 700; }

        /* Right actions */
        .topbar-right { display: flex; align-items: center; gap: 8px; }

        /* session toasts */
        .topbar-toast {
            display: flex; align-items: center; gap: 6px;
            padding: 5px 12px; border-radius: var(--radius-md);
            font-size: .73rem; font-weight: 700;
            animation: fadeUp .3s ease both;
        }
        .topbar-toast.success { background: #D1FAE5; color: #065F46; }
        .topbar-toast.error   { background: #FEE2E2; color: #991B1B; }

        /* icon buttons */
        .topbar-icon-btn {
            width: 32px; height: 32px;
            border-radius: var(--radius-md);
            border: 1px solid var(--slate-200);
            background: white; color: var(--slate-500);
            display: flex; align-items: center; justify-content: center;
            font-size: .88rem; text-decoration: none;
            transition: all .15s; cursor: pointer;
            position: relative;
        }
        .topbar-icon-btn:hover {
            background: var(--slate-50); color: var(--slate-900);
            border-color: var(--slate-300);
        }

        /* notification dot */
        .notif-dot {
            position: absolute; top: 5px; right: 5px;
            width: 6px; height: 6px; border-radius: 50%;
            background: var(--accent); border: 1.5px solid white;
        }

        /* divider */
        .topbar-divider {
            width: 1px; height: 20px;
            background: var(--slate-200);
        }

        /* ── Avatar only user chip ── */
        .topbar-avatar {
            width: 32px; height: 32px; border-radius: 50%;
            background: var(--blue-600); color: white;
            font-family: var(--font-display); font-weight: 800;
            font-size: .82rem; display: flex; align-items: center;
            justify-content: center; cursor: pointer;
            transition: box-shadow .15s;
        }
        .topbar-avatar:hover {
            box-shadow: 0 0 0 3px var(--blue-100);
        }

        /* ── Page content ── */
        .admin-page-content { padding: 24px; flex: 1; }

        /* ══════════════════════════════════════════════════════
           REUSABLE COMPONENTS
        ══════════════════════════════════════════════════════ */

        /* CARDS */
        .admin-card { background:white; border-radius:var(--radius-xl); border:1.5px solid var(--slate-200); overflow:hidden; }
        .admin-card-header { padding:13px 18px; border-bottom:1px solid var(--slate-100); display:flex; justify-content:space-between; align-items:center; }
        .admin-card-header .card-title { font-size:.72rem; font-weight:800; text-transform:uppercase; letter-spacing:.5px; color:var(--slate-700); }
        .admin-card-body { padding:18px; }

        /* STAT CARDS */
        .stat-card { background:white; border-radius:var(--radius-xl); border:1.5px solid var(--slate-200); padding:18px 20px; display:flex; align-items:center; gap:14px; transition:box-shadow .2s, border-color .2s; }
        .stat-card:hover { box-shadow:0 6px 20px rgba(37,99,235,0.09); border-color:var(--blue-200); }
        .stat-icon { width:48px; height:48px; border-radius:var(--radius-lg); display:flex; align-items:center; justify-content:center; font-size:1.2rem; flex-shrink:0; }
        .stat-value { font-family:var(--font-display); font-weight:800; font-size:1.75rem; letter-spacing:-1px; color:var(--slate-900); line-height:1; }
        .stat-label { font-size:.66rem; font-weight:700; color:var(--slate-400); text-transform:uppercase; letter-spacing:.5px; margin-top:3px; }
        .stat-trend { font-size:.72rem; font-weight:700; display:flex; align-items:center; gap:3px; margin-top:4px; }
        .stat-trend.up { color:#059669; }
        .stat-trend.down { color:#DC2626; }

        /* TABLE */
        .table-carage thead th { background:var(--slate-50); color:var(--slate-500); font-size:.68rem; font-weight:700; text-transform:uppercase; letter-spacing:.5px; border:none; border-bottom:1.5px solid var(--slate-200); padding:11px 16px; }
        .table-carage tbody td { padding:12px 16px; vertical-align:middle; border-color:var(--slate-100); font-size:.85rem; }
        .table-carage tbody tr:hover td { background:var(--slate-50); }

        /* FORMS */
        .form-control,.form-select { border:1.5px solid var(--slate-200); border-radius:var(--radius-md); font-size:.875rem; padding:9px 14px; font-family:var(--font-body); background:white; color:var(--slate-900); transition:border-color .2s,box-shadow .2s; }
        .form-control:focus,.form-select:focus { border-color:var(--blue-400); box-shadow:0 0 0 3px rgba(59,130,246,0.12); outline:none; }
        .form-label { font-weight:700; font-size:.78rem; color:var(--slate-700); margin-bottom:6px; }

        /* BUTTONS */
        .btn-carage { background:var(--blue-600); color:white; border:none; font-weight:700; border-radius:var(--radius-md); padding:9px 20px; font-size:.82rem; font-family:var(--font-body); transition:background .15s,transform .15s; cursor:pointer; display:inline-flex; align-items:center; gap:6px; }
        .btn-carage:hover { background:var(--blue-700); color:white; transform:translateY(-1px); }
        .btn-carage-sm { padding:6px 14px; font-size:.75rem; }
        .btn-ghost { border:1.5px solid var(--slate-200); color:var(--slate-600); background:white; font-weight:600; border-radius:var(--radius-md); padding:5px 16px; font-size:.82rem; font-family:var(--font-body); transition:all .15s; cursor:pointer; text-decoration:none; display:inline-flex; align-items:center; gap:6px; }
        .btn-ghost:hover { border-color:var(--slate-300); background:var(--slate-50); color:var(--slate-900); }
        .btn-danger-sm { background:#FEF2F2; color:#DC2626; border:1px solid #FECACA; padding:5px 12px; border-radius:6px; font-weight:700; font-size:.75rem; cursor:pointer; font-family:var(--font-body); transition:background .15s; text-decoration:none; display:inline-flex; align-items:center; gap:4px; }
        .btn-danger-sm:hover { background:#FEE2E2; color:#991B1B; }
        .btn-info-sm { background:var(--blue-50); color:var(--blue-700); border:1px solid var(--blue-100); padding:5px 12px; border-radius:6px; font-weight:700; font-size:.75rem; cursor:pointer; font-family:var(--font-body); transition:background .15s; text-decoration:none; display:inline-flex; align-items:center; gap:4px; }
        .btn-info-sm:hover { background:var(--blue-100); }
        .btn-success-sm { background:#D1FAE5; color:#065F46; border:1px solid #A7F3D0; padding:5px 12px; border-radius:6px; font-weight:700; font-size:.75rem; cursor:pointer; font-family:var(--font-body); transition:background .15s; text-decoration:none; display:inline-flex; align-items:center; gap:4px; }
        .btn-success-sm:hover { background:#A7F3D0; }

        /* STATUS BADGES */
        .status-badge { padding:3px 10px; border-radius:6px; font-size:.68rem; font-weight:800; text-transform:uppercase; letter-spacing:.5px; display:inline-block; }
        .status-pending    { background:#FEF3C7; color:#92400E; }
        .status-processing { background:var(--blue-50); color:var(--blue-700); }
        .status-shipped    { background:#EDE9FE; color:#5B21B6; }
        .status-delivered  { background:#D1FAE5; color:#065F46; }
        .status-cancelled  { background:#FEE2E2; color:#991B1B; }

        /* ALERTS */
        .alert { border-radius:var(--radius-md); border:none; font-weight:600; font-size:.875rem; }
        .alert-success { background:#D1FAE5; color:#065F46; }
        .alert-danger  { background:#FEE2E2; color:#991B1B; }
        .alert-warning { background:#FEF3C7; color:#92400E; }
        .alert-info    { background:var(--blue-50); color:var(--blue-700); }

        /* PAGINATION */
        .page-link { border-radius:var(--radius-sm)!important; border-color:var(--slate-200); color:var(--slate-600); font-size:.82rem; font-weight:600; }
        .page-item.active .page-link { background:var(--blue-600); border-color:var(--blue-600); }

        /* ANIMATION */
        @keyframes fadeUp {
            from { opacity:0; transform:translateY(8px); }
            to   { opacity:1; transform:translateY(0); }
        }

        /* ── RESPONSIVE ── */
        @media (max-width:991px) {
            .admin-sidebar { transform:translateX(-100%); transition:transform .25s; }
            .admin-sidebar.open { transform:translateX(0); }
            .admin-content { margin-left:0; }
            .sidebar-toggle { display:flex !important; }
        }
        .sidebar-toggle { display:none; }

        /* Sidebar overlay on mobile */
        .sidebar-overlay {
            display:none; position:fixed; inset:0; background:rgba(0,0,0,.3);
            z-index:199; backdrop-filter:blur(2px);
        }
        .sidebar-overlay.show { display:block; }
    </style>
    @stack('styles')
</head>
<body>

{{-- Mobile overlay --}}
<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

{{-- ══ SIDEBAR ══ --}}
<aside class="admin-sidebar" id="adminSidebar">

    {{-- Brand --}}
    <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}">
            <div class="brand-icon">
                <i class="bi bi-car-front-fill"></i>
            </div>
            <div class="brand-text">
                <div class="brand-name">CAR<span>AGE</span></div>
                <span class="brand-sub">Admin Panel</span>
            </div>
        </a>
    </div>

    {{-- Navigation --}}
    <nav class="sidebar-nav">

        <div class="nav-section">Overview</div>
        <div class="sidebar-nav-item">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </div>

        <div class="nav-section">Toko</div>
        <div class="sidebar-nav-item">
            <a href="{{ route('admin.produk.index') }}" class="{{ request()->routeIs('admin.produk.*') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i> Kelola Produk
            </a>
        </div>
        <div class="sidebar-nav-item">
            <a href="{{ route('admin.transaksi.index') }}" class="{{ request()->routeIs('admin.transaksi.*') ? 'active' : '' }}">
                <i class="bi bi-receipt"></i> Kelola Transaksi
            </a>
        </div>

        <div class="nav-section">Konten</div>
        <div class="sidebar-nav-item">
            <a href="{{ route('admin.artikel.index') }}" class="{{ request()->routeIs('admin.artikel.*') ? 'active' : '' }}">
                <i class="bi bi-newspaper"></i> Kelola Artikel
            </a>
        </div>

        <div class="nav-section">Pengguna</div>
        <div class="sidebar-nav-item">
            <a href="{{ route('admin.pengguna.index') }}" class="{{ request()->routeIs('admin.pengguna.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Kelola Pengguna
            </a>
        </div>

        <div class="nav-section">Sistem</div>
        <div class="sidebar-nav-item">
            <a href="{{ route('home') }}" target="_blank">
                <i class="bi bi-shop"></i> Lihat Toko
                <i class="bi bi-arrow-up-right ms-auto" style="font-size:.65rem;opacity:.5;width:auto;"></i>
            </a>
        </div>

    </nav>

    {{-- Footer --}}
    <div class="sidebar-footer">
        {{-- User row --}}
        <div class="sidebar-user">
            <div class="sidebar-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div>
                <div class="sidebar-user-name">{{ Str::limit(auth()->user()->name, 16) }}</div>
                <div class="sidebar-user-role">Administrator</div>
            </div>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="bi bi-box-arrow-right"></i> Keluar dari Akun
            </button>
        </form>
    </div>
</aside>

{{-- ══ MAIN CONTENT ══ --}}
<div class="admin-content">

    {{-- Topbar --}}
    <div class="admin-topbar">

        {{-- Left: mobile toggle + breadcrumb --}}
        <div class="topbar-breadcrumb">
            {{-- Mobile toggle --}}
            <button class="topbar-icon-btn sidebar-toggle border-0 me-1" onclick="openSidebar()" style="display:none;">
                <i class="bi bi-list"></i>
            </button>

            <i class="bi bi-house" style="font-size:.8rem;"></i>
            <span class="bc-sep"><i class="bi bi-chevron-right" style="font-size:.6rem;"></i></span>
            @if($__env->hasSection('breadcrumb'))
                @yield('breadcrumb')
            @else
                <span class="bc-current">@yield('page-title', 'Dashboard')</span>
            @endif
        </div>

        {{-- Right actions --}}
        <div class="topbar-right">

            {{-- Session toasts --}}
            @if(session('success'))
            <div class="topbar-toast success">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            </div>
            @endif
            @if(session('error'))
            <div class="topbar-toast error">
                <i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}
            </div>
            @endif

            {{-- View store --}}
            <a href="{{ route('home') }}" target="_blank" class="topbar-icon-btn text-decoration-none" title="Lihat Toko">
                <i class="bi bi-shop"></i>
            </a>

            {{-- Notifications --}}
            <button class="topbar-icon-btn" title="Notifikasi">
                <i class="bi bi-bell"></i>
                <span class="notif-dot"></span>
            </button>

            <div class="topbar-divider"></div>

            {{-- Avatar only --}}
            <div class="topbar-avatar" title="{{ auth()->user()->name }}">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
        </div>
    </div>

    {{-- Page Content --}}
    <div class="admin-page-content">
        @yield('content')
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
function openSidebar() {
    document.getElementById('adminSidebar').classList.add('open');
    document.getElementById('sidebarOverlay').classList.add('show');
}
function closeSidebar() {
    document.getElementById('adminSidebar').classList.remove('open');
    document.getElementById('sidebarOverlay').classList.remove('show');
}

// Auto-hide topbar toasts
document.querySelectorAll('.topbar-toast').forEach(el => {
    setTimeout(() => {
        el.style.transition = 'opacity .4s';
        el.style.opacity = '0';
        setTimeout(() => el.remove(), 400);
    }, 4000);
});
</script>
@stack('scripts')
</body>
</html>