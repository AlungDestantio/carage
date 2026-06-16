@extends('layouts.app')
@section('title', 'Katalog Produk')

@push('styles')
<style>
/* ── FILTER DRAWER (MOBILE) ───────────────────────── */
.filter-drawer-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(15,23,42,0.55);
    z-index: 1040;
    backdrop-filter: blur(2px);
}
.filter-drawer-overlay.open { display: block; }
.filter-drawer {
    position: fixed;
    bottom: 0; left: 0; right: 0;
    background: white;
    border-radius: 20px 20px 0 0;
    z-index: 1050;
    padding: 0;
    transform: translateY(100%);
    transition: transform .3s cubic-bezier(.32,.72,0,1);
    max-height: 88vh;
    overflow-y: auto;
}
.filter-drawer.open { transform: translateY(0); }
.filter-drawer-handle {
    width: 40px; height: 4px;
    background: var(--slate-200);
    border-radius: 2px;
    margin: 12px auto 0;
}
.filter-drawer-inner { padding: 14px 16px 28px; }

/* ── SORT / VIEW TOOLBAR ─────────────────────────── */
.catalog-toolbar {
    background: white;
    border: 1px solid var(--slate-200);
    border-radius: var(--radius-lg);
    padding: 10px 16px;
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 16px;
}
.toolbar-filter-btn {
    display: none;
    align-items: center;
    gap: 6px;
    background: var(--slate-900);
    color: white;
    border: none;
    border-radius: 8px;
    padding: 7px 14px;
    font-family: var(--font-body);
    font-weight: 700;
    font-size: .78rem;
    cursor: pointer;
}
.sort-select-inline {
    border: 1px solid var(--slate-200);
    border-radius: 8px;
    padding: 6px 10px;
    font-family: var(--font-body);
    font-size: .8rem;
    font-weight: 600;
    color: var(--slate-700);
    background: white;
    cursor: pointer;
    flex: 1;
    max-width: 200px;
}
.sort-select-inline:focus { outline: none; border-color: var(--blue-400); }
.view-toggle-btn {
    border: 1px solid var(--slate-200);
    background: white;
    border-radius: 8px;
    padding: 6px 10px;
    color: var(--slate-500);
    cursor: pointer;
    font-size: .95rem;
    line-height: 1;
    transition: all .15s;
}
.view-toggle-btn.active {
    background: var(--slate-900);
    border-color: var(--slate-900);
    color: white;
}

/* ── PRODUCT COUNT CHIP ──────────────────────────── */
.result-count {
    font-size: .75rem;
    font-weight: 700;
    color: var(--slate-400);
    margin-left: auto;
    white-space: nowrap;
}

/* ── ACTIVE FILTER CHIPS ─────────────────────────── */
.filter-chips { display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 14px; }
.filter-chip {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: var(--blue-50);
    color: var(--blue-700);
    border: 1px solid var(--blue-200);
    padding: 4px 10px;
    border-radius: 6px;
    font-size: .72rem;
    font-weight: 700;
    text-decoration: none;
}
.filter-chip .chip-x {
    color: var(--blue-400);
    text-decoration: none;
    font-size: .85rem;
    line-height: 1;
}

/* ── LOAD MORE ───────────────────────────────────── */
.load-more-section {
    text-align: center;
    padding: 28px 0 8px;
}
.btn-load-more {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: white;
    border: 2px solid var(--slate-200);
    color: var(--slate-700);
    font-family: var(--font-body);
    font-weight: 700;
    font-size: .875rem;
    padding: 12px 30px;
    border-radius: 12px;
    cursor: pointer;
    transition: all .2s;
}
.btn-load-more:hover {
    border-color: var(--blue-400);
    color: var(--blue-600);
    background: var(--blue-50);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(37,99,235,0.10);
}
.btn-load-more.loading {
    opacity: .6;
    pointer-events: none;
}
.load-more-progress {
    font-size: .72rem;
    color: var(--slate-400);
    font-weight: 600;
    margin-top: 10px;
}
.progress-bar-wrap {
    height: 3px;
    background: var(--slate-100);
    border-radius: 2px;
    overflow: hidden;
    max-width: 200px;
    margin: 8px auto 0;
}
.progress-bar-fill {
    height: 100%;
    background: var(--blue-500);
    border-radius: 2px;
    transition: width .4s ease;
}

/* ── GRID LAYOUT ─────────────────────────────────── */
#productGrid { transition: all .2s; }
#productGrid.list-mode .product-card-wrap { flex: 0 0 100% !important; max-width: 100% !important; }
#productGrid.list-mode .product-card { flex-direction: row !important; }
#productGrid.list-mode .product-card .img-wrap { width: 130px; min-width: 130px; height: auto !important; }
#productGrid.list-mode .product-card .card-body { padding: 14px 16px; }

/* ── PRODUCT CARD ENHANCEMENTS ───────────────────── */
.product-card-wrap .product-card {
    transition: transform .2s ease, box-shadow .2s ease, border-color .2s;
}
.product-card .img-wrap { height: 180px; }

/* ── SKELETON LOADER ─────────────────────────────── */
.skeleton-card {
    background: white;
    border-radius: var(--radius-xl);
    border: 1px solid var(--slate-200);
    overflow: hidden;
    animation: skeleton-pulse 1.5s ease infinite;
}
.skeleton-img { background: var(--slate-100); height: 180px; }
.skeleton-body { padding: 14px 16px; }
.skeleton-line {
    background: var(--slate-100);
    border-radius: 4px;
    margin-bottom: 8px;
}
@keyframes skeleton-pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: .6; }
}

/* ── EMPTY STATE ─────────────────────────────────── */
.empty-state {
    background: white;
    border-radius: 20px;
    border: 1px solid var(--slate-200);
    padding: 64px 32px;
    text-align: center;
}

/* ── SIDEBAR FILTER ──────────────────────────────── */
.filter-sidebar .filter-title {
    font-size: .65rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: var(--slate-900);
    border-bottom: 2px solid var(--blue-600);
    padding-bottom: 7px;
    margin-bottom: 12px;
}
.filter-sidebar .cat-link {
    font-size: .78rem;
    font-weight: 700;
    padding: 6px 9px;
    border-radius: 7px;
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: space-between;
    color: var(--slate-500);
    transition: all .15s;
    border: 1px solid transparent;
}
.filter-sidebar .cat-link:hover {
    color: var(--blue-700);
    background: var(--blue-50);
}
.filter-sidebar .cat-link.active {
    color: var(--blue-700);
    background: var(--blue-50);
    border-color: var(--blue-200);
}
.filter-sidebar .cat-count-badge {
    font-size: .62rem;
    font-weight: 700;
    background: var(--slate-100);
    color: var(--slate-400);
    padding: 2px 6px;
    border-radius: 4px;
}
.filter-sidebar .cat-link.active .cat-count-badge {
    background: var(--blue-100);
    color: var(--blue-600);
}
/* Sidebar form controls lebih kecil */
.filter-sidebar .form-control,
.filter-sidebar .form-select {
    font-size: .8rem;
    padding: 8px 12px;
}
.filter-sidebar .form-select { padding: 7px 10px; }
.filter-sidebar label span { font-size: .78rem; }
.filter-sidebar .btn-carage { font-size: .8rem; padding: 9px 16px; }

/* ── RESPONSIVE ──────────────────────────────────── */
@media (max-width: 991px) {
    .sidebar-desktop { display: none !important; }
    .toolbar-filter-btn { display: inline-flex !important; }
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

    /* Toolbar */
    .catalog-toolbar { padding: 7px 9px; gap: 6px; border-radius: 10px; }
    .toolbar-filter-btn { font-size: .7rem; padding: 6px 11px; border-radius: 7px; gap: 4px; }
    .sort-select-inline { font-size: .7rem; padding: 5px 7px; }

    /* Page header */
    .section-title { font-size: 1.1rem !important; letter-spacing: -.3px; }
    #totalCount, #shownCount { font-size: .68rem; }

    /* Product cards */
    .product-card { border-radius: 10px; }
    .product-card .img-wrap { height: 110px; }
    .product-card .card-body { padding: 8px 9px; }
    .product-card .brand-tag { font-size: .56rem; letter-spacing: .3px; }
    .product-card h6 { font-size: .7rem; margin: 2px 0 3px; line-height: 1.3; }
    .product-card .price { font-size: .82rem; }
    .product-card .stock-info { font-size: .58rem; margin-bottom: 6px; }
    .product-card .badge-featured { font-size: .52rem; padding: 2px 5px; border-radius: 3px; }
    .btn-ghost  { padding: 5px 7px; font-size: .62rem; border-radius: 6px; }
    .btn-carage { padding: 5px 8px; font-size: .68rem; border-radius: 6px; }

    /* Load more */
    .btn-load-more { font-size: .78rem; padding: 9px 20px; border-radius: 10px; }
    .load-more-progress { font-size: .66rem; }

    /* Filter drawer */
    .filter-drawer-inner { padding: 12px 14px 24px; }
    .filter-drawer-inner .filter-title {
        font-size: .6rem;
        padding-bottom: 6px;
        margin-bottom: 10px;
    }
    .filter-drawer-inner .cat-link { font-size: .75rem; padding: 6px 8px; }
    .filter-drawer-inner .cat-count-badge { font-size: .6rem; }
    .filter-drawer-inner label span { font-size: .75rem; }
    .filter-drawer-inner .form-control,
    .filter-drawer-inner .form-select { font-size: .78rem; padding: 7px 10px; }
    .filter-drawer-inner .btn-carage { font-size: .78rem; padding: 9px 14px; border-radius: 9px; }
    .filter-drawer-inner .btn-ghost { font-size: .78rem; padding: 9px 14px; border-radius: 9px; }

    /* Empty state */
    .empty-state { padding: 36px 16px; }
    .empty-state h5 { font-size: 1rem; }
    .empty-state p { font-size: .78rem; }
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
                <li class="breadcrumb-item active">Katalog Produk</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container py-4">
    <div class="row g-4">

        {{-- ── SIDEBAR (DESKTOP) ──────────────────────── --}}
        <div class="col-lg-3 sidebar-desktop">
            <div class="filter-sidebar" style="position:sticky;top:80px;">
                <form action="{{ route('products.index') }}" method="GET" id="filterFormDesktop">

                    {{-- Search --}}
                    <div class="filter-title">Pencarian</div>
                    <div class="mb-4">
                        <div style="position:relative;">
                            <i class="bi bi-search" style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:var(--slate-400);font-size:.82rem;"></i>
                            <input type="text" name="cari" class="form-control"
                                   placeholder="Cari produk..."
                                   value="{{ request('cari') }}"
                                   style="padding-left:34px;">
                        </div>
                    </div>

                    {{-- Category --}}
                    <div class="filter-title">Kategori</div>
                    <div class="mb-4 d-flex flex-column gap-1">
                        <a href="{{ route('products.index') }}" class="cat-link {{ !request('kategori') ? 'active' : '' }}">
                            Semua Kategori
                            <span class="cat-count-badge">{{ $products->total() }}</span>
                        </a>
                        @foreach($categories as $cat)
                        <a href="{{ route('products.index') }}?kategori={{ $cat->slug }}{{ request('cari') ? '&cari='.request('cari') : '' }}"
                           class="cat-link {{ request('kategori')==$cat->slug ? 'active' : '' }}">
                            {{ $cat->name }}
                            <span class="cat-count-badge">{{ $cat->products_count }}</span>
                        </a>
                        @endforeach
                    </div>

                    {{-- Brand --}}
                    @if($brands->count())
                    <div class="filter-title">Brand</div>
                    <div class="mb-4 d-flex flex-column gap-2">
                        @foreach($brands as $brand)
                        <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                            <input type="radio" name="brand" value="{{ $brand }}"
                                   {{ request('brand')==$brand ? 'checked' : '' }}
                                   style="accent-color:var(--blue-600);width:13px;height:13px;cursor:pointer;">
                            <span style="font-size:.78rem;font-weight:600;color:var(--slate-600);">{{ $brand }}</span>
                        </label>
                        @endforeach
                    </div>
                    @endif

                    {{-- Sort --}}
                    <div class="filter-title">Urutkan</div>
                    <div class="mb-4">
                        <select name="sort" class="form-select form-select-sm"
                                onchange="document.getElementById('filterFormDesktop').submit()">
                            <option value="newest"     {{ request('sort','newest')=='newest'     ? 'selected' : '' }}>Terbaru</option>
                            <option value="price_asc"  {{ request('sort')=='price_asc'           ? 'selected' : '' }}>Harga: Rendah–Tinggi</option>
                            <option value="price_desc" {{ request('sort')=='price_desc'          ? 'selected' : '' }}>Harga: Tinggi–Rendah</option>
                            <option value="popular"    {{ request('sort')=='popular'             ? 'selected' : '' }}>Populer</option>
                        </select>
                    </div>

                    <button type="submit" class="btn-carage w-100">
                        <i class="bi bi-funnel me-2"></i>Terapkan Filter
                    </button>
                    <a href="{{ route('products.index') }}"
                       class="d-block text-center mt-2 text-decoration-none"
                       style="font-size:.75rem;font-weight:700;color:var(--slate-400);padding:7px;border-radius:8px;border:1px solid var(--slate-200);transition:all .15s;"
                       onmouseover="this.style.background='var(--slate-50)'"
                       onmouseout="this.style.background='transparent'">
                        Reset Filter
                    </a>
                </form>
            </div>
        </div>

        {{-- ── MAIN CONTENT ────────────────────────────── --}}
        <div class="col-lg-9">

            {{-- Page header --}}
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h1 class="section-title mb-0">
                        @if(request('kategori'))
                            {{ ucfirst(str_replace('-',' ',request('kategori'))) }}
                        @elseif(request('cari'))
                            Hasil "<span class="hl">{{ request('cari') }}</span>"
                        @else
                            Katalog <span class="hl">Produk</span>
                        @endif
                    </h1>
                    <p style="font-size:.72rem;color:var(--slate-400);margin:4px 0 0;font-weight:600;">
                        <i class="bi bi-box-seam me-1"></i>
                        <span id="totalCount">{{ $products->total() }}</span> produk tersedia
                        · Menampilkan <span id="shownCount">{{ $products->count() }}</span>
                    </p>
                </div>
                {{-- Mobile: filter button only --}}
                <button class="toolbar-filter-btn" onclick="openFilterDrawer()">
                    <i class="bi bi-sliders"></i> Filter
                    @if(request('kategori') || request('brand') || request('cari'))
                    <span style="background:var(--blue-600);width:15px;height:15px;border-radius:50%;font-size:.55rem;display:inline-flex;align-items:center;justify-content:center;">
                        {{ (request('kategori') ? 1 : 0) + (request('brand') ? 1 : 0) + (request('cari') ? 1 : 0) }}
                    </span>
                    @endif
                </button>
            </div>

            {{-- Product grid --}}
            @if($products->count())
            <div class="row g-3" id="productGrid">
                @foreach($products as $product)
                <div class="col-6 col-md-4 product-card-wrap">
                    <div class="product-card h-100 d-flex flex-column">
                        <div class="img-wrap">
                            @if($product->image)
                                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                            @else
                                <div class="img-placeholder">🔧</div>
                            @endif
                            @if($product->is_featured)
                                <span class="badge-featured">Unggulan</span>
                            @endif
                            @if($product->stock > 0)
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
                            <div class="brand-tag">{{ $product->brand }} · {{ $product->category->name }}</div>
                            <h6>{{ $product->name }}</h6>
                            <div class="price">{{ $product->formatted_price }}</div>
                            <div class="stock-info mb-2">
                                @if($product->stock > 10)
                                    <span style="color:#059669;font-weight:700;font-size:.68rem;"><i class="bi bi-circle-fill me-1" style="font-size:.36rem;vertical-align:middle;"></i>Stok {{ $product->stock }}</span>
                                @elseif($product->stock > 0)
                                    <span style="color:#D97706;font-weight:700;font-size:.68rem;"><i class="bi bi-circle-fill me-1" style="font-size:.36rem;vertical-align:middle;"></i>Terbatas ({{ $product->stock }})</span>
                                @else
                                    <span style="color:#DC2626;font-weight:700;font-size:.68rem;"><i class="bi bi-circle-fill me-1" style="font-size:.36rem;vertical-align:middle;"></i>Stok Habis</span>
                                @endif
                            </div>
                            <div class="d-flex gap-2 mt-auto">
                                <a href="{{ route('products.show', $product->slug) }}"
                                   class="btn-ghost flex-fill text-center text-decoration-none d-flex align-items-center justify-content-center"
                                   style="font-size:.75rem;">Detail</a>
                                @if($product->stock > 0)
                                    @auth
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
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

            {{-- Load More --}}
            @if($products->hasMorePages())
            <div class="load-more-section" id="loadMoreSection">
                <button class="btn-load-more" id="loadMoreBtn" onclick="loadMoreProducts()">
                    <i class="bi bi-arrow-down-circle" id="loadMoreIcon"></i>
                    <span id="loadMoreText">Muat Lebih Banyak</span>
                </button>
                <div class="load-more-progress">
                    Menampilkan <span id="shownCount2">{{ $products->count() }}</span> dari {{ $products->total() }} produk
                </div>
                <div class="progress-bar-wrap">
                    <div class="progress-bar-fill" id="loadProgress"
                         style="width:{{ round($products->count()/$products->total()*100) }}%"></div>
                </div>
            </div>
            @else
            <div class="load-more-section">
                <div style="display:inline-flex;align-items:center;gap:8px;font-size:.75rem;font-weight:700;color:var(--slate-400);background:var(--slate-50);padding:9px 18px;border-radius:10px;border:1px solid var(--slate-200);">
                    <i class="bi bi-check-circle-fill" style="color:#059669;"></i>
                    Semua produk sudah ditampilkan
                </div>
                <div class="load-more-progress">Total {{ $products->total() }} produk</div>
            </div>
            @endif

            @else
            {{-- Empty state --}}
            <div class="empty-state fade-up">
                <div style="font-size:3rem;margin-bottom:14px;opacity:.4;">🔍</div>
                <h5 style="font-family:'Bricolage Grotesque',sans-serif;font-weight:800;font-size:1.15rem;letter-spacing:-.3px;margin-bottom:8px;">
                    Produk tidak ditemukan
                </h5>
                <p style="font-size:.82rem;color:var(--slate-400);margin-bottom:20px;">
                    Coba kata kunci atau filter yang berbeda
                </p>
                <a href="{{ route('products.index') }}" class="btn-carage text-decoration-none">
                    <i class="bi bi-arrow-left me-2"></i>Lihat Semua Produk
                </a>
            </div>
            @endif
        </div>

    </div>{{-- /row --}}
</div>{{-- /container --}}


{{-- ── MOBILE FILTER DRAWER ────────────────────────── --}}
<div class="filter-drawer-overlay" id="filterOverlay" onclick="closeFilterDrawer()"></div>
<div class="filter-drawer" id="filterDrawer">
    <div class="filter-drawer-handle"></div>
    <div class="filter-drawer-inner">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px;">
            <span style="font-family:'Bricolage Grotesque',sans-serif;font-weight:800;font-size:.95rem;letter-spacing:-.3px;">Filter Produk</span>
            <button onclick="closeFilterDrawer()"
                    style="background:var(--slate-100);border:none;width:28px;height:28px;border-radius:7px;font-size:.95rem;cursor:pointer;display:flex;align-items:center;justify-content:center;color:var(--slate-600);">
                ×
            </button>
        </div>

        <form action="{{ route('products.index') }}" method="GET" id="filterFormMobile">

            {{-- Search --}}
            <div class="filter-title">Pencarian</div>
            <div class="mb-3">
                <div style="position:relative;">
                    <i class="bi bi-search" style="position:absolute;left:11px;top:50%;transform:translateY(-50%);color:var(--slate-400);font-size:.8rem;"></i>
                    <input type="text" name="cari" class="form-control"
                           placeholder="Cari produk..."
                           value="{{ request('cari') }}"
                           style="padding-left:32px;">
                </div>
            </div>

            {{-- Category --}}
            <div class="filter-title">Kategori</div>
            <div class="mb-3 d-flex flex-column gap-1">
                <a href="{{ route('products.index') }}" class="cat-link {{ !request('kategori') ? 'active' : '' }}">
                    Semua Kategori
                </a>
                @foreach($categories as $cat)
                <a href="{{ route('products.index') }}?kategori={{ $cat->slug }}"
                   class="cat-link {{ request('kategori')==$cat->slug ? 'active' : '' }}"
                   onclick="closeFilterDrawer()">
                    {{ $cat->name }}
                    <span class="cat-count-badge">{{ $cat->products_count }}</span>
                </a>
                @endforeach
            </div>

            {{-- Brand --}}
            @if($brands->count())
            <div class="filter-title">Brand</div>
            <div class="mb-3 d-flex flex-column gap-2">
                @foreach($brands as $brand)
                <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                    <input type="radio" name="brand" value="{{ $brand }}"
                           {{ request('brand')==$brand ? 'checked' : '' }}
                           style="accent-color:var(--blue-600);width:13px;height:13px;cursor:pointer;">
                    <span style="font-size:.78rem;font-weight:600;color:var(--slate-600);">{{ $brand }}</span>
                </label>
                @endforeach
            </div>
            @endif

            {{-- Sort --}}
            <div class="filter-title">Urutkan</div>
            <div class="mb-4">
                <select name="sort" class="form-select form-select-sm">
                    <option value="newest"     {{ request('sort','newest')=='newest'     ? 'selected' : '' }}>Terbaru</option>
                    <option value="price_asc"  {{ request('sort')=='price_asc'           ? 'selected' : '' }}>Harga: Rendah–Tinggi</option>
                    <option value="price_desc" {{ request('sort')=='price_desc'          ? 'selected' : '' }}>Harga: Tinggi–Rendah</option>
                    <option value="popular"    {{ request('sort')=='popular'             ? 'selected' : '' }}>Populer</option>
                </select>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;">
                <a href="{{ route('products.index') }}"
                   class="btn-ghost text-center text-decoration-none d-flex align-items-center justify-content-center">
                    Reset
                </a>
                <button type="submit" class="btn-carage">
                    <i class="bi bi-funnel me-2"></i>Terapkan
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
// ── VIEW MODE ─────────────────────────────────────────
function setView(mode) {
    const grid = document.getElementById('productGrid');
    const gridBtn = document.getElementById('gridViewBtn');
    const listBtn = document.getElementById('listViewBtn');
    if (mode === 'list') {
        grid.classList.add('list-mode');
        listBtn.classList.add('active');
        gridBtn.classList.remove('active');
        localStorage.setItem('catalogView', 'list');
    } else {
        grid.classList.remove('list-mode');
        gridBtn.classList.add('active');
        listBtn.classList.remove('active');
        localStorage.setItem('catalogView', 'grid');
    }
}
document.addEventListener('DOMContentLoaded', () => {
    const saved = localStorage.getItem('catalogView');
    if (saved === 'list') setView('list');
});

// ── MOBILE FILTER DRAWER ──────────────────────────────
function openFilterDrawer() {
    document.getElementById('filterOverlay').classList.add('open');
    document.getElementById('filterDrawer').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeFilterDrawer() {
    document.getElementById('filterOverlay').classList.remove('open');
    document.getElementById('filterDrawer').classList.remove('open');
    document.body.style.overflow = '';
}

// ── LOAD MORE ─────────────────────────────────────────
let currentPage = {{ $products->currentPage() }};
const lastPage  = {{ $products->lastPage() }};
const total     = {{ $products->total() }};
let isLoading   = false;

function loadMoreProducts() {
    if (isLoading || currentPage >= lastPage) return;
    isLoading = true;

    const btn  = document.getElementById('loadMoreBtn');
    const icon = document.getElementById('loadMoreIcon');
    const text = document.getElementById('loadMoreText');
    btn.classList.add('loading');
    icon.className = 'bi bi-arrow-repeat spin';
    text.textContent = 'Memuat...';

    const params = new URLSearchParams(window.location.search);
    params.set('page', currentPage + 1);

    fetch(`{{ route('products.index') }}?${params.toString()}`, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(r => r.text())
    .then(html => {
        const parser = new DOMParser();
        const doc    = parser.parseFromString(html, 'text/html');
        const newCards = doc.querySelectorAll('#productGrid .product-card-wrap');
        const grid   = document.getElementById('productGrid');

        newCards.forEach((card, i) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(16px)';
            grid.appendChild(card);
            setTimeout(() => {
                card.style.transition = 'opacity .35s ease, transform .35s ease';
                card.style.opacity    = '1';
                card.style.transform  = 'translateY(0)';
            }, i * 50);
        });

        currentPage++;
        const shown = grid.querySelectorAll('.product-card-wrap').length;

        document.getElementById('shownCount').textContent  = shown;
        document.getElementById('shownCount2') && (document.getElementById('shownCount2').textContent = shown);
        document.getElementById('loadProgress') && (document.getElementById('loadProgress').style.width = Math.round(shown/total*100)+'%');

        if (currentPage >= lastPage) {
            document.getElementById('loadMoreSection').innerHTML = `
                <div style="display:inline-flex;align-items:center;gap:8px;font-size:.75rem;font-weight:700;color:var(--slate-400);background:var(--slate-50);padding:9px 18px;border-radius:10px;border:1px solid var(--slate-200);">
                    <i class="bi bi-check-circle-fill" style="color:#059669;"></i>
                    Semua produk sudah ditampilkan
                </div>
                <div class="load-more-progress">Total ${total} produk</div>`;
        } else {
            btn.classList.remove('loading');
            icon.className = 'bi bi-arrow-down-circle';
            text.textContent = 'Muat Lebih Banyak';
        }
        isLoading = false;
    })
    .catch(() => {
        btn.classList.remove('loading');
        icon.className = 'bi bi-arrow-down-circle';
        text.textContent = 'Muat Lebih Banyak';
        isLoading = false;
    });
}
</script>
<style>
@keyframes spin { to { transform: rotate(360deg); } }
.spin { display:inline-block; animation: spin .7s linear infinite; }
</style>
@endpush