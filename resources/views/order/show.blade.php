@extends('layouts.app')
@section('title', 'Detail Pesanan — '.$order->order_number)

@push('styles')
<style>
/* ── TIMELINE ────────────────────────────────────── */
.timeline-wrap {
    display: flex;
    align-items: center;
    padding: 8px 0;
    overflow-x: auto;
    scrollbar-width: none;
}
.timeline-wrap::-webkit-scrollbar { display: none; }
.timeline-step {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    flex-shrink: 0;
    min-width: 80px;
}
.timeline-dot {
    width: 40px; height: 40px;
    border-radius: 50%;
    border: 2px solid var(--slate-200);
    background: white;
    display: flex; align-items: center; justify-content: center;
    font-size: .9rem;
    color: var(--slate-300);
    transition: all .2s;
    z-index: 1;
}
.timeline-label {
    font-size: .62rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .5px;
    color: var(--slate-300);
    white-space: nowrap;
    text-align: center;
    line-height: 1.3;
}
.timeline-step.done .timeline-dot { background: var(--blue-600); border-color: var(--blue-600); color: white; }
.timeline-step.done .timeline-label { color: var(--blue-600); }
.timeline-step.current .timeline-dot { border-color: var(--blue-500); color: var(--blue-600); box-shadow: 0 0 0 5px rgba(59,130,246,0.12); }
.timeline-step.current .timeline-label { color: var(--slate-900); font-weight: 800; }
.timeline-line {
    flex: 1;
    height: 2px;
    background: var(--slate-200);
    min-width: 28px;
    margin-bottom: 28px;
    flex-shrink: 0;
    transition: background .3s;
}
.timeline-line.done { background: var(--blue-500); }

/* ── DETAIL CARD ─────────────────────────────────── */
.detail-card {
    background: white;
    border: 1px solid var(--slate-200);
    border-radius: var(--radius-xl);
    overflow: hidden;
}
.detail-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 20px;
    border-bottom: 1px solid var(--slate-100);
    background: var(--slate-50);
}
.detail-card-title {
    font-size: .68rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: var(--slate-900);
    display: flex;
    align-items: center;
    gap: 7px;
}
.detail-card-title i { color: var(--blue-500); font-size: .85rem; }

/* ── PRODUCT ROW ─────────────────────────────────── */
.product-row {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 14px 20px;
    border-bottom: 1px solid var(--slate-100);
    transition: background .12s;
}
.product-row:last-child { border-bottom: none; }
.product-row:hover { background: var(--slate-50); }
.product-thumb {
    width: 54px; height: 54px;
    border-radius: var(--radius-md);
    background: var(--slate-100);
    border: 1px solid var(--slate-200);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.3rem;
    flex-shrink: 0;
    overflow: hidden;
}
.product-thumb img { width: 100%; height: 100%; object-fit: cover; }
.product-name  { font-weight: 700; font-size: .88rem; color: var(--slate-900); line-height: 1.35; }
.product-brand { font-size: .7rem; font-weight: 600; color: var(--slate-400); margin-top: 2px; }
.product-qty-tag {
    display: inline-flex; align-items: center; gap: 4px;
    background: var(--slate-100); color: var(--slate-600);
    font-size: .7rem; font-weight: 800;
    padding: 3px 9px; border-radius: 5px;
}
.product-unit-price { font-size: .73rem; color: var(--slate-400); font-weight: 600; }
.product-subtotal {
    font-family: var(--font-display);
    font-weight: 800; font-size: .95rem;
    color: var(--accent);
    white-space: nowrap; margin-left: auto; flex-shrink: 0;
}

/* ── PRICE ROWS ──────────────────────────────────── */
.price-summary { padding: 16px 20px; background: var(--slate-50); border-top: 1px solid var(--slate-100); }
.price-row {
    display: flex; justify-content: space-between; align-items: center;
    font-size: .83rem; padding: 7px 0;
    border-bottom: 1px solid var(--slate-100);
}
.price-row:last-child { border-bottom: none; }
.price-row .lbl { color: var(--slate-500); font-weight: 600; }
.price-row .val { font-weight: 700; color: var(--slate-800); }
.price-row.total { padding-top: 12px; margin-top: 4px; border-top: 2px solid var(--slate-200); border-bottom: none; }
.price-row.total .lbl { font-weight: 800; font-size: .88rem; color: var(--slate-900); }
.price-row.total .val { font-family: var(--font-display); font-weight: 800; font-size: 1.15rem; color: var(--accent); letter-spacing: -.3px; }

/* ── INFO ROWS ───────────────────────────────────── */
.info-body { padding: 16px 20px; }
.info-row {
    display: flex; justify-content: space-between; align-items: flex-start;
    gap: 12px; font-size: .83rem; padding: 10px 0;
    border-bottom: 1px solid var(--slate-100);
}
.info-row:last-child { border-bottom: none; padding-bottom: 0; }
.info-row .lbl { color: var(--slate-400); font-weight: 700; flex-shrink: 0; font-size: .8rem; }
.info-row .val { color: var(--slate-800); font-weight: 700; text-align: right; font-size: .85rem; }

/* ── PAYMENT STATUS BOX ──────────────────────────── */
.pay-status-box {
    display: flex; align-items: center; justify-content: space-between;
    margin-top: 14px; padding: 12px 14px;
    border-radius: var(--radius-md); gap: 8px;
}
.pay-status-box.paid   { background: #D1FAE5; }
.pay-status-box.unpaid { background: #FEF3C7; }
.pay-status-label { font-size: .78rem; font-weight: 700; display: flex; align-items: center; gap: 6px; }
.pay-status-box.paid   .pay-status-label { color: #065F46; }
.pay-status-box.unpaid .pay-status-label { color: #92400E; }
.pay-pill { font-size: .65rem; font-weight: 800; padding: 4px 10px; border-radius: 5px; letter-spacing: .3px; }
.pay-status-box.paid   .pay-pill { background: #A7F3D0; color: #065F46; }
.pay-status-box.unpaid .pay-pill { background: #FDE68A; color: #92400E; }

/* ── CANCELLED BANNER ────────────────────────────── */
.cancelled-banner {
    background: #FEF2F2; border: 1px solid #FECACA;
    border-radius: var(--radius-md); padding: 16px 20px;
    display: flex; align-items: center; gap: 12px;
}
.cancelled-banner i { color: #EF4444; font-size: 1.3rem; flex-shrink: 0; }
.cancelled-banner .cb-title { font-weight: 800; font-size: .9rem; color: #991B1B; margin-bottom: 2px; }
.cancelled-banner .cb-sub   { font-size: .75rem; color: #EF4444; font-weight: 600; }

/* ── ADDRESS BLOCK ───────────────────────────────── */
.address-block { padding: 18px 20px; }
.address-name  { font-family: var(--font-display); font-weight: 800; font-size: .95rem; color: var(--slate-900); letter-spacing: -.2px; margin-bottom: 5px; }
.address-phone { font-size: .8rem; font-weight: 700; color: var(--blue-600); margin-bottom: 10px; display: flex; align-items: center; gap: 6px; }
.address-text  { font-size: .82rem; color: var(--slate-500); line-height: 1.75; }
.address-note  { margin-top: 12px; padding: 10px 14px; background: var(--blue-50); border-left: 3px solid var(--blue-400); border-radius: 0 var(--radius-sm) var(--radius-sm) 0; }
.address-note-lbl  { font-size: .6rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: var(--blue-400); margin-bottom: 4px; }
.address-note-text { font-size: .8rem; color: var(--blue-700); font-style: italic; line-height: 1.55; }

/* ── RESPONSIVE ──────────────────────────────────── */
@media (max-width: 767px) {
    /* Breadcrumb */
    .breadcrumb-carage { padding: 8px 0; }
    .breadcrumb-item a,
    .breadcrumb-item.active { font-size: .68rem; }
    .breadcrumb-item + .breadcrumb-item::before { font-size: .68rem; }
    .breadcrumb-item.active {
        max-width: 120px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: inline-block;
        vertical-align: middle;
    }

    /* Container */
    .container.py-4 { padding-top: 16px !important; padding-bottom: 28px !important; }

    /* Page header */
    .section-eyebrow { font-size: .58rem; }
    .section-title   { font-size: 1.15rem !important; }
    .status-badge[style*="font-size:.78rem"] { font-size: .66rem !important; padding: 4px 10px !important; }
    div[style*="font-size:.7rem"][style*="margin-top:5px"] { font-size: .62rem !important; }

    /* Timeline card */
    .detail-card { border-radius: 12px; }
    .detail-card-header { padding: 10px 13px; }
    .detail-card-title { font-size: .6rem !important; gap: 5px; }
    .detail-card-title i { font-size: .78rem; }
    .detail-card-header span[style*="font-size:.85rem"] { font-size: .72rem !important; }

    /* Timeline inner */
    .detail-card > div[style*="padding:22px 28px"] { padding: 16px 14px !important; }
    .timeline-step { min-width: 58px; gap: 6px; }
    .timeline-dot  { width: 32px; height: 32px; font-size: .75rem; }
    .timeline-label { font-size: .54rem; }
    .timeline-line { min-width: 16px; margin-bottom: 24px; }

    /* Cancelled banner */
    .cancelled-banner { padding: 12px 13px; gap: 9px; border-radius: 9px; }
    .cancelled-banner i { font-size: 1.1rem; }
    .cancelled-banner .cb-title { font-size: .8rem; }
    .cancelled-banner .cb-sub   { font-size: .68rem; }

    /* Product rows */
    .product-row   { padding: 10px 13px; gap: 9px; }
    .product-thumb { width: 44px; height: 44px; font-size: 1.1rem; border-radius: 8px; }
    .product-name  { font-size: .78rem; }
    .product-brand { font-size: .62rem; }
    .product-qty-tag  { font-size: .62rem; padding: 2px 7px; }
    .product-unit-price { font-size: .65rem; }
    .product-subtotal { font-size: .82rem; }

    /* Price summary */
    .price-summary { padding: 12px 13px; }
    .price-row { font-size: .75rem; padding: 6px 0; }
    .price-row.total .lbl { font-size: .8rem; }
    .price-row.total .val { font-size: 1rem; }

    /* Info body */
    .info-body { padding: 12px 13px; }
    .info-row { font-size: .75rem; padding: 8px 0; gap: 8px; }
    .info-row .lbl { font-size: .72rem; }
    .info-row .val { font-size: .78rem; }

    /* Payment status */
    .pay-status-box { padding: 10px 12px; margin-top: 10px; border-radius: 9px; }
    .pay-status-label { font-size: .7rem; }
    .pay-pill { font-size: .6rem; padding: 3px 8px; }

    /* Address block */
    .address-block { padding: 13px 13px; }
    .address-name  { font-size: .85rem; }
    .address-phone { font-size: .72rem; margin-bottom: 7px; }
    .address-text  { font-size: .75rem; line-height: 1.7; }
    .address-note  { padding: 8px 11px; margin-top: 10px; }
    .address-note-lbl  { font-size: .56rem; }
    .address-note-text { font-size: .72rem; }

    /* Back button */
    a.btn-ghost[style*="padding:11px"] { font-size: .75rem !important; padding: 9px !important; border-radius: 9px !important; }

    /* Item count badge in header */
    span[style*="font-size:.7rem"][style*="color:var(--slate-400)"] { font-size: .62rem !important; }
}
</style>
@endpush

@section('content')

<div class="breadcrumb-carage">
    <div class="container">
        <nav><ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('order.history') }}">History</a></li>
            <li class="breadcrumb-item active">{{ $order->order_number }}</li>
        </ol></nav>
    </div>
</div>

<div class="container py-4 py-lg-5">

    {{-- Page Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4 fade-up">
        <div>
            <div class="section-eyebrow">Pesanan Anda</div>
            <h1 class="section-title mb-0">Detail <span class="hl">Pesanan</span></h1>
        </div>
        <div style="text-align:right;">
            <span class="status-badge status-{{ $order->status }}"
                  style="font-size:.78rem;padding:6px 14px;">
                {{ ucfirst($order->status) }}
            </span>
            <div style="font-size:.7rem;font-weight:600;color:var(--slate-400);margin-top:5px;">
                <i class="bi bi-calendar3 me-1"></i>{{ $order->created_at->format('d M Y, H:i') }} WIB
            </div>
        </div>
    </div>

    {{-- Timeline --}}
    <div class="detail-card mb-4 fade-up fade-up-1">
        <div class="detail-card-header">
            <div class="detail-card-title">
                <i class="bi bi-signpost-2"></i> Status Pengiriman
            </div>
            <span style="font-family:var(--font-display);font-weight:800;font-size:.85rem;color:var(--slate-500);letter-spacing:-.2px;">
                {{ $order->order_number }}
            </span>
        </div>
        <div style="padding:22px 28px;">
            @php
                $steps = [
                    ['bi-hourglass-split',  'Menunggu', 'pending'],
                    ['bi-gear-fill',        'Diproses', 'processing'],
                    ['bi-truck-front-fill', 'Dikirim',  'shipped'],
                    ['bi-house-check-fill', 'Diterima', 'delivered'],
                ];
                $statusOrder = ['pending','processing','shipped','delivered'];
                $currentIdx  = array_search($order->status, $statusOrder);
                if ($order->status === 'cancelled') $currentIdx = -1;
            @endphp

            @if($order->status === 'cancelled')
            <div class="cancelled-banner">
                <i class="bi bi-x-circle-fill"></i>
                <div>
                    <div class="cb-title">Pesanan Dibatalkan</div>
                    <div class="cb-sub">Pesanan ini telah dibatalkan dan tidak dapat diproses lebih lanjut.</div>
                </div>
            </div>
            @else
            <div class="timeline-wrap">
                @foreach($steps as $i => [$icon, $label, $key])
                <div class="timeline-step
                    {{ $currentIdx > $i  ? 'done'    : '' }}
                    {{ $currentIdx === $i ? 'current' : '' }}">
                    <div class="timeline-dot">
                        @if($currentIdx > $i)
                            <i class="bi bi-check-lg"></i>
                        @else
                            <i class="bi {{ $icon }}"></i>
                        @endif
                    </div>
                    <div class="timeline-label">{{ $label }}</div>
                </div>
                @if($i < count($steps) - 1)
                <div class="timeline-line {{ $currentIdx > $i ? 'done' : '' }}"></div>
                @endif
                @endforeach
            </div>
            @endif
        </div>
    </div>

    {{-- Main Grid --}}
    <div class="row g-4">

        {{-- Produk + Harga --}}
        <div class="col-lg-7">
            <div class="detail-card fade-up fade-up-2">
                <div class="detail-card-header">
                    <div class="detail-card-title">
                        <i class="bi bi-box-seam"></i> Produk Dipesan
                    </div>
                    <span style="font-size:.7rem;font-weight:700;color:var(--slate-400);">
                        {{ $order->orderItems->count() }} item
                    </span>
                </div>

                @foreach($order->orderItems as $item)
                <div class="product-row">
                    <div class="product-thumb">
                        @if($item->product && $item->product->image)
                            <img src="{{ asset('storage/'.$item->product->image) }}" alt="{{ $item->product->name }}">
                        @else
                            🔧
                        @endif
                    </div>
                    <div style="flex:1;min-width:0;">
                        <div class="product-name">{{ $item->product->name ?? 'Produk tidak tersedia' }}</div>
                        @if($item->product)
                        <div class="product-brand">{{ $item->product->brand }}</div>
                        @endif
                        <div class="d-flex align-items-center gap-2 mt-2 flex-wrap">
                            <span class="product-qty-tag">
                                <i class="bi bi-x" style="font-size:.65rem;"></i>{{ $item->quantity }}
                            </span>
                            <span class="product-unit-price">
                                Rp {{ number_format($item->price, 0, ',', '.') }} / pcs
                            </span>
                        </div>
                    </div>
                    <div class="product-subtotal">
                        Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}
                    </div>
                </div>
                @endforeach

                <div class="price-summary">
                    <div class="price-row">
                        <span class="lbl">Subtotal produk</span>
                        <span class="val">Rp {{ number_format($order->total_amount - $order->shipping_cost, 0, ',', '.') }}</span>
                    </div>
                    <div class="price-row">
                        <span class="lbl">Ongkos kirim</span>
                        <span class="val">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                    </div>
                    <div class="price-row total">
                        <span class="lbl">Total Pembayaran</span>
                        <span class="val">{{ $order->formatted_total }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Info + Alamat --}}
        <div class="col-lg-5 d-flex flex-column gap-4">

            <div class="detail-card fade-up fade-up-2">
                <div class="detail-card-header">
                    <div class="detail-card-title"><i class="bi bi-receipt"></i> Info Pesanan</div>
                </div>
                <div class="info-body">
                    @php
                        $methodConfig = [
                            'transfer' => ['bi-building',     'Transfer Bank', 'var(--blue-600)'],
                            'qris'     => ['bi-qr-code-scan', 'QRIS',          '#7C3AED'],
                            'cod'      => ['bi-cash-stack',   'COD',           '#059669'],
                        ];
                        $mc = $methodConfig[$order->payment_method] ?? ['bi-credit-card', 'Lainnya', 'var(--slate-500)'];
                    @endphp
                    <div class="info-row">
                        <span class="lbl">No. Pesanan</span>
                        <span class="val" style="font-family:var(--font-display);letter-spacing:-.2px;">{{ $order->order_number }}</span>
                    </div>
                    <div class="info-row">
                        <span class="lbl">Tanggal</span>
                        <span class="val">{{ $order->created_at->format('d M Y, H:i') }} WIB</span>
                    </div>
                    <div class="info-row">
                        <span class="lbl">Metode Bayar</span>
                        <span class="val" style="color:{{ $mc[2] }};display:flex;align-items:center;gap:5px;">
                            <i class="bi {{ $mc[0] }}"></i> {{ $mc[1] }}
                        </span>
                    </div>
                    <div class="pay-status-box {{ $order->payment_status === 'paid' ? 'paid' : 'unpaid' }}">
                        <span class="pay-status-label">
                            <i class="bi {{ $order->payment_status === 'paid' ? 'bi-check-circle-fill' : 'bi-clock-fill' }}"></i>
                            Status Pembayaran
                        </span>
                        <span class="pay-pill">{{ $order->payment_status === 'paid' ? 'LUNAS' : 'BELUM BAYAR' }}</span>
                    </div>
                </div>
            </div>

            <div class="detail-card fade-up fade-up-3">
                <div class="detail-card-header">
                    <div class="detail-card-title"><i class="bi bi-geo-alt-fill"></i> Alamat Pengiriman</div>
                </div>
                <div class="address-block">
                    <div class="address-name">{{ $order->recipient_name }}</div>
                    <div class="address-phone"><i class="bi bi-telephone-fill"></i> {{ $order->recipient_phone }}</div>
                    <div class="address-text">{{ $order->shipping_address }}</div>
                    @if($order->notes)
                    <div class="address-note">
                        <div class="address-note-lbl">Catatan Kurir</div>
                        <div class="address-note-text">{{ $order->notes }}</div>
                    </div>
                    @endif
                </div>
            </div>

            <a href="{{ route('order.history') }}"
               class="btn-ghost d-flex align-items-center justify-content-center gap-2
                      text-decoration-none fade-up fade-up-3"
               style="padding:11px;border-radius:var(--radius-md);">
                <i class="bi bi-arrow-left"></i> Kembali ke History
            </a>

        </div>
    </div>

</div>

@endsection