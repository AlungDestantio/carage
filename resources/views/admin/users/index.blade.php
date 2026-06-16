@extends('layouts.admin')
@section('title', 'Kelola Pengguna')
@section('page-title', 'Kelola Pengguna')

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
    color: var(--slate-900); width: 230px;
    background: var(--slate-50);
    transition: border-color .2s, box-shadow .2s;
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
.table-pengguna { border-collapse: separate; border-spacing: 0; width: 100%; }
.table-pengguna thead th {
    background: var(--slate-50);
    color: var(--slate-400);
    font-size: .63rem; font-weight: 800;
    text-transform: uppercase; letter-spacing: 1px;
    border: none;
    border-bottom: 1px solid var(--slate-200);
    padding: 11px 18px;
    white-space: nowrap;
}
.table-pengguna tbody td {
    padding: 13px 18px;
    vertical-align: middle;
    border-bottom: 1px solid var(--slate-100);
    font-size: .84rem;
}
.table-pengguna tbody tr:last-child td { border-bottom: none; }
.table-pengguna tbody tr { transition: background .12s; }
.table-pengguna tbody tr:hover td { background: var(--slate-50); }

/* ── Pengguna cell ── */
.pengguna-cell { display: flex; align-items: center; gap: 11px; }
.pengguna-avatar {
    width: 36px; height: 36px; border-radius: 50%;
    color: white; font-family: var(--font-display);
    font-weight: 800; font-size: .86rem;
    display: flex; align-items: center;
    justify-content: center; flex-shrink: 0;
}
.pengguna-name  { font-weight: 700; font-size: .84rem; color: var(--slate-900); }
.pengguna-email { font-size: .69rem; color: var(--slate-400); margin-top: 2px; }

/* ── Role badges ── */
.badge-role {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 3px 9px; border-radius: 5px;
    font-size: .63rem; font-weight: 800;
    text-transform: uppercase; letter-spacing: .4px;
    white-space: nowrap;
}
.badge-admin    { background: #FFF7ED; color: #C2410C; border: 1px solid #FED7AA; }
.badge-customer { background: var(--blue-50); color: var(--blue-700); border: 1px solid var(--blue-100); }

/* ── Phone & date ── */
.phone-val   { font-weight: 600; font-size: .8rem; color: var(--slate-700); }
.phone-empty { color: var(--slate-300); font-size: .8rem; }
.join-date   { font-weight: 700; font-size: .78rem; color: var(--slate-700); }
.join-ago    { font-size: .67rem; color: var(--slate-400); margin-top: 1px; }

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
.aksi-view     { background: var(--slate-100); color: var(--slate-600); border: 1px solid var(--slate-200); }
.aksi-view:hover   { background: var(--slate-200); color: var(--slate-900); }
.aksi-edit     { background: var(--blue-50); color: var(--blue-700); border: 1px solid var(--blue-100); }
.aksi-edit:hover   { background: var(--blue-100); color: var(--blue-800); }
.aksi-delete   { background: #FEF2F2; color: #DC2626; border: 1px solid #FECACA; }
.aksi-delete:hover { background: #FEE2E2; color: #991B1B; }
.aksi-disabled {
    background: var(--slate-50); color: var(--slate-300);
    border: 1px solid var(--slate-200);
    opacity: .5; cursor: not-allowed; pointer-events: none;
}

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
    .filter-input { width: 180px; }
    .table-pengguna thead th,
    .table-pengguna tbody td { padding: 10px 14px; }
}

@media (max-width: 767px) {
    /* Page header */
    .page-header { margin-bottom: 14px; gap: 10px; }
    .page-header-eyebrow { font-size: .56rem; margin-bottom: 3px; }
    .page-header-title   { font-size: 1.1rem; }
    .page-header-sub     { font-size: .66rem; margin-top: 3px; }
    .page-header .btn-carage { font-size: .72rem; padding: 7px 12px; border-radius: 8px; }

    /* Filter bar */
    .filter-bar  { padding: 10px 12px; gap: 7px; border-radius: 12px; }
    .filter-form { gap: 6px; }
    .filter-search { width: 100%; }
    .filter-input  { width: 100%; font-size: .75rem; padding: 6px 10px 6px 28px; border-radius: 8px; }
    .filter-select { font-size: .7rem; padding: 6px 7px; border-radius: 8px; flex: 1; min-width: 0; }
    .filter-form .btn-carage,
    .filter-form .btn-ghost { font-size: .68rem; padding: 6px 10px; border-radius: 7px; flex-shrink: 0; }
    .filter-meta { display: none; }

    /* Table card */
    .table-card { border-radius: 12px; }

    /* Hide extra columns — keep Pengguna + Role + Aksi */
    .col-hide-mobile { display: none !important; }

    /* Compact table */
    .table-pengguna thead th { font-size: .58rem; padding: 8px 10px; }
    .table-pengguna tbody td { font-size: .75rem; padding: 10px 10px; }

    /* Pengguna cell compact */
    .pengguna-cell  { gap: 8px; }
    .pengguna-avatar { width: 30px; height: 30px; font-size: .72rem; }
    .pengguna-name  { font-size: .74rem; }
    .pengguna-email { font-size: .6rem; margin-top: 1px; }

    /* Role badge compact */
    .badge-role { font-size: .58rem; padding: 2px 7px; gap: 3px; }

    /* Mobile: show join date below role badge */
    .mobile-join-date {
        display: block !important;
        font-size: .6rem; color: var(--slate-400);
        font-weight: 600; margin-top: 4px;
    }

    /* Aksi: icon only */
    .aksi-wrap  { gap: 4px; }
    .aksi-btn   { padding: 5px 8px; font-size: .7rem; border-radius: 6px; }
    .aksi-btn span { display: none; }

    /* Pagination */
    .pag-bar  { padding: 10px 12px; gap: 8px; }
    .pag-info { font-size: .62rem; }
    .pag-pages { display: none; }
    .pag-btn  { font-size: .66rem; padding: 5px 10px; border-radius: 7px; }

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
        <div class="page-header-eyebrow">Pengguna</div>
        <h2 class="page-header-title">Kelola Pengguna</h2>
        <p class="page-header-sub">{{ $users->total() }} pengguna terdaftar</p>
    </div>
    <a href="{{ route('admin.pengguna.create') }}" class="btn-carage text-decoration-none d-inline-flex align-items-center gap-2">
        <i class="bi bi-person-plus-fill"></i> Tambah Pengguna
    </a>
</div>

{{-- ── FILTER BAR ── --}}
<div class="filter-bar">
    <form action="{{ route('admin.pengguna.index') }}" method="GET" class="filter-form">
        <div class="filter-search">
            <i class="bi bi-search filter-search-icon"></i>
            <input type="text" name="cari" class="filter-input"
                   placeholder="Cari nama atau email..."
                   value="{{ request('cari') }}">
        </div>

        <select name="role" class="filter-select" onchange="this.form.submit()">
            <option value="">Semua Role</option>
            <option value="admin"    {{ request('role')==='admin'    ? 'selected' : '' }}>Admin</option>
            <option value="customer" {{ request('role')==='customer' ? 'selected' : '' }}>Customer</option>
        </select>

        <button type="submit" class="btn-carage d-inline-flex align-items-center gap-1">
            <i class="bi bi-funnel"></i> <span class="d-none d-sm-inline">Filter</span>
        </button>

        @if(request()->hasAny(['cari','role']))
        <a href="{{ route('admin.pengguna.index') }}" class="btn-ghost text-decoration-none d-inline-flex align-items-center gap-1">
            <i class="bi bi-x-lg"></i> <span class="d-none d-sm-inline">Reset</span>
        </a>
        @endif
    </form>

    <div class="filter-meta d-none d-md-block">
        <strong>{{ $users->count() }}</strong> / <strong>{{ $users->total() }}</strong> pengguna
    </div>
</div>

{{-- ── TABLE ── --}}
<div class="table-card">
    <div class="table-responsive">
        <table class="table-pengguna">
            <thead>
                <tr>
                    <th style="width:42%;">Pengguna</th>
                    <th>Role</th>
                    <th class="col-hide-mobile col-hide-tablet">Telepon</th>
                    <th class="col-hide-mobile">Bergabung</th>
                    <th style="text-align:right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>
                        <div class="pengguna-cell">
                            <div class="pengguna-avatar"
                                 style="background:{{ $user->isAdmin() ? 'var(--accent)' : 'var(--blue-600)' }};">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div style="min-width:0;">
                                <div class="pengguna-name">{{ Str::limit($user->name, 28) }}</div>
                                <div class="pengguna-email">{{ Str::limit($user->email, 30) }}</div>
                            </div>
                        </div>
                    </td>

                    <td>
                        @if($user->isAdmin())
                            <span class="badge-role badge-admin">
                                <i class="bi bi-shield-fill-check"></i> Admin
                            </span>
                        @else
                            <span class="badge-role badge-customer">
                                <i class="bi bi-person-fill"></i> Customer
                            </span>
                        @endif
                        {{-- Mobile: join date below role --}}
                        <div class="mobile-join-date d-none">
                            {{ $user->created_at->format('d M Y') }}
                        </div>
                    </td>

                    <td class="col-hide-mobile col-hide-tablet">
                        @if($user->phone)
                            <span class="phone-val">{{ $user->phone }}</span>
                        @else
                            <span class="phone-empty">—</span>
                        @endif
                    </td>

                    <td class="col-hide-mobile">
                        <div class="join-date">{{ $user->created_at->format('d M Y') }}</div>
                        <div class="join-ago">{{ $user->created_at->diffForHumans() }}</div>
                    </td>

                    <td>
                        <div class="aksi-wrap">
                            <a href="{{ route('admin.pengguna.show', $user->id) }}"
                               class="aksi-btn aksi-view" title="Detail">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                            <a href="{{ route('admin.pengguna.edit', $user->id) }}"
                               class="aksi-btn aksi-edit">
                                <i class="bi bi-pencil-fill"></i>
                                <span>Edit</span>
                            </a>
                            @if(!$user->isAdmin())
                            <form action="{{ route('admin.pengguna.destroy', $user->id) }}" method="POST"
                                  onsubmit="return confirm('Hapus pengguna \'{{ addslashes($user->name) }}\'?\nTindakan ini tidak dapat dibatalkan.')">
                                @csrf @method('DELETE')
                                <button type="submit" class="aksi-btn aksi-delete">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                            </form>
                            @else
                            <span class="aksi-btn aksi-disabled" title="Admin tidak dapat dihapus">
                                <i class="bi bi-trash3-fill"></i>
                            </span>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="bi bi-people"></i>
                            </div>
                            <div class="empty-title">
                                {{ request()->hasAny(['cari','role']) ? 'Tidak ada pengguna yang cocok' : 'Belum ada pengguna' }}
                            </div>
                            <div class="empty-sub">
                                {{ request()->hasAny(['cari','role']) ? 'Coba ubah kata kunci atau filter pencarian' : 'Pengguna akan muncul setelah melakukan registrasi' }}
                            </div>
                            @if(request()->hasAny(['cari','role']))
                            <a href="{{ route('admin.pengguna.index') }}" class="btn-ghost text-decoration-none mt-3 d-inline-flex align-items-center gap-2">
                                <i class="bi bi-arrow-counterclockwise"></i> Reset Filter
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
    @if($users->hasPages())
    <div class="pag-bar">
        <div class="pag-info">
            Hal. <strong>{{ $users->currentPage() }}</strong> / <strong>{{ $users->lastPage() }}</strong>
            &nbsp;·&nbsp;
            {{ $users->firstItem() }}–{{ $users->lastItem() }} dari {{ $users->total() }} pengguna
        </div>
        <div class="pag-actions">
            @if($users->onFirstPage())
                <span class="pag-btn pag-btn-disabled">
                    <i class="bi bi-arrow-left"></i>
                    <span class="d-none d-sm-inline">Sebelumnya</span>
                </span>
            @else
                <a href="{{ $users->previousPageUrl() }}" class="pag-btn">
                    <i class="bi bi-arrow-left"></i>
                    <span class="d-none d-sm-inline">Sebelumnya</span>
                </a>
            @endif

            <div class="pag-pages">
                @for($p = max(1, $users->currentPage()-1); $p <= min($users->lastPage(), $users->currentPage()+1); $p++)
                    @if($p === $users->currentPage())
                        <span class="pag-page pag-page-active">{{ $p }}</span>
                    @else
                        <a href="{{ $users->url($p) }}" class="pag-page">{{ $p }}</a>
                    @endif
                @endfor
            </div>

            @if($users->hasMorePages())
                <a href="{{ $users->nextPageUrl() }}" class="pag-btn pag-btn-primary">
                    <span class="d-none d-sm-inline">Selanjutnya</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            @else
                <span class="pag-btn pag-btn-disabled">
                    <span class="d-none d-sm-inline">Selanjutnya</span>
                    <i class="bi bi-arrow-right"></i>
                </span>
            @endif
        </div>
    </div>
    @endif
</div>

@endsection