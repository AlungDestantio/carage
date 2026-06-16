@extends('layouts.app')
@section('title', $product->name)

@push('styles')
<style>
/* ── LAYOUT UTAMA ────────────────────────────────── */
.product-layout {
    display: grid;
    grid-template-columns: 420px 1fr;
    gap: 32px;
    align-items: start;
}

/* Kolom kiri sticky */
.product-img-col {
    position: sticky;
    top: 80px;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

/* Gambar utama */
.product-img-main {
    background: white;
    border: 1px solid var(--slate-200);
    border-radius: 20px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    min-height: 420px;
    padding: 0;
}
.product-img-main img {
    width: 100%;
    height: 420px;
    max-height: none;
    object-fit: cover;
    display: block;
    transition: transform .35s ease;
}
.product-img-main:hover img { transform: scale(1.04); }

/* Trust badges */
.trust-badge-row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 8px;
}
.trust-badge-item {
    background: white;
    border: 1px solid var(--slate-200);
    border-radius: 10px;
    padding: 10px 6px;
    text-align: center;
    transition: border-color .15s;
}
.trust-badge-item:hover { border-color: var(--blue-200); }
.trust-badge-item i {
    color: var(--blue-600);
    font-size: .95rem;
    display: block;
    margin-bottom: 4px;
}
.trust-badge-item span {
    font-size: .62rem;
    font-weight: 700;
    color: var(--slate-500);
    line-height: 1.3;
    display: block;
}

/* Share row */
.share-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px;
}
.share-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    background: white;
    border: 1px solid var(--slate-200);
    border-radius: 10px;
    padding: 9px 12px;
    font-family: var(--font-body);
    font-weight: 700;
    font-size: .75rem;
    color: var(--slate-500);
    cursor: pointer;
    text-decoration: none;
    transition: all .15s;
}
.share-btn:hover {
    background: var(--slate-50);
    border-color: var(--slate-300);
    color: var(--slate-700);
}

/* ── DETAIL PANEL ────────────────────────────────── */
.product-detail-col { min-width: 0; }

.product-tags {
    display: flex;
    align-items: center;
    gap: 6px;
    flex-wrap: wrap;
    margin-bottom: 10px;
}
.ptag {
    font-size: .66rem;
    font-weight: 800;
    padding: 3px 10px;
    border-radius: 5px;
    text-transform: uppercase;
    letter-spacing: .4px;
}
.ptag-cat   { background: var(--blue-50);   color: var(--blue-700); }
.ptag-brand { background: var(--slate-100); color: var(--slate-500); }
.ptag-sku   { font-size: .66rem; font-weight: 600; color: var(--slate-400); }

.product-title {
    font-family: 'Bricolage Grotesque', sans-serif;
    font-weight: 800;
    font-size: 1.85rem;
    line-height: 1.1;
    letter-spacing: -.5px;
    color: var(--slate-900);
    margin: 0 0 10px;
}
.product-price {
    font-family: 'Bricolage Grotesque', sans-serif;
    font-weight: 800;
    font-size: 2rem;
    color: var(--accent);
    letter-spacing: -1px;
    line-height: 1;
    margin-bottom: 14px;
}

.stock-pill {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: .72rem;
    font-weight: 800;
    padding: 5px 12px;
    border-radius: 6px;
}
.stock-ok    { background: #D1FAE5; color: #065F46; }
.stock-warn  { background: #FEF3C7; color: #92400E; }
.stock-empty { background: #FEE2E2; color: #991B1B; }

.product-divider {
    border: none;
    border-top: 1px solid var(--slate-100);
    margin: 18px 0;
}

/* Description */
.desc-section-label {
    font-size: .65rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: var(--slate-400);
    margin-bottom: 8px;
}
.desc-box {
    background: var(--slate-50);
    border: 1px solid var(--slate-100);
    border-radius: 12px;
    padding: 16px 18px;
    font-size: .85rem;
    line-height: 1.85;
    color: var(--slate-600);
    margin-bottom: 6px;
}
.desc-collapsed {
    max-height: 110px;
    overflow: hidden;
    position: relative;
}
.desc-collapsed::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 44px;
    background: linear-gradient(transparent, #F8FAFC);
    pointer-events: none;
}
.desc-toggle-btn {
    display: inline-block;
    background: none;
    border: none;
    color: var(--blue-600);
    font-size: .75rem;
    font-weight: 700;
    font-family: var(--font-body);
    cursor: pointer;
    padding: 0;
    margin-bottom: 18px;
}

/* Spec table */
.spec-box {
    background: white;
    border: 1px solid var(--slate-200);
    border-radius: 12px;
    padding: 16px 18px;
    margin-bottom: 20px;
}
.spec-box-title {
    font-size: .65rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: var(--slate-900);
    margin-bottom: 12px;
}
.spec-table { width: 100%; border-collapse: collapse; }
.spec-table tr { border-bottom: 1px solid var(--slate-100); }
.spec-table tr:last-child { border-bottom: none; }
.spec-table td { padding: 8px 0; font-size: .8rem; vertical-align: middle; }
.spec-table td:first-child { color: var(--slate-400); font-weight: 700; width: 42%; }
.spec-table td:last-child  { color: var(--slate-800); font-weight: 600; }

/* Qty stepper */
.qty-wrap {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
    margin-bottom: 14px;
}
.qty-stepper {
    display: flex;
    align-items: center;
    background: white;
    border: 1.5px solid var(--slate-200);
    border-radius: 11px;
    overflow: hidden;
}
.qty-btn {
    background: none;
    border: none;
    padding: 9px 16px;
    font-size: 1.05rem;
    font-weight: 700;
    color: var(--slate-600);
    cursor: pointer;
    line-height: 1;
    transition: background .12s;
}
.qty-btn:hover { background: var(--slate-50); }
.qty-input {
    width: 44px;
    text-align: center;
    border: none;
    font-weight: 800;
    font-size: .9rem;
    outline: none;
    color: var(--slate-900);
    font-family: var(--font-body);
    -moz-appearance: textfield;
}
.qty-input::-webkit-inner-spin-button,
.qty-input::-webkit-outer-spin-button { -webkit-appearance: none; }

/* CTA */
.btn-add-cart {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    background: var(--blue-600);
    color: white;
    border: none;
    border-radius: 12px;
    padding: 14px 24px;
    font-family: var(--font-body);
    font-weight: 700;
    font-size: .92rem;
    cursor: pointer;
    transition: all .18s;
    text-decoration: none;
}
.btn-add-cart:hover {
    background: var(--blue-700);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(37,99,235,0.22);
}
.btn-add-cart[disabled] {
    background: var(--slate-300);
    opacity: .6;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

/* ── RELATED ─────────────────────────────────────── */
.related-section {
    margin-top: 52px;
    padding-top: 40px;
    border-top: 1px solid var(--slate-200);
}

/* ── STICKY CTA MOBILE ───────────────────────────── */
.sticky-cta-mobile {
    display: none;  /* hidden by default — JS shows it on mobile only */
    position: fixed;
    bottom: 62px;
    left: 0; right: 0;
    background: white;
    border-top: 1px solid var(--slate-200);
    padding: 9px 14px;
    z-index: 998;
    box-shadow: 0 -4px 16px rgba(15,23,42,0.08);
    gap: 12px;
    align-items: center;
}

/* Desktop: ALWAYS hidden regardless of JS */
@media (min-width: 768px) {
    .sticky-cta-mobile { display: none !important; }
}
.sticky-cta-price {
    font-family: 'Bricolage Grotesque', sans-serif;
    font-weight: 800;
    font-size: 1rem;
    color: var(--accent);
    letter-spacing: -.5px;
    white-space: nowrap;
    line-height: 1;
}
.sticky-cta-label {
    font-size: .56rem;
    font-weight: 700;
    color: var(--slate-400);
    text-transform: uppercase;
    letter-spacing: .5px;
}

/* ── RESPONSIVE ──────────────────────────────────── */
@media (max-width: 991px) {
    .product-layout {
        grid-template-columns: 1fr;
        gap: 16px;
    }
    .product-img-col { position: static; }
    .product-img-main {
        min-height: 260px;
        border-radius: 14px;
    }
    .product-img-main img {
        height: 260px;
    }
    /* Trust badges & share lebih compact di tablet */
    .trust-badge-item { padding: 8px 5px; }
    .trust-badge-item i { font-size: .85rem; }
    .trust-badge-item span { font-size: .58rem; }
    .share-btn { font-size: .72rem; padding: 8px 10px; }
    /* Related lebih dekat saat 1 kolom */
    .related-section { margin-top: 20px; padding-top: 20px; }
}
@media (max-width: 767px) {
    /* Breadcrumb */
    .breadcrumb-carage { padding: 8px 0; }
    .breadcrumb-item a,
    .breadcrumb-item.active { font-size: .68rem; }
    .breadcrumb-item + .breadcrumb-item::before { font-size: .68rem; }
    .breadcrumb-item.active {
        max-width: 130px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: inline-block;
        vertical-align: middle;
    }

    /* Image */
    .product-img-main {
        min-height: 220px;
        border-radius: 12px;
    }
    .product-img-main img { height: 220px; }

    /* Trust & share strip */
    .trust-badge-item { padding: 7px 4px; border-radius: 8px; }
    .trust-badge-item i { font-size: .8rem; margin-bottom: 3px; }
    .trust-badge-item span { font-size: .56rem; }
    .share-btn { font-size: .68rem; padding: 7px 9px; border-radius: 8px; }

    /* Tags */
    .ptag { font-size: .6rem; padding: 2px 8px; }
    .ptag-sku { font-size: .6rem; }

    /* Title & price */
    .product-title  { font-size: 1.2rem; letter-spacing: -.3px; margin-bottom: 8px; }
    .product-price  { font-size: 1.5rem; letter-spacing: -.5px; margin-bottom: 10px; }

    /* Stock pill */
    .stock-pill { font-size: .66rem; padding: 4px 10px; }

    /* Divider spacing */
    .product-divider { margin: 14px 0; }

    /* Description */
    .desc-section-label { font-size: .6rem; margin-bottom: 6px; }
    .desc-box { padding: 12px 13px; font-size: .78rem; line-height: 1.75; }
    .desc-collapsed { max-height: 84px; }
    .desc-toggle-btn { font-size: .72rem; }

    /* Spec */
    .spec-box { padding: 12px 13px; border-radius: 10px; }
    .spec-box-title { font-size: .6rem; margin-bottom: 10px; }
    .spec-table td { padding: 7px 0; font-size: .75rem; }

    /* Qty */
    .qty-wrap { gap: 9px; margin-bottom: 12px; }
    .qty-wrap > span:first-child { font-size: .72rem; }
    .qty-wrap > span:last-child { font-size: .64rem; }
    .qty-stepper { border-radius: 9px; }
    .qty-btn { padding: 8px 13px; font-size: .95rem; }
    .qty-input { width: 38px; font-size: .85rem; }

    /* Add to cart button */
    .btn-add-cart { font-size: .85rem; padding: 12px 20px; border-radius: 10px; }

    /* Guest register text */
    .product-detail-col > div[style*="text-align:center"] { font-size: .7rem !important; }

    /* Padding bottom for sticky cta */
    .product-detail-col { padding-bottom: 16px; }

    /* Sticky CTA */
    .sticky-cta-mobile { display: flex; }
    .sticky-cta-mobile .btn-add-cart {
        flex: 1;
        padding: 10px 14px;
        font-size: .78rem;
        border-radius: 9px;
    }

    /* Related section */
    .related-section { margin-top: 8px; padding-top: 14px; }
    .related-section .section-title { font-size: 1.1rem !important; }
    .related-section .product-card .img-wrap { height: 110px; }
    .related-section .product-card .card-body { padding: 8px 9px; }
    .related-section .product-card h6 { font-size: .7rem; }
    .related-section .product-card .price { font-size: .82rem; }
    .related-section .product-card .brand-tag { font-size: .56rem; }
    .related-section .btn-ghost { font-size: .62rem; padding: 5px 7px; }
    .related-section .btn-carage { font-size: .68rem; padding: 5px 8px; }
}
@media (min-width: 992px) and (max-width: 1199px) {
    .product-layout { grid-template-columns: 360px 1fr; gap: 24px; }
}
</style>
@endpush

@section('content')

{{-- BREADCRUMB --}}
<div class="breadcrumb-carage">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produk</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route('products.index') }}?kategori={{ $product->category->slug }}">
                        {{ $product->category->name }}
                    </a>
                </li>
                <li class="breadcrumb-item active">{{ Str::limit($product->name, 40) }}</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container py-4 py-lg-5">

    <div class="product-layout">

        {{-- ══ KOLOM KIRI — GAMBAR (STICKY) ══════════════ --}}
        <div class="product-img-col fade-up">

            <div class="product-img-main">
                @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                @else
                    <div style="font-size:6rem;opacity:.12;user-select:none;">🔧</div>
                @endif

                @if($product->is_featured)
                <div style="position:absolute;top:14px;left:14px;background:var(--blue-600);color:white;font-size:.6rem;font-weight:800;padding:4px 10px;border-radius:6px;text-transform:uppercase;letter-spacing:.4px;">
                    ⭐ Produk Unggulan
                </div>
                @endif

                @if($product->stock <= 0)
                <div style="position:absolute;inset:0;background:rgba(255,255,255,0.80);display:flex;align-items:center;justify-content:center;border-radius:20px;">
                    <span style="background:#FEE2E2;color:#991B1B;font-weight:800;font-size:.85rem;padding:9px 20px;border-radius:10px;border:1px solid #FECACA;">
                        Stok Habis
                    </span>
                </div>
                @endif
            </div>

            <div class="trust-badge-row">
                <div class="trust-badge-item">
                    <i class="bi bi-shield-check"></i>
                    <span>Garansi Original</span>
                </div>
                <div class="trust-badge-item">
                    <i class="bi bi-truck-front"></i>
                    <span>Kirim Hari Ini</span>
                </div>
                <div class="trust-badge-item">
                    <i class="bi bi-arrow-counterclockwise"></i>
                    <span>Retur Mudah</span>
                </div>
            </div>

            <div class="share-row">
                <button class="share-btn" onclick="copyLink()" id="shareBtn">
                    <i class="bi bi-share" id="shareIcon"></i>
                    <span id="shareText">Bagikan</span>
                </button>
                <a href="{{ route('products.index') }}?kategori={{ $product->category->slug }}" class="share-btn">
                    <i class="bi bi-grid"></i> Lihat Kategori
                </a>
            </div>
        </div>

        {{-- ══ KOLOM KANAN — DETAIL ════════════════════════ --}}
        <div class="product-detail-col">

            <div class="product-tags fade-up">
                <span class="ptag ptag-cat">{{ $product->category->name }}</span>
                <span class="ptag ptag-brand">{{ $product->brand }}</span>
                @if($product->sku)
                <span class="ptag-sku">SKU: {{ $product->sku }}</span>
                @endif
            </div>

            <h1 class="product-title fade-up fade-up-1">{{ $product->name }}</h1>

            <div class="product-price fade-up fade-up-1">{{ $product->formatted_price }}</div>

            <div class="fade-up fade-up-2" style="margin-bottom:4px;">
                @if($product->stock > 10)
                    <span class="stock-pill stock-ok">
                        <i class="bi bi-check-circle-fill"></i> Stok Tersedia ({{ $product->stock }} unit)
                    </span>
                @elseif($product->stock > 0)
                    <span class="stock-pill stock-warn">
                        <i class="bi bi-exclamation-circle-fill"></i> Stok Terbatas — {{ $product->stock }} unit tersisa
                    </span>
                @else
                    <span class="stock-pill stock-empty">
                        <i class="bi bi-x-circle-fill"></i> Stok Habis
                    </span>
                @endif
            </div>

            <hr class="product-divider">

            {{-- Description --}}
            <div class="fade-up fade-up-2" style="margin-bottom:18px;">
                <div class="desc-section-label">Deskripsi Produk</div>
                <div class="desc-box desc-collapsed" id="descBox">
                    {!! nl2br(e($product->description)) !!}
                </div>
                <button class="desc-toggle-btn" id="descToggle" onclick="toggleDesc()">
                    Tampilkan selengkapnya ↓
                </button>
            </div>

            {{-- Spec table --}}
            <div class="spec-box fade-up fade-up-2">
                <div class="spec-box-title">Spesifikasi</div>
                <table class="spec-table">
                    <tr><td>Merek</td><td><strong>{{ $product->brand }}</strong></td></tr>
                    <tr><td>Kategori</td><td>{{ $product->category->name }}</td></tr>
                    @if($product->sku)
                    <tr><td>SKU / Kode</td><td style="font-family:monospace;font-size:.76rem;">{{ $product->sku }}</td></tr>
                    @endif
                    <tr>
                        <td>Ketersediaan</td>
                        <td>
                            @if($product->stock > 0)
                                <span style="color:#059669;font-weight:700;">Tersedia</span>
                            @else
                                <span style="color:#DC2626;font-weight:700;">Habis</span>
                            @endif
                        </td>
                    </tr>
                    <tr><td>Kondisi</td><td>Baru / Original</td></tr>
                    <tr><td>Garansi</td><td>Garansi Keaslian</td></tr>
                </table>
            </div>

            {{-- Add to cart --}}
            <div class="fade-up fade-up-3">
                @if($product->stock > 0)
                    @auth
                    <form action="{{ route('cart.add') }}" method="POST" id="addToCartForm">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="qty-wrap">
                            <span style="font-size:.78rem;font-weight:700;color:var(--slate-500);">Jumlah:</span>
                            <div class="qty-stepper">
                                <button type="button" class="qty-btn"
                                        onclick="let i=document.getElementById('qtyInput');let v=parseInt(i.value);if(v>1)i.value=v-1;">−</button>
                                <input type="number" name="quantity" value="1"
                                       min="1" max="{{ $product->stock }}"
                                       id="qtyInput" class="qty-input">
                                <button type="button" class="qty-btn"
                                        onclick="let i=document.getElementById('qtyInput');let v=parseInt(i.value);if(v<{{ $product->stock }})i.value=v+1;">+</button>
                            </div>
                            <span style="font-size:.66rem;color:var(--slate-400);font-weight:600;">Maks. {{ $product->stock }}</span>
                        </div>
                        <button type="submit" class="btn-add-cart">
                            <i class="bi bi-bag-plus"></i> Tambah ke Keranjang
                        </button>
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="btn-add-cart" style="margin-bottom:8px;">
                        <i class="bi bi-bag-plus"></i> Masuk untuk Membeli
                    </a>
                    <p style="font-size:.72rem;color:var(--slate-400);font-weight:600;text-align:center;margin:8px 0 0;">
                        Belum punya akun?
                        <a href="{{ route('register') }}" style="color:var(--blue-600);text-decoration:none;font-weight:700;">Daftar gratis →</a>
                    </p>
                    @endauth
                @else
                    <button class="btn-add-cart" disabled>
                        <i class="bi bi-x-circle"></i> Stok Sedang Kosong
                    </button>
                    <p style="font-size:.72rem;color:var(--slate-400);font-weight:600;text-align:center;margin:8px 0 0;">
                        Lihat produk serupa di bawah
                    </p>
                @endif
            </div>

        </div>{{-- /detail col --}}
    </div>{{-- /product-layout --}}


    {{-- ── PRODUK TERKAIT ───────────────────────────── --}}
    @if($related->count())
    <div class="related-section fade-up">
        <div class="section-eyebrow">Kategori Sama</div>
        <div class="d-flex justify-content-between align-items-end mb-4">
            <h2 class="section-title">Produk <span class="hl">Terkait</span></h2>
            <a href="{{ route('products.index') }}?kategori={{ $product->category->slug }}"
               class="btn-carage-outline text-decoration-none">Lihat Semua →</a>
        </div>
        <div class="row g-3">
            @foreach($related as $rel)
            <div class="col-6 col-md-3 product-card-wrap">
                <div class="product-card h-100 d-flex flex-column">
                    <div class="img-wrap">
                        @if($rel->image)
                            <img src="{{ asset('storage/'.$rel->image) }}" alt="{{ $rel->name }}">
                        @else
                            <div class="img-placeholder">🔧</div>
                        @endif
                        @if($rel->is_featured)
                            <span class="badge-featured">Unggulan</span>
                        @endif
                        @if($rel->stock > 0)
                        <span style="position:absolute;top:8px;right:8px;background:#D1FAE5;color:#065F46;font-size:.58rem;font-weight:800;padding:2px 6px;border-radius:4px;">
                            Tersedia
                        </span>
                        @else
                        <span style="position:absolute;top:8px;right:8px;background:#FEE2E2;color:#991B1B;font-size:.58rem;font-weight:800;padding:2px 6px;border-radius:4px;">
                            Habis
                        </span>
                        @endif
                    </div>
                    <div class="card-body d-flex flex-column">
                        <div class="brand-tag">{{ $rel->brand }} · {{ $rel->category->name }}</div>
                        <h6>{{ Str::limit($rel->name, 48) }}</h6>
                        <div class="price">{{ $rel->formatted_price }}</div>
                        <div class="stock-info mb-2">
                            @if($rel->stock > 10)
                                <span style="color:#059669;font-weight:700;font-size:.68rem;"><i class="bi bi-circle-fill me-1" style="font-size:.36rem;vertical-align:middle;"></i>Stok {{ $rel->stock }}</span>
                            @elseif($rel->stock > 0)
                                <span style="color:#D97706;font-weight:700;font-size:.68rem;"><i class="bi bi-circle-fill me-1" style="font-size:.36rem;vertical-align:middle;"></i>Terbatas ({{ $rel->stock }})</span>
                            @else
                                <span style="color:#DC2626;font-weight:700;font-size:.68rem;"><i class="bi bi-circle-fill me-1" style="font-size:.36rem;vertical-align:middle;"></i>Stok Habis</span>
                            @endif
                        </div>
                        <div class="d-flex gap-2 mt-auto">
                            <a href="{{ route('products.show', $rel->slug) }}"
                               class="btn-ghost flex-fill text-center text-decoration-none d-flex align-items-center justify-content-center"
                               style="font-size:.75rem;">Detail</a>
                            @if($rel->stock > 0)
                                @auth
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $rel->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn-carage" style="padding:7px 12px;font-size:.85rem;">
                                        <i class="bi bi-bag-plus"></i>
                                    </button>
                                </form>
                                @else
                                <a href="{{ route('login') }}" class="btn-carage text-decoration-none d-flex align-items-center"
                                   style="padding:7px 12px;font-size:.85rem;">
                                    <i class="bi bi-bag-plus"></i>
                                </a>
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

</div>{{-- /container --}}


{{-- ── STICKY CTA (MOBILE ONLY) ────────────────────── --}}
@if($product->stock > 0)
<div class="sticky-cta-mobile" id="stickyCta">
    <div>
        <div class="sticky-cta-label">Harga</div>
        <div class="sticky-cta-price">{{ $product->formatted_price }}</div>
    </div>
    @auth
    <button class="btn-add-cart"
            onclick="document.getElementById('addToCartForm').submit()">
        <i class="bi bi-bag-plus"></i> Tambah ke Keranjang
    </button>
    @else
    <a href="{{ route('login') }}" class="btn-add-cart">
        <i class="bi bi-bag-plus"></i> Masuk untuk Beli
    </a>
    @endauth
</div>
@endif

@endsection

@push('scripts')
<script>
// Copy link
function copyLink() {
    navigator.clipboard.writeText(window.location.href).then(() => {
        const icon = document.getElementById('shareIcon');
        const text = document.getElementById('shareText');
        icon.className = 'bi bi-check-circle-fill';
        icon.style.color = '#059669';
        text.textContent = 'Tersalin!';
        setTimeout(() => {
            icon.className = 'bi bi-share';
            icon.style.color = '';
            text.textContent = 'Bagikan';
        }, 2200);
    });
}

// Description toggle (mobile)
function toggleDesc() {
    const box = document.getElementById('descBox');
    const btn = document.getElementById('descToggle');
    const collapsed = box.classList.toggle('desc-collapsed');
    btn.textContent = collapsed ? 'Tampilkan selengkapnya ↓' : 'Sembunyikan ↑';
}

// Sticky CTA: hide when native form is visible
const stickyCta = document.getElementById('stickyCta');
if (stickyCta) {
    const target = document.getElementById('addToCartForm')
                || document.querySelector('.btn-add-cart');
    if (target) {
        new IntersectionObserver(entries => {
            stickyCta.style.display = entries[0].isIntersecting ? 'none' : 'flex';
        }, { threshold: 0.15 }).observe(target);
    }
}
</script>
@endpush