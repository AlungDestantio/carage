@extends('layouts.app')
@section('title', 'History Transaksi')

@push('styles')
<style>
/* ── STATUS FILTER TABS ──────────────────────────── */
.status-filter-wrap {
    display: flex;
    gap: 6px;
    flex-wrap: wrap;
    margin-bottom: 20px;
    padding: 4px 0;
}
.status-tab {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    border-radius: 10px;
    border: 1.5px solid var(--slate-200);
    background: white;
    font-family: var(--font-body);
    font-size: .78rem;
    font-weight: 700;
    color: var(--slate-500);
    text-decoration: none;
    transition: all .15s;
    white-space: nowrap;
}
.status-tab:hover { border-color: var(--blue-300); color: var(--blue-600); background: var(--blue-50); }
.status-tab.active { background: var(--blue-600); border-color: var(--blue-600); color: white; }
.status-tab i { font-size: .78rem; }

/* ── ORDER CARD ──────────────────────────────────── */
.order-card {
    background: white;
    border: 1px solid var(--slate-200);
    border-radius: 16px;
    overflow: hidden;
    transition: box-shadow .2s, border-color .2s, transform .2s;
}
.order-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 32px rgba(37,99,235,0.09);
    border-color: var(--blue-200);
}
.order-card::before {
    content: '';
    display: block;
    height: 3px;
    background: var(--blue-500);
}
.order-card.status-pending::before    { background: #F59E0B; }
.order-card.status-processing::before { background: var(--blue-500); }
.order-card.status-shipped::before    { background: #8B5CF6; }
.order-card.status-delivered::before  { background: #10B981; }
.order-card.status-cancelled::before  { background: #EF4444; }

.order-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    padding: 14px 20px 12px;
    border-bottom: 1px solid var(--slate-100);
}
.order-number {
    font-family: var(--font-display);
    font-weight: 800;
    font-size: .95rem;
    color: var(--slate-900);
    letter-spacing: -.3px;
    display: flex;
    align-items: center;
    gap: 7px;
}
.order-number-icon {
    width: 28px; height: 28px;
    background: var(--blue-50);
    border-radius: 7px;
    display: flex; align-items: center; justify-content: center;
    font-size: .8rem;
    color: var(--blue-600);
    flex-shrink: 0;
}
.order-meta {
    font-size: .7rem;
    font-weight: 600;
    color: var(--slate-400);
    margin-top: 2px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.order-card-body {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr auto;
    gap: 0;
    align-items: center;
}
.order-info-cell {
    padding: 16px 20px;
    border-right: 1px solid var(--slate-100);
}
.order-info-cell:last-child { border-right: none; }
.order-info-label {
    font-size: .62rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--slate-400);
    margin-bottom: 5px;
}
.order-info-value {
    font-size: .85rem;
    font-weight: 700;
    color: var(--slate-800);
    display: flex;
    align-items: center;
    gap: 5px;
}
.order-total-value {
    font-family: var(--font-display);
    font-weight: 800;
    font-size: 1.05rem;
    color: var(--accent);
    letter-spacing: -.3px;
}
.pay-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: .67rem;
    font-weight: 800;
    padding: 4px 9px;
    border-radius: 6px;
}
.pay-paid   { background: #D1FAE5; color: #059669; }
.pay-unpaid { background: #FEF3C7; color: #92400E; }

.order-action-cell {
    padding: 16px 20px;
    display: flex;
    align-items: center;
    justify-content: flex-end;
}
.btn-detail {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: var(--blue-600);
    color: white;
    font-family: var(--font-body);
    font-weight: 700;
    font-size: .78rem;
    padding: 8px 16px;
    border-radius: 9px;
    text-decoration: none;
    transition: all .15s;
    white-space: nowrap;
}
.btn-detail:hover { background: var(--blue-700); color: white; transform: translateX(2px); }

/* ── EMPTY STATE ─────────────────────────────────── */
.empty-order {
    background: white;
    border: 1px solid var(--slate-200);
    border-radius: 16px;
    padding: 60px 32px;
    text-align: center;
}

/* ── RESPONSIVE ──────────────────────────────────── */
@media (max-width: 991px) {
    .order-card-body { grid-template-columns: 1fr 1fr; }
    .order-info-cell:nth-child(2) { border-right: none; }
    .order-action-cell {
        grid-column: 1 / -1;
        border-top: 1px solid var(--slate-100);
        padding: 12px 20px;
        justify-content: flex-end;
    }
}
@media (max-width: 767px) {
    /* Breadcrumb */
    .breadcrumb-carage { padding: 8px 0; }
    .breadcrumb-item a,
    .breadcrumb-item.active { font-size: .68rem; }
    .breadcrumb-item + .breadcrumb-item::before { font-size: .68rem; }

    /* Container */
    .container.py-5 { padding-top: 18px !important; padding-bottom: 28px !important; }

    /* Page header */
    .section-eyebrow { font-size: .58rem; }
    .section-title   { font-size: 1.2rem !important; letter-spacing: -.3px; }
    .mb-4.fade-up    { margin-bottom: 12px !important; }
    .mb-4.fade-up span[style*="font-size:.75rem"] { font-size: .66rem !important; }

    /* Status tabs — horizontal scroll */
    .status-filter-wrap {
        flex-wrap: nowrap;
        overflow-x: auto;
        scrollbar-width: none;
        -webkit-overflow-scrolling: touch;
        padding-bottom: 2px;
        margin-bottom: 14px;
    }
    .status-filter-wrap::-webkit-scrollbar { display: none; }
    .status-tab { font-size: .68rem; padding: 6px 11px; border-radius: 8px; gap: 4px; }
    .status-tab i { font-size: .68rem; }

    /* Order card */
    .order-card { border-radius: 12px; }
    .order-card-header { padding: 11px 13px 9px; gap: 8px; }
    .order-number { font-size: .82rem; gap: 6px; }
    .order-number-icon { width: 24px; height: 24px; font-size: .7rem; border-radius: 6px; }
    .order-meta { font-size: .62rem; gap: 5px; margin-top: 2px; }
    .status-badge { font-size: .6rem !important; padding: 3px 8px !important; }

    /* Info grid — 2 kolom */
    .order-card-body { grid-template-columns: 1fr 1fr; }
    .order-info-cell { padding: 11px 13px; }
    .order-info-cell:nth-child(2) { border-right: none; }
    .order-info-label { font-size: .56rem; letter-spacing: .5px; margin-bottom: 4px; }
    .order-info-value { font-size: .75rem; gap: 4px; }
    .order-total-value { font-size: .88rem; }
    .pay-badge { font-size: .6rem; padding: 3px 7px; border-radius: 5px; }

    /* Action cell */
    .order-action-cell {
        grid-column: 1 / -1;
        border-top: 1px solid var(--slate-100);
        padding: 10px 13px;
        justify-content: stretch;
    }
    .btn-detail { width: 100%; justify-content: center; font-size: .75rem; padding: 8px 14px; border-radius: 8px; }

    /* Empty state */
    .empty-order { padding: 36px 18px; border-radius: 12px; }
    .empty-order > div[style*="width:72px"] {
        width: 56px !important; height: 56px !important;
        font-size: 1.4rem !important;
        margin-bottom: 14px !important;
    }
    .empty-order h5 { font-size: .95rem !important; margin-bottom: 6px !important; }
    .empty-order p  { font-size: .75rem !important; margin-bottom: 16px !important; }
    .empty-order .btn-carage,
    .empty-order .btn-carage-outline { font-size: .75rem; padding: 8px 16px; border-radius: 9px; }

    /* Pagination */
    .mt-4.d-flex.justify-content-center { margin-top: 18px !important; }
    .page-link { font-size: .72rem !important; padding: 5px 9px !important; }
}
</style>
@endpush

@section('content')

<div class="breadcrumb-carage">
    <div class="container">
        <nav><ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">History Transaksi</li>
        </ol></nav>
    </div>
</div>

<div class="container py-5">

    {{-- Page Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4 fade-up">
        <div>
            <div class="section-eyebrow">Akun Saya</div>
            <h1 class="section-title">History <span class="hl">Transaksi</span></h1>
        </div>
        @if($orders->total() > 0)
        <span style="font-size:.75rem;font-weight:700;color:var(--slate-400);">
            <i class="bi bi-receipt me-1"></i>{{ $orders->total() }} pesanan
        </span>
        @endif
    </div>

    {{-- Status Filter Tabs --}}
    @php
        $activeStatus = request('status', 'all');
        $statusTabs = [
            'all'        => ['label' => 'Semua',      'icon' => 'bi-grid-3x3-gap'],
            'pending'    => ['label' => 'Menunggu',   'icon' => 'bi-hourglass-split'],
            'processing' => ['label' => 'Diproses',   'icon' => 'bi-arrow-repeat'],
            'shipped'    => ['label' => 'Dikirim',    'icon' => 'bi-truck'],
            'delivered'  => ['label' => 'Selesai',    'icon' => 'bi-check-circle'],
            'cancelled'  => ['label' => 'Dibatalkan', 'icon' => 'bi-x-circle'],
        ];
    @endphp
    <div class="status-filter-wrap fade-up">
        @foreach($statusTabs as $key => $tab)
        <a href="{{ route('order.history') }}{{ $key !== 'all' ? '?status='.$key : '' }}"
           class="status-tab {{ $activeStatus === $key ? 'active' : '' }}">
            <i class="bi {{ $tab['icon'] }}"></i>
            {{ $tab['label'] }}
        </a>
        @endforeach
    </div>

    @if($orders->count())

    <div class="d-flex flex-column gap-3">
        @foreach($orders as $order)
        @php
            $methodConfig = [
                'transfer' => ['bi-building',     'Transfer Bank', 'var(--blue-600)'],
                'qris'     => ['bi-qr-code-scan', 'QRIS',          '#7C3AED'],
                'cod'      => ['bi-cash-stack',   'COD',           '#059669'],
            ];
            $mc = $methodConfig[$order->payment_method] ?? ['bi-credit-card', 'Lainnya', 'var(--slate-500)'];
        @endphp

        <div class="order-card status-{{ $order->status }} fade-up">
            <div class="order-card-header">
                <div>
                    <div class="order-number">
                        <span class="order-number-icon"><i class="bi bi-receipt"></i></span>
                        {{ $order->order_number }}
                    </div>
                    <div class="order-meta">
                        <span><i class="bi bi-calendar3 me-1"></i>{{ $order->created_at->format('d M Y') }}</span>
                        <span style="opacity:.4;">·</span>
                        <span>{{ $order->created_at->format('H:i') }} WIB</span>
                    </div>
                </div>
                <span class="status-badge status-{{ $order->status }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

            <div class="order-card-body">
                <div class="order-info-cell">
                    <div class="order-info-label">Total Pembayaran</div>
                    <div class="order-total-value">{{ $order->formatted_total }}</div>
                </div>
                <div class="order-info-cell">
                    <div class="order-info-label">Metode Bayar</div>
                    <div class="order-info-value" style="color:{{ $mc[2] }};">
                        <i class="bi {{ $mc[0] }}"></i> {{ $mc[1] }}
                    </div>
                </div>
                <div class="order-info-cell">
                    <div class="order-info-label">Status Bayar</div>
                    <div>
                        @if($order->payment_status === 'paid')
                            <span class="pay-badge pay-paid"><i class="bi bi-check-circle-fill"></i> Lunas</span>
                        @else
                            <span class="pay-badge pay-unpaid"><i class="bi bi-clock-fill"></i> Belum Bayar</span>
                        @endif
                    </div>
                </div>
                <div class="order-action-cell">
                    <a href="{{ route('order.show', $order->id) }}" class="btn-detail">
                        Detail <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($orders->hasPages())
    <div class="mt-4 d-flex justify-content-center fade-up">
        {{ $orders->links() }}
    </div>
    @endif

    @else

    <div class="empty-order fade-up">
        <div style="width:72px;height:72px;background:var(--blue-50);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.8rem;margin:0 auto 18px;">
            📋
        </div>
        <h5 style="font-family:var(--font-display);font-weight:800;font-size:1.2rem;color:var(--slate-900);letter-spacing:-.4px;margin-bottom:8px;">
            @if($activeStatus !== 'all')
                Tidak ada pesanan "{{ $statusTabs[$activeStatus]['label'] }}"
            @else
                Belum Ada Transaksi
            @endif
        </h5>
        <p style="font-size:.85rem;color:var(--slate-400);max-width:300px;margin:0 auto 24px;line-height:1.7;">
            @if($activeStatus !== 'all')
                Belum ada pesanan dengan status ini. Coba tab lain.
            @else
                Riwayat belanja kamu akan muncul di sini.
            @endif
        </p>
        @if($activeStatus !== 'all')
        <a href="{{ route('order.history') }}"
           class="btn-carage-outline text-decoration-none d-inline-flex align-items-center gap-2">
            <i class="bi bi-grid-3x3-gap"></i> Lihat Semua Pesanan
        </a>
        @else
        <a href="{{ route('products.index') }}"
           class="btn-carage text-decoration-none d-inline-flex align-items-center gap-2">
            <i class="bi bi-bag-fill"></i> Mulai Belanja
        </a>
        @endif
    </div>

    @endif

</div>

@endsection