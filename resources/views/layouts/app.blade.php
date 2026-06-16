<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Carage') — Sparepart Mobil Terpercaya</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- Google Fonts: Bricolage Grotesque + Plus Jakarta Sans --}}
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,700;12..96,800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ── TOKENS ────────────────────────────────────────── */
        :root {
            --blue-50:  #EFF6FF;
            --blue-100: #DBEAFE;
            --blue-200: #BFDBFE;
            --blue-400: #60A5FA;
            --blue-500: #3B82F6;
            --blue-600: #2563EB;
            --blue-700: #1D4ED8;
            --blue-800: #1E40AF;
            --blue-900: #1E3A8A;

            --slate-50:  #F8FAFC;
            --slate-100: #F1F5F9;
            --slate-200: #E2E8F0;
            --slate-300: #CBD5E1;
            --slate-400: #94A3B8;
            --slate-500: #64748B;
            --slate-600: #475569;
            --slate-700: #334155;
            --slate-900: #0F172A;

            --bg-page:  #F0F4FF;
            --white:    #FFFFFF;
            --accent:   #F97316;

            --font-display: 'Bricolage Grotesque', sans-serif;
            --font-body:    'Plus Jakarta Sans', sans-serif;

            --radius-sm: 8px;
            --radius-md: 10px;
            --radius-lg: 14px;
            --radius-xl: 18px;
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: var(--font-body);
            background: var(--bg-page);
            color: var(--slate-900);
            -webkit-font-smoothing: antialiased;
        }

        /* ── NAVBAR ─────────────────────────────────────────── */
        .navbar-carage {
            background: var(--white);
            border-bottom: 1px solid var(--slate-200);
            padding: 0;
        }
        .navbar-carage .container { height: 62px; }
        .navbar-carage .navbar-brand {
            font-family: var(--font-display);
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--slate-900) !important;
            letter-spacing: -1px;
            padding: 0;
            line-height: 1;
        }
        .navbar-carage .navbar-brand span { color: var(--blue-600); }
        .navbar-carage .nav-link {
            color: var(--slate-500) !important;
            font-weight: 600;
            font-size: 0.875rem;
            padding: 7px 14px !important;
            border-radius: var(--radius-sm);
            transition: all .15s;
        }
        .navbar-carage .nav-link:hover {
            color: var(--slate-900) !important;
            background: var(--slate-50);
        }
        .navbar-carage .nav-link.active {
            color: var(--blue-600) !important;
            background: var(--blue-50);
        }

        /* ── AVATAR CIRCLE ───────────────────────────────────── */
        .avatar-circle {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: var(--blue-600);
            color: white;
            font-weight: 700;
            font-size: 0.72rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid var(--blue-100);
            flex-shrink: 0;
            cursor: pointer;
            transition: border-color .15s;
        }
        .avatar-circle:hover { border-color: var(--blue-400); }

        /* ── BUTTONS NAV ────────────────────────────────────── */
        .btn-nav-cart {
            background: var(--blue-600);
            color: white !important;
            border-radius: var(--radius-md);
            padding: 8px 18px !important;
            font-weight: 700;
            font-size: 0.82rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: none;
            transition: background .15s;
            line-height: 1;
            text-decoration: none;
        }
        .btn-nav-cart:hover { background: var(--blue-700); }

        .btn-nav-icon {
            width: 38px;
            height: 38px;
            border: 1px solid var(--slate-200);
            border-radius: var(--radius-md);
            background: var(--white);
            color: var(--slate-600);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            position: relative;
            transition: all .15s;
            text-decoration: none;
        }
        .btn-nav-icon:hover {
            background: var(--slate-50);
            border-color: var(--slate-300);
            color: var(--slate-900);
        }

        .cart-badge {
            background: var(--accent);
            color: white;
            font-size: 0.62rem;
            font-weight: 800;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            top: -4px;
            right: -4px;
            border: 2px solid white;
            line-height: 1;
        }
        /* cart badge inline (desktop label) */
        .cart-badge-inline {
            background: var(--accent);
            color: white;
            font-size: 0.62rem;
            font-weight: 800;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-nav-ghost {
            border: 1px solid var(--slate-200);
            color: var(--slate-700) !important;
            background: var(--white);
            border-radius: var(--radius-md);
            padding: 8px 16px !important;
            font-weight: 600;
            font-size: 0.82rem;
            transition: all .15s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }
        .btn-nav-ghost:hover {
            border-color: var(--slate-300);
            background: var(--slate-50);
        }

        /* ── BUTTONS ─────────────────────────────────────────── */
        .btn-carage {
            background: var(--blue-600);
            color: white;
            border: none;
            font-weight: 700;
            border-radius: var(--radius-md);
            padding: 10px 22px;
            font-size: 0.875rem;
            font-family: var(--font-body);
            transition: background .15s, transform .15s;
            cursor: pointer;
        }
        .btn-carage:hover { background: var(--blue-700); color: white; transform: translateY(-1px); }
        .btn-carage-outline {
            border: 1px solid var(--blue-200);
            color: var(--blue-600);
            background: transparent;
            font-weight: 700;
            border-radius: var(--radius-md);
            padding: 8px 20px;
            font-size: 0.82rem;
            font-family: var(--font-body);
            transition: all .15s;
            cursor: pointer;
        }
        .btn-carage-outline:hover {
            border-color: var(--blue-400);
            background: var(--blue-50);
            color: var(--blue-700);
        }
        .btn-ghost {
            border: 1px solid var(--slate-200);
            color: var(--slate-600);
            background: white;
            font-weight: 600;
            border-radius: var(--radius-md);
            padding: 8px 18px;
            font-size: 0.82rem;
            font-family: var(--font-body);
            transition: all .15s;
            cursor: pointer;
        }
        .btn-ghost:hover { border-color: var(--slate-300); background: var(--slate-50); color: var(--slate-900); }

        /* ── SECTION HEADERS ─────────────────────────────────── */
        .section-eyebrow {
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--blue-600);
            margin-bottom: 6px;
        }
        .section-title {
            font-family: var(--font-display);
            font-weight: 800;
            font-size: 2rem;
            color: var(--slate-900);
            line-height: 1.1;
            letter-spacing: -1px;
            margin: 0;
        }
        .section-title .hl { color: var(--blue-600); }

        /* ── PRODUCT CARD ─────────────────────────────────────── */
        .product-card {
            background: white;
            border-radius: var(--radius-xl);
            overflow: hidden;
            border: 1px solid var(--slate-200);
            transition: transform .2s ease, box-shadow .2s ease, border-color .2s;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 40px rgba(37,99,235,0.10);
            border-color: var(--blue-100);
        }
        .product-card .img-wrap {
            background: var(--slate-100);
            height: 190px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }
        .product-card .img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform .3s ease; }
        .product-card:hover .img-wrap img { transform: scale(1.04); }
        .product-card .img-placeholder { font-size: 3rem; color: var(--slate-300); }
        .product-card .badge-featured {
            position: absolute;
            top: 10px; left: 10px;
            background: var(--blue-600);
            color: white;
            font-size: 0.65rem;
            font-weight: 800;
            padding: 3px 9px;
            border-radius: 5px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .product-card .card-body { padding: 14px 16px; }
        .product-card .brand-tag {
            font-size: 0.68rem;
            font-weight: 700;
            color: var(--slate-400);
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .product-card h6 {
            font-weight: 700;
            font-size: 0.9rem;
            line-height: 1.4;
            color: var(--slate-900);
            margin: 5px 0 6px;
        }
        .product-card .price {
            font-family: var(--font-display);
            font-weight: 800;
            font-size: 1.1rem;
            color: var(--accent);
        }
        .product-card .stock-info { font-size: 0.72rem; color: var(--slate-400); margin-bottom: 10px; }

        /* ── ARTICLE CARD ─────────────────────────────────────── */
        .article-card {
            background: white;
            border-radius: var(--radius-xl);
            overflow: hidden;
            border: 1px solid var(--slate-200);
            transition: transform .2s ease, box-shadow .2s ease;
            text-decoration: none;
            display: block;
            color: inherit;
        }
        .article-card:hover { transform: translateY(-4px); box-shadow: 0 12px 32px rgba(15,23,42,0.08); }
        .article-card .img-wrap { height: 195px; overflow: hidden; background: var(--slate-100); }
        .article-card .img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform .3s ease; }
        .article-card:hover .img-wrap img { transform: scale(1.04); }
        .article-card .article-date { font-size: 0.72rem; color: var(--slate-400); font-weight: 600; }
        .article-card h6 { font-weight: 700; font-size: 0.93rem; line-height: 1.45; color: var(--slate-900); margin-bottom: 8px; }
        .article-card .read-link { font-size: 0.8rem; font-weight: 700; color: var(--blue-600); }

        /* ── BREADCRUMB ───────────────────────────────────────── */
        .breadcrumb-carage { background: white; border-bottom: 1px solid var(--slate-200); padding: 13px 0; }
        .breadcrumb-carage .breadcrumb { margin: 0; }
        .breadcrumb-item a { color: var(--blue-600); text-decoration: none; font-weight: 600; font-size: 0.82rem; }
        .breadcrumb-item.active { font-size: 0.82rem; font-weight: 600; color: var(--slate-400); }
        .breadcrumb-item + .breadcrumb-item::before { color: var(--slate-300); }

        /* ── ALERTS ───────────────────────────────────────────── */
        .alert { border-radius: var(--radius-md); border: none; font-weight: 600; font-size: 0.875rem; }
        .alert-success { background: #D1FAE5; color: #065F46; }
        .alert-danger  { background: #FEE2E2; color: #991B1B; }
        .alert-warning { background: #FEF3C7; color: #92400E; }
        .alert-info    { background: var(--blue-50); color: var(--blue-700); }

        /* ── STATUS BADGES ────────────────────────────────────── */
        .status-badge {
            padding: 3px 10px;
            border-radius: 5px;
            font-size: 0.68rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-block;
        }
        .status-pending    { background: #FEF3C7; color: #92400E; }
        .status-processing { background: var(--blue-50); color: var(--blue-700); }
        .status-shipped    { background: #EDE9FE; color: #5B21B6; }
        .status-delivered  { background: #D1FAE5; color: #065F46; }
        .status-cancelled  { background: #FEE2E2; color: #991B1B; }

        /* ── CATEGORY CARD ────────────────────────────────────── */
        .cat-card {
            background: white;
            border: 1px solid var(--slate-200);
            border-radius: var(--radius-lg);
            padding: 22px 14px;
            text-align: center;
            transition: all .2s ease;
            cursor: pointer;
            text-decoration: none;
            display: block;
            color: var(--slate-700);
        }
        .cat-card:hover {
            border-color: var(--blue-300);
            color: var(--blue-700);
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(37,99,235,0.10);
            background: var(--blue-50);
        }
        .cat-card .cat-icon { font-size: 1.8rem; margin-bottom: 8px; }
        .cat-card .cat-name { font-weight: 700; font-size: 0.82rem; }
        .cat-card .cat-count { font-size: 0.68rem; color: var(--slate-400); margin-top: 3px; }

        /* ── FORMS ────────────────────────────────────────────── */
        .form-control, .form-select {
            border: 1px solid var(--slate-200);
            border-radius: var(--radius-md);
            font-size: 0.9rem;
            padding: 10px 14px;
            font-family: var(--font-body);
            background: white;
            color: var(--slate-900);
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--blue-400);
            box-shadow: 0 0 0 3px rgba(59,130,246,0.12);
        }
        .form-label { font-weight: 600; font-size: 0.82rem; color: var(--slate-700); }

        /* ── FILTER SIDEBAR ───────────────────────────────────── */
        .filter-sidebar { background: white; border-radius: var(--radius-lg); border: 1px solid var(--slate-200); padding: 20px; }
        .filter-title {
            font-weight: 800;
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--slate-900);
            border-bottom: 2px solid var(--blue-600);
            padding-bottom: 8px;
            margin-bottom: 14px;
        }

        /* ── TABLE ────────────────────────────────────────────── */
        .table-carage thead th {
            background: var(--slate-900);
            color: rgba(255,255,255,0.6);
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
            padding: 12px 16px;
        }
        .table-carage tbody td { padding: 13px 16px; vertical-align: middle; border-color: var(--slate-100); font-size: 0.85rem; }
        .table-carage tbody tr:hover td { background: var(--slate-50); }

        /* ── ADMIN SIDEBAR ────────────────────────────────────── */
        .admin-sidebar {
            background: var(--slate-900);
            min-height: 100vh;
            width: 240px;
            position: fixed;
            left: 0; top: 0;
            z-index: 100;
            border-right: 2px solid var(--blue-600);
        }
        .admin-sidebar .sidebar-brand {
            padding: 20px 20px 16px;
            border-bottom: 1px solid rgba(255,255,255,0.07);
        }
        .admin-sidebar .sidebar-brand .brand-name {
            font-family: var(--font-display);
            font-weight: 800;
            font-size: 1.4rem;
            color: white;
            letter-spacing: -1px;
        }
        .admin-sidebar .sidebar-brand .brand-name span { color: var(--blue-400); }
        .admin-sidebar .sidebar-brand .brand-sub {
            display: block;
            font-size: 0.62rem;
            color: var(--blue-400);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-top: 2px;
        }
        .admin-sidebar .nav-section {
            font-size: 0.6rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: rgba(255,255,255,0.2);
            padding: 14px 20px 6px;
        }
        .admin-sidebar .nav-item a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 20px;
            color: rgba(255,255,255,0.45);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.82rem;
            border-left: 2px solid transparent;
            transition: all .15s;
        }
        .admin-sidebar .nav-item a:hover { color: white; background: rgba(255,255,255,0.04); }
        .admin-sidebar .nav-item a.active {
            color: white;
            background: rgba(59,130,246,0.12);
            border-left-color: var(--blue-400);
        }
        .admin-sidebar .nav-item a i { font-size: 1rem; width: 18px; }
        .admin-content { margin-left: 240px; min-height: 100vh; background: var(--bg-page); }
        .admin-topbar {
            background: white;
            border-bottom: 1px solid var(--slate-200);
            padding: 14px 26px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .admin-topbar .page-title {
            font-family: var(--font-display);
            font-weight: 800;
            font-size: 1.2rem;
            letter-spacing: -0.5px;
            color: var(--slate-900);
        }
        .admin-page-content { padding: 24px; }
        .admin-card {
            background: white;
            border-radius: var(--radius-xl);
            border: 1px solid var(--slate-200);
            overflow: hidden;
        }
        .admin-card-header {
            padding: 14px 20px;
            border-bottom: 1px solid var(--slate-100);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .admin-card-header .card-title {
            font-size: 0.72rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--slate-900);
        }
        .stat-card {
            background: white;
            border-radius: var(--radius-xl);
            border: 1px solid var(--slate-200);
            padding: 18px 22px;
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .stat-card .stat-icon {
            width: 48px; height: 48px;
            border-radius: var(--radius-md);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem;
        }
        .stat-card .stat-value {
            font-family: var(--font-display);
            font-weight: 800;
            font-size: 1.7rem;
            letter-spacing: -1px;
            color: var(--slate-900);
            line-height: 1;
        }
        .stat-card .stat-label {
            font-size: 0.7rem;
            font-weight: 700;
            color: var(--slate-400);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* ── HERO ─────────────────────────────────────────────── */
        .hero-section {
            background: var(--slate-900);
            color: white;
            padding: 72px 0 0;
            position: relative;
            overflow: hidden;
        }
        .hero-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            pointer-events: none;
        }
        .hero-blob.b1 { width: 520px; height: 520px; background: rgba(59,130,246,0.14); right: -80px; top: -80px; }
        .hero-blob.b2 { width: 320px; height: 320px; background: rgba(37,99,235,0.10); left: 36%; bottom: -60px; }
        .hero-pill {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: rgba(59,130,246,0.12);
            border: 1px solid rgba(59,130,246,0.22);
            border-radius: 100px;
            padding: 5px 14px;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--blue-400);
            margin-bottom: 18px;
        }
        .hero-title {
            font-family: var(--font-display);
            font-weight: 800;
            font-size: 4rem;
            line-height: 1.0;
            letter-spacing: -2px;
            margin-bottom: 16px;
        }
        .hero-title .accent { color: var(--blue-400); }
        .hero-sub { font-size: 1rem; color: rgba(255,255,255,0.42); max-width: 400px; line-height: 1.7; margin-bottom: 26px; font-weight: 500; }
        .hero-search-bar {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.10);
            border-radius: var(--radius-lg);
            display: flex;
            overflow: hidden;
            backdrop-filter: blur(8px);
            max-width: 440px;
        }
        .hero-search-bar input {
            background: transparent;
            border: none;
            color: white;
            padding: 13px 16px;
            font-family: var(--font-body);
            font-size: 0.875rem;
            font-weight: 500;
            flex: 1;
        }
        .hero-search-bar input::placeholder { color: rgba(255,255,255,0.25); }
        .hero-search-bar input:focus { outline: none; }
        .hero-search-bar button {
            background: var(--blue-600);
            border: none;
            padding: 0 20px;
            color: white;
            font-size: 1rem;
            cursor: pointer;
            transition: background .15s;
        }
        .hero-search-bar button:hover { background: var(--blue-700); }
        .hero-stats {
            display: flex;
            gap: 0;
            padding: 36px 0 0;
            border-top: 1px solid rgba(255,255,255,0.07);
            margin-top: 36px;
        }
        .hero-stat {
            padding-right: 36px;
            margin-right: 36px;
            border-right: 1px solid rgba(255,255,255,0.07);
        }
        .hero-stat:last-child { border-right: none; }
        .hero-stat-val {
            font-family: var(--font-display);
            font-weight: 800;
            font-size: 1.6rem;
            color: white;
            letter-spacing: -1px;
        }
        .hero-stat-label { font-size: 0.65rem; color: rgba(255,255,255,0.28); text-transform: uppercase; letter-spacing: 1.5px; font-weight: 700; margin-top: 2px; }
        .hero-visual-box {
            width: 380px; height: 300px;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 20px;
            display: flex; align-items: center; justify-content: center; flex-direction: column;
            gap: 10px;
            position: relative;
            overflow: hidden;
        }

        /* ── TRUST BAR ────────────────────────────────────────── */
        .trust-bar { background: white; border-bottom: 1px solid var(--slate-200); padding: 13px 0; }
        .trust-item { display: flex; align-items: center; gap: 9px; font-size: 0.78rem; font-weight: 600; color: var(--slate-600); }
        .trust-item .trust-icon {
            width: 28px; height: 28px;
            background: var(--blue-50);
            border-radius: var(--radius-sm);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        /* ── FOOTER ───────────────────────────────────────────── */
        .footer-carage {
            background: var(--slate-900);
            color: rgba(255,255,255,0.4);
            padding: 52px 0 20px;
            border-top: 2px solid var(--blue-600);
        }
        .footer-carage .footer-brand {
            font-family: var(--font-display);
            font-weight: 800;
            font-size: 1.7rem;
            color: white;
            letter-spacing: -1px;
            margin-bottom: 10px;
        }
        .footer-carage .footer-brand span { color: var(--blue-400); }
        .footer-carage h6 { color: rgba(255,255,255,0.45); font-size: 0.68rem; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 14px; }
        .footer-carage a { color: rgba(255,255,255,0.3); text-decoration: none; font-size: 0.82rem; display: block; margin-bottom: 8px; transition: color .15s; }
        .footer-carage a:hover { color: var(--blue-400); }
        .footer-carage .footer-divider { border-color: rgba(255,255,255,0.07); margin: 36px 0 16px; }
        .footer-copy { font-size: 0.72rem; color: rgba(255,255,255,0.15); }

        /* ── PAGINATION ───────────────────────────────────────── */
        .page-link {
            border-radius: var(--radius-sm) !important;
            border-color: var(--slate-200);
            color: var(--slate-600);
            font-size: 0.82rem;
            font-weight: 600;
        }
        .page-item.active .page-link { background: var(--blue-600); border-color: var(--blue-600); }

        /* ── UTILITY ──────────────────────────────────────────── */
        .text-accent { color: var(--accent) !important; }
        .text-blue   { color: var(--blue-600) !important; }
        .bg-hero     { background: var(--slate-900) !important; }

        /* ── ANIMATIONS ───────────────────────────────────────── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-up   { animation: fadeUp .5s ease both; }
        .fade-up-1 { animation-delay: .06s; }
        .fade-up-2 { animation-delay: .13s; }
        .fade-up-3 { animation-delay: .21s; }
        .fade-up-4 { animation-delay: .30s; }

        /* ── TOAST NOTIFICATION ───────────────────────────────── */
        .toast-carage {
            position: fixed;
            top: 76px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            max-width: 360px;
            border-radius: var(--radius-lg);
            padding: 14px 16px 14px 20px;
            display: flex;
            align-items: flex-start;
            gap: 11px;
            font-size: .85rem;
            background: var(--white);
            border: 1px solid var(--slate-200);
            box-shadow: 0 4px 6px rgba(15,23,42,0.04), 0 10px 30px rgba(15,23,42,0.10);
            transform: translateX(calc(100% + 28px));
            transition: transform .4s cubic-bezier(.32,.72,0,1);
            overflow: hidden;
        }
        .toast-carage.show {
            transform: translateX(0);
        }
        /* garis aksen kiri */
        .toast-carage::before {
            content: '';
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 4px;
            border-radius: var(--radius-lg) 0 0 var(--radius-lg);
        }
        .toast-carage.toast-success::before { background: var(--blue-600); }
        .toast-carage.toast-error::before   { background: #DC2626; }
        .toast-carage .toast-icon {
            font-size: 1rem;
            flex-shrink: 0;
            margin-top: 1px;
        }
        .toast-carage.toast-success .toast-icon { color: var(--blue-600); }
        .toast-carage.toast-error   .toast-icon { color: #DC2626; }
        .toast-carage .toast-msg {
            flex: 1;
            line-height: 1.5;
        }
        .toast-carage .toast-label {
            font-size: .68rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 2px;
        }
        .toast-carage.toast-success .toast-label { color: var(--blue-600); }
        .toast-carage.toast-error   .toast-label { color: #DC2626; }
        .toast-carage .toast-text {
            font-weight: 600;
            color: var(--slate-700);
            font-size: .85rem;
        }
        .toast-carage .toast-close {
            background: none;
            border: none;
            cursor: pointer;
            font-size: .8rem;
            padding: 0;
            line-height: 1;
            flex-shrink: 0;
            color: var(--slate-400);
            transition: color .15s;
            margin-top: 2px;
        }
        .toast-carage .toast-close:hover { color: var(--slate-900); }

        /* ── MOBILE BOTTOM NAV ────────────────────────────────── */
        .mobile-bottom-nav {
            display: none;
            position: fixed;
            bottom: 0; left: 0; right: 0;
            z-index: 1050;
            background: var(--white);
            border-top: 1px solid var(--slate-200);
            box-shadow: 0 -4px 20px rgba(15,23,42,0.08);
            height: 62px;
            align-items: stretch;
            padding: 0 4px;
            padding-bottom: env(safe-area-inset-bottom);
        }

        .mobile-tab-item {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 3px;
            text-decoration: none;
            color: var(--slate-400);
            font-size: 0.6rem;
            font-weight: 700;
            letter-spacing: 0.3px;
            border-radius: var(--radius-sm);
            margin: 6px 2px;
            transition: all .15s ease;
            position: relative;
        }
        .mobile-tab-item i {
            font-size: 1.25rem;
            line-height: 1;
            transition: transform .15s ease;
        }
        .mobile-tab-item:hover,
        .mobile-tab-item.active {
            color: var(--blue-600);
        }
        .mobile-tab-item.active i { transform: translateY(-1px); }
        .mobile-tab-item.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            width: 18px; height: 3px;
            background: var(--blue-600);
            border-radius: 2px;
        }
        .mobile-tab-item.active { background: var(--blue-50); }

        /* ── MOBILE NAVBAR SPECIFIC ───────────────────────────── */
        .navbar-right-group {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-left: auto;
        }

        @media (max-width: 991px) {
            .navbar-carage .dropdown-menu.dropdown-menu-end {
                right: 0 !important;
                left: auto !important;
            }
        }

        /* ── RESPONSIVE ───────────────────────────────────────── */
        @media (max-width: 767px) {
            /* ── GLOBAL CONTAINER PADDING ── */
            .container {
                padding-left: 16px !important;
                padding-right: 16px !important;
            }

            /* Body padding untuk bottom bar */
            body { padding-bottom: 68px; }
            .breadcrumb-carage { padding: 8px 0; }
            .breadcrumb-item a { font-size: 0.7rem; }
            .breadcrumb-item.active { font-size: 0.7rem; }
            .breadcrumb-item + .breadcrumb-item::before { font-size: 0.7rem; }

            /* Potong teks yang terlalu panjang */
            .breadcrumb-item:last-child a,
            .breadcrumb-item.active {
                max-width: 140px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                display: inline-block;
                vertical-align: middle;
            }

            /* Aktifkan bottom nav */
            .mobile-bottom-nav { display: flex !important; }

            /* Navbar: height lebih kecil sedikit */
            .navbar-carage .container {
                height: 56px;
                display: flex;
                align-items: center;
            }

            /* Brand font ukuran mobile */
            .navbar-carage .navbar-brand { font-size: 1.2rem; letter-spacing: -.5px; }

            /* Sembunyikan toggler & collapse desktop nav */
            .navbar-carage .navbar-toggler { display: none !important; }
            .navbar-carage .navbar-collapse { display: none !important; }

            /* Tombol icon ukuran mobile */
            .btn-nav-icon { width: 36px; height: 36px; font-size: 0.9rem; }
            .avatar-circle { width: 32px; height: 32px; font-size: 0.68rem; }

            /* Dropdown posisi & ukuran */
            .navbar-carage .dropdown-menu {
                font-size: 0.82rem;
                min-width: 200px !important;
                border-radius: var(--radius-lg) !important;
                border-color: var(--slate-200) !important;
                box-shadow: 0 8px 32px rgba(15,23,42,0.12) !important;
            }

            /* Toast mobile: compact di kanan atas */
            .toast-carage {
                top: 64px;
                right: 12px;
                left: auto;
                min-width: unset;
                max-width: 260px;
                padding: 10px 12px 10px 16px;
                gap: 8px;
                border-radius: var(--radius-md);
            }
            .toast-carage .toast-icon { font-size: .85rem; }
            .toast-carage .toast-label { font-size: .6rem; margin-bottom: 1px; }
            .toast-carage .toast-text  { font-size: .75rem; }
            .toast-carage .toast-close { font-size: .72rem; }

            /* Footer mobile */
            .footer-carage { padding: 32px 0 10px; }
            .footer-carage .footer-brand { font-size: 1.2rem; margin-bottom: 6px; }
            .footer-carage p[style] { font-size: .72rem !important; max-width: 100% !important; }
            .footer-carage h6 { font-size: .6rem; margin-bottom: 10px; }
            .footer-carage a { font-size: .72rem; margin-bottom: 5px; }
            .footer-carage .footer-copy { font-size: .62rem; }
            .footer-carage .footer-divider { margin: 20px 0 12px; }
            .footer-carage p[style*="display:flex"] { font-size: .7rem !important; margin-bottom: 5px !important; }
            .footer-carage .row.g-4 { --bs-gutter-y: 20px; }
            .footer-carage .d-flex.gap-2 a[style] {
                width: 28px !important;
                height: 28px !important;
                font-size: .8rem !important;
            }

            /* Misc */
            .hero-title { font-size: 2.2rem; }
            .hero-stats { gap: 20px; }
            .section-title { font-size: 1.7rem; }
        }
    </style>

    @stack('styles')
</head>
<body>

{{-- ── NAVBAR ─────────────────────────────────────────────── --}}
<nav class="navbar navbar-carage sticky-top">
    <div class="container">

        {{-- Brand --}}
        <a class="navbar-brand" href="{{ route('home') }}">CAR<span>AGE</span></a>

        {{-- Desktop Nav Links (hanya tampil lg ke atas) --}}
        <ul class="navbar-nav me-auto ms-3 gap-1 d-none d-lg-flex flex-row">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}">Produk</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('articles.*') ? 'active' : '' }}" href="{{ route('articles.index') }}">Artikel</a>
            </li>
        </ul>

        {{-- Right group: tampil di SEMUA ukuran layar --}}
        <div class="navbar-right-group">
            @auth
                {{-- Keranjang --}}
                @php $cartCount = \App\Models\Cart::where('user_id', auth()->id())->count(); @endphp

                {{-- Desktop: tombol dengan label --}}
                <a class="btn-nav-cart d-none d-lg-inline-flex" href="{{ route('cart.index') }}">
                    <i class="bi bi-bag"></i>
                    Keranjang
                    @if($cartCount > 0)
                        <span class="cart-badge-inline">{{ $cartCount }}</span>
                    @endif
                </a>

                {{-- Mobile: icon saja --}}
                <a class="btn-nav-icon d-lg-none" href="{{ route('cart.index') }}">
                    <i class="bi bi-bag"></i>
                    @if($cartCount > 0)
                        <span class="cart-badge">{{ $cartCount }}</span>
                    @endif
                </a>

                {{-- Avatar + Dropdown --}}
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center gap-2 text-decoration-none"
                       data-bs-toggle="dropdown" aria-expanded="false" style="outline:none;">
                        <div class="avatar-circle">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>
                        {{-- Nama hanya tampil di desktop --}}
                        <span class="d-none d-lg-inline"
                              style="font-weight:600;font-size:.82rem;color:var(--slate-600);">
                            {{ Str::limit(auth()->user()->name, 12) }}
                            <i class="bi bi-chevron-down ms-1" style="font-size:.6rem;"></i>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm"
                        style="border-radius:12px;border-color:var(--slate-200);font-size:.82rem;min-width:200px;margin-top:8px;">
                        {{-- Header info user --}}
                        <li class="px-3 py-2" style="border-bottom:1px solid var(--slate-100);">
                            <div style="font-weight:700;font-size:.82rem;color:var(--slate-900);">
                                {{ auth()->user()->name }}
                            </div>
                            <div style="font-size:.7rem;color:var(--slate-400);margin-top:2px;">
                                {{ auth()->user()->email }}
                            </div>
                        </li>
                        {{-- Admin dashboard --}}
                        @if(auth()->user()->isAdmin())
                        <li>
                            <a class="dropdown-item py-2" href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-speedometer2 me-2 text-blue"></i>Dashboard Admin
                            </a>
                        </li>
                        @endif
                        <li>
                            <a class="dropdown-item py-2" href="{{ route('order.history') }}">
                                <i class="bi bi-clock-history me-2 text-blue"></i>History Pesanan
                            </a>
                        </li>
                        <li><hr class="dropdown-divider my-1"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item py-2 text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i>Keluar
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>

            @else
                {{-- Guest: tombol masuk & daftar --}}
                <a class="btn-nav-ghost d-none d-lg-inline-flex" href="{{ route('login') }}">Masuk</a>
                <a class="btn-nav-cart d-none d-lg-inline-flex" href="{{ route('register') }}">Daftar Gratis</a>

                {{-- Mobile guest: hanya icon person --}}
                <a class="btn-nav-icon d-lg-none" href="{{ route('login') }}">
                    <i class="bi bi-person"></i>
                </a>
            @endauth
        </div>

    </div>
</nav>

{{-- ── MOBILE BOTTOM TAB BAR ──────────────────────────────── --}}
<nav class="mobile-bottom-nav">
    <a href="{{ route('home') }}"
       class="mobile-tab-item {{ request()->routeIs('home') ? 'active' : '' }}">
        <i class="bi {{ request()->routeIs('home') ? 'bi-house-fill' : 'bi-house' }}"></i>
        Beranda
    </a>

    <a href="{{ route('products.index') }}"
       class="mobile-tab-item {{ request()->routeIs('products.*') ? 'active' : '' }}">
        <i class="bi {{ request()->routeIs('products.*') ? 'bi-grid-fill' : 'bi-grid' }}"></i>
        Produk
    </a>

    <a href="{{ route('articles.index') }}"
       class="mobile-tab-item {{ request()->routeIs('articles.*') ? 'active' : '' }}">
        <i class="bi {{ request()->routeIs('articles.*') ? 'bi-newspaper' : 'bi-newspaper' }}"></i>
        Artikel
    </a>

    @auth
    <a href="{{ route('order.history') }}"
       class="mobile-tab-item {{ request()->routeIs('order.*') ? 'active' : '' }}">
        <i class="bi bi-clock-history"></i>
        History
    </a>
    @else
    <a href="{{ route('login') }}"
       class="mobile-tab-item">
        <i class="bi bi-person"></i>
        Masuk
    </a>
    @endauth
</nav>

{{-- ── TOAST NOTIFICATIONS ─────────────────────────────────── --}}
@if(session('success'))
<div id="toastSuccess" class="toast-carage toast-success" role="alert" aria-live="polite">
    <i class="bi bi-check-circle-fill toast-icon"></i>
    <div class="toast-msg">
        <div class="toast-label">Berhasil</div>
        <div class="toast-text">{{ session('success') }}</div>
    </div>
    <button class="toast-close" onclick="dismissToast('toastSuccess')" aria-label="Tutup">
        <i class="bi bi-x-lg"></i>
    </button>
</div>
@endif

@if(session('error'))
<div id="toastError" class="toast-carage toast-error" role="alert" aria-live="polite">
    <i class="bi bi-exclamation-circle-fill toast-icon"></i>
    <div class="toast-msg">
        <div class="toast-label">Gagal</div>
        <div class="toast-text">{{ session('error') }}</div>
    </div>
    <button class="toast-close" onclick="dismissToast('toastError')" aria-label="Tutup">
        <i class="bi bi-x-lg"></i>
    </button>
</div>
@endif

{{-- ── MAIN CONTENT ─────────────────────────────────────────── --}}
@yield('content')

{{-- ── FOOTER ───────────────────────────────────────────────── --}}
<footer class="footer-carage">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="footer-brand">CAR<span>AGE</span></div>
                <p style="font-size:.82rem;line-height:1.75;color:rgba(255,255,255,0.35);max-width:260px;">Platform e-commerce sparepart mobil terpercaya. Ribuan produk original dan berkualitas untuk kendaraan Anda.</p>
                <div class="d-flex gap-2 mt-3">
                    @foreach(['instagram','facebook','whatsapp'] as $social)
                    <a href="#" style="width:34px;height:34px;background:rgba(255,255,255,0.07);border-radius:8px;display:inline-flex;align-items:center;justify-content:center;color:rgba(255,255,255,0.35);font-size:.95rem;transition:all .15s;"
                       onmouseover="this.style.background='rgba(59,130,246,0.18)';this.style.color='#93C5FD'"
                       onmouseout="this.style.background='rgba(255,255,255,0.07)';this.style.color='rgba(255,255,255,0.35)'">
                        <i class="bi bi-{{ $social }}"></i>
                    </a>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-2 col-6">
                <h6>Produk</h6>
                <a href="{{ route('products.index') }}?kategori=oli-pelumas">Oli & Pelumas</a>
                <a href="{{ route('products.index') }}?kategori=rem-kopling">Rem & Kopling</a>
                <a href="{{ route('products.index') }}?kategori=aki-elektrikal">Aki & Elektrikal</a>
                <a href="{{ route('products.index') }}?kategori=filter">Filter</a>
            </div>
            <div class="col-lg-2 col-6">
                <h6>Informasi</h6>
                <a href="{{ route('articles.index') }}">Blog & Artikel</a>
                <a href="#">Tentang Kami</a>
                <a href="#">Cara Belanja</a>
                <a href="#">Kebijakan Privasi</a>
            </div>
            <div class="col-lg-4">
                <h6>Kontak</h6>
                @foreach([
                    ['bi-geo-alt','Jl. Raya Darmo No.1, Surabaya'],
                    ['bi-telephone','+62 812-3456-7890'],
                    ['bi-envelope','halo@carage.id'],
                    ['bi-clock','Senin–Sabtu, 08.00–17.00'],
                ] as $contact)
                <p style="font-size:.8rem;color:rgba(255,255,255,0.32);display:flex;align-items:flex-start;gap:8px;margin-bottom:8px;">
                    <i class="bi {{ $contact[0] }}" style="color:var(--blue-400);flex-shrink:0;margin-top:1px;"></i>
                    {{ $contact[1] }}
                </p>
                @endforeach
            </div>
        </div>
        <hr class="footer-divider">
        <div class="footer-copy text-center">© {{ date('Y') }} Carage. Semua hak dilindungi.</div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

{{-- ── TOAST SCRIPT ─────────────────────────────────────────── --}}
<script>
function dismissToast(id) {
    const el = document.getElementById(id);
    if (!el) return;
    el.classList.remove('show');
    setTimeout(() => el.remove(), 400);
}

document.addEventListener('DOMContentLoaded', function () {
    ['toastSuccess', 'toastError'].forEach(function (id) {
        const el = document.getElementById(id);
        if (!el) return;
        // Slide in
        setTimeout(() => el.classList.add('show'), 80);
        // Auto dismiss setelah 4 detik
        setTimeout(() => dismissToast(id), 4000);
    });
});
</script>

@stack('scripts')
</body>
</html>