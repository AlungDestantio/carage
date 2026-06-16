@extends('layouts.admin')
@section('title', 'Tambah Produk')
@section('page-title', 'Tambah Produk')

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

/* ══ FORM CARD ════════════════════════════════════════════ */
.form-card {
    background: white;
    border: 1px solid var(--slate-200);
    border-radius: var(--radius-xl);
    overflow: hidden;
    margin-bottom: 16px;
}
.form-card-header {
    padding: 13px 18px;
    border-bottom: 1px solid var(--slate-100);
    display: flex; align-items: center; gap: 8px;
}
.form-card-header-icon {
    width: 26px; height: 26px;
    background: var(--blue-50);
    border-radius: 7px;
    display: flex; align-items: center; justify-content: center;
    color: var(--blue-600); font-size: .78rem;
    flex-shrink: 0;
}
.form-card-header-title {
    font-size: .68rem; font-weight: 800;
    text-transform: uppercase; letter-spacing: 1px;
    color: var(--slate-500);
}
.form-card-body { padding: 20px; }

/* ══ FORM ELEMENTS ════════════════════════════════════════ */
.form-label {
    font-weight: 700; font-size: .75rem;
    color: var(--slate-700); margin-bottom: 6px;
    display: block;
}
.form-label .req { color: var(--blue-500); margin-left: 2px; }
.form-hint {
    font-size: .68rem; color: var(--slate-400);
    margin-top: 5px; line-height: 1.5;
}

.form-control, .form-select {
    border: 1.5px solid var(--slate-200);
    border-radius: var(--radius-md);
    font-size: .82rem; padding: 9px 13px;
    font-family: var(--font-body);
    color: var(--slate-900);
    background: var(--slate-50);
    transition: border-color .2s, box-shadow .2s, background .2s;
    width: 100%;
}
.form-control:focus, .form-select:focus {
    outline: none;
    border-color: var(--blue-400);
    box-shadow: 0 0 0 3px rgba(59,130,246,.1);
    background: white;
}
.form-control::placeholder { color: var(--slate-400); }
textarea.form-control { resize: vertical; }

/* Price input with prefix */
.input-prefix-wrap { position: relative; }
.input-prefix {
    position: absolute; left: 13px; top: 50%;
    transform: translateY(-50%);
    font-size: .78rem; font-weight: 700;
    color: var(--slate-400); pointer-events: none;
}
.input-prefix-wrap .form-control { padding-left: 38px; }

/* ══ IMAGE UPLOAD ═════════════════════════════════════════ */
.img-upload-area {
    border: 2px dashed var(--slate-200);
    border-radius: var(--radius-lg);
    padding: 36px 20px;
    text-align: center;
    cursor: pointer;
    transition: border-color .2s, background .2s;
    min-height: 160px;
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    gap: 6px;
    background: var(--slate-50);
}
.img-upload-area:hover {
    border-color: var(--blue-400);
    background: var(--blue-50);
}
.img-upload-icon { font-size: 1.8rem; color: var(--slate-300); line-height: 1; }
.img-upload-text { font-weight: 700; font-size: .8rem; color: var(--slate-600); }
.img-upload-hint { font-size: .68rem; color: var(--slate-400); }
.img-preview {
    width: 100%; max-height: 200px;
    object-fit: contain; border-radius: var(--radius-md);
    display: none;
}

/* ══ SETTINGS CARD ════════════════════════════════════════ */
.settings-card {
    background: white;
    border: 1px solid var(--slate-200);
    border-radius: var(--radius-xl);
    overflow: hidden;
    position: sticky;
    top: 76px;
}
.settings-card-header {
    padding: 13px 18px;
    border-bottom: 1px solid var(--slate-100);
    display: flex; align-items: center; gap: 8px;
}
.settings-card-body { padding: 18px; }

/* Toggle row */
.toggle-row {
    display: flex; align-items: center;
    justify-content: space-between; gap: 16px;
}
.toggle-label { font-weight: 700; font-size: .82rem; color: var(--slate-900); }
.toggle-desc { font-size: .68rem; color: var(--slate-400); margin-top: 2px; }
.form-check-input { cursor: pointer; }
.form-check-input:checked {
    background-color: var(--blue-600);
    border-color: var(--blue-600);
}
.settings-divider {
    height: 1px; background: var(--slate-100);
    margin: 14px 0;
}

/* Tips box */
.tips-box {
    background: var(--blue-50);
    border: 1px solid var(--blue-100);
    border-radius: var(--radius-md);
    padding: 12px 14px;
    margin-top: 14px;
}
.tips-box-title {
    font-size: .68rem; font-weight: 800;
    color: var(--blue-700); margin-bottom: 5px;
    display: flex; align-items: center; gap: 5px;
}
.tips-box-text {
    font-size: .68rem; color: var(--blue-600);
    line-height: 1.6;
}

/* Submit buttons */
.submit-wrap {
    margin-top: 18px;
    display: flex; flex-direction: column; gap: 8px;
}
.btn-submit {
    width: 100%;
    display: flex; align-items: center; justify-content: center; gap: 7px;
    padding: 11px;
    background: var(--blue-600); color: white;
    border: none; border-radius: var(--radius-md);
    font-size: .84rem; font-weight: 700;
    font-family: var(--font-body);
    cursor: pointer; transition: background .15s;
}
.btn-submit:hover { background: var(--blue-700); }
.btn-cancel {
    width: 100%;
    display: flex; align-items: center; justify-content: center;
    padding: 10px;
    background: white; color: var(--slate-600);
    border: 1.5px solid var(--slate-200);
    border-radius: var(--radius-md);
    font-size: .82rem; font-weight: 600;
    font-family: var(--font-body);
    text-decoration: none; transition: all .15s;
}
.btn-cancel:hover { background: var(--slate-50); color: var(--slate-900); border-color: var(--slate-300); }

/* ── Responsive ── */
@media (max-width: 991px) {
    .settings-card { position: static; }
}
@media (max-width: 767px) {
    .page-header-title { font-size: 1.15rem; }
    .form-card-body { padding: 14px; }
    .settings-card-body { padding: 14px; }
    .form-control, .form-select { font-size: .78rem; padding: 8px 11px; }
    .img-upload-area { padding: 24px 14px; min-height: 130px; }
    .img-upload-icon { font-size: 1.5rem; }
}
</style>
@endpush

@section('content')

{{-- ── PAGE HEADER ── --}}
<div class="page-header">
    <div>
        <div class="page-header-eyebrow">Manajemen Toko</div>
        <h2 class="page-header-title">Tambah Produk Baru</h2>
    </div>
    <a href="{{ route('admin.produk.index') }}" class="btn-ghost text-decoration-none">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
@csrf
<div class="row g-4">

    {{-- ── LEFT: MAIN FIELDS ── --}}
    <div class="col-lg-8">

        {{-- Error Alert --}}
        @if($errors->any())
        <div class="alert alert-danger d-flex align-items-start gap-2 mb-3" style="font-size:.8rem;border-radius:var(--radius-md);">
            <i class="bi bi-exclamation-circle-fill mt-1 flex-shrink-0"></i>
            <div>@foreach($errors->all() as $err)<div>{{ $err }}</div>@endforeach</div>
        </div>
        @endif

        {{-- Basic Info --}}
        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-header-icon"><i class="bi bi-info-circle-fill"></i></div>
                <span class="form-card-header-title">Informasi Dasar</span>
            </div>
            <div class="form-card-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Nama Produk <span class="req">*</span></label>
                        <input type="text" name="name" class="form-control"
                               value="{{ old('name') }}" required
                               placeholder="Contoh: Oli Shell Helix HX7 1 Liter">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Kategori <span class="req">*</span></label>
                        <select name="category_id" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Brand / Merek</label>
                        <input type="text" name="brand" class="form-control"
                               value="{{ old('brand') }}"
                               placeholder="Shell, NGK, Denso, Bosch...">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Deskripsi Produk <span class="req">*</span></label>
                        <textarea name="description" class="form-control" rows="5" required
                                  placeholder="Jelaskan spesifikasi, keunggulan, dan informasi penting produk...">{{ old('description') }}</textarea>
                        <div class="form-hint">Tulis deskripsi yang detail untuk membantu pelanggan memilih produk.</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pricing & Stock --}}
        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-header-icon"><i class="bi bi-tag-fill"></i></div>
                <span class="form-card-header-title">Harga & Stok</span>
            </div>
            <div class="form-card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Harga Jual (Rp) <span class="req">*</span></label>
                        <div class="input-prefix-wrap">
                            <span class="input-prefix">Rp</span>
                            <input type="number" name="price" class="form-control"
                                   value="{{ old('price') }}" required min="0"
                                   placeholder="85000">
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <label class="form-label">Stok <span class="req">*</span></label>
                        <input type="number" name="stock" class="form-control"
                               value="{{ old('stock', 0) }}" required min="0">
                    </div>
                    <div class="col-md-3 col-6">
                        <label class="form-label">SKU</label>
                        <input type="text" name="sku" class="form-control"
                               value="{{ old('sku') }}" placeholder="OLI-001">
                    </div>
                </div>
            </div>
        </div>

        {{-- Image Upload --}}
        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-header-icon"><i class="bi bi-image-fill"></i></div>
                <span class="form-card-header-title">Foto Produk</span>
            </div>
            <div class="form-card-body">
                <div class="img-upload-area" id="uploadArea"
                     onclick="document.getElementById('imageInput').click()">
                    <div class="img-upload-icon" id="uploadIcon">
                        <i class="bi bi-cloud-arrow-up"></i>
                    </div>
                    <div class="img-upload-text" id="uploadText">Klik untuk pilih foto</div>
                    <div class="img-upload-hint" id="uploadHint">JPG, PNG, WEBP — Maks. 2MB</div>
                    <img id="imgPreview" class="img-preview" src="" alt="">
                </div>
                <input type="file" id="imageInput" name="image" accept="image/*"
                       style="display:none;" onchange="previewImg(this)">
                <div class="form-hint">Disarankan rasio 1:1 (persegi), ukuran minimal 500×500px.</div>
            </div>
        </div>

    </div>

    {{-- ── RIGHT: SETTINGS ── --}}
    <div class="col-lg-4">
        <div class="settings-card">
            <div class="settings-card-header">
                <div class="form-card-header-icon"><i class="bi bi-toggles"></i></div>
                <span class="form-card-header-title">Pengaturan</span>
            </div>
            <div class="settings-card-body">

                {{-- Active toggle --}}
                <div class="toggle-row">
                    <div>
                        <div class="toggle-label">Tampilkan Produk</div>
                        <div class="toggle-desc">Produk terlihat di halaman toko</div>
                    </div>
                    <div class="form-check form-switch mb-0">
                        <input class="form-check-input" type="checkbox"
                               name="is_active" value="1" id="is_active" checked>
                    </div>
                </div>

                <div class="settings-divider"></div>

                {{-- Featured toggle --}}
                <div class="toggle-row">
                    <div>
                        <div class="toggle-label">Produk Unggulan</div>
                        <div class="toggle-desc">Tampil di section unggulan homepage</div>
                    </div>
                    <div class="form-check form-switch mb-0">
                        <input class="form-check-input" type="checkbox"
                               name="is_featured" value="1" id="is_featured"
                               {{ old('is_featured') ? 'checked' : '' }}>
                    </div>
                </div>

                {{-- Tips --}}
                <div class="tips-box">
                    <div class="tips-box-title">
                        <i class="bi bi-info-circle"></i> Tips Produk Unggulan
                    </div>
                    <div class="tips-box-text">
                        Maksimal 8 produk unggulan ditampilkan di homepage. Pilih produk terlaris atau terbaru.
                    </div>
                </div>

                {{-- Submit --}}
                <div class="submit-wrap">
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-check-lg"></i> Simpan Produk
                    </button>
                    <a href="{{ route('admin.produk.index') }}" class="btn-cancel">
                        Batal
                    </a>
                </div>

            </div>
        </div>
    </div>

</div>
</form>

@endsection

@push('scripts')
<script>
function previewImg(input) {
    const preview  = document.getElementById('imgPreview');
    const icon     = document.getElementById('uploadIcon');
    const text     = document.getElementById('uploadText');
    const hint     = document.getElementById('uploadHint');

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.style.display = 'block';
            icon.style.display = 'none';
            text.style.display = 'none';
            hint.style.display = 'none';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush