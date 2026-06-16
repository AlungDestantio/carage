@extends('layouts.app')
@section('title', 'Keranjang Belanja')

@push('styles')
<style>
/* ── CART ITEM CARD ──────────────────────────────── */
.cart-item-card {
    background: white;
    border: 1px solid var(--slate-200);
    border-radius: var(--radius-lg);
    padding: 18px;
    margin-bottom: 12px;
    display: flex;
    align-items: flex-start;
    gap: 16px;
    transition: box-shadow .2s, border-color .2s;
}
.cart-item-card:hover {
    box-shadow: 0 6px 24px rgba(15,23,42,0.06);
    border-color: var(--blue-100);
}
.cart-img {
    width: 68px;
    height: 68px;
    background: var(--slate-100);
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    flex-shrink: 0;
}
.cart-img img { width: 100%; height: 100%; object-fit: cover; }
.cart-info { flex: 1; min-width: 0; }
.cart-actions {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    flex-shrink: 0;
}

/* ── QTY STEPPER ─────────────────────────────────── */
.qty-stepper {
    display: inline-flex;
    align-items: center;
    border: 1.5px solid var(--slate-200);
    border-radius: var(--radius-md);
    overflow: hidden;
    background: white;
}
.qty-btn {
    background: none;
    border: none;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: .9rem;
    color: var(--slate-600);
    cursor: pointer;
    transition: background .15s, color .15s;
}
.qty-btn:hover { background: var(--blue-50); color: var(--blue-600); }
.qty-input {
    width: 42px;
    text-align: center;
    border: none;
    border-left: 1.5px solid var(--slate-200);
    border-right: 1.5px solid var(--slate-200);
    font-weight: 700;
    font-size: .88rem;
    color: var(--slate-900);
    padding: 4px 0;
    -moz-appearance: textfield;
}
.qty-input:focus { outline: none; background: var(--blue-50); }
.qty-input::-webkit-outer-spin-button,
.qty-input::-webkit-inner-spin-button { -webkit-appearance: none; }

/* ── DELETE BUTTON ───────────────────────────────── */
.cart-delete-btn {
    width: 32px;
    height: 32px;
    border-radius: var(--radius-sm);
    background: none;
    border: 1.5px solid var(--slate-200);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--slate-400);
    font-size: .88rem;
    cursor: pointer;
    transition: all .15s;
}
.cart-delete-btn:hover { background: #FEF2F2; border-color: #FECACA; color: #DC2626; }

/* ── RESPONSIVE ──────────────────────────────────── */
@media (max-width: 767px) {
    /* Breadcrumb */
    .breadcrumb-carage { padding: 8px 0; }
    .breadcrumb-item a,
    .breadcrumb-item.active { font-size: .68rem; }
    .breadcrumb-item + .breadcrumb-item::before { font-size: .68rem; }

    /* Container */
    .container.py-5 { padding-top: 18px !important; padding-bottom: 24px !important; }

    /* Page header */
    .section-eyebrow { font-size: .58rem; }
    .section-title   { font-size: 1.2rem !important; letter-spacing: -.3px; }
    .mb-5.fade-up    { margin-bottom: 16px !important; }

    /* Item count bar */
    .d-flex.align-items-center.justify-content-between.mb-3 span { font-size: .72rem !important; }
    .d-flex.align-items-center.justify-content-between.mb-3 a    { font-size: .68rem !important; }

    /* Cart item card */
    .cart-item-card {
        padding: 12px;
        gap: 10px;
        border-radius: 11px;
        margin-bottom: 9px;
        flex-wrap: wrap;
    }
    .cart-img { width: 54px; height: 54px; border-radius: 8px; font-size: 1.2rem !important; }

    /* Product info inside card */
    .cart-info > div:nth-child(1) { font-size: .58rem !important; margin-bottom: 2px !important; }
    .cart-info > div:nth-child(2) { font-size: .78rem !important; margin-bottom: 3px !important; }
    .cart-info > div:nth-child(3) { font-size: .68rem !important; }
    .cart-info > div:nth-child(4) { font-size: .6rem !important; margin-top: 3px !important; }

    /* Actions row — full width di bawah */
    .cart-actions {
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        margin-top: 8px;
        padding-top: 10px;
        border-top: 1px solid var(--slate-100);
    }
    .cart-actions > div:first-child {
        font-size: .88rem !important;
        margin-bottom: 0 !important;
        text-align: left !important;
    }

    /* Qty stepper mobile */
    .qty-btn  { width: 28px; height: 28px; font-size: .8rem; }
    .qty-input { width: 34px; font-size: .8rem; }

    /* Delete btn */
    .cart-delete-btn { width: 28px; height: 28px; font-size: .78rem; }

    /* Continue shopping */
    .mt-3.fade-up .btn-ghost { font-size: .72rem; padding: 6px 12px; border-radius: 8px; }

    /* Summary card */
    .admin-card[style*="position:sticky"] { position: static !important; }
    .admin-card { border-radius: 12px; }
    .admin-card-header { padding: 10px 14px; }
    .admin-card-header .card-title { font-size: .64rem !important; }
    .admin-card > .p-4 { padding: 14px !important; }

    /* Mini item list in summary */
    .admin-card .d-flex.justify-content-between.align-items-center.mb-2 span:first-child { font-size: .7rem !important; }
    .admin-card .d-flex.justify-content-between.align-items-center.mb-2 span:last-child  { font-size: .7rem !important; }

    /* Price breakdown box */
    .admin-card div[style*="background:var(--slate-50)"] { padding: 12px !important; border-radius: 9px !important; }
    .admin-card div[style*="background:var(--slate-50)"] .d-flex span { font-size: .75rem !important; }
    .admin-card div[style*="border-top:2px solid var(--slate-200)"] span:first-child { font-size: .88rem !important; }
    .admin-card div[style*="border-top:2px solid var(--slate-200)"] span:last-child  { font-size: 1rem !important; }

    /* Shipping note */
    .admin-card div[style*="background:var(--blue-50)"] { padding: 10px 11px !important; border-radius: 9px !important; }
    .admin-card div[style*="background:var(--blue-50)"] span { font-size: .66rem !important; }
    .admin-card div[style*="background:var(--blue-50)"] i  { font-size: .8rem; }

    /* Checkout button */
    .btn-carage.d-block { padding: 12px !important; font-size: .82rem !important; margin-top: 14px !important; border-radius: 10px !important; }

    /* Empty state */
    .admin-card .p-5 { padding: 28px 18px !important; }
    .admin-card .p-5 > div[style*="width:90px"] {
        width: 62px !important; height: 62px !important;
        font-size: 1.8rem !important;
        margin-bottom: 14px !important;
    }
    .admin-card h4 { font-size: 1.05rem !important; margin-bottom: 6px !important; }
    .admin-card > div > p { font-size: .75rem !important; margin-bottom: 18px !important; }
    .admin-card .btn-carage[style*="padding:12px 28px"] { padding: 10px 20px !important; font-size: .78rem !important; border-radius: 9px !important; }
}
</style>
@endpush

@section('content')

<div class="breadcrumb-carage">
    <div class="container">
        <nav><ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Keranjang</li>
        </ol></nav>
    </div>
</div>

<div class="container py-5">

    {{-- Page Header --}}
    <div class="mb-5 fade-up">
        <div class="section-eyebrow">Belanja Anda</div>
        <h1 class="section-title">Keranjang <span class="hl">Belanja</span></h1>
    </div>

    @if($carts->count())
    <div class="row g-4">

        {{-- LEFT: Cart Items --}}
        <div class="col-lg-8">

            {{-- Item count header --}}
            <div class="d-flex align-items-center justify-content-between mb-3 fade-up fade-up-1">
                <span style="font-size:.82rem;font-weight:700;color:var(--slate-500);">
                    {{ $carts->count() }} produk di keranjang
                </span>
                <a href="{{ route('products.index') }}"
                   style="font-size:.78rem;font-weight:700;color:var(--blue-600);text-decoration:none;">
                    <i class="bi bi-plus-circle me-1"></i>Tambah Produk
                </a>
            </div>

            {{-- Cart Items --}}
            @foreach($carts as $cart)
            <div class="cart-item-card fade-up fade-up-{{ $loop->index + 1 }}">

                {{-- Product image --}}
                <div class="cart-img">
                    @if($cart->product->image)
                        <img src="{{ asset('storage/'.$cart->product->image) }}" alt="{{ $cart->product->name }}">
                    @else
                        <span style="font-size:1.5rem;">🔧</span>
                    @endif
                </div>

                {{-- Product info --}}
                <div class="cart-info">
                    <div style="font-size:.68rem;font-weight:700;color:var(--blue-600);text-transform:uppercase;letter-spacing:1px;margin-bottom:3px;">
                        {{ $cart->product->brand }} · {{ $cart->product->category->name }}
                    </div>
                    <div style="font-weight:700;font-size:.92rem;color:var(--slate-900);line-height:1.35;margin-bottom:5px;">
                        {{ $cart->product->name }}
                    </div>
                    <div style="font-size:.78rem;color:var(--slate-400);">
                        Harga satuan: <strong style="color:var(--slate-600);">{{ $cart->product->formatted_price }}</strong>
                    </div>
                    @if($cart->product->stock <= 5)
                    <div style="font-size:.68rem;font-weight:700;color:#D97706;margin-top:4px;">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i>Stok tersisa {{ $cart->product->stock }}
                    </div>
                    @endif
                </div>

                {{-- Qty control + price + delete --}}
                <div class="cart-actions">
                    <div style="font-family:var(--font-display);font-weight:800;font-size:1.05rem;color:var(--accent);margin-bottom:10px;text-align:right;">
                        Rp {{ number_format($cart->quantity * $cart->product->price, 0, ',', '.') }}
                    </div>
                    <div class="d-flex align-items-center justify-content-end gap-3">
                        {{-- Qty stepper --}}
                        <form action="{{ route('cart.update', $cart->id) }}" method="POST" class="qty-form">
                            @csrf @method('PATCH')
                            <div class="qty-stepper">
                                <button type="button" class="qty-btn"
                                        onclick="var i=this.nextElementSibling;if(i.value>1){i.value--;this.closest('form').submit();}">
                                    <i class="bi bi-dash"></i>
                                </button>
                                <input type="number" name="quantity" value="{{ $cart->quantity }}"
                                       min="1" max="{{ $cart->product->stock }}"
                                       class="qty-input"
                                       onchange="this.closest('form').submit()">
                                <button type="button" class="qty-btn"
                                        onclick="var i=this.previousElementSibling;if(i.value<{{ $cart->product->stock }}){i.value++;this.closest('form').submit();}">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                        </form>

                        {{-- Delete --}}
                        <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="cart-delete-btn" title="Hapus dari keranjang"
                                    onclick="return confirm('Hapus produk ini dari keranjang?')">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach

            {{-- Continue shopping link --}}
            <div class="mt-3 fade-up">
                <a href="{{ route('products.index') }}" class="btn-ghost text-decoration-none d-inline-flex align-items-center gap-2">
                    <i class="bi bi-arrow-left"></i> Lanjut Belanja
                </a>
            </div>
        </div>

        {{-- RIGHT: Order Summary --}}
        <div class="col-lg-4">
            <div class="admin-card fade-up fade-up-2" style="position:sticky;top:82px;">
                <div class="admin-card-header">
                    <div class="card-title">
                        <i class="bi bi-receipt me-2" style="color:var(--blue-500);"></i>
                        Ringkasan Pesanan
                    </div>
                </div>
                <div class="p-4">

                    {{-- Item list mini --}}
                    <div class="mb-4">
                        @foreach($carts as $cart)
                        <div class="d-flex justify-content-between align-items-center mb-2"
                             style="font-size:.8rem;{{ !$loop->last ? 'padding-bottom:8px;border-bottom:1px solid var(--slate-100);margin-bottom:8px;' : '' }}">
                            <span style="color:var(--slate-600);flex:1;min-width:0;padding-right:8px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                {{ $cart->quantity }}× {{ $cart->product->name }}
                            </span>
                            <span style="font-weight:700;color:var(--slate-900);white-space:nowrap;">
                                Rp {{ number_format($cart->quantity * $cart->product->price, 0, ',', '.') }}
                            </span>
                        </div>
                        @endforeach
                    </div>

                    {{-- Price breakdown --}}
                    <div style="background:var(--slate-50);border-radius:var(--radius-md);padding:16px;">
                        <div class="d-flex justify-content-between mb-2" style="font-size:.85rem;color:var(--slate-500);">
                            <span>Subtotal</span>
                            <span style="font-weight:700;color:var(--slate-900);">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3" style="font-size:.85rem;color:var(--slate-500);">
                            <span>Ongkir (estimasi)</span>
                            <span style="font-weight:700;color:var(--slate-900);">Rp 25.000</span>
                        </div>
                        <div class="d-flex justify-content-between pt-3"
                             style="border-top:2px solid var(--slate-200);">
                            <span style="font-weight:800;font-size:1rem;color:var(--slate-900);">Total</span>
                            <span style="font-weight:800;font-size:1.15rem;color:var(--accent);font-family:var(--font-display);">
                                Rp {{ number_format($total + 25000, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    {{-- Shipping note --}}
                    <div class="d-flex align-items-center gap-2 mt-3 p-3"
                         style="background:var(--blue-50);border-radius:var(--radius-md);border:1px solid var(--blue-100);">
                        <i class="bi bi-truck-front-fill" style="color:var(--blue-500);flex-shrink:0;"></i>
                        <span style="font-size:.75rem;color:var(--blue-700);font-weight:600;">
                            Ongkir final dihitung saat checkout. Order sebelum 14.00 dikirim hari ini!
                        </span>
                    </div>

                    <a href="{{ route('order.checkout') }}"
                       class="btn-carage d-block text-center text-decoration-none mt-4"
                       style="padding:14px;font-size:.95rem;display:flex !important;align-items:center;justify-content:center;gap:8px;">
                        <i class="bi bi-lock-fill"></i> Lanjut ke Pembayaran
                    </a>
                </div>
            </div>
        </div>
    </div>

    @else

    {{-- Empty State --}}
    <div class="admin-card fade-up" style="max-width:480px;margin:0 auto;">
        <div class="p-5 text-center">
            <div style="width:90px;height:90px;background:var(--blue-50);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:2.4rem;margin:0 auto 22px;">
                🛒
            </div>
            <h4 style="font-family:var(--font-display);font-weight:800;font-size:1.5rem;letter-spacing:-.5px;color:var(--slate-900);margin-bottom:8px;">
                Keranjang Masih Kosong
            </h4>
            <p style="font-size:.88rem;color:var(--slate-400);line-height:1.75;max-width:300px;margin:0 auto 28px;">
                Belum ada produk yang ditambahkan. Yuk temukan sparepart yang kamu butuhkan!
            </p>
            <a href="{{ route('products.index') }}" class="btn-carage text-decoration-none d-inline-flex align-items-center gap-2"
               style="padding:12px 28px;">
                <i class="bi bi-bag-fill"></i> Mulai Belanja
            </a>
        </div>
    </div>

    @endif
</div>

@endsection