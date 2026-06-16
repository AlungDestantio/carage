@extends('layouts.admin')
@section('title', 'Detail Pengguna')
@section('page-title', 'Detail Pengguna')

@push('styles')
<style>

/* ══ PAGE HEADER ══════════════════════════════════════════ */
.page-header {
    display: flex; align-items: flex-end;
    justify-content: space-between; gap: 16px;
    flex-wrap: wrap; margin-bottom: 24px;
}
.page-header-eyebrow {
    font-size: .6rem; font-weight: 800;
    letter-spacing: 2px; text-transform: uppercase;
    color: var(--blue-500); margin-bottom: 5px;
}
.page-header-title {
    font-family: var(--font-display);
    font-weight: 800; font-size: 1.45rem;
    color: var(--slate-900); letter-spacing: -.5px; margin: 0;
}
.page-header-sub {
    font-size: .74rem; color: var(--slate-400);
    font-weight: 600; margin: 4px 0 0;
}

/* ══ PROFILE CARD ═════════════════════════════════════════ */
.profile-card {
    background: white;
    border: 1px solid var(--slate-200);
    border-radius: var(--radius-xl);
    overflow: hidden;
    margin-bottom: 16px;
}
.profile-banner {
    background: var(--slate-900);
    height: 76px; position: relative;
    overflow: hidden;
}
.profile-banner::before {
    content: ''; position: absolute; inset: 0;
    background-image:
        linear-gradient(rgba(59,130,246,.07) 1px, transparent 1px),
        linear-gradient(90deg, rgba(59,130,246,.07) 1px, transparent 1px);
    background-size: 26px 26px;
}
.profile-avatar {
    width: 60px; height: 60px; border-radius: 50%;
    color: white; font-family: var(--font-display);
    font-weight: 800; font-size: 1.4rem;
    display: flex; align-items: center; justify-content: center;
    border: 3px solid white;
    position: absolute; bottom: -30px; left: 50%;
    transform: translateX(-50%);
    box-shadow: 0 4px 12px rgba(0,0,0,.15);
}
.profile-body {
    padding: 40px 20px 14px;
    text-align: center;
}
.profile-name {
    font-family: var(--font-display); font-weight: 800;
    font-size: 1rem; color: var(--slate-900); letter-spacing: -.3px;
}
.profile-email { font-size: .72rem; color: var(--slate-400); margin-top: 3px; }

/* Role badges */
.badge-role {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 3px 9px; border-radius: 5px;
    font-size: .63rem; font-weight: 800;
    text-transform: uppercase; letter-spacing: .4px;
    white-space: nowrap;
}
.badge-admin    { background: #FFF7ED; color: #C2410C; border: 1px solid #FED7AA; }
.badge-customer { background: var(--blue-50); color: var(--blue-700); border: 1px solid var(--blue-100); }

/* Detail rows */
.profile-details { padding: 14px 18px; }
.detail-divider  { height: 1px; background: var(--slate-100); margin: 0; }
.detail-row {
    display: flex; justify-content: space-between;
    align-items: flex-start; gap: 12px;
    padding: 10px 0;
    border-bottom: 1px solid var(--slate-100);
}
.detail-row:last-child { border-bottom: none; }
.detail-label {
    font-size: .72rem; font-weight: 600;
    color: var(--slate-400);
    flex-shrink: 0;
    min-width: 80px;
    display: flex; align-items: flex-start; gap: 4px;
    padding-top: 1px;
}
.detail-value {
    font-size: .78rem; font-weight: 700;
    color: var(--slate-900); text-align: right;
    line-height: 1.6;
    word-break: break-word;
    flex: 1;
    min-width: 0;
}

/* Danger zone */
.danger-zone { padding: 0 16px 16px; }
.btn-danger-full {
    width: 100%;
    display: flex; align-items: center; justify-content: center; gap: 6px;
    background: #FEF2F2; color: #DC2626;
    border: 1px solid #FECACA;
    border-radius: var(--radius-md);
    padding: 9px; font-weight: 700; font-size: .78rem;
    font-family: var(--font-body); cursor: pointer;
    transition: all .15s;
}
.btn-danger-full:hover { background: #FEE2E2; color: #991B1B; border-color: #FCA5A5; }

/* ══ STAT MINI CARDS ══════════════════════════════════════ */
.stat-mini {
    background: white;
    border: 1px solid var(--slate-200);
    border-radius: var(--radius-lg);
    padding: 14px 10px;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    gap: 6px;
    min-width: 0;
    height: 100%;
}
.stat-mini-icon {
    width: 36px; height: 36px; border-radius: var(--radius-sm);
    display: flex; align-items: center; justify-content: center;
    font-size: .9rem; flex-shrink: 0;
}
.stat-mini-val {
    font-family: var(--font-display); font-weight: 800;
    font-size: 1.05rem; color: var(--slate-900);
    letter-spacing: -.5px; line-height: 1;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 100%;
}
.stat-mini-label {
    font-size: .62rem; font-weight: 700;
    color: var(--slate-400); text-transform: uppercase;
    letter-spacing: .5px;
    line-height: 1.35;
    text-align: center;
}

/* ══ ORDER TABLE CARD ═════════════════════════════════════ */
.detail-card {
    background: white;
    border: 1px solid var(--slate-200);
    border-radius: var(--radius-xl);
    overflow: hidden;
}
.detail-card-header {
    padding: 13px 18px;
    border-bottom: 1px solid var(--slate-100);
    display: flex; align-items: center;
    justify-content: space-between; gap: 10px;
    background: var(--slate-50);
}
.detail-card-header-left {
    display: flex; align-items: center; gap: 8px;
}
.detail-card-header-icon {
    width: 26px; height: 26px;
    background: var(--blue-50); border-radius: 7px;
    display: flex; align-items: center; justify-content: center;
    color: var(--blue-600); font-size: .78rem; flex-shrink: 0;
}
.detail-card-header-title {
    font-size: .68rem; font-weight: 800;
    text-transform: uppercase; letter-spacing: 1px; color: var(--slate-500);
}

/* Order table */
.table-order { border-collapse: separate; border-spacing: 0; width: 100%; }
.table-order thead th {
    background: var(--slate-50); color: var(--slate-400);
    font-size: .63rem; font-weight: 800;
    text-transform: uppercase; letter-spacing: 1px;
    border: none; border-bottom: 1px solid var(--slate-200);
    padding: 10px 18px; white-space: nowrap;
}
.table-order tbody td {
    padding: 12px 18px; vertical-align: middle;
    border-bottom: 1px solid var(--slate-100);
    font-size: .84rem;
}
.table-order tbody tr:last-child td { border-bottom: none; }
.table-order tbody tr:hover td { background: var(--slate-50); }

.order-num {
    font-family: var(--font-display); font-weight: 800;
    font-size: .86rem; color: var(--slate-900);
}
.order-total {
    font-family: var(--font-display); font-weight: 800;
    font-size: .86rem; color: var(--slate-900);
}
.order-date { font-weight: 700; font-size: .76rem; color: var(--slate-700); }
.order-ago  { font-size: .66rem; color: var(--slate-400); margin-top: 1px; }

/* Status badges */
.status-badge {
    padding: 3px 9px; border-radius: 5px;
    font-size: .63rem; font-weight: 800;
    text-transform: uppercase; letter-spacing: .4px;
    display: inline-block; white-space: nowrap;
}
.status-pending    { background: #FEF3C7; color: #92400E; border: 1px solid #FDE68A; }
.status-processing { background: var(--blue-50); color: var(--blue-700); border: 1px solid var(--blue-200); }
.status-shipped    { background: #EDE9FE; color: #5B21B6; border: 1px solid #DDD6FE; }
.status-delivered  { background: #ECFDF5; color: #059669; border: 1px solid #D1FAE5; }
.status-cancelled  { background: #FEF2F2; color: #DC2626; border: 1px solid #FECACA; }

/* Aksi */
.aksi-btn {
    display: inline-flex; align-items: center; gap: 4px;
    padding: 5px 12px; border-radius: var(--radius-sm);
    font-size: .73rem; font-weight: 700;
    text-decoration: none; border: none; cursor: pointer;
    font-family: var(--font-body); transition: all .15s;
}
.aksi-view-blue       { background: var(--blue-50); color: var(--blue-700); border: 1px solid var(--blue-100); }
.aksi-view-blue:hover { background: var(--blue-100); color: var(--blue-800); }

/* Empty state */
.empty-state-sm {
    padding: 32px 20px; text-align: center;
    display: flex; flex-direction: column; align-items: center;
}
.empty-icon-sm {
    width: 46px; height: 46px;
    background: var(--slate-100); border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.2rem; color: var(--slate-300);
    margin-bottom: 10px;
}
.empty-title-sm {
    font-family: var(--font-display); font-weight: 800;
    font-size: .9rem; color: var(--slate-700); margin-bottom: 4px;
}
.empty-sub-sm { font-size: .74rem; color: var(--slate-400); line-height: 1.6; }

/* View all link */
.btn-view-all {
    display: inline-flex; align-items: center; gap: 4px;
    font-size: .72rem; font-weight: 700;
    color: var(--blue-600); text-decoration: none;
    padding: 4px 10px; border-radius: 6px;
    border: 1px solid var(--blue-100);
    background: var(--blue-50); transition: all .15s;
}
.btn-view-all:hover { background: var(--blue-100); color: var(--blue-800); }

/* ══ RESPONSIVE ══════════════════════════════════════════ */
@media (max-width: 767px) {
    /* Page header */
    .page-header { margin-bottom: 14px; gap: 10px; }
    .page-header-eyebrow { font-size: .56rem; margin-bottom: 3px; }
    .page-header-title   { font-size: 1.1rem; }
    .page-header-sub     { font-size: .62rem; margin-top: 3px;
                           white-space: nowrap; overflow: hidden;
                           text-overflow: ellipsis; max-width: 180px; }
    .page-header > div:last-child { gap: 6px !important; }
    .page-header .btn-ghost { font-size: .72rem; padding: 7px 11px; border-radius: 8px; }

    /* Profile card */
    .profile-card   { border-radius: 12px; }
    .profile-banner { height: 60px; }
    .profile-avatar { width: 50px; height: 50px; font-size: 1.15rem; bottom: -25px; }
    .profile-body   { padding: 34px 16px 12px; }
    .profile-name   { font-size: .9rem; }
    .profile-email  { font-size: .65rem; margin-top: 2px; }
    .badge-role     { font-size: .58rem; padding: 2px 7px; margin-top: 8px; }

    .profile-details { padding: 11px 14px; }
    .detail-row      { padding: 8px 0; gap: 8px; }
    .detail-label    { font-size: .65rem; min-width: 70px; }
    .detail-value    { font-size: .72rem; }

    .danger-zone         { padding: 0 14px 14px; }
    .btn-danger-full     { font-size: .72rem; padding: 8px; border-radius: 8px; }

    /* Stat mini cards — fixed mobile layout */
    .stat-mini {
        padding: 10px 6px;
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 5px;
        border-radius: 10px;
    }
    .stat-mini-icon  { width: 28px; height: 28px; font-size: .72rem; border-radius: 7px; }
    .stat-mini-val   { font-size: .78rem; letter-spacing: -.3px; }
    .stat-mini-label { font-size: .52rem; margin-top: 0; line-height: 1.3; }

    .row.g-3 { --bs-gutter-x: 8px; --bs-gutter-y: 8px; }
    .mb-4    { margin-bottom: 12px !important; }

    /* Detail card */
    .detail-card { border-radius: 12px; }
    .detail-card-header { padding: 10px 13px; }
    .detail-card-header-icon  { width: 22px; height: 22px; font-size: .7rem; border-radius: 6px; }
    .detail-card-header-title { font-size: .6rem; }
    .btn-view-all { font-size: .62rem; padding: 3px 8px; border-radius: 5px; }

    /* Order table — hide Tanggal col, keep No + Total + Status + Aksi */
    .col-hide-mobile { display: none !important; }
    .table-order thead th { font-size: .58rem; padding: 8px 10px; }
    .table-order tbody td { font-size: .72rem; padding: 10px 10px; }
    .order-num   { font-size: .72rem; }
    .order-total { font-size: .72rem; }
    .status-badge { font-size: .56rem; padding: 2px 6px; }
    .aksi-btn     { padding: 4px 8px; font-size: .68rem; border-radius: 6px; }

    /* Mobile: show date below order number */
    .order-mobile-date {
        display: block !important;
        font-size: .6rem; color: var(--slate-400);
        font-weight: 600; margin-top: 2px;
    }

    /* Empty state */
    .empty-state-sm  { padding: 24px 14px; }
    .empty-icon-sm   { width: 38px; height: 38px; font-size: 1rem; margin-bottom: 8px; }
    .empty-title-sm  { font-size: .82rem; }
    .empty-sub-sm    { font-size: .68rem; }

    /* Row fix — no horizontal overflow */
    .row.g-4 {
        --bs-gutter-x: 12px;
        --bs-gutter-y: 12px;
        margin-right: 0;
        margin-left: 0;
    }
    .row.g-4 > [class*="col-"] {
        padding-right: calc(var(--bs-gutter-x) * .5);
        padding-left:  calc(var(--bs-gutter-x) * .5);
    }
}
</style>
@endpush

@section('content')

{{-- ── PAGE HEADER ── --}}
<div class="page-header">
    <div>
        <div class="page-header-eyebrow">Pengguna</div>
        <h2 class="page-header-title">Detail Pengguna</h2>
        <p class="page-header-sub">{{ $pengguna->email }}</p>
    </div>
    <div style="display:flex;gap:8px;align-items:center;flex-shrink:0;">
        <a href="{{ route('admin.pengguna.index') }}"
           class="btn-ghost text-decoration-none d-inline-flex align-items-center gap-2">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="row g-4">

    {{-- ── LEFT: PROFIL ── --}}
    <div class="col-lg-4">

        <div class="profile-card">
            <div class="profile-banner">
                <div class="profile-avatar"
                     style="background:{{ $pengguna->isAdmin() ? 'var(--accent)' : 'var(--blue-600)' }};">
                    {{ strtoupper(substr($pengguna->name, 0, 1)) }}
                </div>
            </div>

            <div class="profile-body">
                <div class="profile-name">{{ $pengguna->name }}</div>
                <div class="profile-email">{{ $pengguna->email }}</div>
                <div style="margin-top:10px;">
                    @if($pengguna->isAdmin())
                        <span class="badge-role badge-admin">
                            <i class="bi bi-shield-fill-check"></i> Admin
                        </span>
                    @else
                        <span class="badge-role badge-customer">
                            <i class="bi bi-person-fill"></i> Customer
                        </span>
                    @endif
                </div>
            </div>

            <div class="detail-divider"></div>

            <div class="profile-details">
                <div class="detail-row">
                    <div class="detail-label"><i class="bi bi-telephone"></i> Telepon</div>
                    <div class="detail-value">{{ $pengguna->phone ?? '—' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label"><i class="bi bi-geo-alt"></i> Alamat</div>
                    <div class="detail-value">{{ $pengguna->address ?? '—' }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label"><i class="bi bi-calendar3"></i> Bergabung</div>
                    <div class="detail-value">{{ $pengguna->created_at->format('d M Y') }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label"><i class="bi bi-clock"></i> Terakhir aktif</div>
                    <div class="detail-value">{{ $pengguna->updated_at->diffForHumans() }}</div>
                </div>
            </div>

            @if(!$pengguna->isAdmin())
            <div class="detail-divider"></div>
            <div class="danger-zone" style="padding-top:12px;">
                <form action="{{ route('admin.pengguna.destroy', $pengguna->id) }}" method="POST"
                      onsubmit="return confirm('Hapus pengguna \'{{ addslashes($pengguna->name) }}\'?\nSeluruh data terkait akan ikut terhapus.')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-danger-full">
                        <i class="bi bi-trash3-fill"></i> Hapus Pengguna Ini
                    </button>
                </form>
            </div>
            @endif
        </div>

    </div>

    {{-- ── RIGHT: ORDERS ── --}}
    <div class="col-lg-8">

        {{-- Stats mini --}}
        @php
            $totalOrders = $pengguna->orders()->count();
            $totalSpend  = $pengguna->orders()->where('payment_status','paid')->sum('total_amount');
            $doneOrders  = $pengguna->orders()->where('status','delivered')->count();
        @endphp
        <div class="row g-3 mb-4">
            <div class="col-4">
                <div class="stat-mini">
                    <div class="stat-mini-icon" style="background:var(--blue-50);color:var(--blue-600);">
                        <i class="bi bi-bag-check-fill"></i>
                    </div>
                    <div class="stat-mini-val">{{ $totalOrders }}</div>
                    <div class="stat-mini-label">Total Pesanan</div>
                </div>
            </div>
            <div class="col-4">
                <div class="stat-mini">
                    <div class="stat-mini-icon" style="background:#ECFDF5;color:#059669;">
                        <i class="bi bi-cash-coin"></i>
                    </div>
                    <div class="stat-mini-val">Rp {{ number_format($totalSpend/1000,0,',','.').'K' }}</div>
                    <div class="stat-mini-label">Total Belanja</div>
                </div>
            </div>
            <div class="col-4">
                <div class="stat-mini">
                    <div class="stat-mini-icon" style="background:#ECFDF5;color:#059669;">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div class="stat-mini-val">{{ $doneOrders }}</div>
                    <div class="stat-mini-label">Selesai</div>
                </div>
            </div>
        </div>

        {{-- Riwayat pesanan --}}
        <div class="detail-card">
            <div class="detail-card-header">
                <div class="detail-card-header-left">
                    <div class="detail-card-header-icon"><i class="bi bi-receipt"></i></div>
                    <span class="detail-card-header-title">Riwayat Pesanan Terakhir</span>
                </div>
                <a href="{{ route('admin.transaksi.index') }}?user={{ $pengguna->id }}"
                   class="btn-view-all">
                    Lihat Semua <i class="bi bi-arrow-right" style="font-size:.6rem;"></i>
                </a>
            </div>
            <div class="table-responsive">
                <table class="table-order">
                    <thead>
                        <tr>
                            <th>No. Pesanan</th>
                            <th class="col-hide-mobile">Total</th>
                            <th>Status</th>
                            <th class="col-hide-mobile">Tanggal</th>
                            <th style="text-align:right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td>
                                <span class="order-num">{{ $order->order_number }}</span>
                                {{-- Mobile: total + date below order number --}}
                                <div class="order-mobile-date d-none">
                                    {{ $order->formatted_total }}
                                    · {{ $order->created_at->format('d M Y') }}
                                </div>
                            </td>
                            <td class="col-hide-mobile">
                                <span class="order-total">{{ $order->formatted_total }}</span>
                            </td>
                            <td>
                                <span class="status-badge status-{{ $order->status }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="col-hide-mobile">
                                <div class="order-date">{{ $order->created_at->format('d M Y') }}</div>
                                <div class="order-ago">{{ $order->created_at->diffForHumans() }}</div>
                            </td>
                            <td style="text-align:right;">
                                <a href="{{ route('admin.transaksi.show', $order->id) }}"
                                   class="aksi-btn aksi-view-blue">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state-sm">
                                    <div class="empty-icon-sm">
                                        <i class="bi bi-cart-x"></i>
                                    </div>
                                    <div class="empty-title-sm">Belum ada pesanan</div>
                                    <div class="empty-sub-sm">Pengguna ini belum pernah melakukan pembelian</div>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

@endsection