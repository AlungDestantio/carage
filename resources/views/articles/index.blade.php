@extends('layouts.app')
@section('title', 'Artikel')

@push('styles')
<style>
@media (max-width: 767px) {
    /* Breadcrumb */
    .breadcrumb-carage { padding: 8px 0; }
    .breadcrumb-item a,
    .breadcrumb-item.active { font-size: .68rem; }
    .breadcrumb-item + .breadcrumb-item::before { font-size: .68rem; }
    .breadcrumb-item.active {
        max-width: 160px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: inline-block;
        vertical-align: middle;
    }

    /* Page header */
    .container.py-5 { padding-top: 20px !important; padding-bottom: 24px !important; }
    .section-eyebrow { font-size: .58rem; margin-bottom: 4px; }
    .section-title { font-size: 1.2rem !important; letter-spacing: -.3px; }

    /* Search bar — full width di mobile */
    .article-search-wrap {
        width: 100% !important;
        margin-top: 10px;
    }
    .article-search-wrap input {
        width: 100% !important;
        font-size: .78rem !important;
        padding: 9px 0 !important;
    }
    .article-search-wrap button {
        padding: 0 14px !important;
        font-size: .72rem !important;
    }
    .article-search-wrap .search-icon-wrap {
        padding: 0 10px !important;
        font-size: .8rem !important;
    }

    /* Search result alert */
    .alert { font-size: .75rem !important; padding: 9px 12px; }

    /* Article grid — 1 kolom di mobile */
    .row.g-4 > .col-md-4 {
        flex: 0 0 100% !important;
        max-width: 100% !important;
    }

    /* Article card */
    .article-card { border-radius: 12px; }
    .article-card .img-wrap { height: 150px !important; }
    .article-card > div[style*="padding:20px"] {
        padding: 12px 14px 14px !important;
    }
    .article-card .article-date { font-size: .62rem !important; margin-bottom: 5px !important; }
    .article-card h6 { font-size: .8rem !important; line-height: 1.4 !important; margin-bottom: 5px !important; }
    .article-card p  { font-size: .72rem !important; line-height: 1.6 !important; margin-bottom: 9px !important; }
    .article-card .read-link { font-size: .68rem !important; }

    /* Pagination */
    .mt-5.d-flex.justify-content-center { margin-top: 24px !important; }
    .page-link { font-size: .72rem !important; padding: 5px 9px !important; }

    /* Empty state */
    .admin-card .p-5 { padding: 28px 18px !important; }
    .admin-card .p-5 > div[style*="width:80px"] {
        width: 58px !important; height: 58px !important;
        font-size: 1.6rem !important;
        margin-bottom: 14px !important;
    }
    .admin-card h5 { font-size: 1rem !important; }
    .admin-card p  { font-size: .75rem !important; margin-bottom: 16px !important; }
    .admin-card .btn-carage { font-size: .78rem; padding: 9px 16px; border-radius: 9px; }
}
</style>
@endpush

@section('content')

<div class="breadcrumb-carage">
    <div class="container">
        <nav><ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Artikel</li>
        </ol></nav>
    </div>
</div>

<div class="container py-5">

    {{-- Page Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4 mb-md-5 fade-up">
        <div>
            <div class="section-eyebrow">Tips & Informasi</div>
            <h1 class="section-title">Arsip <span class="hl">Artikel</span></h1>
        </div>

        {{-- Search --}}
        <form action="{{ route('articles.index') }}" method="GET" class="article-search-wrap">
            <div style="display:flex;background:white;border:1.5px solid var(--slate-200);border-radius:var(--radius-lg);overflow:hidden;transition:border-color .2s;box-shadow:0 2px 8px rgba(15,23,42,0.04);"
                 onfocusin="this.style.borderColor='var(--blue-400)'"
                 onfocusout="this.style.borderColor='var(--slate-200)'">
                <div class="search-icon-wrap" style="display:flex;align-items:center;padding:0 14px;color:var(--slate-300);font-size:.9rem;flex-shrink:0;">
                    <i class="bi bi-search"></i>
                </div>
                <input type="text" name="cari"
                       placeholder="Cari artikel..."
                       value="{{ request('cari') }}"
                       style="border:none;outline:none;padding:11px 0;font-family:var(--font-body);font-size:.88rem;font-weight:500;color:var(--slate-900);background:transparent;width:200px;">
                <button type="submit"
                        style="background:var(--blue-600);border:none;color:white;padding:0 20px;font-family:var(--font-body);font-weight:700;font-size:.82rem;cursor:pointer;transition:background .15s;flex-shrink:0;display:flex;align-items:center;gap:6px;"
                        onmouseover="this.style.background='var(--blue-700)'"
                        onmouseout="this.style.background='var(--blue-600)'">
                    Cari
                </button>
            </div>
        </form>
    </div>

    {{-- Search result info --}}
    @if(request('cari'))
    <div class="alert alert-info mb-4 fade-up" style="font-size:.85rem;">
        <i class="bi bi-search me-2"></i>
        Hasil pencarian untuk: <strong>"{{ request('cari') }}"</strong> — {{ $articles->total() }} artikel ditemukan
        <a href="{{ route('articles.index') }}" class="ms-2" style="color:var(--blue-700);font-weight:700;text-decoration:none;">Hapus filter ×</a>
    </div>
    @endif

    @if($articles->count())

    <div class="row g-4">
        @foreach($articles as $article)
        <div class="col-md-4 fade-up fade-up-{{ ($loop->index % 3) + 1 }}">
            <a href="{{ route('articles.show', $article->slug) }}" class="article-card h-100 text-decoration-none">
                <div class="img-wrap" style="height:200px;">
                    @if($article->image)
                        <img src="{{ asset('storage/'.$article->image) }}" alt="{{ $article->title }}">
                    @else
                        <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:3.5rem;color:var(--slate-300);background:var(--slate-100);">📰</div>
                    @endif
                </div>
                <div style="padding:20px 22px 22px;">
                    <div class="article-date mb-2">
                        <i class="bi bi-calendar3 me-1"></i>{{ $article->published_at->format('d M Y') }}
                        <span class="ms-2"><i class="bi bi-person me-1"></i>{{ $article->author->name }}</span>
                    </div>
                    <h6 style="font-weight:700;font-size:.95rem;color:var(--slate-900);line-height:1.45;margin-bottom:8px;">
                        {{ $article->title }}
                    </h6>
                    <p style="font-size:.82rem;color:var(--slate-400);line-height:1.65;margin-bottom:14px;">
                        {{ Str::limit($article->excerpt, 110) }}
                    </p>
                    <span class="read-link" style="display:inline-flex;align-items:center;gap:4px;">
                        Baca Selengkapnya <i class="bi bi-arrow-right" style="font-size:.75rem;"></i>
                    </span>
                </div>
            </a>
        </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    @if($articles->hasPages())
    <div class="mt-5 d-flex justify-content-center fade-up">
        {{ $articles->links() }}
    </div>
    @endif

    @else

    {{-- Empty state --}}
    <div class="admin-card fade-up" style="max-width:480px;margin:0 auto;">
        <div class="p-5 text-center">
            <div style="width:80px;height:80px;background:var(--blue-50);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:2.2rem;margin:0 auto 20px;">
                📰
            </div>
            <h5 style="font-family:var(--font-display);font-weight:800;font-size:1.4rem;color:var(--slate-900);letter-spacing:-.5px;margin-bottom:8px;">
                @if(request('cari'))
                    Artikel Tidak Ditemukan
                @else
                    Belum Ada Artikel
                @endif
            </h5>
            <p style="font-size:.88rem;color:var(--slate-400);max-width:300px;margin:0 auto 24px;line-height:1.7;">
                @if(request('cari'))
                    Coba kata kunci lain atau lihat semua artikel yang tersedia.
                @else
                    Artikel tips & informasi seputar perawatan mobil akan segera tersedia.
                @endif
            </p>
            @if(request('cari'))
            <a href="{{ route('articles.index') }}" class="btn-carage text-decoration-none d-inline-flex align-items-center gap-2">
                <i class="bi bi-arrow-left"></i> Lihat Semua Artikel
            </a>
            @endif
        </div>
    </div>

    @endif

</div>

@endsection