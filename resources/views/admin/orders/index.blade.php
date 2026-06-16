@extends('layouts.admin')
@section('title', 'Kelola Transaksi')
@section('page-title', 'Kelola Transaksi')

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

/* ══ FILTER BAR ═══════════════════════════════════════════ */
.filter-bar {
    background: white;
    border: 1px solid var(--slate-200);
    border-radius: var(--radius-xl);
    padding: 12px 16px;
    display: flex; align-items: center;
    justify-content: space-between;
    gap: 10px; flex-wrap: wrap;
    margin-bottom: 16px;
}
.filter-form {
    display: flex; align-items: center;
    gap: 8px; flex-wrap: wrap; flex: 1;
}
.filter-search { position: relative; }
.filter-search-icon {
    position: absolute; left: 10px; top: 50%;
    transform: translateY(-50%);
    color: var(--slate-400); font-size: .78rem;
    pointer-events: none;
}
.filter-input {
    border: 1.5px solid var(--slate-200);
    border-radius: var(--radius-md);
    padding: 7px 12px 7px 30px;
    font-size: .8rem; font-family: var(--font-body);
    color: var(--slate-900); width: 230px;
    background: var(--slate-50);
    transition: border-color .2s, box-shadow .2s;
}
.filter-input:focus {
    outline: none; border-color: var(--blue-400);
    box-shadow: 0 0 0 3px rgba(59,130,246,.1);
    background: white;
}
.filter-select {
    border: 1.5px solid var(--slate-200);
    border-radius: var(--radius-md);
    padding: 7px 10px; font-size: .8rem;
    font-family: var(--font-body); color: var(--slate-700);
    background: var(--slate-50); cursor: pointer;
    transition: border-color .2s;
}
.filter-select:focus { outline: none; border-color: var(--blue-400); background: white; }
.filter-meta {
    font-size: .73rem; font-weight: 600;
    color: var(--slate-400); white-space: nowrap; flex-shrink: 0;
}
.filter-meta strong { color: var(--slate-700); }

/* ══ TABLE CARD ═══════════════════════════════════════════ */
.table-card {
    background: white;
    border: 1px solid var(--slate-200);
    border-radius: var(--radius-xl);
    overflow: hidden;
}
.table-trx { border-collapse: separate; border-spacing: 0; width: 100%; }
.table-trx thead th {
    background: var(--slate-50);
    color: var(--slate-400);
    font-size: .63rem; font-weight: 800;
    text-transform: uppercase; letter-spacing: 1px;
    border: none;
    border-bottom: 1px solid var(--slate-200);
    padding: 11px 18px;
    white-space: nowrap;
}
.table-trx tbody td {
    padding: 13px 18px;
    vertical-align: middle;
    border-bottom: 1px solid var(--slate-100);
    font-size: .84rem;
}
.table-trx tbody tr:last-child td { border-bottom: none; }
.table-trx tbody tr { transition: background .12s; }
.table-trx tbody tr:hover td { background: var(--slate-50); }

/* ── Order number ── */
.order-number {
    font-family: var(--font-display);
    font-weight: 800; font-size: .88rem;
    color: var(--slate-900); letter-spacing: -.3px;
}

/* ── Customer cell ── */
.cust-cell { display: flex; align-items: center; gap: 10px; }
.cust-avatar {
    width: 30px; height: 30px; border-radius: 50%;
    background: var(--blue-100); color: var(--blue-600);
    font-family: var(--font-display); font-weight: 800;
    font-size: .72rem; display: flex; align-items: center;
    justify-content: center; flex-shrink: 0;
}
.cust-name  { font-weight: 700; font-size: .8rem; color: var(--slate-900); }
.cust-email { font-size: .67rem; color: var(--slate-400); margin-top: 1px; }

/* ── Total ── */
.trx-total {
    font-family: var(--font-display);
    font-weight: 800; font-size: .88rem;
    color: var(--slate-900);
}

/* ── Method badge ── */
.badge-metode {
    background: var(--slate-100); color: var(--slate-600);
    border: 1px solid var(--slate-200);
    padding: 3px 8px; border-radius: 5px;
    font-size: .62rem; font-weight: 800; letter-spacing: .5px;
    text-transform: uppercase;
}

/* ── Status badges ── */
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

/* ── Payment badges ── */
.badge-paid, .badge-unpaid {
    padding: 3px 9px; border-radius: 5px;
    font-size: .63rem; font-weight: 800;
    text-transform: uppercase; letter-spacing: .4px;
    display: inline-block;
}
.badge-paid   { background: #ECFDF5; color: #059669; border: 1px solid #D1FAE5; }
.badge-unpaid { background: #FEF2F2; color: #DC2626; border: 1px solid #FECACA; }

/* ── Date ── */
.trx-date { font-weight: 700; font-size: .78rem; color: var(--slate-700); }
.trx-time { font-size: .67rem; color: var(--slate-400); margin-top: 1px; }

/* ── Aksi ── */
.aksi-wrap { display: flex; align-items: center; gap: 6px; justify-content: flex-end; }
.aksi-btn {
    display: inline-flex; align-items: center; gap: 4px;
    padding: 5px 12px; border-radius: var(--radius-sm);
    font-size: .73rem; font-weight: 700;
    text-decoration: none; border: none; cursor: pointer;
    font-family: var(--font-body); transition: all .15s;
    white-space: nowrap;
}
.aksi-view       { background: var(--blue-50); color: var(--blue-700); border: 1px solid var(--blue-100); }
.aksi-view:hover { background: var(--blue-100); color: var(--blue-800); }

/* ══ EMPTY STATE ══════════════════════════════════════════ */
.empty-state {
    padding: 60px 20px; text-align: center;
    display: flex; flex-direction: column; align-items: center;
}
.empty-icon {
    width: 56px; height: 56px;
    background: var(--slate-100); border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.4rem; color: var(--slate-300);
    margin-bottom: 14px;
}
.empty-title {
    font-family: var(--font-display); font-weight: 800;
    font-size: 1rem; color: var(--slate-700); margin-bottom: 6px;
}
.empty-sub { font-size: .78rem; color: var(--slate-400); max-width: 300px; line-height: 1.6; }

/* ══ PAGINATION ═══════════════════════════════════════════ */
.pag-bar {
    padding: 13px 18px;
    border-top: 1px solid var(--slate-100);
    display: flex; align-items: center;
    justify-content: space-between;
    gap: 12px; flex-wrap: wrap;
}
.pag-info { font-size: .72rem; font-weight: 600; color: var(--slate-400); }
.pag-info strong { color: var(--slate-700); }
.pag-actions { display: flex; align-items: center; gap: 5px; }
.pag-btn {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 6px 14px; border-radius: var(--radius-md);
    font-size: .75rem; font-weight: 700;
    text-decoration: none; transition: all .15s;
    border: 1.5px solid var(--slate-200);
    background: white; color: var(--slate-600);
}
.pag-btn:hover { background: var(--slate-50); color: var(--slate-900); border-color: var(--slate-300); }
.pag-btn-primary { background: var(--blue-600); color: white; border-color: var(--blue-600); }
.pag-btn-primary:hover { background: var(--blue-700); border-color: var(--blue-700); color: white; }
.pag-btn-disabled { opacity: .35; cursor: not-allowed; pointer-events: none; }
.pag-pages { display: flex; align-items: center; gap: 3px; }
.pag-page {
    width: 30px; height: 30px; border-radius: var(--radius-sm);
    display: flex; align-items: center; justify-content: center;
    font-size: .75rem; font-weight: 700; text-decoration: none;
    color: var(--slate-500); background: white;
    border: 1.5px solid var(--slate-200); transition: all .15s;
}
.pag-page:hover { background: var(--slate-50); color: var(--slate-900); border-color: var(--slate-300); }
.pag-page-active { background: var(--blue-600) !important; color: white !important; border-color: var(--blue-600) !important; }

/* ══ RESPONSIVE ═══════════════════════════════════════════ */
@media (max-width: 991px) {
    /* Hide lower-priority columns on tablet */
    .col-hide-tablet { display: none !important; }
    .filter-input { width: 180px; }
    .table-trx thead th,
    .table-trx tbody td { padding: 10px 14px; }
}

@media (max-width: 767px) {
    /* Page header */
    .page-header { margin-bottom: 14px; gap: 10px; }
    .page-header-eyebrow { font-size: .56rem; margin-bottom: 3px; }
    .page-header-title   { font-size: 1.1rem; }
    .page-header-sub     { font-size: .66rem; margin-top: 3px; }

    /* Filter bar */
    .filter-bar  { padding: 10px 12px; gap: 7px; border-radius: 12px; }
    .filter-form { gap: 6px; }
    .filter-search { width: 100%; }
    .filter-input  { width: 100%; font-size: .75rem; padding: 6px 10px 6px 28px; border-radius: 8px; }
    .filter-select { font-size: .7rem; padding: 6px 7px; border-radius: 8px; flex: 1; min-width: 0; }
    .filter-form .btn-carage,
    .filter-form .btn-ghost { font-size: .68rem; padding: 6px 10px; border-radius: 7px; flex-shrink: 0; }
    .filter-meta { display: none; }

    /* Table card */
    .table-card { border-radius: 12px; }

    /* Hide extra columns — keep No.Pesanan + Total + Status + Aksi */
    .col-hide-mobile { display: none !important; }

    /* Compact table */
    .table-trx thead th { font-size: .58rem; padding: 8px 10px; }
    .table-trx tbody td { font-size: .75rem; padding: 10px 10px; }

    /* Order number + customer stacked */
    .order-number { font-size: .75rem; }
    .order-sub    { font-size: .62rem; color: var(--slate-400); font-weight: 600; margin-top: 2px; }

    /* Total */
    .trx-total { font-size: .78rem; }

    /* Status & payment badges compact */
    .status-badge,
    .badge-paid,
    .badge-unpaid { font-size: .58rem; padding: 2px 6px; }

    /* Aksi: icon only */
    .aksi-btn      { padding: 5px 9px; font-size: .7rem; border-radius: 6px; }
    .aksi-btn span { display: none; }

    /* Pagination */
    .pag-bar  { padding: 10px 12px; gap: 8px; }
    .pag-info { font-size: .62rem; }
    .pag-pages { display: none; }
    .pag-btn  { font-size: .66rem; padding: 5px 10px; border-radius: 7px; }

    /* Empty state */
    .empty-state { padding: 32px 16px; }
    .empty-icon  { width: 44px; height: 44px; font-size: 1.1rem; margin-bottom: 10px; }
    .empty-title { font-size: .88rem; }
    .empty-sub   { font-size: .72rem; }
}
</style>
@endpush

@section('content')

{{-- ── PAGE HEADER ── --}}
<div class="page-header">
    <div>
        <div class="page-header-eyebrow">Manajemen Toko</div>
        <h2 class="page-header-title">Kelola Transaksi</h2>
        <p class="page-header-sub">{{ $orders->total() }} transaksi tercatat</p>
    </div>
</div>

{{-- ── FILTER BAR ── --}}
<div class="filter-bar">
    <form action="{{ route('admin.transaksi.index') }}" method="GET" class="filter-form">

        <div class="filter-search">
            <i class="bi bi-search filter-search-icon"></i>
            <input type="text" name="cari" class="filter-input"
                   placeholder="Cari no. pesanan, nama pelanggan..."
                   value="{{ request('cari') }}">
        </div>

        <select name="status" class="filter-select" onchange="this.form.submit()">
            <option value="">Semua Status</option>
            <option value="pending"    {{ request('status')==='pending'    ? 'selected' : '' }}>Pending</option>
            <option value="processing" {{ request('status')==='processing' ? 'selected' : '' }}>Processing</option>
            <option value="shipped"    {{ request('status')==='shipped'    ? 'selected' : '' }}>Shipped</option>
            <option value="delivered"  {{ request('status')==='delivered'  ? 'selected' : '' }}>Delivered</option>
            <option value="cancelled"  {{ request('status')==='cancelled'  ? 'selected' : '' }}>Cancelled</option>
        </select>

        <select name="bayar" class="filter-select col-hide-mobile" onchange="this.form.submit()">
            <option value="">Semua Pembayaran</option>
            <option value="paid"   {{ request('bayar')==='paid'   ? 'selected' : '' }}>Lunas</option>
            <option value="unpaid" {{ request('bayar')==='unpaid' ? 'selected' : '' }}>Belum Bayar</option>
        </select>

        <button type="submit" class="btn-carage btn-carage-sm">
            <i class="bi bi-funnel"></i> <span class="d-none d-sm-inline">Filter</span>
        </button>

        @if(request()->hasAny(['cari','status','bayar']))
        <a href="{{ route('admin.transaksi.index') }}" class="btn-ghost btn-carage-sm text-decoration-none">
            <i class="bi bi-x-lg"></i> <span class="d-none d-sm-inline">Reset</span>
        </a>
        @endif
    </form>

    <div class="filter-meta d-none d-md-block">
        <strong>{{ $orders->count() }}</strong> / <strong>{{ $orders->total() }}</strong> transaksi
    </div>
</div>

{{-- ── TABLE ── --}}
<div class="table-card">
    <div class="table-responsive">
        <table class="table-trx">
            <thead>
                <tr>
                    <th>No. Pesanan</th>
                    <th class="col-hide-mobile">Pelanggan</th>
                    <th>Total</th>
                    <th class="col-hide-tablet col-hide-mobile">Metode</th>
                    <th>Status</th>
                    <th class="col-hide-mobile">Bayar</th>
                    <th class="col-hide-tablet col-hide-mobile">Tanggal</th>
                    <th style="text-align:right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td>
                        <span class="order-number">{{ $order->order_number }}</span>
                        {{-- Mobile: customer name + date below order number --}}
                        <div class="order-sub d-md-none">
                            {{ Str::limit($order->user->name, 18) }}
                            · {{ $order->created_at->format('d M Y') }}
                        </div>
                    </td>

                    <td class="col-hide-mobile">
                        <div class="cust-cell">
                            <div class="cust-avatar">{{ strtoupper(substr($order->user->name,0,1)) }}</div>
                            <div>
                                <div class="cust-name">{{ Str::limit($order->user->name, 20) }}</div>
                                <div class="cust-email">{{ Str::limit($order->user->email, 24) }}</div>
                            </div>
                        </div>
                    </td>

                    <td>
                        <span class="trx-total">{{ $order->formatted_total }}</span>
                    </td>

                    <td class="col-hide-tablet col-hide-mobile">
                        <span class="badge-metode">{{ strtoupper($order->payment_method) }}</span>
                    </td>

                    <td>
                        <span class="status-badge status-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
                    </td>

                    <td class="col-hide-mobile">
                        @if($order->payment_status === 'paid')
                            <span class="badge-paid">Lunas</span>
                        @else
                            <span class="badge-unpaid">Belum</span>
                        @endif
                    </td>

                    <td class="col-hide-tablet col-hide-mobile">
                        <div class="trx-date">{{ $order->created_at->format('d M Y') }}</div>
                        <div class="trx-time">{{ $order->created_at->format('H:i') }}</div>
                    </td>

                    <td>
                        <div class="aksi-wrap">
                            <a href="{{ route('admin.transaksi.show', $order->id) }}"
                               class="aksi-btn aksi-view">
                                <i class="bi bi-eye-fill"></i>
                                <span>Detail</span>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8">
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="bi bi-receipt"></i>
                            </div>
                            <div class="empty-title">
                                {{ request()->hasAny(['cari','status','bayar']) ? 'Tidak ada transaksi yang cocok' : 'Belum ada transaksi' }}
                            </div>
                            <div class="empty-sub">
                                {{ request()->hasAny(['cari','status','bayar']) ? 'Coba ubah filter atau kata kunci pencarian' : 'Transaksi akan muncul di sini setelah pelanggan melakukan pembelian' }}
                            </div>
                            @if(request()->hasAny(['cari','status','bayar']))
                            <a href="{{ route('admin.transaksi.index') }}" class="btn-ghost text-decoration-none mt-3 d-inline-flex align-items-center gap-2">
                                <i class="bi bi-arrow-counterclockwise"></i> Reset Filter
                            </a>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- ── PAGINATION ── --}}
    @if($orders->hasPages())
    <div class="pag-bar">
        <div class="pag-info">
            Hal. <strong>{{ $orders->currentPage() }}</strong> / <strong>{{ $orders->lastPage() }}</strong>
            &nbsp;·&nbsp;
            {{ $orders->firstItem() }}–{{ $orders->lastItem() }} dari {{ $orders->total() }} transaksi
        </div>
        <div class="pag-actions">
            @if($orders->onFirstPage())
                <span class="pag-btn pag-btn-disabled">
                    <i class="bi bi-arrow-left"></i>
                    <span class="d-none d-sm-inline">Sebelumnya</span>
                </span>
            @else
                <a href="{{ $orders->previousPageUrl() }}" class="pag-btn">
                    <i class="bi bi-arrow-left"></i>
                    <span class="d-none d-sm-inline">Sebelumnya</span>
                </a>
            @endif

            <div class="pag-pages">
                @for($p = max(1, $orders->currentPage()-1); $p <= min($orders->lastPage(), $orders->currentPage()+1); $p++)
                    @if($p === $orders->currentPage())
                        <span class="pag-page pag-page-active">{{ $p }}</span>
                    @else
                        <a href="{{ $orders->url($p) }}" class="pag-page">{{ $p }}</a>
                    @endif
                @endfor
            </div>

            @if($orders->hasMorePages())
                <a href="{{ $orders->nextPageUrl() }}" class="pag-btn pag-btn-primary">
                    <span class="d-none d-sm-inline">Selanjutnya</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            @else
                <span class="pag-btn pag-btn-disabled">
                    <span class="d-none d-sm-inline">Selanjutnya</span>
                    <i class="bi bi-arrow-right"></i>
                </span>
            @endif
        </div>
    </div>
    @endif
</div>

@endsection