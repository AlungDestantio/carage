@extends('layouts.admin')
@section('title', 'Detail Transaksi')
@section('page-title', 'Detail Transaksi')

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
.page-header-meta {
    display: flex; align-items: center; gap: 8px;
    margin-top: 6px; flex-wrap: wrap;
}
.order-number-badge {
    font-family: var(--font-display);
    font-weight: 800; font-size: .9rem;
    color: var(--slate-700); letter-spacing: -.2px;
}

/* ══ DETAIL CARD ══════════════════════════════════════════ */
.detail-card {
    background: white;
    border: 1px solid var(--slate-200);
    border-radius: var(--radius-xl);
    overflow: hidden;
    margin-bottom: 16px;
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
    background: var(--blue-50);
    border-radius: 7px;
    display: flex; align-items: center; justify-content: center;
    color: var(--blue-600); font-size: .78rem;
    flex-shrink: 0;
}
.detail-card-header-title {
    font-size: .68rem; font-weight: 800;
    text-transform: uppercase; letter-spacing: 1px;
    color: var(--slate-500);
}
.detail-card-body { padding: 18px; }

/* ══ ITEMS TABLE ══════════════════════════════════════════ */
.table-items {
    border-collapse: separate;
    border-spacing: 0;
    width: 100%;
    table-layout: fixed;
}
.table-items thead th {
    background: var(--slate-50);
    color: var(--slate-400);
    font-size: .63rem; font-weight: 800;
    text-transform: uppercase; letter-spacing: 1px;
    border: none;
    border-bottom: 1px solid var(--slate-200);
    padding: 10px 18px;
    white-space: nowrap;
    overflow: hidden;
}
.table-items tbody td {
    padding: 13px 18px;
    vertical-align: middle;
    border-bottom: 1px solid var(--slate-100);
    font-size: .84rem;
    overflow: hidden;
}
.table-items tbody tr:last-child td { border-bottom: none; }
.table-items tbody tr:hover td { background: var(--slate-50); }

/* Column widths — desktop */
.col-produk   { width: auto; }
.col-harga    { width: 130px; }
.col-qty      { width: 70px; }
.col-subtotal { width: 130px; }

.item-thumb {
    width: 44px; height: 44px;
    background: var(--slate-100);
    border-radius: var(--radius-md);
    border: 1px solid var(--slate-200);
    overflow: hidden; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.1rem; color: var(--slate-300);
}
.item-thumb img { width: 100%; height: 100%; object-fit: cover; }
.item-name     { font-weight: 700; font-size: .84rem; color: var(--slate-900); }
.item-brand    { font-size: .68rem; color: var(--slate-400); margin-top: 2px; }
.item-price    { font-weight: 600; font-size: .82rem; color: var(--slate-700); }
.item-qty {
    background: var(--blue-50); color: var(--blue-700);
    border: 1px solid var(--blue-100);
    padding: 3px 9px; border-radius: 6px;
    font-size: .72rem; font-weight: 800;
    display: inline-block;
}
.item-subtotal {
    font-family: var(--font-display);
    font-weight: 800; font-size: .9rem;
    color: var(--slate-900); text-align: right;
}

/* ── Tfoot ── */
.tfoot-row td {
    padding: 9px 18px;
    background: var(--slate-50);
    border-top: 1px solid var(--slate-100);
    font-size: .8rem;
    overflow: hidden;
}
.tfoot-row .tfoot-label-cell {
    text-align: right;
    font-weight: 700;
    color: var(--slate-500);
}
.tfoot-row .tfoot-value-cell {
    text-align: right;
    font-weight: 700;
    color: var(--slate-800);
}
.tfoot-total td {
    padding: 13px 18px;
    background: var(--blue-50);
    border-top: 1px solid var(--blue-100);
    overflow: hidden;
}
.tfoot-total-label {
    text-align: right;
    font-size: .78rem; font-weight: 800;
    color: var(--slate-700); text-transform: uppercase;
    letter-spacing: .5px;
}
.tfoot-total-val {
    text-align: right;
    font-family: var(--font-display);
    font-weight: 800; font-size: 1.05rem;
    color: var(--blue-700);
}

/* ══ STATUS TIMELINE ══════════════════════════════════════ */
.status-timeline {
    display: flex; align-items: center;
    padding: 10px 0 16px;
    overflow-x: auto;
    scrollbar-width: none;
}
.status-timeline::-webkit-scrollbar { display: none; }
.timeline-step {
    display: flex; flex-direction: column;
    align-items: center; gap: 6px;
    flex-shrink: 0;
}
.timeline-dot {
    width: 30px; height: 30px; border-radius: 50%;
    background: var(--slate-100); color: var(--slate-400);
    border: 2px solid var(--slate-200);
    display: flex; align-items: center; justify-content: center;
    font-size: .72rem; font-weight: 800;
    transition: all .2s;
}
.timeline-step.done .timeline-dot {
    background: var(--blue-600); color: white; border-color: var(--blue-600);
}
.timeline-step.current .timeline-dot {
    background: white; color: var(--blue-600);
    border-color: var(--blue-500);
    box-shadow: 0 0 0 4px rgba(59,130,246,.15);
}
.timeline-label {
    font-size: .62rem; font-weight: 700;
    color: var(--slate-400);
    text-transform: uppercase; letter-spacing: .5px;
    white-space: nowrap;
}
.timeline-step.done .timeline-label,
.timeline-step.current .timeline-label { color: var(--blue-600); }
.timeline-line {
    flex: 1; height: 2px;
    background: var(--slate-200);
    margin-bottom: 22px; min-width: 24px;
    transition: background .2s;
}
.timeline-line.done { background: var(--blue-500); }

/* Status update form */
.status-form {
    display: flex; gap: 10px;
    align-items: flex-end; flex-wrap: wrap;
    padding-top: 4px;
}
.status-form-group { flex: 1; min-width: 160px; }
.form-label {
    font-weight: 700; font-size: .73rem;
    color: var(--slate-600); margin-bottom: 6px;
    display: block;
}
.form-select {
    border: 1.5px solid var(--slate-200);
    border-radius: var(--radius-md);
    font-size: .82rem; padding: 9px 12px;
    font-family: var(--font-body);
    color: var(--slate-900);
    background: var(--slate-50);
    transition: border-color .2s, box-shadow .2s;
    width: 100%;
}
.form-select:focus {
    outline: none; border-color: var(--blue-400);
    box-shadow: 0 0 0 3px rgba(59,130,246,.1);
    background: white;
}
.btn-update {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 9px 22px;
    background: var(--blue-600); color: white;
    border: none; border-radius: var(--radius-md);
    font-size: .8rem; font-weight: 700;
    font-family: var(--font-body);
    cursor: pointer; transition: background .15s;
    white-space: nowrap;
}
.btn-update:hover { background: var(--blue-700); }

/* ══ INFO ROWS ══════════════════════════════════════════ */
.info-row {
    display: flex; justify-content: space-between;
    align-items: flex-start; gap: 12px;
    margin-bottom: 10px;
}
.info-row:last-child { margin-bottom: 0; }
.info-label {
    font-size: .74rem; font-weight: 600;
    color: var(--slate-400); flex-shrink: 0;
    display: flex; align-items: center; gap: 4px;
}
.info-value {
    font-size: .78rem; font-weight: 700;
    color: var(--slate-900); text-align: right;
    line-height: 1.5;
}

/* Customer row */
.cust-row {
    display: flex; align-items: center; gap: 12px;
    margin-bottom: 14px; padding-bottom: 14px;
    border-bottom: 1px solid var(--slate-100);
}
.cust-avatar-lg {
    width: 40px; height: 40px; border-radius: 50%;
    background: var(--blue-100); color: var(--blue-600);
    font-family: var(--font-display); font-weight: 800;
    font-size: .95rem;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.cust-name-lg  { font-weight: 800; font-size: .88rem; color: var(--slate-900); }
.cust-email-lg { font-size: .7rem; color: var(--slate-400); margin-top: 1px; }

/* Notes */
.notes-box {
    margin-top: 12px;
    background: var(--blue-50); border: 1px solid var(--blue-100);
    border-radius: var(--radius-md); padding: 11px 13px;
}
.notes-box-label {
    font-size: .62rem; font-weight: 800;
    color: var(--blue-600); text-transform: uppercase;
    letter-spacing: 1px; margin-bottom: 5px;
    display: flex; align-items: center; gap: 4px;
}
.notes-box-text { font-size: .78rem; color: var(--slate-600); line-height: 1.6; font-style: italic; }

/* Total row */
.total-row {
    display: flex; justify-content: space-between; align-items: center;
    padding-top: 14px; margin-top: 14px;
    border-top: 1px solid var(--slate-100);
}
.total-row-label { font-weight: 700; font-size: .82rem; color: var(--slate-700); }
.total-row-val {
    font-family: var(--font-display);
    font-weight: 800; font-size: 1.05rem; color: var(--blue-700);
}

/* Badges */
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

.badge-paid, .badge-unpaid {
    padding: 3px 9px; border-radius: 5px; font-size: .63rem;
    font-weight: 800; text-transform: uppercase; letter-spacing: .4px; display: inline-block;
}
.badge-paid   { background: #ECFDF5; color: #059669; border: 1px solid #D1FAE5; }
.badge-unpaid { background: #FEF2F2; color: #DC2626; border: 1px solid #FECACA; }
.badge-metode {
    background: var(--slate-100); color: var(--slate-600);
    border: 1px solid var(--slate-200);
    padding: 3px 8px; border-radius: 5px;
    font-size: .62rem; font-weight: 800;
    letter-spacing: .5px; text-transform: uppercase;
}

/* ══ RESPONSIVE ══════════════════════════════════════════ */
@media (max-width: 767px) {

    /* Page header */
    .page-header { margin-bottom: 14px; gap: 10px; }
    .page-header-eyebrow { font-size: .56rem; margin-bottom: 3px; }
    .page-header-title   { font-size: 1.1rem; }
    .order-number-badge  { font-size: .78rem; }
    .page-header .btn-ghost { font-size: .72rem; padding: 6px 11px; border-radius: 8px; }
    .page-header-meta    { gap: 6px; margin-top: 5px; }

    /* Detail cards */
    .detail-card { border-radius: 12px; margin-bottom: 12px; }
    .detail-card-header { padding: 10px 13px; }
    .detail-card-header-icon { width: 22px; height: 22px; font-size: .7rem; border-radius: 6px; }
    .detail-card-header-title { font-size: .6rem; }
    .detail-card-header span[style*="font-size:.78rem"] { font-size: .66rem !important; }
    .detail-card-body { padding: 13px; }

    /* ── Items table mobile ──
       Kolom: Produk (auto) | Qty (56px) | Subtotal (90px)
       Kolom Harga Satuan disembunyikan via .col-hide-mobile-items
    */
    .col-hide-mobile-items { display: none !important; }

    .col-produk   { width: auto; }
    .col-qty      { width: 56px; }
    .col-subtotal { width: 90px; }

    .table-items thead th { font-size: .58rem; padding: 8px 10px; }
    .table-items tbody td { font-size: .75rem; padding: 10px 10px; }

    .item-thumb  { width: 36px; height: 36px; font-size: .9rem; border-radius: 7px; }
    .item-name   { font-size: .74rem; }
    .item-brand  { font-size: .6rem; }
    .item-qty    { font-size: .62rem; padding: 2px 7px; border-radius: 5px; }
    .item-subtotal { font-size: .78rem; }

    /* Tfoot mobile */
    .tfoot-row td  { font-size: .72rem; padding: 7px 10px; }
    .tfoot-total td { padding: 10px 10px; }
    .tfoot-total-label { font-size: .7rem; }
    .tfoot-total-val   { font-size: .9rem; }

    /* Timeline */
    .timeline-dot   { width: 26px; height: 26px; font-size: .62rem; }
    .timeline-label { font-size: .54rem; }
    .timeline-line  { min-width: 16px; margin-bottom: 20px; }

    /* Status form */
    .status-form { flex-direction: column; gap: 8px; }
    .status-form-group { min-width: 100%; }
    .form-label   { font-size: .68rem; margin-bottom: 4px; }
    .form-select  { font-size: .78rem; padding: 8px 10px; border-radius: 8px; }
    .btn-update   { width: 100%; justify-content: center; font-size: .78rem; padding: 10px; border-radius: 9px; }

    /* Right panel cards */
    .cust-avatar-lg { width: 34px; height: 34px; font-size: .82rem; }
    .cust-name-lg   { font-size: .78rem; }
    .cust-email-lg  { font-size: .62rem; }
    .cust-row       { gap: 9px; margin-bottom: 12px; padding-bottom: 12px; }

    .info-label { font-size: .66rem; }
    .info-value { font-size: .72rem; }
    .info-row   { margin-bottom: 8px; gap: 8px; }

    .notes-box { padding: 9px 10px; border-radius: 8px; margin-top: 10px; }
    .notes-box-label { font-size: .58rem; margin-bottom: 3px; }
    .notes-box-text  { font-size: .7rem; }

    .total-row       { padding-top: 11px; margin-top: 11px; }
    .total-row-label { font-size: .75rem; }
    .total-row-val   { font-size: .9rem; }

    .badge-metode,
    .badge-paid,
    .badge-unpaid,
    .status-badge { font-size: .58rem; padding: 2px 7px; }

    /* Row gutter */
    .row.g-4 { --bs-gutter-y: 0; }
}
</style>
@endpush

@section('content')

{{-- ── PAGE HEADER ── --}}
<div class="page-header">
    <div>
        <div class="page-header-eyebrow">Manajemen Toko</div>
        <h2 class="page-header-title">Detail Transaksi</h2>
        <div class="page-header-meta">
            <span class="order-number-badge">{{ $order->order_number }}</span>
            <span class="status-badge status-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
        </div>
    </div>
    <a href="{{ route('admin.transaksi.index') }}" class="btn-ghost text-decoration-none d-inline-flex align-items-center gap-2">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="row g-4">

    {{-- ── LEFT COLUMN ── --}}
    <div class="col-lg-8">

        {{-- Produk Dipesan --}}
        <div class="detail-card">
            <div class="detail-card-header">
                <div class="detail-card-header-left">
                    <div class="detail-card-header-icon"><i class="bi bi-bag-check-fill"></i></div>
                    <span class="detail-card-header-title">Produk Dipesan</span>
                </div>
                <span style="font-family:var(--font-display);font-size:.78rem;font-weight:800;color:var(--slate-400);">
                    {{ $order->order_number }}
                </span>
            </div>
            <div class="table-responsive">
                <table class="table-items">
                    <colgroup>
                        <col class="col-produk">
                        <col class="col-harga col-hide-mobile-items">
                        <col class="col-qty">
                        <col class="col-subtotal">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th class="col-hide-mobile-items">Harga Satuan</th>
                            <th>Qty</th>
                            <th style="text-align:right;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderItems as $item)
                        <tr>
                            <td>
                                <div style="display:flex;align-items:center;gap:12px;">
                                    <div class="item-thumb">
                                        @if($item->product && $item->product->image)
                                            <img src="{{ asset('storage/'.$item->product->image) }}" alt="">
                                        @else
                                            <i class="bi bi-box-seam"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="item-name">{{ $item->product->name ?? 'Produk dihapus' }}</div>
                                        @if($item->product && $item->product->brand)
                                        <div class="item-brand">{{ $item->product->brand }}</div>
                                        @endif
                                        {{-- Mobile: tampilkan harga di bawah nama produk --}}
                                        <div class="d-lg-none" style="font-size:.65rem;color:var(--slate-400);font-weight:600;margin-top:2px;">
                                            Rp {{ number_format($item->price, 0, ',', '.') }} / pcs
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="col-hide-mobile-items">
                                <span class="item-price">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                            </td>
                            <td><span class="item-qty">{{ $item->quantity }}x</span></td>
                            <td><div class="item-subtotal">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</div></td>
                        </tr>
                        @endforeach
                    </tbody>

                    {{--
                        TFOOT: Setiap <td> mapped 1-to-1 ke kolom aslinya.
                        Kolom "Harga Satuan" diberi class col-hide-mobile-items agar
                        ikut hidden di mobile — tidak ada ruang kosong sisa.
                    --}}
                    <tfoot>
                        {{-- Baris Subtotal Produk --}}
                        <tr class="tfoot-row">
                            <td class="tfoot-label-cell">Subtotal Produk</td>
                            <td class="col-hide-mobile-items"></td>
                            <td></td>
                            <td class="tfoot-value-cell">
                                Rp {{ number_format($order->total_amount - $order->shipping_cost, 0, ',', '.') }}
                            </td>
                        </tr>
                        {{-- Baris Ongkir --}}
                        <tr class="tfoot-row">
                            <td class="tfoot-label-cell">Ongkir</td>
                            <td class="col-hide-mobile-items"></td>
                            <td></td>
                            <td class="tfoot-value-cell">
                                Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}
                            </td>
                        </tr>
                        {{-- Baris Total --}}
                        <tr class="tfoot-total">
                            <td class="tfoot-total-label">Total Pembayaran</td>
                            <td class="col-hide-mobile-items"></td>
                            <td></td>
                            <td class="tfoot-total-val">{{ $order->formatted_total }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        {{-- Update Status --}}
        <div class="detail-card">
            <div class="detail-card-header">
                <div class="detail-card-header-left">
                    <div class="detail-card-header-icon"><i class="bi bi-arrow-repeat"></i></div>
                    <span class="detail-card-header-title">Update Status Pesanan</span>
                </div>
                <span class="status-badge status-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
            </div>
            <div class="detail-card-body">

                {{-- Timeline --}}
                @php
                    $steps = ['pending','processing','shipped','delivered'];
                    $currentIdx = array_search($order->status, $steps);
                    $cancelled  = $order->status === 'cancelled';
                @endphp
                <div class="status-timeline">
                    @foreach($steps as $i => $step)
                    <div class="timeline-step
                        {{ !$cancelled && $currentIdx >= $i ? 'done' : '' }}
                        {{ !$cancelled && $currentIdx == $i ? 'current' : '' }}">
                        <div class="timeline-dot">
                            @if(!$cancelled && $currentIdx > $i)
                                <i class="bi bi-check-lg"></i>
                            @else
                                {{ $i + 1 }}
                            @endif
                        </div>
                        <div class="timeline-label">{{ ucfirst($step) }}</div>
                    </div>
                    @if(!$loop->last)
                    <div class="timeline-line {{ !$cancelled && $currentIdx > $i ? 'done' : '' }}"></div>
                    @endif
                    @endforeach
                </div>

                <form action="{{ route('admin.transaksi.updateStatus', $order->id) }}" method="POST"
                      class="status-form">
                    @csrf @method('PATCH')
                    <div class="status-form-group">
                        <label class="form-label">Ubah Status ke</label>
                        <select name="status" class="form-select">
                            <option value="pending"    {{ $order->status==='pending'    ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status==='processing' ? 'selected' : '' }}>Processing</option>
                            <option value="shipped"    {{ $order->status==='shipped'    ? 'selected' : '' }}>Shipped</option>
                            <option value="delivered"  {{ $order->status==='delivered'  ? 'selected' : '' }}>Delivered</option>
                            <option value="cancelled"  {{ $order->status==='cancelled'  ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <button type="submit" class="btn-update">
                        <i class="bi bi-check-lg"></i> Update Status
                    </button>
                </form>

            </div>
        </div>

    </div>

    {{-- ── RIGHT COLUMN ── --}}
    <div class="col-lg-4">

        {{-- Info Pelanggan --}}
        <div class="detail-card">
            <div class="detail-card-header">
                <div class="detail-card-header-left">
                    <div class="detail-card-header-icon"><i class="bi bi-person-fill"></i></div>
                    <span class="detail-card-header-title">Info Pelanggan</span>
                </div>
            </div>
            <div class="detail-card-body">
                <div class="cust-row">
                    <div class="cust-avatar-lg">{{ strtoupper(substr($order->user->name,0,1)) }}</div>
                    <div>
                        <div class="cust-name-lg">{{ $order->user->name }}</div>
                        <div class="cust-email-lg">{{ $order->user->email }}</div>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-label"><i class="bi bi-person-check"></i> Penerima</div>
                    <div class="info-value">{{ $order->recipient_name }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label"><i class="bi bi-telephone"></i> Telepon</div>
                    <div class="info-value">{{ $order->recipient_phone }}</div>
                </div>
                <div class="info-row" style="align-items:flex-start;">
                    <div class="info-label"><i class="bi bi-geo-alt"></i> Alamat</div>
                    <div class="info-value">{{ $order->shipping_address }}</div>
                </div>
                @if($order->notes)
                <div class="notes-box">
                    <div class="notes-box-label"><i class="bi bi-chat-left-text"></i> Catatan</div>
                    <div class="notes-box-text">{{ $order->notes }}</div>
                </div>
                @endif
            </div>
        </div>

        {{-- Info Pembayaran --}}
        <div class="detail-card">
            <div class="detail-card-header">
                <div class="detail-card-header-left">
                    <div class="detail-card-header-icon"><i class="bi bi-credit-card-fill"></i></div>
                    <span class="detail-card-header-title">Info Pembayaran</span>
                </div>
            </div>
            <div class="detail-card-body">
                <div class="info-row">
                    <div class="info-label">Metode</div>
                    <div><span class="badge-metode">{{ strtoupper($order->payment_method) }}</span></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Status Bayar</div>
                    <div>
                        @if($order->payment_status === 'paid')
                            <span class="badge-paid">Lunas</span>
                        @else
                            <span class="badge-unpaid">Belum Bayar</span>
                        @endif
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-label">Tanggal Order</div>
                    <div class="info-value">{{ $order->created_at->format('d M Y, H:i') }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Diperbarui</div>
                    <div class="info-value">{{ $order->updated_at->diffForHumans() }}</div>
                </div>
                <div class="total-row">
                    <span class="total-row-label">Total Pembayaran</span>
                    <span class="total-row-val">{{ $order->formatted_total }}</span>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection