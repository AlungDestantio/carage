{{-- =========================================================
    resources/views/articles/show.blade.php
   ========================================================= --}}
@extends('layouts.app')
@section('title', $article->title)

@push('styles')
<style>
/* ── ARTICLE CONTENT TYPOGRAPHY ─────────────────────────── */
.article-body {
    font-size: .97rem;
    line-height: 1.9;
    color: var(--slate-700);
}
.article-body h2 {
    font-family: var(--font-display);
    font-weight: 800;
    font-size: 1.45rem;
    color: var(--slate-900);
    letter-spacing: -.5px;
    margin-top: 36px;
    margin-bottom: 14px;
    padding-bottom: 10px;
    border-bottom: 2px solid var(--blue-100);
}
.article-body h3 {
    font-family: var(--font-display);
    font-weight: 800;
    font-size: 1.15rem;
    color: var(--slate-900);
    margin-top: 28px;
    margin-bottom: 10px;
}
.article-body p { margin-bottom: 18px; }
.article-body ul, .article-body ol {
    padding-left: 22px;
    margin-bottom: 18px;
}
.article-body li { margin-bottom: 8px; }
.article-body strong { color: var(--slate-900); font-weight: 700; }
.article-body a { color: var(--blue-600); font-weight: 600; }
.article-body blockquote {
    border-left: 4px solid var(--blue-400);
    background: var(--blue-50);
    margin: 24px 0;
    padding: 16px 20px;
    border-radius: 0 var(--radius-md) var(--radius-md) 0;
    font-style: italic;
    color: var(--slate-600);
}
.article-body img {
    width: 100%;
    border-radius: var(--radius-lg);
    margin: 20px 0;
}
.article-body table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 18px;
    font-size: .88rem;
}
.article-body table th {
    background: var(--slate-900);
    color: rgba(255,255,255,.6);
    padding: 10px 14px;
    font-size: .72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .5px;
    text-align: left;
}
.article-body table td {
    padding: 10px 14px;
    border-bottom: 1px solid var(--slate-100);
    vertical-align: middle;
}
.article-body table tr:hover td { background: var(--slate-50); }

/* ── RELATED ARTICLE CARD ────────────────────────────────── */
.related-card {
    display: flex;
    gap: 12px;
    padding-bottom: 14px;
    margin-bottom: 14px;
    border-bottom: 1px solid var(--slate-100);
    text-decoration: none;
    transition: opacity .15s;
}
.related-card:hover { opacity: .8; }
.related-card:last-child { border-bottom: none; padding-bottom: 0; margin-bottom: 0; }
.related-thumb {
    width: 64px; height: 64px;
    background: var(--slate-100);
    border-radius: var(--radius-md);
    flex-shrink: 0; overflow: hidden;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.4rem; color: var(--slate-300);
}
.related-thumb img { width: 100%; height: 100%; object-fit: cover; }
.related-title {
    font-weight: 700; font-size: .82rem;
    color: var(--slate-900); line-height: 1.4;
    margin-bottom: 4px;
    display: block;
}
.related-date {
    font-size: .7rem; color: var(--slate-400); font-weight: 600;
}

/* ── RESPONSIVE ──────────────────────────────────────────── */
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

    /* Container spacing */
    .container.py-5 { padding-top: 20px !important; padding-bottom: 28px !important; }

    /* Sidebar — di bawah artikel di mobile */
    .col-lg-4 { margin-top: 8px; }
    .admin-card[style*="position:sticky"] { position: static !important; }

    /* Meta row */
    .d-flex.align-items-center.gap-3.mb-4 { gap: 6px !important; margin-bottom: 12px !important; flex-wrap: wrap; }
    .d-flex.align-items-center.gap-3.mb-4 span[style*="font-size:.72rem"] { font-size: .64rem !important; }
    .d-flex.align-items-center.gap-3.mb-4 span[style*="width:3px"] { display: none; }
    .d-flex.align-items-center.gap-3.mb-4 span[style*="font-size:.68rem"] { font-size: .62rem !important; padding: 2px 8px !important; }

    /* Title */
    h1[style*="font-family:var(--font-display)"] {
        font-size: 1.35rem !important;
        letter-spacing: -.4px !important;
        margin-bottom: 18px !important;
        line-height: 1.25 !important;
    }

    /* Hero image */
    .fade-up div[style*="border-radius:var(--radius-xl)"] { margin-bottom: 18px !important; border-radius: 12px !important; }
    .fade-up div[style*="border-radius:var(--radius-xl)"] img { max-height: 210px !important; }

    /* Excerpt / lead */
    div[style*="border-left:4px solid var(--blue-500)"] {
        padding: 12px 14px !important;
        margin-bottom: 20px !important;
        border-radius: 0 10px 10px 0 !important;
    }
    div[style*="border-left:4px solid var(--blue-500)"] p {
        font-size: .82rem !important;
        line-height: 1.65 !important;
    }

    /* Article body */
    .article-body { font-size: .84rem; line-height: 1.8; }
    .article-body h2 { font-size: 1.1rem; margin-top: 24px; margin-bottom: 10px; padding-bottom: 8px; }
    .article-body h3 { font-size: .95rem; margin-top: 20px; margin-bottom: 8px; }
    .article-body p  { margin-bottom: 14px; }
    .article-body li { margin-bottom: 6px; }
    .article-body blockquote { padding: 12px 14px; margin: 16px 0; font-size: .82rem; }
    .article-body table th { font-size: .62rem; padding: 8px 10px; }
    .article-body table td { font-size: .78rem; padding: 8px 10px; }

    /* Share section */
    .fade-up.mt-5.pt-4 { margin-top: 24px !important; padding-top: 16px !important; }
    .fade-up.mt-5.pt-4 > div > div:first-child > div[style*="font-size:.7rem"] { font-size: .62rem !important; margin-bottom: 6px !important; }
    .fade-up.mt-5.pt-4 a[style*="width:36px"] { width: 32px !important; height: 32px !important; font-size: .8rem !important; }
    .fade-up.mt-5.pt-4 .btn-ghost { font-size: .72rem; padding: 6px 12px; border-radius: 8px; }

    /* Sidebar card */
    .admin-card { border-radius: 12px; }
    .admin-card-header { padding: 11px 14px; }
    .admin-card-header .card-title { font-size: .64rem !important; }
    .admin-card > .p-4 { padding: 14px !important; }

    /* Related cards */
    .related-card { gap: 10px; padding-bottom: 12px; margin-bottom: 12px; }
    .related-thumb { width: 52px; height: 52px; font-size: 1.1rem; border-radius: 8px; }
    .related-title { font-size: .75rem; margin-bottom: 3px; }
    .related-date  { font-size: .62rem; }

    /* Empty related */
    .text-center.py-3 p { font-size: .72rem !important; }
}
</style>
@endpush

@section('content')

<div class="breadcrumb-carage">
    <div class="container">
        <nav><ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('articles.index') }}">Artikel</a></li>
            <li class="breadcrumb-item active">{{ Str::limit($article->title, 40) }}</li>
        </ol></nav>
    </div>
</div>

<div class="container py-5">
    <div class="row g-5">

        {{-- ══ MAIN CONTENT ══ --}}
        <div class="col-lg-8">

            {{-- Meta --}}
            <div class="d-flex align-items-center gap-3 mb-4 fade-up">
                <span style="display:inline-flex;align-items:center;gap:5px;font-size:.72rem;font-weight:600;color:var(--slate-400);">
                    <i class="bi bi-calendar3"></i> {{ $article->published_at->format('d M Y') }}
                </span>
                <span style="width:3px;height:3px;background:var(--slate-300);border-radius:50%;"></span>
                <span style="display:inline-flex;align-items:center;gap:5px;font-size:.72rem;font-weight:600;color:var(--slate-400);">
                    <i class="bi bi-person"></i> {{ $article->author->name }}
                </span>
                <span style="width:3px;height:3px;background:var(--slate-300);border-radius:50%;"></span>
                <span style="font-size:.68rem;font-weight:700;color:var(--blue-600);background:var(--blue-50);padding:3px 10px;border-radius:5px;text-transform:uppercase;letter-spacing:.5px;">
                    Artikel
                </span>
            </div>

            {{-- Title --}}
            <h1 class="fade-up fade-up-1"
                style="font-family:var(--font-display);font-weight:800;font-size:clamp(1.7rem,3.5vw,2.4rem);line-height:1.15;letter-spacing:-1px;color:var(--slate-900);margin-bottom:28px;">
                {{ $article->title }}
            </h1>

            {{-- Hero image --}}
            @if($article->image)
            <div class="fade-up fade-up-1" style="border-radius:var(--radius-xl);overflow:hidden;margin-bottom:32px;border:1px solid var(--slate-200);">
                <img src="{{ asset('storage/'.$article->image) }}" alt="{{ $article->title }}"
                     style="width:100%;display:block;max-height:440px;object-fit:cover;">
            </div>
            @endif

            {{-- Excerpt / lead --}}
            @if($article->excerpt)
            <div class="fade-up fade-up-2"
                 style="background:var(--blue-50);border-left:4px solid var(--blue-500);padding:18px 22px;border-radius:0 var(--radius-lg) var(--radius-lg) 0;margin-bottom:32px;">
                <p style="font-size:.97rem;font-weight:600;color:var(--blue-800);line-height:1.7;margin:0;">
                    {{ $article->excerpt }}
                </p>
            </div>
            @endif

            {{-- Article body --}}
            <div class="article-body fade-up fade-up-2">
                {!! $article->content !!}
            </div>

            {{-- Share section --}}
            <div class="fade-up mt-5 pt-4" style="border-top:2px solid var(--slate-100);">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <div style="font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:2px;color:var(--slate-400);margin-bottom:8px;">Bagikan Artikel</div>
                        <div class="d-flex gap-2">
                            @foreach([
                                ['bi-whatsapp','#25D366','WhatsApp'],
                                ['bi-facebook','#1877F2','Facebook'],
                                ['bi-twitter-x','#000','Twitter/X'],
                            ] as [$icon,$color,$label])
                            <a href="#" title="{{ $label }}"
                               style="width:36px;height:36px;border-radius:var(--radius-sm);background:{{ $color }};display:inline-flex;align-items:center;justify-content:center;color:white;font-size:.9rem;text-decoration:none;transition:opacity .15s;"
                               onmouseover="this.style.opacity='.8'"
                               onmouseout="this.style.opacity='1'">
                                <i class="bi {{ $icon }}"></i>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    <a href="{{ route('articles.index') }}" class="btn-ghost text-decoration-none d-inline-flex align-items-center gap-2">
                        <i class="bi bi-arrow-left"></i> Semua Artikel
                    </a>
                </div>
            </div>

        </div>

        {{-- ══ SIDEBAR ══ --}}
        <div class="col-lg-4">
            <div class="admin-card mb-4 fade-up fade-up-2" style="position:sticky;top:82px;">
                <div class="admin-card-header">
                    <div class="card-title">
                        <i class="bi bi-newspaper me-2" style="color:var(--blue-500);"></i>
                        Artikel Terkait
                    </div>
                </div>
                <div class="p-4">
                    @forelse($related as $rel)
                    <a href="{{ route('articles.show', $rel->slug) }}" class="related-card">
                        <div class="related-thumb">
                            @if($rel->image)
                                <img src="{{ asset('storage/'.$rel->image) }}" alt="{{ $rel->title }}">
                            @else
                                📰
                            @endif
                        </div>
                        <div style="flex:1;min-width:0;">
                            <span class="related-title">{{ Str::limit($rel->title, 60) }}</span>
                            <span class="related-date">
                                <i class="bi bi-calendar3 me-1"></i>{{ $rel->published_at->format('d M Y') }}
                            </span>
                        </div>
                    </a>
                    @empty
                    <div class="text-center py-3">
                        <div style="font-size:2rem;margin-bottom:8px;">📭</div>
                        <p style="font-size:.82rem;color:var(--slate-400);margin:0;">Tidak ada artikel terkait</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</div>

@endsection