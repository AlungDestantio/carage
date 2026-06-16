@extends('layouts.admin')
@section('title', 'Kelola Produk')
@section('page-title', 'Kelola Produk')

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
    color: var(--slate-900); width: 220px;
    transition: border-color .2s, box-shadow .2s;
    background: var(--slate-50);
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

.table-produk { border-collapse: separate; border-spacing: 0; width: 100%; }
.table-produk thead th {
    background: var(--slate-50);
    color: var(--slate-400);
    font-size: .63rem; font-weight: 800;
    text-transform: uppercase; letter-spacing: 1px;
    border: none;
    border-bottom: 1px solid var(--slate-200);
    padding: 11px 18px;
    white-space: nowrap;
}
.table-produk tbody td {
    padding: 13px 18px;
    vertical-align: middle;
    border-bottom: 1px solid var(--slate-100);
    font-size: .84rem;
}
.table-produk tbody tr:last-child td { border-bottom: none; }
.table-produk tbody tr { transition: background .12s; }
.table-produk tbody tr:hover td { background: var(--slate-50); }

/* ── Produk cell ── */
.produk-cell { display: flex; align-items: center; gap: 12px; }
.produk-thumb {
    width: 46px; height: 46px;
    border-radius: var(--radius-md);
    background: var(--slate-100);
    border: 1px solid var(--slate-200);
    overflow: hidden; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
}
.produk-thumb img { width: 100%; height: 100%; object-fit: cover; }
.produk-thumb-placeholder { font-size: 1.1rem; color: var(--slate-300); }
.produk-name {
    font-weight: 700; font-size: .84rem;
    color: var(--slate-900);
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    max-width: 240px; display: block;
}
.produk-meta {
    display: flex; align-items: center; gap: 5px;
    font-size: .68rem; color: var(--slate-400); margin-top: 2px;
}
.produk-sku {
    font-family: monospace;
    background: var(--slate-100);
    padding: 1px 5px; border-radius: 3px;
    font-size: .66rem; color: var(--slate-500);
}

/* ── Inline chips ── */
.badge-kategori {
    background: var(--blue-50); color: var(--blue-600);
    border: 1px solid var(--blue-100);
    padding: 3px 9px; border-radius: 6px;
    font-size: .68rem; font-weight: 700; white-space: nowrap;
}
.produk-price {
    font-family: var(--font-display);
    font-weight: 800; font-size: .88rem;
    color: var(--slate-900);
}

/* ── Stok pills ── */
.stok-pill {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 3px 9px; border-radius: 6px;
    font-size: .72rem; font-weight: 700;
}
.stok-dot { width: 5px; height: 5px; border-radius: 50%; flex-shrink: 0; }
.stok-ok    { background: #ECFDF5; color: #059669; }
.stok-ok    .stok-dot { background: #059669; }
.stok-low   { background: #FFFBEB; color: #D97706; }
.stok-low   .stok-dot { background: #D97706; }
.stok-empty { background: #FEF2F2; color: #DC2626; }

/* ── Status badges ── */
.badge-status {
    padding: 3px 9px; border-radius: 5px;
    font-size: .63rem; font-weight: 800;
    text-transform: uppercase; letter-spacing: .4px;
    display: inline-block; white-space: nowrap;
}
.badge-active   { background: #ECFDF5; color: #059669; border: 1px solid #D1FAE5; }
.badge-inactive { background: var(--slate-100); color: var(--slate-500); border: 1px solid var(--slate-200); }
.badge-featured { background: #FFF7ED; color: #C2410C; border: 1px solid #FED7AA; }

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
.aksi-edit   { background: var(--blue-50); color: var(--blue-700); border: 1px solid var(--blue-100); }
.aksi-edit:hover   { background: var(--blue-100); color: var(--blue-800); }
.aksi-delete { background: #FEF2F2; color: #DC2626; border: 1px solid #FECACA; }
.aksi-delete:hover { background: #FEE2E2; color: #991B1B; }

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
.empty-sub { font-size: .78rem; color: var(--slate-400); max-width: 280px; line-height: 1.6; }

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
    .col-hide-tablet { display: none !important; }
    .filter-input    { width: 180px; }
    .produk-name     { max-width: 180px; }
    .table-produk thead th,
    .table-produk tbody td { padding: 10px 14px; }
}

@media (max-width: 767px) {
    /* Page header */
    .page-header { margin-bottom: 14px; gap: 10px; }
    .page-header-eyebrow { font-size: .56rem; margin-bottom: 3px; }
    .page-header-title   { font-size: 1.1rem; }
    .page-header-sub     { font-size: .66rem; margin-top: 3px; }
    .page-header .btn-carage { font-size: .72rem; padding: 7px 12px; border-radius: 8px; }

    /* Filter bar */
    .filter-bar { padding: 10px 12px; gap: 7px; border-radius: 12px; }
    .filter-form { gap: 6px; }
    .filter-search { width: 100%; }
    .filter-input  { width: 100%; font-size: .75rem; padding: 6px 10px 6px 28px; border-radius: 8px; }
    .filter-select { font-size: .7rem; padding: 6px 7px; border-radius: 8px; flex: 1; min-width: 0; }
    .filter-form .btn-carage,
    .filter-form .btn-ghost { font-size: .68rem; padding: 6px 10px; border-radius: 7px; flex-shrink: 0; }

    /* Table card */
    .table-card { border-radius: 12px; }

    /* Hide extra columns — keep only Produk + Stok + Aksi */
    .col-hide-mobile { display: none !important; }

    /* Compact table */
    .table-produk thead th { font-size: .58rem; padding: 8px 10px; }
    .table-produk tbody td { padding: 10px 10px; font-size: .78rem; }

    /* Produk cell compact */
    .produk-cell  { gap: 8px; }
    .produk-thumb { width: 38px; height: 38px; border-radius: 7px; }
    .produk-name  { font-size: .74rem; max-width: 120px; }
    .produk-meta  { font-size: .59rem; margin-top: 1px; flex-wrap: wrap; gap: 3px; }
    .produk-sku   { font-size: .58rem; }

    /* Stok pill compact */
    .stok-pill { font-size: .6rem; padding: 2px 6px; gap: 3px; }
    .stok-dot  { width: 4px; height: 4px; }

    /* Aksi: icon only, no label */
    .aksi-wrap     { gap: 4px; }
    .aksi-btn      { padding: 5px 8px; font-size: .72rem; border-radius: 6px; }
    .aksi-btn span { display: none; }

    /* Pagination */
    .pag-bar  { padding: 10px 12px; gap: 8px; }
    .pag-info { font-size: .62rem; }
    .pag-pages { display: none; }
    .pag-btn  { font-size: .66rem; padding: 5px 10px; border-radius: 7px; }
    .pag-btn .d-none { display: none !important; }

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
        <h2 class="page-header-title">Kelola Produk</h2>
        <p class="page-header-sub">{{ $products->total() }} produk terdaftar di toko</p>
    </div>
    <a href="{{ route('admin.produk.create') }}" class="btn-carage text-decoration-none d-inline-flex align-items-center gap-2">
        <i class="bi bi-plus-lg"></i> Tambah Produk
    </a>
</div>

{{-- ── FILTER BAR ── --}}
<div class="filter-bar">
    <form action="{{ route('admin.produk.index') }}" method="GET" class="filter-form">
        <div class="filter-search">
            <i class="bi bi-search filter-search-icon"></i>
            <input type="text" name="cari" class="filter-input"
                   placeholder="Cari produk, brand, SKU..."
                   value="{{ request('cari') }}">
        </div>

        <select name="kategori" class="filter-select">
            <option value="">Semua Kategori</option>
            @foreach($categories ?? [] as $cat)
            <option value="{{ $cat->id }}" {{ request('kategori') == $cat->id ? 'selected' : '' }}>
                {{ $cat->name }}
            </option>
            @endforeach
        </select>

        <select name="status" class="filter-select">
            <option value="">Semua Status</option>
            <option value="active"   {{ request('status') === 'active'   ? 'selected' : '' }}>Aktif</option>
            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Non-Aktif</option>
            <option value="featured" {{ request('status') === 'featured' ? 'selected' : '' }}>Unggulan</option>
            <option value="empty"    {{ request('status') === 'empty'    ? 'selected' : '' }}>Stok Habis</option>
        </select>

        <button type="submit"
                class="btn-carage btn-carage-sm">
            <i class="bi bi-funnel"></i>
            <span class="d-none d-sm-inline">Filter</span>
        </button>

        @if(request()->hasAny(['cari','kategori','status']))
        <a href="{{ route('admin.produk.index') }}" class="btn-ghost btn-carage-sm text-decoration-none">
            <i class="bi bi-x-lg"></i> <span class="d-none d-sm-inline">Reset</span>
        </a>
        @endif
    </form>

    <div class="filter-meta d-none d-md-block">
        <strong>{{ $products->count() }}</strong> / <strong>{{ $products->total() }}</strong> produk
    </div>
</div>

{{-- ── PRODUCT TABLE ── --}}
<div class="table-card">
    <div class="table-responsive">
        <table class="table-produk">
            <thead>
                <tr>
                    <th style="width:45%;">Produk</th>
                    <th class="col-hide-tablet col-hide-mobile">Kategori</th>
                    <th class="col-hide-mobile">Harga</th>
                    <th>Stok</th>
                    <th class="col-hide-tablet col-hide-mobile">Status</th>
                    <th style="text-align:right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td>
                        <div class="produk-cell">
                            <div class="produk-thumb">
                                @if($product->image)
                                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                                @else
                                    <span class="produk-thumb-placeholder"><i class="bi bi-box-seam"></i></span>
                                @endif
                            </div>
                            <div style="min-width:0;">
                                <span class="produk-name">{{ Str::limit($product->name, 42) }}</span>
                                <div class="produk-meta">
                                    @if($product->brand)<span>{{ $product->brand }}</span>@endif
                                    @if($product->brand && $product->sku)<span style="color:var(--slate-300);">·</span>@endif
                                    @if($product->sku)<span class="produk-sku">{{ $product->sku }}</span>@endif
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="col-hide-tablet col-hide-mobile"><span class="badge-kategori">{{ $product->category->name }}</span></td>
                    <td class="col-hide-mobile"><span class="produk-price">{{ $product->formatted_price }}</span></td>
                    <td>
                        @if($product->stock > 10)
                            <div class="stok-pill stok-ok"><span class="stok-dot"></span>{{ $product->stock }}</div>
                        @elseif($product->stock > 0)
                            <div class="stok-pill stok-low"><span class="stok-dot"></span>{{ $product->stock }}</div>
                        @else
                            <div class="stok-pill stok-empty">Habis</div>
                        @endif
                        {{-- Mobile only: show price below stok --}}
                        <div class="d-md-none mt-1" style="font-family:var(--font-display);font-weight:800;font-size:.72rem;color:var(--slate-900);">{{ $product->formatted_price }}</div>
                    </td>
                    <td class="col-hide-tablet col-hide-mobile">
                        <div style="display:flex;flex-wrap:wrap;gap:4px;">
                            @if($product->is_active)
                                <span class="badge-status badge-active">Aktif</span>
                            @else
                                <span class="badge-status badge-inactive">Non-Aktif</span>
                            @endif
                            @if($product->is_featured)
                                <span class="badge-status badge-featured">Unggulan</span>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="aksi-wrap">
                            <a href="{{ route('admin.produk.edit', $product->id) }}" class="aksi-btn aksi-edit">
                                <i class="bi bi-pencil-fill"></i> <span>Edit</span>
                            </a>
                            <form action="{{ route('admin.produk.destroy', $product->id) }}" method="POST"
                                  onsubmit="return confirm('Hapus \'{{ addslashes(Str::limit($product->name,30)) }}\'?\nTindakan ini tidak dapat dibatalkan.')">
                                @csrf @method('DELETE')
                                <button type="submit" class="aksi-btn aksi-delete">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="6">
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="bi bi-box-seam"></i>
                            </div>
                            <div class="empty-title">
                                {{ request()->hasAny(['cari','kategori','status']) ? 'Tidak ada produk yang cocok' : 'Belum ada produk' }}
                            </div>
                            <div class="empty-sub">
                                {{ request()->hasAny(['cari','kategori','status']) ? 'Coba ubah kata kunci atau filter pencarian' : 'Mulai tambahkan produk untuk ditampilkan di toko' }}
                            </div>
                            @if(request()->hasAny(['cari','kategori','status']))
                                <a href="{{ route('admin.produk.index') }}" class="btn-ghost text-decoration-none mt-3 d-inline-flex align-items-center gap-2">
                                    <i class="bi bi-arrow-counterclockwise"></i> Reset Filter
                                </a>
                            @else
                                <a href="{{ route('admin.produk.create') }}" class="btn-carage text-decoration-none mt-3 d-inline-flex align-items-center gap-2">
                                    <i class="bi bi-plus-lg"></i> Tambah Produk Pertama
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
    @if($products->hasPages())
    <div class="pag-bar">
        <div class="pag-info">
            Hal. <strong>{{ $products->currentPage() }}</strong> / <strong>{{ $products->lastPage() }}</strong>
            &nbsp;·&nbsp;
            {{ $products->firstItem() }}–{{ $products->lastItem() }} dari {{ $products->total() }} produk
        </div>

        <div class="pag-actions">
            @if($products->onFirstPage())
                <span class="pag-btn pag-btn-disabled"><i class="bi bi-arrow-left"></i> <span class="d-none d-sm-inline">Sebelumnya</span></span>
            @else
                <a href="{{ $products->previousPageUrl() }}" class="pag-btn">
                    <i class="bi bi-arrow-left"></i> <span class="d-none d-sm-inline">Sebelumnya</span>
                </a>
            @endif

            <div class="pag-pages">
                @for($p = max(1, $products->currentPage()-1); $p <= min($products->lastPage(), $products->currentPage()+1); $p++)
                    @if($p === $products->currentPage())
                        <span class="pag-page pag-page-active">{{ $p }}</span>
                    @else
                        <a href="{{ $products->url($p) }}" class="pag-page">{{ $p }}</a>
                    @endif
                @endfor
            </div>

            @if($products->hasMorePages())
                <a href="{{ $products->nextPageUrl() }}" class="pag-btn pag-btn-primary">
                    <span class="d-none d-sm-inline">Selanjutnya</span> <i class="bi bi-arrow-right"></i>
                </a>
            @else
                <span class="pag-btn pag-btn-disabled"><span class="d-none d-sm-inline">Selanjutnya</span> <i class="bi bi-arrow-right"></i></span>
            @endif
        </div>
    </div>
    @endif
</div>

@endsection