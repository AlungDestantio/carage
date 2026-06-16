@extends('layouts.app')
@section('title', 'Pembayaran')

@push('styles')
<style>
/* ── PAYMENT OPTIONS ─────────────────────────────── */
.pay-option {
    border: 2px solid var(--slate-200);
    border-radius: var(--radius-lg);
    padding: 18px 14px;
    text-align: center;
    transition: all .18s;
    position: relative;
    background: white;
}
.pay-option:hover {
    border-color: var(--blue-300);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(37,99,235,0.08);
}
.pay-option.selected {
    border-color: var(--blue-500);
    background: var(--blue-50);
    box-shadow: 0 0 0 3px rgba(59,130,246,0.10);
}
.pay-icon {
    width: 44px; height: 44px;
    border-radius: var(--radius-md);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.2rem;
    margin: 0 auto 10px;
}
.pay-name {
    font-weight: 800;
    font-size: .85rem;
    color: var(--slate-900);
    margin-bottom: 4px;
}
.pay-desc {
    font-size: .68rem;
    color: var(--slate-400);
    line-height: 1.5;
}
.pay-check {
    position: absolute;
    top: 8px; right: 10px;
    font-size: .95rem;
    color: var(--blue-500);
    opacity: 0;
    transition: opacity .15s;
}
.pay-option.selected .pay-check { opacity: 1; }

/* ── ORDER ITEM IMAGE ────────────────────────────── */
.order-item-img {
    width: 46px; height: 46px;
    border-radius: var(--radius-md);
    background: var(--slate-100);
    display: flex; align-items: center; justify-content: center;
    overflow: hidden;
    flex-shrink: 0;
}
.order-item-img img { width: 100%; height: 100%; object-fit: cover; }

/* ── RESPONSIVE ──────────────────────────────────── */
@media (max-width: 767px) {
    /* Breadcrumb */
    .breadcrumb-carage { padding: 8px 0; }
    .breadcrumb-item a,
    .breadcrumb-item.active { font-size: .68rem; }
    .breadcrumb-item + .breadcrumb-item::before { font-size: .68rem; }
    .breadcrumb-item.active {
        max-width: 100px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: inline-block;
        vertical-align: middle;
    }

    /* Container */
    .container.py-5 { padding-top: 18px !important; padding-bottom: 28px !important; }

    /* Page header */
    .section-eyebrow { font-size: .58rem; }
    .section-title   { font-size: 1.2rem !important; letter-spacing: -.3px; }
    .mb-4.fade-up    { margin-bottom: 14px !important; }

    /* Cards */
    .admin-card { border-radius: 12px; }
    .admin-card-header { padding: 10px 13px; }
    .admin-card-header .card-title { font-size: .64rem !important; }
    .admin-card > .p-4 { padding: 13px !important; }
    .admin-card[style*="position:sticky"] { position: static !important; }

    /* Error alert */
    .alert { font-size: .75rem !important; padding: 9px 12px; border-radius: 9px; }

    /* Form labels & inputs */
    .form-label { font-size: .72rem !important; margin-bottom: 4px; }
    .form-control { font-size: .8rem; padding: 8px 11px; border-radius: 8px; }
    .form-control::placeholder { font-size: .78rem; }
    .row.g-3 { --bs-gutter-y: 10px; }

    /* Payment options — 3 kolom tetap tapi lebih compact */
    .pay-option { padding: 12px 8px; border-radius: 10px; }
    .pay-icon { width: 34px; height: 34px; font-size: .95rem; margin-bottom: 7px; border-radius: 8px; }
    .pay-name { font-size: .72rem; margin-bottom: 3px; }
    .pay-desc { font-size: .58rem; line-height: 1.4; }
    .pay-check { font-size: .8rem; top: 6px; right: 7px; }

    /* Security note */
    .admin-card div[style*="background:var(--blue-50)"] { padding: 9px 11px !important; border-radius: 9px !important; }
    .admin-card div[style*="background:var(--blue-50)"] span { font-size: .66rem !important; }
    .admin-card div[style*="background:var(--blue-50)"] i   { font-size: .85rem; }

    /* Order summary — item list */
    .order-items .d-flex { gap: 9px !important; padding-bottom: 10px !important; margin-bottom: 10px !important; }
    .order-item-img { width: 38px !important; height: 38px !important; border-radius: 7px !important; }
    .order-items div[style*="font-size:.82rem"] { font-size: .72rem !important; }
    .order-items div[style*="font-size:.72rem"] { font-size: .64rem !important; }
    .order-items div[style*="font-size:.88rem"] { font-size: .78rem !important; }

    /* Price breakdown */
    .admin-card div[style*="background:var(--slate-50)"][style*="padding:16px"] {
        padding: 11px !important;
        border-radius: 9px !important;
    }
    .admin-card div[style*="background:var(--slate-50)"] .d-flex span { font-size: .75rem !important; }
    .admin-card div[style*="border-top:2px solid var(--slate-200)"] span:first-child { font-size: .85rem !important; }
    .admin-card div[style*="border-top:2px solid var(--slate-200)"] span:last-child  { font-size: 1rem !important; }

    /* T&C text */
    .text-center[style*="font-size:.72rem"] { font-size: .64rem !important; }

    /* Submit button */
    button.btn-carage[style*="padding:14px"] {
        padding: 12px !important;
        font-size: .82rem !important;
        border-radius: 10px !important;
        margin-top: 14px !important;
    }
}
</style>
@endpush

@section('content')

<div class="breadcrumb-carage">
    <div class="container">
        <nav><ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('cart.index') }}">Keranjang</a></li>
            <li class="breadcrumb-item active">Pembayaran</li>
        </ol></nav>
    </div>
</div>

<div class="container py-5">

    {{-- Page Header --}}
    <div class="mb-4 fade-up">
        <div class="section-eyebrow">Langkah Terakhir</div>
        <h1 class="section-title">Form <span class="hl">Pembayaran</span></h1>
    </div>

    <form action="{{ route('order.store') }}" method="POST">
        @csrf
        <div class="row g-4">

            {{-- LEFT COLUMN --}}
            <div class="col-lg-7">

                {{-- Error Alert --}}
                @if($errors->any())
                <div class="alert alert-danger mb-4 fade-up">
                    <i class="bi bi-exclamation-circle-fill me-2"></i>
                    @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
                </div>
                @endif

                {{-- Shipping Info --}}
                <div class="admin-card mb-4 fade-up fade-up-1">
                    <div class="admin-card-header">
                        <div class="card-title">
                            <i class="bi bi-geo-alt-fill me-2" style="color:var(--blue-500);"></i>
                            Informasi Pengiriman
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Penerima <span class="text-danger">*</span></label>
                                <input type="text" name="recipient_name" class="form-control"
                                       value="{{ old('recipient_name', auth()->user()->name) }}" required
                                       placeholder="Nama lengkap penerima">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">No. Telepon <span class="text-danger">*</span></label>
                                <input type="text" name="recipient_phone" class="form-control"
                                       value="{{ old('recipient_phone', auth()->user()->phone) }}" required
                                       placeholder="08xx-xxxx-xxxx">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                                <textarea name="shipping_address" class="form-control" rows="3" required
                                          placeholder="Jalan, nomor, RT/RW, kelurahan, kecamatan, kota...">{{ old('shipping_address', auth()->user()->address) }}</textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Catatan untuk Kurir <span style="color:var(--slate-400);font-weight:400;">(opsional)</span></label>
                                <textarea name="notes" class="form-control" rows="2"
                                          placeholder="Contoh: Hubungi saya sebelum tiba, taruh di depan pintu...">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Payment Method --}}
                <div class="admin-card fade-up fade-up-2">
                    <div class="admin-card-header">
                        <div class="card-title">
                            <i class="bi bi-credit-card-fill me-2" style="color:var(--blue-500);"></i>
                            Metode Pembayaran
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="row g-3">
                            @foreach([
                                'transfer' => ['bi-building-fill','Transfer Bank','BCA · Mandiri · BNI · BRI','var(--blue-600)'],
                                'qris'     => ['bi-qr-code-scan','QRIS','GoPay · OVO · Dana · ShopeePay','#7C3AED'],
                                'cod'      => ['bi-cash-stack','COD','Bayar saat pesanan tiba','#059669'],
                            ] as $val => [$icon,$label,$desc,$color])
                            <div class="col-4">
                                <label class="pay-label" style="cursor:pointer;display:block;">
                                    <input type="radio" name="payment_method" value="{{ $val }}"
                                           class="visually-hidden pay-radio" {{ $val === 'transfer' ? 'checked' : '' }}>
                                    <div class="pay-option {{ $val === 'transfer' ? 'selected' : '' }}"
                                         data-color="{{ $color }}">
                                        <div class="pay-icon" style="background:{{ $color }}15;color:{{ $color }};">
                                            <i class="bi {{ $icon }}"></i>
                                        </div>
                                        <div class="pay-name">{{ $label }}</div>
                                        <div class="pay-desc">{{ $desc }}</div>
                                        <div class="pay-check"><i class="bi bi-check-circle-fill"></i></div>
                                    </div>
                                </label>
                            </div>
                            @endforeach
                        </div>

                        {{-- Security note --}}
                        <div class="d-flex align-items-center gap-2 mt-4 p-3"
                             style="background:var(--blue-50);border-radius:var(--radius-md);border:1px solid var(--blue-100);">
                            <i class="bi bi-shield-check-fill" style="color:var(--blue-500);font-size:1.1rem;flex-shrink:0;"></i>
                            <span style="font-size:.78rem;color:var(--blue-700);font-weight:600;">
                                Transaksi Anda dilindungi enkripsi SSL 256-bit. Data pembayaran aman bersama kami.
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ORDER SUMMARY --}}
            <div class="col-lg-5">
                <div class="admin-card fade-up fade-up-2" style="position:sticky;top:82px;">
                    <div class="admin-card-header">
                        <div class="card-title">
                            <i class="bi bi-receipt me-2" style="color:var(--blue-500);"></i>
                            Ringkasan Pesanan
                        </div>
                        <span style="font-size:.68rem;color:var(--slate-400);font-weight:600;">{{ $carts->count() }} item</span>
                    </div>
                    <div class="p-4">

                        {{-- Items --}}
                        <div class="order-items mb-4">
                            @foreach($carts as $cart)
                            <div class="d-flex align-items-center gap-3 mb-3 pb-3"
                                 style="{{ !$loop->last ? 'border-bottom:1px solid var(--slate-100);' : '' }}">
                                <div class="order-item-img">
                                    @if($cart->product->image)
                                        <img src="{{ asset('storage/'.$cart->product->image) }}" alt="">
                                    @else
                                        <span style="font-size:1.2rem;">🔧</span>
                                    @endif
                                </div>
                                <div style="flex:1;min-width:0;">
                                    <div style="font-weight:700;font-size:.82rem;line-height:1.35;color:var(--slate-900);">{{ $cart->product->name }}</div>
                                    <div style="font-size:.72rem;color:var(--slate-400);margin-top:2px;">
                                        {{ $cart->quantity }} pcs × {{ $cart->product->formatted_price }}
                                    </div>
                                </div>
                                <div style="font-weight:800;font-size:.88rem;color:var(--accent);white-space:nowrap;">
                                    Rp {{ number_format($cart->quantity * $cart->product->price, 0, ',', '.') }}
                                </div>
                            </div>
                            @endforeach
                        </div>

                        {{-- Price breakdown --}}
                        <div style="background:var(--slate-50);border-radius:var(--radius-md);padding:16px;">
                            <div class="d-flex justify-content-between mb-2" style="font-size:.85rem;color:var(--slate-600);">
                                <span>Subtotal</span>
                                <span style="font-weight:700;color:var(--slate-900);">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3" style="font-size:.85rem;color:var(--slate-600);">
                                <span>Ongkos Kirim</span>
                                <span style="font-weight:700;color:var(--slate-900);">Rp {{ number_format($shipping, 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between pt-3"
                                 style="border-top:2px solid var(--slate-200);">
                                <span style="font-weight:800;font-size:1rem;color:var(--slate-900);">Total Pembayaran</span>
                                <span style="font-weight:800;font-size:1.15rem;color:var(--accent);font-family:var(--font-display);">
                                    Rp {{ number_format($total, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        <button type="submit" class="btn-carage d-block w-100 text-center mt-4"
                                style="padding:14px;font-size:.95rem;letter-spacing:-.2px;">
                            <i class="bi bi-lock-fill me-2"></i>Buat Pesanan Sekarang
                        </button>

                        <div class="text-center mt-3" style="font-size:.72rem;color:var(--slate-400);">
                            Dengan memesan, Anda menyetujui <a href="#" style="color:var(--blue-600);">Syarat & Ketentuan</a> kami
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.querySelectorAll('.pay-radio').forEach(radio => {
    radio.addEventListener('change', () => {
        document.querySelectorAll('.pay-option').forEach(o => o.classList.remove('selected'));
        if (radio.checked) radio.nextElementSibling.classList.add('selected');
    });
});
</script>
@endpush

@endsection