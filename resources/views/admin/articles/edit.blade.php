@extends('layouts.admin')
@section('title', 'Edit Artikel')
@section('page-title', 'Edit Artikel')

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
    display: flex; align-items: center;
    justify-content: space-between; gap: 8px;
}
.form-card-header-left {
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
.form-label .opt { font-weight: 500; color: var(--slate-400); font-size: .7rem; margin-left: 4px; }
.form-label .req { color: var(--blue-500); margin-left: 2px; }
.form-hint { font-size: .68rem; color: var(--slate-400); margin-top: 5px; line-height: 1.5; }

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
    outline: none; border-color: var(--blue-400);
    box-shadow: 0 0 0 3px rgba(59,130,246,.1);
    background: white;
}
.form-control::placeholder { color: var(--slate-400); }
textarea.form-control { resize: vertical; }

/* ══ CONTENT EDITOR ═══════════════════════════════════════ */
.content-editor {
    font-family: 'Fira Code', 'Courier New', monospace;
    font-size: .8rem; line-height: 1.75;
    color: var(--slate-800);
    background: var(--slate-50);
}
.content-editor:focus { background: white; }

.html-badge {
    background: var(--blue-50); color: var(--blue-600);
    border: 1px solid var(--blue-100);
    padding: 2px 8px; border-radius: 4px;
    font-size: .62rem; font-weight: 800; letter-spacing: 1px;
}
.tag-toolbar { display: flex; gap: 6px; flex-wrap: wrap; margin-top: 10px; }
.html-tag-btn {
    background: var(--slate-100); color: var(--slate-600);
    border: 1px solid var(--slate-200);
    padding: 3px 10px; border-radius: 5px;
    font-size: .68rem; font-weight: 700;
    font-family: monospace; cursor: pointer; transition: all .15s;
}
.html-tag-btn:hover { background: var(--blue-50); color: var(--blue-700); border-color: var(--blue-200); }

/* ══ CURRENT IMAGE ════════════════════════════════════════ */
.current-img-block {
    display: flex; align-items: center; gap: 14px;
    padding: 12px 14px;
    background: var(--slate-50);
    border: 1px solid var(--slate-200);
    border-radius: var(--radius-md);
    margin-bottom: 12px;
}
.current-img-block img {
    width: 112px; height: 64px;
    object-fit: cover;
    border-radius: var(--radius-md);
    border: 1px solid var(--slate-200);
    flex-shrink: 0;
}
.current-img-label {
    font-size: .68rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: 1px;
    color: var(--slate-400); margin-bottom: 3px;
    display: flex; align-items: center; gap: 4px;
}
.current-img-hint { font-size: .72rem; color: var(--slate-500); line-height: 1.55; }

/* ══ IMAGE UPLOAD ═════════════════════════════════════════ */
.img-upload-area {
    border: 2px dashed var(--slate-200);
    border-radius: var(--radius-lg);
    padding: 28px 20px; text-align: center; cursor: pointer;
    transition: border-color .2s, background .2s;
    min-height: 120px;
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    gap: 6px; background: var(--slate-50);
}
.img-upload-area:hover { border-color: var(--blue-400); background: var(--blue-50); }
.img-upload-icon { font-size: 1.8rem; color: var(--slate-300); line-height: 1; }
.img-upload-text { font-weight: 700; font-size: .8rem; color: var(--slate-600); }
.img-upload-hint { font-size: .68rem; color: var(--slate-400); }
.img-preview { width: 100%; max-height: 200px; object-fit: contain; border-radius: var(--radius-md); display: none; }

/* ══ SETTINGS CARD ════════════════════════════════════════ */
.settings-card {
    background: white;
    border: 1px solid var(--slate-200);
    border-radius: var(--radius-xl);
    overflow: hidden;
    position: sticky; top: 76px;
}
.settings-card-header {
    padding: 13px 18px;
    border-bottom: 1px solid var(--slate-100);
    display: flex; align-items: center; gap: 8px;
}
.settings-card-body { padding: 18px; }
.settings-divider { height: 1px; background: var(--slate-100); margin: 14px 0; }

/* Status radio options */
.status-option-group { display: flex; flex-direction: column; gap: 7px; }
.status-option {
    display: flex; align-items: center; gap: 11px;
    padding: 11px 13px; border-radius: var(--radius-md);
    border: 1.5px solid var(--slate-200);
    cursor: pointer; transition: all .15s; background: white;
}
.status-option input[type=radio] { display: none; }
.status-option:hover { border-color: var(--blue-300); background: var(--blue-50); }
.status-option.selected { border-color: var(--blue-500); background: var(--blue-50); }
.status-option-icon {
    width: 32px; height: 32px; border-radius: var(--radius-sm);
    display: flex; align-items: center; justify-content: center;
    font-size: .88rem; flex-shrink: 0;
}
.status-opt-label { font-weight: 700; font-size: .8rem; color: var(--slate-900); }
.status-opt-desc { font-size: .67rem; color: var(--slate-400); margin-top: 1px; }

/* Meta box */
.meta-box {
    background: var(--slate-50);
    border: 1px solid var(--slate-200);
    border-radius: var(--radius-md);
    padding: 12px 14px;
    margin-bottom: 16px;
}
.meta-box-title {
    font-size: .62rem; font-weight: 800;
    text-transform: uppercase; letter-spacing: 1px;
    color: var(--slate-400); margin-bottom: 10px;
}
.meta-row {
    display: flex; justify-content: space-between;
    align-items: center; font-size: .74rem; margin-bottom: 5px;
}
.meta-row:last-child { margin-bottom: 0; }
.meta-key { color: var(--slate-500); font-weight: 600; }
.meta-val { color: var(--slate-900); font-weight: 700; }
.meta-val.mono { font-family: monospace; font-size: .68rem; color: var(--slate-500); }

/* Submit buttons */
.submit-wrap { display: flex; flex-direction: column; gap: 8px; }
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
@media (max-width: 991px) { .settings-card { position: static; } }
@media (max-width: 767px) {
    .page-header-title { font-size: 1.15rem; }
    .form-card-body { padding: 14px; }
    .settings-card-body { padding: 14px; }
    .form-control, .form-select { font-size: .78rem; padding: 8px 11px; }
    .img-upload-area { padding: 20px 14px; min-height: 110px; }
    .current-img-block img { width: 80px; height: 46px; }
}
</style>
@endpush

@section('content')

{{-- ── PAGE HEADER ── --}}
<div class="page-header">
    <div>
        <div class="page-header-eyebrow">Konten</div>
        <h2 class="page-header-title">Edit Artikel</h2>
        <p class="page-header-sub">{{ Str::limit($artikel->title, 55) }}</p>
    </div>
    <div style="display:flex;gap:8px;align-items:center;">
        @if($artikel->status === 'published')
        <a href="{{ route('articles.show', $artikel->slug) }}" target="_blank"
           class="btn-ghost text-decoration-none">
            <i class="bi bi-eye"></i> Lihat
        </a>
        @endif
        <a href="{{ route('admin.artikel.index') }}" class="btn-ghost text-decoration-none">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<form action="{{ route('admin.artikel.update', $artikel->id) }}" method="POST" enctype="multipart/form-data">
@csrf @method('PUT')
<div class="row g-4">

    {{-- ── LEFT: MAIN CONTENT ── --}}
    <div class="col-lg-8">

        {{-- Error Alert --}}
        @if($errors->any())
        <div class="alert alert-danger d-flex align-items-start gap-2 mb-3" style="font-size:.8rem;border-radius:var(--radius-md);">
            <i class="bi bi-exclamation-circle-fill mt-1 flex-shrink-0"></i>
            <div>@foreach($errors->all() as $err)<div>{{ $err }}</div>@endforeach</div>
        </div>
        @endif

        {{-- Informasi Artikel --}}
        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-header-left">
                    <div class="form-card-header-icon"><i class="bi bi-file-earmark-text-fill"></i></div>
                    <span class="form-card-header-title">Informasi Artikel</span>
                </div>
            </div>
            <div class="form-card-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Judul Artikel <span class="req">*</span></label>
                        <input type="text" name="title" class="form-control"
                               value="{{ old('title', $artikel->title) }}" required
                               placeholder="Masukkan judul artikel yang menarik...">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Ringkasan <span class="opt">(Excerpt)</span></label>
                        <textarea name="excerpt" class="form-control" rows="2"
                                  placeholder="Ringkasan singkat artikel untuk preview di halaman blog...">{{ old('excerpt', $artikel->excerpt) }}</textarea>
                        <div class="form-hint">Ditampilkan sebagai preview di halaman daftar artikel.</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Konten Artikel --}}
        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-header-left">
                    <div class="form-card-header-icon"><i class="bi bi-body-text"></i></div>
                    <span class="form-card-header-title">Konten Artikel</span>
                </div>
                <span class="html-badge">HTML</span>
            </div>
            <div class="form-card-body">
                <textarea name="content" id="articleContent"
                          class="form-control content-editor"
                          rows="20" required>{{ old('content', $artikel->content) }}</textarea>
                <div class="tag-toolbar">
                    @foreach(['<h3>', '<p>', '<ul><li>', '<strong>', '<a href="">', '<img src="">'] as $tag)
                    <button type="button" class="html-tag-btn" onclick="insertTag(this)" data-tag="{{ $tag }}">
                        {{ $tag }}
                    </button>
                    @endforeach
                </div>
                <div class="form-hint mt-2">
                    <i class="bi bi-info-circle me-1"></i>
                    Gunakan tag HTML untuk memformat konten. Klik tag di atas untuk menyisipkan.
                </div>
            </div>
        </div>

        {{-- Cover Image --}}
        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-header-left">
                    <div class="form-card-header-icon"><i class="bi bi-image-fill"></i></div>
                    <span class="form-card-header-title">Foto Cover Artikel</span>
                </div>
            </div>
            <div class="form-card-body">

                {{-- Current image --}}
                @if($artikel->image)
                <div class="current-img-block">
                    <img src="{{ asset('storage/'.$artikel->image) }}" alt="{{ $artikel->title }}">
                    <div>
                        <div class="current-img-label"><i class="bi bi-image"></i> Cover Saat Ini</div>
                        <div class="current-img-hint">
                            Upload foto baru di bawah untuk mengganti.<br>
                            Biarkan kosong jika tidak ingin mengubah.
                        </div>
                    </div>
                </div>
                @endif

                <div class="img-upload-area" id="uploadArea"
                     onclick="document.getElementById('imageInput').click()">
                    <div class="img-upload-icon" id="uploadIcon"><i class="bi bi-cloud-arrow-up"></i></div>
                    <div class="img-upload-text" id="uploadText">
                        {{ $artikel->image ? 'Klik untuk ganti foto cover' : 'Klik untuk pilih foto cover' }}
                    </div>
                    <div class="img-upload-hint" id="uploadHint">JPG, PNG, WEBP — Maks. 2MB · Rasio 16:9 direkomendasikan</div>
                    <img id="imgPreview" class="img-preview" src="" alt="">
                </div>
                <input type="file" id="imageInput" name="image" accept="image/*"
                       style="display:none;" onchange="previewImg(this)">

            </div>
        </div>

    </div>

    {{-- ── RIGHT: SETTINGS ── --}}
    <div class="col-lg-4">
        <div class="settings-card">
            <div class="settings-card-header">
                <div class="form-card-header-icon"><i class="bi bi-send-fill"></i></div>
                <span class="form-card-header-title">Pengaturan Publikasi</span>
            </div>
            <div class="settings-card-body">

                {{-- Status --}}
                <label class="form-label">Status <span class="req">*</span></label>
                <div class="status-option-group">
                    <label class="status-option {{ old('status', $artikel->status) === 'draft' ? 'selected' : '' }}">
                        <input type="radio" name="status" value="draft"
                               {{ old('status', $artikel->status) === 'draft' ? 'checked' : '' }}
                               onchange="updateStatusOpts()">
                        <div class="status-option-icon" style="background:var(--slate-100);color:var(--slate-500);">
                            <i class="bi bi-file-earmark"></i>
                        </div>
                        <div>
                            <div class="status-opt-label">Draft</div>
                            <div class="status-opt-desc">Belum dipublikasikan</div>
                        </div>
                    </label>
                    <label class="status-option {{ old('status', $artikel->status) === 'published' ? 'selected' : '' }}">
                        <input type="radio" name="status" value="published"
                               {{ old('status', $artikel->status) === 'published' ? 'checked' : '' }}
                               onchange="updateStatusOpts()">
                        <div class="status-option-icon" style="background:#ECFDF5;color:#059669;">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <div>
                            <div class="status-opt-label">Published</div>
                            <div class="status-opt-desc">Langsung tampil di blog</div>
                        </div>
                    </label>
                </div>

                <div class="settings-divider"></div>

                {{-- Article meta --}}
                <div class="meta-box">
                    <div class="meta-box-title">Info Artikel</div>
                    <div class="meta-row">
                        <span class="meta-key">Penulis</span>
                        <span class="meta-val">{{ $artikel->author->name }}</span>
                    </div>
                    <div class="meta-row">
                        <span class="meta-key">Dibuat</span>
                        <span class="meta-val">{{ $artikel->created_at->format('d M Y') }}</span>
                    </div>
                    @if($artikel->published_at)
                    <div class="meta-row">
                        <span class="meta-key">Dipublikasi</span>
                        <span class="meta-val">{{ $artikel->published_at->format('d M Y') }}</span>
                    </div>
                    @endif
                    <div class="meta-row">
                        <span class="meta-key">Slug</span>
                        <span class="meta-val mono">{{ Str::limit($artikel->slug, 22) }}</span>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="submit-wrap">
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-check-lg"></i> Update Artikel
                    </button>
                    <a href="{{ route('admin.artikel.index') }}" class="btn-cancel">
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
    const preview = document.getElementById('imgPreview');
    const icon    = document.getElementById('uploadIcon');
    const text    = document.getElementById('uploadText');
    const hint    = document.getElementById('uploadHint');
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

function insertTag(btn) {
    const ta = document.getElementById('articleContent');
    const tag = btn.dataset.tag;
    const start = ta.selectionStart;
    const end = ta.selectionEnd;
    const selected = ta.value.substring(start, end);
    const tagName = tag.match(/<([a-z0-9]+)/i)?.[1] || '';
    const closing = tagName ? `</${tagName}>` : '';
    const insert = selected ? `${tag}${selected}${closing}` : `${tag}${closing}`;
    ta.value = ta.value.substring(0, start) + insert + ta.value.substring(end);
    ta.focus();
    ta.setSelectionRange(start + tag.length, start + tag.length + selected.length);
}

function updateStatusOpts() {
    document.querySelectorAll('.status-option').forEach(el => el.classList.remove('selected'));
    const checked = document.querySelector('input[name=status]:checked');
    if (checked) checked.closest('.status-option').classList.add('selected');
}
</script>
@endpush