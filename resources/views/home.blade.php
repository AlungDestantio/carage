@extends('layouts.app')
@section('title', 'Beranda')

@push('styles')
<style>
/* ── HERO ─────────────────────────────────────────── */
.home-hero {
    background: #0B1120;
    position: relative;
    overflow: hidden;
}
.hero-grid-overlay {
    position: absolute;
    inset: 0;
    background-image:
        linear-gradient(rgba(59,130,246,0.035) 1px, transparent 1px),
        linear-gradient(90deg, rgba(59,130,246,0.035) 1px, transparent 1px);
    background-size: 48px 48px;
    pointer-events: none;
}
.hero-orb-top {
    position: absolute;
    width: 520px;
    height: 520px;
    background: rgba(37,99,235,0.14);
    border-radius: 50%;
    filter: blur(90px);
    top: -150px;
    left: 50%;
    transform: translateX(-50%);
    pointer-events: none;
}
.hero-orb-left {
    position: absolute;
    width: 260px;
    height: 260px;
    background: rgba(96,165,250,0.07);
    border-radius: 50%;
    filter: blur(60px);
    bottom: -60px;
    left: 10%;
    pointer-events: none;
}
.hero-orb-right {
    position: absolute;
    width: 220px;
    height: 220px;
    background: rgba(29,78,216,0.10);
    border-radius: 50%;
    filter: blur(60px);
    bottom: -40px;
    right: 8%;
    pointer-events: none;
}
.hero-inner {
    max-width: 680px;
    margin: 0 auto;
    padding: 80px 0 56px;
    text-align: center;
}
.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(59,130,246,0.10);
    border: 1px solid rgba(59,130,246,0.20);
    border-radius: 100px;
    padding: 6px 16px;
    font-size: .68rem;
    font-weight: 700;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: #60A5FA;
    margin-bottom: 22px;
}
.hero-badge-dot {
    width: 6px;
    height: 6px;
    background: #3B82F6;
    border-radius: 50%;
    display: inline-block;
    animation: heroPulse 2s ease infinite;
}
.hero-headline {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 800;
    font-size: clamp(5rem, 5.5vw, 3.8rem);
    line-height: 1.0;
    letter-spacing: -2px;
    color: #fff;
    margin-bottom: 18px;
    white-space: nowrap;
}
.hero-headline-muted {
    color: rgba(255,255,255,0.30);
}
.hero-headline-accent {
    color: #3B82F6;
}
.hero-subtext {
    font-size: 1rem;
    color: rgba(255,255,255,0.38);
    line-height: 1.75;
    max-width: 460px;
    margin: 0 auto 32px;
    font-weight: 500;
}
.hero-search-wrap {
    max-width: 500px;
    margin: 0 auto 44px;
}
.hero-search-box {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.10);
    border-radius: 14px;
    display: flex;
    overflow: hidden;
}
.hero-search-input {
    background: transparent;
    border: none;
    outline: none;
    color: #fff;
    padding: 14px 18px;
    font-size: .9rem;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 500;
    flex: 1;
    min-width: 0;
}
.hero-search-btn {
    background: #2563EB;
    border: none;
    color: #fff;
    padding: 0 22px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 700;
    font-size: .82rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
    white-space: nowrap;
    flex-shrink: 0;
}
.stats-fixed{
    display:inline-flex;
    background:rgba(255,255,255,0.04);
    border:1px solid rgba(255,255,255,0.08);
    border-radius:14px;
    overflow:hidden;
    margin-bottom:44px;
}

.stats-fixed .hero-stat-item{
    padding:16px 26px;
    text-align:center;
}

.stats-fixed .hero-stat-item:not(:last-child){
    border-right:1px solid rgba(255,255,255,0.07);
}
.hero-stat-value {
    font-family: 'Bricolage Grotesque', sans-serif;
    font-weight: 800;
    font-size: 1.5rem;
    color: #fff;
    letter-spacing: -1px;
    line-height: 1;
    margin-bottom: 4px;
}
.hero-stat-label {
    font-size: .62rem;
    color: rgba(255,255,255,0.27);
    text-transform: uppercase;
    letter-spacing: 1.5px;
    font-weight: 700;
}
.hero-feat-card {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 14px;
    padding: 16px;
    text-align: left;
}
.hero-feat-icon {
    width: 32px;
    height: 32px;
    background: rgba(37,99,235,0.20);
    border-radius: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 15px;
    margin-bottom: 10px;
}
.hero-feat-title {
    font-size: .78rem;
    font-weight: 700;
    color: rgba(255,255,255,0.70);
    margin-bottom: 3px;
}
.hero-feat-desc {
    font-size: .7rem;
    color: rgba(255,255,255,0.25);
    line-height: 1.5;
}
.hero-trust-strip {
    background: rgba(255,255,255,0.025);
    border-top: 1px solid rgba(255,255,255,0.06);
    padding: 14px 0;
}
.hero-trust-item {
    font-size: .72rem;
    font-weight: 600;
    color: rgba(255,255,255,0.28);
}

@keyframes heroPulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50%       { opacity: .4; transform: scale(0.7); }
}

/* ── CTA BANNER ──────────────────────────────────── */
.cta-section {
    background: var(--blue-800);
    padding: 60px 0;
    position: relative;
    overflow: hidden;
}
.cta-orb-top-right {
    position: absolute;
    right: -60px;
    top: -60px;
    width: 340px;
    height: 340px;
    background: rgba(255,255,255,0.04);
    border-radius: 50%;
}
.cta-orb-bottom-mid {
    position: absolute;
    left: 40%;
    bottom: -80px;
    width: 220px;
    height: 220px;
    background: rgba(255,255,255,0.03);
    border-radius: 50%;
}
.cta-eyebrow {
    font-size: .68rem;
    font-weight: 700;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    color: rgba(255,255,255,0.4);
    margin-bottom: 10px;
}
.cta-headline {
    font-family: 'Bricolage Grotesque', sans-serif;
    font-weight: 800;
    font-size: 2.2rem;
    color: white;
    line-height: 1.15;
    letter-spacing: -1px;
    margin-bottom: 24px;
}
.cta-headline-muted {
    color: rgba(255,255,255,0.45);
}
.cta-benefit-item {
    display: flex;
    align-items: center;
    gap: 10px;
    color: rgba(255,255,255,0.65);
    font-size: .82rem;
    font-weight: 600;
}
.cta-benefit-icon {
    color: rgba(255,255,255,0.35);
    font-size: .95rem;
    flex-shrink: 0;
}
.cta-btn {
    display: inline-block;
    background: white;
    color: var(--blue-700);
    font-family: 'Bricolage Grotesque', sans-serif;
    font-weight: 800;
    font-size: .95rem;
    padding: 14px 30px;
    border-radius: 12px;
    text-decoration: none;
    transition: all .15s;
    letter-spacing: -.3px;
}
.cta-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(0,0,0,0.18);
}
@media (max-width: 767px) {
    /* ── GLOBAL ── */
    section.py-5 { padding-top: 24px !important; padding-bottom: 24px !important; }
    .mb-4 { margin-bottom: 12px !important; }
    .row.g-3 { --bs-gutter-x: 8px; --bs-gutter-y: 8px; }
    .row.g-4 { --bs-gutter-x: 8px; --bs-gutter-y: 8px; }

    /* ── SECTION HEADER ── */
    .section-eyebrow    { font-size: .55rem; }
    .section-title      { font-size: 1.15rem !important; letter-spacing: -.3px; }
    .btn-carage-outline { font-size: .65rem; padding: 4px 10px; border-radius: 7px; }

    /* ── HERO ── */
    .hero-inner { padding: 28px 4px 22px; }
    .hero-badge { font-size: .55rem; padding: 4px 10px; margin-bottom: 12px; }
    .hero-headline {
        font-size: 2.5rem !important;
        letter-spacing: -.5px;
        white-space: normal;
        line-height: 1.15;
        margin-bottom: 12px;
    }
    .hero-subtext {
        font-size: .72rem;
        line-height: 1.6;
        margin-bottom: 14px;
    }
    .hero-search-wrap  { margin-bottom: 16px; }
    .hero-search-box   { border-radius: 10px; }
    .hero-search-input { padding: 9px 11px; font-size: .75rem; }
    .hero-search-btn   { padding: 0 13px; font-size: .7rem; gap: 4px; }

    /* Stats scroll */
    .stats-fixed {
        display: flex;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
        margin: 0 auto 16px;
        border-radius: 9px;
        width: fit-content;
        max-width: 100%;
        justify-content: center;
    }
    .stats-fixed::-webkit-scrollbar { display: none; }
    .stats-fixed .hero-stat-item { padding: 9px 13px; flex-shrink: 0; }
    .hero-stat-value { font-size: .95rem; }
    .hero-stat-label { font-size: .5rem; letter-spacing: 1px; }

    /* Feature mini-cards */
    .hero-feat-card {
        padding: 8px 7px;
        border-radius: 8px;
    }
    .hero-feat-icon {
        width: 20px; height: 20px;
        font-size: 10px;
        border-radius: 5px;
        margin-bottom: 5px;
    }
    .hero-feat-title { font-size: .58rem; margin-bottom: 2px; }
    .hero-feat-desc  { font-size: .54rem; line-height: 1.3; }

    /* Trust strip */
    .hero-trust-strip { padding: 8px 0; }
    .hero-trust-item  { font-size: .56rem; }

    /* ── KATEGORI — 3 kolom ── */
    .col-6.col-md-4.col-lg-2 {
        flex: 0 0 33.333% !important;
        max-width: 33.333% !important;
        padding-left: 4px !important;
        padding-right: 4px !important;
    }
    .cat-card {
        padding: 10px 5px;
        border-radius: 9px;
    }
    .cat-card .cat-icon  { font-size: 1.1rem; margin-bottom: 3px; }
    .cat-card .cat-name  { font-size: .6rem; }
    .cat-card .cat-count { font-size: .52rem; margin-top: 1px; }

    /* ── PRODUK — 2 kolom kecil ── */
    .col-6.col-md-4.col-xl-3 {
        padding-left: 4px !important;
        padding-right: 4px !important;
    }
    .product-card { border-radius: 10px; }
    .product-card .img-wrap  { height: 100px; }
    .product-card .card-body { padding: 8px 9px; }
    .product-card .brand-tag { font-size: .54rem; letter-spacing: .5px; }
    .product-card h6 {
        font-size: .7rem;
        margin: 2px 0;
        line-height: 1.25;
    }
    .product-card .price      { font-size: .78rem; }
    .product-card .stock-info { font-size: .56rem; margin-bottom: 6px; }
    .product-card .badge-featured {
        font-size: .52rem;
        padding: 2px 6px;
        border-radius: 4px;
    }
    .btn-ghost  { padding: 5px 7px; font-size: .65rem; border-radius: 6px; }
    .btn-carage { padding: 5px 7px; font-size: .7rem;  border-radius: 6px; }

    /* ── CTA ── */
    .cta-section  { padding: 30px 0; }
    .cta-eyebrow  { font-size: .55rem; }
    .cta-headline { font-size: 1.25rem; letter-spacing: -.4px; margin-bottom: 12px; }
    .cta-benefit-item { font-size: .68rem; gap: 6px; }
    .cta-btn { padding: 10px 20px; font-size: .78rem; border-radius: 9px; }
    .row.g-3 .col-md-6 {
        flex: 0 0 100% !important;
        max-width: 100% !important;
    }

    /* ── ARTIKEL — 1 kolom ── */
    .col-md-4:has(.article-card) {
        flex: 0 0 100% !important;
        max-width: 100% !important;
    }
    .article-card { border-radius: 10px; }
    .article-card .img-wrap { height: 120px; }
    .article-card div[style*="padding:18px"] { padding: 11px 12px !important; }
    .article-card h6          { font-size: .78rem; margin-bottom: 4px; }
    .article-card p           { font-size: .68rem !important; margin-bottom: 7px !important; line-height: 1.5 !important; }
    .article-card .read-link  { font-size: .65rem; }
    .article-card .article-date { font-size: .58rem; margin-bottom: 4px !important; }
}
</style>
@endpush

@section('content')

{{-- ── HERO (CENTERED) ──────────────────────────────── --}}
<section class="home-hero">

    {{-- Grid pattern overlay --}}
    <div class="hero-grid-overlay"></div>

    {{-- Ambient glow orbs --}}
    <div class="hero-orb-top"></div>
    <div class="hero-orb-left"></div>
    <div class="hero-orb-right"></div>

    <div class="container position-relative" style="z-index:2;">
        <div class="hero-inner">

            {{-- Animated pill badge --}}
            <div class="fade-up fade-up-1 hero-badge">
                <span class="hero-badge-dot"></span>
                Platform Sparepart #1 di Surabaya
            </div>

            {{-- Main headline --}}
            <h1 class="fade-up fade-up-2 hero-headline">
                <span class="hero-headline-muted">Temukan</span> Sparepart<br>
                Mobil <span class="hero-headline-accent">Original</span>
            </h1>

            {{-- Subtext --}}
            <p class="fade-up fade-up-3 hero-subtext">
                Ribuan produk sparepart original & berkualitas. Pengiriman cepat ke seluruh Indonesia. Garansi keaslian terjamin.
            </p>

            {{-- Search bar --}}
            <form action="{{ route('products.index') }}" method="GET"
                  class="fade-up fade-up-3 hero-search-wrap">
                <div class="hero-search-box">
                    <input type="text" name="cari"
                           placeholder="Cari sparepart... oli, rem, aki, filter"
                           class="hero-search-input">
                    <button type="submit" class="hero-search-btn">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </div>
            </form>

            {{-- Stats pill --}}
            <div class="fade-up fade-up-4 stats-fixed">
                @foreach([['500+','Produk'],['10K+','Pelanggan'],['4.9★','Rating'],['100%','Original']] as $stat)
                <div class="hero-stat-item">
                    <div class="hero-stat-value">{{ $stat[0] }}</div>
                    <div class="hero-stat-label">{{ $stat[1] }}</div>
                </div>
                @endforeach
            </div>

            {{-- Feature mini-cards --}}
            <div class="row g-3 fade-up fade-up-4">
                @foreach([
                    ['🛡️','Garansi Original','Semua produk terjamin keasliannya'],
                    ['🚚','Kirim Hari Ini','Order sebelum jam 14.00 langsung dikirim'],
                    ['🎧','Konsultasi Gratis','Chat langsung dengan mekanik kami'],
                ] as $feat)
                <div class="col-4">
                    <div class="hero-feat-card">
                        <div class="hero-feat-icon">{{ $feat[0] }}</div>
                        <div class="hero-feat-title">{{ $feat[1] }}</div>
                        <div class="hero-feat-desc">{{ $feat[2] }}</div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>

    {{-- Bottom trust strip --}}
    <div class="hero-trust-strip">
        <div class="container">
            <div class="d-flex justify-content-center align-items-center gap-4 flex-wrap">
                @foreach(['🔒 Pembayaran Aman','📦 2.400+ Stok Ready','⚡ Proses Cepat','🔧 Sparepart Lengkap'] as $t)
                <span class="hero-trust-item">{{ $t }}</span>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ── KATEGORI ─────────────────────────────────────── --}}
<section class="py-5" style="background:white;border-bottom:1px solid var(--slate-200);">
    <div class="container">
        <div class="section-eyebrow">Jelajahi</div>
        <div class="d-flex justify-content-between align-items-end mb-4">
            <h2 class="section-title">Kategori <span class="hl">Produk</span></h2>
            <a href="{{ route('products.index') }}" class="btn-carage-outline text-decoration-none">Semua Produk →</a>
        </div>
        @php
        $catIcons = ['oli-pelumas'=>'🛢️','rem-kopling'=>'🔴','filter'=>'🌀','aki-elektrikal'=>'⚡','suspensi-steering'=>'🔩','body-eksterior'=>'🚙'];
        @endphp
        <div class="row g-3">
            @foreach($categories as $cat)
            <div class="col-6 col-md-4 col-lg-2">
                <a href="{{ route('products.index') }}?kategori={{ $cat->slug }}" class="cat-card">
                    <div class="cat-icon">{{ $catIcons[$cat->slug] ?? '🔧' }}</div>
                    <div class="cat-name">{{ $cat->name }}</div>
                    <div class="cat-count">{{ $cat->products_count }} produk</div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ── PRODUK UNGGULAN ──────────────────────────────── --}}
<section class="py-5" style="background:var(--bg-page);">
    <div class="container">
        <div class="section-eyebrow">Pilihan Terbaik</div>
        <div class="d-flex justify-content-between align-items-end mb-4">
            <h2 class="section-title">Produk <span class="hl">Unggulan</span></h2>
            <a href="{{ route('products.index') }}" class="btn-carage-outline text-decoration-none">Lihat Semua →</a>
        </div>
        <div class="row g-3">
            @foreach($featuredProducts as $product)
            <div class="col-6 col-md-4 col-xl-3">
                <div class="product-card h-100 d-flex flex-column">
                    <div class="img-wrap">
                        @if($product->image)
                            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                        @else
                            <div class="img-placeholder">🔧</div>
                        @endif
                        <span class="badge-featured">Unggulan</span>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <div class="brand-tag">{{ $product->brand }} · {{ $product->category->name }}</div>
                        <h6>{{ $product->name }}</h6>
                        <div class="price">{{ $product->formatted_price }}</div>
                        <div class="stock-info">Stok: {{ $product->stock }}</div>
                        <div class="d-flex gap-2 mt-auto">
                            <a href="{{ route('products.show', $product->slug) }}"
                               class="btn-ghost flex-fill text-center text-decoration-none d-flex align-items-center justify-content-center"
                               style="font-size:.8rem;">Detail</a>
                            @auth
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn-carage" style="padding:8px 14px;font-size:.9rem;">
                                    <i class="bi bi-bag-plus"></i>
                                </button>
                            </form>
                            @else
                            <a href="{{ route('login') }}" class="btn-carage text-decoration-none d-flex align-items-center" style="padding:8px 14px;font-size:.9rem;">
                                <i class="bi bi-bag-plus"></i>
                            </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ── CTA BANNER ───────────────────────────────────── --}}
<section class="cta-section">
    <div class="cta-orb-top-right"></div>
    <div class="cta-orb-bottom-mid"></div>
    <div class="container position-relative" style="z-index:1;">
        <div class="row align-items-center gy-4">
            <div class="col-lg-8">
                <div class="cta-eyebrow">Keuntungan Belanja di Carage</div>
                <h2 class="cta-headline">
                    Sparepart Original,<br><span class="cta-headline-muted">Harga Transparan.</span>
                </h2>
                <div class="row g-3">
                    @foreach([
                        ['bi-truck-front','Pengiriman Cepat ke seluruh Indonesia'],
                        ['bi-patch-check','Garansi Produk Original'],
                        ['bi-lock','Pembayaran Aman & Terenkripsi'],
                        ['bi-headset','Konsultasi Gratis dengan Mekanik'],
                    ] as $b)
                    <div class="col-md-6">
                        <div class="cta-benefit-item">
                            <i class="bi {{ $b[0] }} cta-benefit-icon"></i>
                            {{ $b[1] }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-4 text-lg-end text-center">
                <a href="{{ route('products.index') }}" class="cta-btn">
                    Belanja Sekarang →
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ── ARTIKEL TERBARU ──────────────────────────────── --}}
@if($latestArticles->count())
<section class="py-5" style="background:var(--bg-page);">
    <div class="container">
        <div class="section-eyebrow">Tips & Info</div>
        <div class="d-flex justify-content-between align-items-end mb-4">
            <h2 class="section-title">Artikel <span class="hl">Terbaru</span></h2>
            <a href="{{ route('articles.index') }}" class="btn-carage-outline text-decoration-none">Semua Artikel →</a>
        </div>
        <div class="row g-4">
            @foreach($latestArticles as $article)
            <div class="col-md-4">
                <a href="{{ route('articles.show', $article->slug) }}" class="article-card h-100">
                    <div class="img-wrap">
                        @if($article->image)
                            <img src="{{ asset('storage/'.$article->image) }}" alt="{{ $article->title }}">
                        @else
                            <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:2.5rem;color:var(--slate-300);">📰</div>
                        @endif
                    </div>
                    <div style="padding:18px 20px;">
                        <div class="article-date mb-2">
                            <i class="bi bi-calendar3 me-1"></i>{{ $article->published_at->format('d M Y') }}
                        </div>
                        <h6>{{ $article->title }}</h6>
                        <p style="font-size:.82rem;color:var(--slate-400);line-height:1.65;margin-bottom:12px;">
                            {{ Str::limit($article->excerpt, 100) }}
                        </p>
                        <span class="read-link">Baca Selengkapnya →</span>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection