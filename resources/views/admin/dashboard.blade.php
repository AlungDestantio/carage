@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@push('styles')
<style>

/* ══ WELCOME STRIP ════════════════════════════════════════ */
.dash-topstrip {
    background: white;
    border-radius: var(--radius-xl);
    border: 1px solid var(--slate-200);
    padding: 22px 28px;
    display: flex; align-items: center;
    justify-content: space-between; gap: 20px;
    flex-wrap: wrap;
    margin-bottom: 20px;
}
.dash-greeting-label {
    font-size: .62rem; font-weight: 700;
    letter-spacing: 2px; text-transform: uppercase;
    color: var(--blue-500); margin-bottom: 5px;
}
.dash-greeting-title {
    font-family: var(--font-display);
    font-weight: 800; font-size: 1.45rem;
    color: var(--slate-900); letter-spacing: -.5px;
    margin: 0 0 4px; line-height: 1.15;
}
.dash-greeting-sub {
    font-size: .78rem; color: var(--slate-400);
    font-weight: 500; margin: 0;
}
.dash-topstrip-right { display: flex; gap: 8px; flex-shrink: 0; }

/* ══ PRIMARY STAT CARDS ═══════════════════════════════════ */
.stat-card-v2 {
    background: white;
    border: 1px solid var(--slate-200);
    border-radius: var(--radius-xl);
    padding: 18px 18px 16px;
    display: flex; flex-direction: column; gap: 10px;
    height: 100%;
    transition: box-shadow .2s, border-color .2s;
}
.stat-card-v2:hover {
    box-shadow: 0 6px 20px rgba(37,99,235,.08);
    border-color: var(--blue-200);
}
.stat-icon-v2 {
    width: 40px; height: 40px;
    border-radius: var(--radius-md);
    display: flex; align-items: center; justify-content: center;
    font-size: 1rem;
}
.stat-label-v2 {
    font-size: .63rem; font-weight: 700;
    color: var(--slate-400); text-transform: uppercase;
    letter-spacing: .5px; line-height: 1.3;
}
.stat-value-v2 {
    font-family: var(--font-display);
    font-weight: 800; font-size: 1.65rem;
    letter-spacing: -1.2px; line-height: 1;
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}

/* ══ SECTION CARDS ════════════════════════════════════════ */
.admin-card {
    background: white;
    border: 1px solid var(--slate-200);
    border-radius: var(--radius-xl);
    overflow: hidden;
}
.admin-card-header {
    padding: 13px 18px;
    border-bottom: 1px solid var(--slate-100);
    display: flex; align-items: center;
    justify-content: space-between; gap: 10px;
    background: var(--slate-50);
}
.card-header-icon {
    width: 28px; height: 28px; border-radius: 8px;
    background: var(--blue-50); color: var(--blue-600);
    display: flex; align-items: center; justify-content: center;
    font-size: .85rem; flex-shrink: 0;
}
.card-title {
    font-size: .7rem; font-weight: 800;
    text-transform: uppercase; letter-spacing: .8px;
    color: var(--slate-600);
}

/* ══ QUICK ACTIONS ════════════════════════════════════════ */
.qa-row {
    display: flex; align-items: center; gap: 12px;
    padding: 10px 12px;
    background: var(--qa-bg);
    border: 1px solid transparent;
    border-radius: var(--radius-lg);
    transition: all .15s; cursor: pointer;
    text-decoration: none;
}
.qa-row:hover {
    background: var(--qa-hbg);
    border-color: rgba(0,0,0,.06);
    transform: translateX(2px);
}
.qa-icon {
    width: 36px; height: 36px; border-radius: var(--radius-md);
    background: white; display: flex; align-items: center;
    justify-content: center; font-size: .9rem;
    color: var(--qa-icon); flex-shrink: 0;
    box-shadow: 0 1px 3px rgba(0,0,0,.07);
}
.qa-text   { flex: 1; min-width: 0; }
.qa-title  { font-weight: 700; font-size: .82rem; color: var(--qa-color); line-height: 1.2; }
.qa-sub    { font-size: .67rem; color: var(--slate-400); font-weight: 500; margin-top: 1px; }
.qa-arrow  { font-size: .75rem; color: var(--slate-300); flex-shrink: 0; transition: transform .15s; }
.qa-row:hover .qa-arrow { transform: translateX(2px); color: var(--slate-500); }

/* ══ ORDER TABLE ══════════════════════════════════════════ */
.table-carage { border-collapse: separate; border-spacing: 0; width: 100%; }
.table-carage thead th {
    background: var(--slate-50); color: var(--slate-400);
    font-size: .62rem; font-weight: 800;
    text-transform: uppercase; letter-spacing: .8px;
    border: none; border-bottom: 1px solid var(--slate-200);
    padding: 9px 16px; white-space: nowrap;
}
.table-carage tbody td {
    padding: 11px 16px; vertical-align: middle;
    border-bottom: 1px solid var(--slate-100);
    font-size: .82rem;
}
.table-carage tbody tr:last-child td { border-bottom: none; }
.table-carage tbody tr:hover td { background: var(--slate-50); }

/* ══ STATUS BADGES ════════════════════════════════════════ */
.status-badge {
    padding: 3px 9px; border-radius: 5px;
    font-size: .62rem; font-weight: 800;
    text-transform: uppercase; letter-spacing: .4px;
    display: inline-block; white-space: nowrap;
}
.status-pending    { background: #FEF3C7; color: #92400E; border: 1px solid #FDE68A; }
.status-processing { background: var(--blue-50); color: var(--blue-700); border: 1px solid var(--blue-200); }
.status-shipped    { background: #EDE9FE; color: #5B21B6; border: 1px solid #DDD6FE; }
.status-delivered  { background: #ECFDF5; color: #059669; border: 1px solid #D1FAE5; }
.status-cancelled  { background: #FEF2F2; color: #DC2626; border: 1px solid #FECACA; }

/* ══ BUTTONS ══════════════════════════════════════════════ */
.btn-info-sm {
    display: inline-flex; align-items: center; gap: 4px;
    font-size: .7rem; font-weight: 700;
    color: var(--blue-600); text-decoration: none;
    padding: 4px 10px; border-radius: 6px;
    border: 1px solid var(--blue-100);
    background: var(--blue-50); transition: all .15s;
}
.btn-info-sm:hover { background: var(--blue-100); color: var(--blue-800); }

/* ══ ORDER DIST ROWS ══════════════════════════════════════ */
.dist-row {
    display: flex; align-items: center; gap: 10px;
    padding: 9px 18px;
    border-bottom: 1px solid var(--slate-100);
}
.dist-row:last-child { border-bottom: none; }
.dist-dot {
    width: 8px; height: 8px; border-radius: 50%;
    flex-shrink: 0;
}
.dist-label {
    font-size: .76rem; font-weight: 600; color: var(--slate-500);
    flex: 1; min-width: 0;
}
.dist-bar-wrap {
    flex: 2; height: 5px; background: var(--slate-100);
    border-radius: 99px; overflow: hidden;
    min-width: 60px;
}
.dist-bar { height: 100%; border-radius: 99px; transition: width .6s ease; }
.dist-count {
    font-size: .72rem; font-weight: 800;
    color: var(--slate-900); min-width: 22px;
    text-align: right;
}

/* ══ USER AVATAR ══════════════════════════════════════════ */
.user-avatar {
    width: 28px; height: 28px; border-radius: 50%;
    background: var(--blue-100); color: var(--blue-700);
    font-family: var(--font-display); font-weight: 800;
    font-size: .7rem; display: flex; align-items: center;
    justify-content: center; flex-shrink: 0;
}

/* ══ SECONDARY STAT CARDS ═════════════════════════════════ */
.sec-stat {
    background: white; border: 1px solid var(--slate-200);
    border-radius: var(--radius-xl);
    display: flex; align-items: center; gap: 12px;
    padding: 14px 16px; height: 100%;
}
.sec-stat-icon {
    width: 38px; height: 38px; border-radius: var(--radius-md);
    display: flex; align-items: center; justify-content: center;
    font-size: .9rem; flex-shrink: 0;
}
.sec-stat-val {
    font-family: var(--font-display); font-weight: 800;
    font-size: 1.25rem; letter-spacing: -.5px;
    line-height: 1;
}
.sec-stat-label {
    font-size: .62rem; font-weight: 700;
    color: var(--slate-400); text-transform: uppercase;
    letter-spacing: .4px; margin-top: 2px;
}

/* ══ ANIMATIONS ═══════════════════════════════════════════ */
.fade-up   { animation: fadeUp .4s ease both; }
.fade-up-1 { animation-delay: .05s; }
.fade-up-2 { animation-delay: .10s; }
.fade-up-3 { animation-delay: .15s; }
@keyframes fadeUp {
    from { opacity:0; transform:translateY(10px); }
    to   { opacity:1; transform:translateY(0); }
}

/* ══ RESPONSIVE ═══════════════════════════════════════════ */
@media (max-width: 767px) {
    /* Welcome strip */
    .dash-topstrip {
        flex-direction: column; align-items: flex-start;
        padding: 16px 18px; border-radius: 14px;
        margin-bottom: 14px;
    }
    .dash-greeting-title { font-size: 1.15rem; }
    .dash-greeting-sub   { font-size: .72rem; }
    .dash-topstrip-right { width: 100%; }
    .dash-topstrip-right a { flex: 1; justify-content: center; text-align: center; }

    /* Primary stat cards */
    .stat-card-v2  { padding: 14px 14px 12px; border-radius: 12px; gap: 8px; }
    .stat-icon-v2  { width: 34px; height: 34px; font-size: .88rem; border-radius: 8px; }
    .stat-label-v2 { font-size: .57rem; }
    .stat-value-v2 { font-size: 1.25rem; letter-spacing: -.8px; }

    .row.g-3 { --bs-gutter-x: 8px; --bs-gutter-y: 8px; }
    .row.g-4 {
        --bs-gutter-x: 10px; --bs-gutter-y: 10px;
        margin-right: 0; margin-left: 0;
    }
    .row.g-4 > [class*="col-"] {
        padding-right: calc(var(--bs-gutter-x) * .5);
        padding-left:  calc(var(--bs-gutter-x) * .5);
    }
    .mb-4 { margin-bottom: 14px !important; }

    /* Section cards */
    .admin-card      { border-radius: 12px; }
    .admin-card-header { padding: 10px 14px; }
    .card-header-icon { width: 24px; height: 24px; font-size: .76rem; border-radius: 6px; }
    .card-title      { font-size: .62rem; }
    .btn-info-sm     { font-size: .62rem; padding: 3px 8px; border-radius: 5px; }

    /* Order table — hide Pelanggan on mobile */
    .col-hide-mobile { display: none !important; }
    .table-carage thead th { font-size: .56rem; padding: 8px 10px; }
    .table-carage tbody td { font-size: .72rem; padding: 9px 10px; }
    .status-badge    { font-size: .55rem; padding: 2px 6px; }

    /* Quick actions */
    .qa-row   { padding: 9px 10px; border-radius: 10px; }
    .qa-icon  { width: 30px; height: 30px; font-size: .8rem; }
    .qa-title { font-size: .76rem; }
    .qa-sub   { font-size: .62rem; }

    /* Dist rows */
    .dist-row   { padding: 8px 14px; }
    .dist-label { font-size: .68rem; }
    .dist-count { font-size: .66rem; }
    .dist-bar-wrap { min-width: 40px; }

    /* Sec stats */
    .sec-stat      { padding: 11px 12px; border-radius: 10px; gap: 10px; }
    .sec-stat-icon { width: 32px; height: 32px; font-size: .8rem; border-radius: 7px; }
    .sec-stat-val  { font-size: 1rem; }
    .sec-stat-label { font-size: .56rem; }
}
</style>
@endpush

@section('content')

{{-- ── WELCOME STRIP ──────────────────────────────────────── --}}
<div class="dash-topstrip fade-up">
    <div class="dash-topstrip-left">
        <div class="dash-greeting-label">{{ now()->translatedFormat('l, d F Y') }}</div>
        <h2 class="dash-greeting-title">Halo, {{ Str::limit(auth()->user()->name, 18) }}! 👋</h2>
        <p class="dash-greeting-sub">Berikut ringkasan aktivitas toko Carage hari ini.</p>
    </div>
    <div class="dash-topstrip-right">
        <a href="{{ route('admin.produk.create') }}" class="btn-carage text-decoration-none">
            <i class="bi bi-plus-lg"></i> Tambah Produk
        </a>
        <a href="{{ route('admin.artikel.create') }}" class="btn-ghost text-decoration-none">
            <i class="bi bi-pencil-square"></i> Tulis Artikel
        </a>
    </div>
</div>

{{-- ── PRIMARY STAT CARDS ─────────────────────────────────── --}}
@php
$mainStats = [
    ['Total Pesanan',    $stats['total_orders'],   'bi-bag-check-fill',  '#DBEAFE', '#1D4ED8', '#2563EB'],
    ['Revenue Bulan Ini','Rp '.number_format(($stats['total_revenue'] ?? 0)/1000000,1).'Jt', 'bi-cash-coin', '#BBF7D0', '#065F46', '#059669'],
    ['Total Produk',     $stats['total_products'], 'bi-box-seam-fill',   '#EDE9FE', '#5B21B6', '#7C3AED'],
    ['Pesanan Pending',  $stats['pending_orders'], 'bi-hourglass-split', '#FDE68A', '#92400E', '#D97706'],
];
@endphp
<div class="row g-3 mb-4">
    @foreach($mainStats as [$label,$value,$icon,$bg2,$textColor,$iconColor])
    <div class="col-6 col-xl-3">
        <div class="stat-card-v2 fade-up">
            <div class="stat-icon-v2" style="background:{{ $bg2 }};color:{{ $iconColor }};">
                <i class="bi {{ $icon }}"></i>
            </div>
            <div class="stat-label-v2">{{ $label }}</div>
            <div class="stat-value-v2" style="color:{{ $textColor }};">{{ $value }}</div>
        </div>
    </div>
    @endforeach
</div>

{{-- ── MIDDLE ROW: Pesanan Terbaru + Aksi Cepat ──────────── --}}
<div class="row g-4 mb-4">

    {{-- Pesanan Terbaru --}}
    <div class="col-lg-8">
        <div class="admin-card fade-up" style="height:100%;">
            <div class="admin-card-header">
                <div style="display:flex;align-items:center;gap:8px;">
                    <div class="card-header-icon"><i class="bi bi-receipt"></i></div>
                    <span class="card-title">Pesanan Terbaru</span>
                </div>
                <a href="{{ route('admin.transaksi.index') }}" class="btn-info-sm">
                    Lihat Semua <i class="bi bi-arrow-right" style="font-size:.6rem;"></i>
                </a>
            </div>
            <div class="table-responsive">
                <table class="table-carage">
                    <thead>
                        <tr>
                            <th>No. Pesanan</th>
                            <th class="col-hide-mobile">Pelanggan</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th style="text-align:right;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders as $order)
                        <tr>
                            <td>
                                <div style="font-family:var(--font-display);font-weight:800;font-size:.86rem;color:var(--slate-900);">
                                    {{ $order->order_number }}
                                </div>
                                {{-- Mobile: show customer name below order number --}}
                                <div class="d-block d-md-none" style="font-size:.62rem;color:var(--slate-400);font-weight:600;margin-top:2px;">
                                    {{ Str::limit($order->user->name, 18) }} · {{ $order->created_at->format('d M') }}
                                </div>
                            </td>
                            <td class="col-hide-mobile">
                                <div style="display:flex;align-items:center;gap:8px;">
                                    <div class="user-avatar">{{ strtoupper(substr($order->user->name,0,1)) }}</div>
                                    <div>
                                        <div style="font-weight:700;font-size:.82rem;color:var(--slate-900);">{{ Str::limit($order->user->name, 16) }}</div>
                                        <div style="font-size:.66rem;color:var(--slate-400);">{{ $order->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                            </td>
                            <td style="font-family:var(--font-display);font-weight:800;font-size:.86rem;color:var(--slate-900);">
                                {{ $order->formatted_total }}
                            </td>
                            <td>
                                <span class="status-badge status-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
                            </td>
                            <td style="text-align:right;">
                                <a href="{{ route('admin.transaksi.show', $order->id) }}" class="btn-info-sm">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <div style="font-size:1.4rem;margin-bottom:6px;">📭</div>
                                <p style="font-size:.82rem;color:var(--slate-400);margin:0;">Belum ada pesanan</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Aksi Cepat --}}
    <div class="col-lg-4">
        <div class="admin-card fade-up fade-up-1" style="height:100%;">
            <div class="admin-card-header">
                <div style="display:flex;align-items:center;gap:8px;">
                    <div class="card-header-icon"><i class="bi bi-lightning-fill"></i></div>
                    <span class="card-title">Aksi Cepat</span>
                </div>
            </div>
            <div style="padding:14px;display:flex;flex-direction:column;gap:8px;">
                @php
                $quickActions = [
                    [route('admin.produk.create'),   'bi-plus-circle',   '#EFF6FF','#DBEAFE','#1D4ED8','#2563EB','Tambah Produk',    'Tambah ke katalog toko'],
                    [route('admin.artikel.create'),  'bi-pencil-square', '#F5F3FF','#EDE9FE','#5B21B6','#7C3AED','Tulis Artikel',    'Blog & konten toko'],
                    [route('admin.transaksi.index'), 'bi-receipt',       '#F0FDF4','#BBF7D0','#065F46','#059669','Kelola Transaksi', 'Proses pesanan masuk'],
                    [route('admin.pengguna.index'),  'bi-people-fill',   '#FFFBEB','#FDE68A','#92400E','#D97706','Kelola Pengguna',  'Manajemen akun member'],
                ];
                @endphp
                @foreach($quickActions as [$href,$icon,$bg,$hbg,$color,$iconColor,$title,$sub])
                <a href="{{ $href }}" class="qa-row"
                   style="--qa-bg:{{ $bg }};--qa-hbg:{{ $hbg }};--qa-color:{{ $color }};--qa-icon:{{ $iconColor }};">
                    <div class="qa-icon"><i class="bi {{ $icon }}"></i></div>
                    <div class="qa-text">
                        <div class="qa-title">{{ $title }}</div>
                        <div class="qa-sub">{{ $sub }}</div>
                    </div>
                    <i class="bi bi-arrow-right qa-arrow"></i>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- ── BOTTOM ROW: Distribusi Pesanan + Produk Terlaris + Pengguna Baru ── --}}
<div class="row g-4 mb-4">

    {{-- Distribusi Status Pesanan --}}
    <div class="col-lg-4">
        <div class="admin-card fade-up" style="height:100%;">
            <div class="admin-card-header">
                <div style="display:flex;align-items:center;gap:8px;">
                    <div class="card-header-icon"><i class="bi bi-pie-chart-fill"></i></div>
                    <span class="card-title">Distribusi Pesanan</span>
                </div>
                <span style="font-size:.66rem;font-weight:700;color:var(--slate-400);">{{ $stats['total_orders'] }} total</span>
            </div>

            @php
            $statusDist = [
                ['Pending',    $stats['pending_orders']    ?? 0, '#F59E0B'],
                ['Diproses',   $stats['processing_orders'] ?? 0, '#3B82F6'],
                ['Dikirim',    $stats['shipped_orders']    ?? 0, '#8B5CF6'],
                ['Selesai',    $stats['delivered_orders']  ?? 0, '#10B981'],
                ['Dibatalkan', $stats['cancelled_orders']  ?? 0, '#EF4444'],
            ];
            $totalOrders = max($stats['total_orders'], 1);
            @endphp

            <div style="padding:6px 0 8px;">
                @foreach($statusDist as [$label,$count,$color])
                <div class="dist-row">
                    <span class="dist-dot" style="background:{{ $color }};"></span>
                    <span class="dist-label">{{ $label }}</span>
                    <div class="dist-bar-wrap">
                        <div class="dist-bar"
                             style="width:{{ round(($count/$totalOrders)*100) }}%;background:{{ $color }};">
                        </div>
                    </div>
                    <span class="dist-count">{{ $count }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Produk Terlaris --}}
    <div class="col-lg-4">
        <div class="admin-card fade-up fade-up-1" style="height:100%;">
            <div class="admin-card-header">
                <div style="display:flex;align-items:center;gap:8px;">
                    <div class="card-header-icon"><i class="bi bi-award-fill"></i></div>
                    <span class="card-title">Produk Terlaris</span>
                </div>
                <a href="{{ route('admin.produk.index') }}" class="btn-info-sm">
                    Semua <i class="bi bi-arrow-right" style="font-size:.6rem;"></i>
                </a>
            </div>
            <div style="padding:4px 0;">
                @forelse($topProducts ?? [] as $i => $product)
                <div style="padding:10px 18px;{{ !$loop->last ? 'border-bottom:1px solid var(--slate-100);' : '' }}display:flex;align-items:center;gap:12px;">
                    <div style="width:24px;height:24px;border-radius:6px;background:var(--blue-50);color:var(--blue-600);font-family:var(--font-display);font-weight:800;font-size:.72rem;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        {{ $loop->iteration }}
                    </div>
                    <div style="flex:1;min-width:0;">
                        <div style="font-weight:700;font-size:.82rem;color:var(--slate-900);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                            {{ Str::limit($product->name, 22) }}
                        </div>
                        <div style="font-size:.66rem;color:var(--slate-400);margin-top:1px;">
                            {{ $product->category->name ?? '—' }}
                        </div>
                    </div>
                    <div style="flex-shrink:0;text-align:right;">
                        <div style="font-family:var(--font-display);font-weight:800;font-size:.82rem;color:var(--slate-900);">{{ $product->sold_count ?? 0 }}</div>
                        <div style="font-size:.6rem;font-weight:600;color:var(--slate-400);">terjual</div>
                    </div>
                </div>
                @empty
                <div class="text-center py-4">
                    <div style="font-size:1.3rem;margin-bottom:6px;">📦</div>
                    <p style="font-size:.8rem;color:var(--slate-400);margin:0;">Belum ada data penjualan</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Pengguna Terbaru --}}
    <div class="col-lg-4">
        <div class="admin-card fade-up fade-up-2" style="height:100%;">
            <div class="admin-card-header">
                <div style="display:flex;align-items:center;gap:8px;">
                    <div class="card-header-icon"><i class="bi bi-person-fill-add"></i></div>
                    <span class="card-title">Pengguna Terbaru</span>
                </div>
                <a href="{{ route('admin.pengguna.index') }}" class="btn-info-sm">
                    Semua <i class="bi bi-arrow-right" style="font-size:.6rem;"></i>
                </a>
            </div>
            <div style="padding:4px 0;">
                @forelse($recentUsers ?? [] as $user)
                <div style="padding:10px 18px;{{ !$loop->last ? 'border-bottom:1px solid var(--slate-100);' : '' }}display:flex;align-items:center;gap:10px;">
                    <div class="user-avatar" style="width:32px;height:32px;font-size:.76rem;">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div style="flex:1;min-width:0;">
                        <div style="font-weight:700;font-size:.82rem;color:var(--slate-900);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                            {{ Str::limit($user->name, 20) }}
                        </div>
                        <div style="font-size:.66rem;color:var(--slate-400);margin-top:1px;">
                            {{ $user->created_at->diffForHumans() }}
                        </div>
                    </div>
                    <span class="status-badge {{ $user->isAdmin() ? 'badge-admin' : 'badge-customer' }}"
                          style="{{ $user->isAdmin() ? 'background:#FFF7ED;color:#C2410C;border:1px solid #FED7AA;' : 'background:var(--blue-50);color:var(--blue-700);border:1px solid var(--blue-100);' }}">
                        {{ $user->isAdmin() ? 'Admin' : 'Customer' }}
                    </span>
                </div>
                @empty
                <div class="text-center py-4">
                    <div style="font-size:1.3rem;margin-bottom:6px;">👤</div>
                    <p style="font-size:.8rem;color:var(--slate-400);margin:0;">Belum ada pengguna baru</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

{{-- ── SECONDARY STAT CARDS ───────────────────────────────── --}}
@php
$secStats = [
    ['Total Pengguna',  $stats['total_users']      ?? 0, 'bi-people-fill',              '#DBEAFE', '#1D4ED8', '#2563EB'],
    ['Artikel Tayang',  $stats['total_articles']   ?? 0, 'bi-newspaper',                '#BBF7D0', '#065F46', '#059669'],
    ['Produk Habis',    $stats['out_of_stock']      ?? 0, 'bi-exclamation-triangle-fill','#FECACA', '#991B1B', '#DC2626'],
    ['Pesanan Selesai', $stats['delivered_orders']  ?? 0, 'bi-check-circle-fill',        '#BBF7D0', '#065F46', '#059669'],
];
@endphp
<div class="row g-3">
    @foreach($secStats as [$label,$value,$icon,$bg2,$textColor,$iconColor])
    <div class="col-6 col-lg-3">
        <div class="sec-stat fade-up">
            <div class="sec-stat-icon" style="background:{{ $bg2 }};color:{{ $iconColor }};">
                <i class="bi {{ $icon }}"></i>
            </div>
            <div>
                <div class="sec-stat-val" style="color:{{ $textColor }};">{{ $value }}</div>
                <div class="sec-stat-label">{{ $label }}</div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection

@push('scripts')
@php
    $statPending  = $stats['pending_orders']    ?? 0;
    $statProcess  = $stats['processing_orders'] ?? 0;
    $statShipped  = $stats['shipped_orders']    ?? 0;
    $statDeliver  = $stats['delivered_orders']  ?? 0;
    $statCancel   = $stats['cancelled_orders']  ?? 0;
@endphp
<script>
// Animate progress bars on load
document.addEventListener('DOMContentLoaded', function () {
    const bars = document.querySelectorAll('.dist-bar');
    bars.forEach(bar => {
        const target = bar.style.width;
        bar.style.width = '0%';
        setTimeout(() => { bar.style.width = target; }, 100);
    });
});
</script>
@endpush