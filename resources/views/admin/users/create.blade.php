@extends('layouts.admin')
@section('title', 'Tambah Pengguna')
@section('page-title', 'Tambah Pengguna')

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

/* Password field */
.pwd-wrap { position: relative; }
.pwd-wrap .form-control { padding-right: 42px; }
.pwd-toggle {
    position: absolute; right: 12px; top: 50%;
    transform: translateY(-50%);
    background: none; border: none;
    color: var(--slate-400); cursor: pointer;
    padding: 0; font-size: .88rem;
    transition: color .15s;
}
.pwd-toggle:hover { color: var(--slate-700); }

/* Password hint box */
.pwd-hint-box {
    background: var(--slate-50);
    border: 1px solid var(--slate-200);
    border-radius: var(--radius-md);
    padding: 10px 14px;
    font-size: .72rem; color: var(--slate-500);
    line-height: 1.7;
}

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

/* Role option group */
.role-option-group { display: flex; flex-direction: column; gap: 7px; }
.role-option {
    display: flex; align-items: center; gap: 11px;
    padding: 11px 13px; border-radius: var(--radius-md);
    border: 1.5px solid var(--slate-200);
    cursor: pointer; transition: all .15s; background: white;
}
.role-option input[type=radio] { display: none; }
.role-option:hover { border-color: var(--blue-300); background: var(--blue-50); }
.role-option.selected { border-color: var(--blue-500); background: var(--blue-50); }
.role-option-icon {
    width: 32px; height: 32px; border-radius: var(--radius-sm);
    display: flex; align-items: center; justify-content: center;
    font-size: .88rem; flex-shrink: 0;
}
.role-opt-label { font-weight: 700; font-size: .8rem; color: var(--slate-900); }
.role-opt-desc { font-size: .67rem; color: var(--slate-400); margin-top: 1px; }

/* Warning box */
.warning-box {
    background: #FFFBEB;
    border: 1px solid #FDE68A;
    border-radius: var(--radius-md);
    padding: 12px 14px;
    margin-bottom: 16px;
}
.warning-box-title {
    font-size: .68rem; font-weight: 800;
    color: #92400E; margin-bottom: 5px;
    display: flex; align-items: center; gap: 5px;
}
.warning-box-text {
    font-size: .68rem; color: #78350F; line-height: 1.65;
}

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
}
</style>
@endpush

@section('content')

{{-- ── PAGE HEADER ── --}}
<div class="page-header">
    <div>
        <div class="page-header-eyebrow">Pengguna</div>
        <h2 class="page-header-title">Tambah Pengguna Baru</h2>
    </div>
    <a href="{{ route('admin.pengguna.index') }}" class="btn-ghost text-decoration-none">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<form action="{{ route('admin.pengguna.store') }}" method="POST">
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

        {{-- Identitas --}}
        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-header-icon"><i class="bi bi-person-fill"></i></div>
                <span class="form-card-header-title">Identitas Pengguna</span>
            </div>
            <div class="form-card-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Nama Lengkap <span class="req">*</span></label>
                        <input type="text" name="name" class="form-control"
                               value="{{ old('name') }}" required
                               placeholder="Contoh: Budi Santoso">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email <span class="req">*</span></label>
                        <input type="email" name="email" class="form-control"
                               value="{{ old('email') }}" required
                               placeholder="email@contoh.com">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">No. Telepon</label>
                        <input type="text" name="phone" class="form-control"
                               value="{{ old('phone') }}"
                               placeholder="08xxxxxxxxxx">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Alamat</label>
                        <textarea name="address" class="form-control" rows="3"
                                  placeholder="Alamat lengkap pengguna...">{{ old('address') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- Password --}}
        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-header-icon"><i class="bi bi-lock-fill"></i></div>
                <span class="form-card-header-title">Keamanan Akun</span>
            </div>
            <div class="form-card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Password <span class="req">*</span></label>
                        <div class="pwd-wrap">
                            <input type="password" name="password" id="passwordInput"
                                   class="form-control" required
                                   placeholder="Minimal 8 karakter">
                            <button type="button" class="pwd-toggle"
                                    onclick="togglePwd('passwordInput', this)">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Konfirmasi Password <span class="req">*</span></label>
                        <div class="pwd-wrap">
                            <input type="password" name="password_confirmation" id="passwordConfirm"
                                   class="form-control" required
                                   placeholder="Ulangi password">
                            <button type="button" class="pwd-toggle"
                                    onclick="togglePwd('passwordConfirm', this)">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="pwd-hint-box">
                            <i class="bi bi-shield-check me-1" style="color:#059669;"></i>
                            Password harus minimal <strong>8 karakter</strong>. Gunakan kombinasi huruf, angka, dan simbol untuk keamanan lebih baik.
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- ── RIGHT: ROLE & SETTINGS ── --}}
    <div class="col-lg-4">
        <div class="settings-card">
            <div class="settings-card-header">
                <div class="form-card-header-icon"><i class="bi bi-shield-fill-check"></i></div>
                <span class="form-card-header-title">Role & Akses</span>
            </div>
            <div class="settings-card-body">

                {{-- Role selector --}}
                <label class="form-label">Role Pengguna <span class="req">*</span></label>
                <div class="role-option-group">
                    <label class="role-option {{ old('role','customer') === 'customer' ? 'selected' : '' }}">
                        <input type="radio" name="role" value="customer"
                               {{ old('role','customer') === 'customer' ? 'checked' : '' }}
                               onchange="updateRoleOpts()">
                        <div class="role-option-icon" style="background:var(--blue-50);color:var(--blue-600);">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <div>
                            <div class="role-opt-label">Customer</div>
                            <div class="role-opt-desc">Akses toko & pembelian</div>
                        </div>
                    </label>
                    <label class="role-option {{ old('role') === 'admin' ? 'selected' : '' }}">
                        <input type="radio" name="role" value="admin"
                               {{ old('role') === 'admin' ? 'checked' : '' }}
                               onchange="updateRoleOpts()">
                        <div class="role-option-icon" style="background:#FFF7ED;color:#C2410C;">
                            <i class="bi bi-shield-fill-check"></i>
                        </div>
                        <div>
                            <div class="role-opt-label">Admin</div>
                            <div class="role-opt-desc">Akses panel admin penuh</div>
                        </div>
                    </label>
                </div>

                <div class="settings-divider"></div>

                {{-- Warning box --}}
                <div class="warning-box">
                    <div class="warning-box-title">
                        <i class="bi bi-exclamation-triangle-fill"></i> Perhatian
                    </div>
                    <div class="warning-box-text">
                        Role <strong>Admin</strong> memiliki akses penuh ke seluruh panel. Berikan role ini hanya kepada orang yang dipercaya.
                    </div>
                </div>

                {{-- Actions --}}
                <div class="submit-wrap">
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-check-lg"></i> Simpan Pengguna
                    </button>
                    <a href="{{ route('admin.pengguna.index') }}" class="btn-cancel">
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
function togglePwd(id, btn) {
    const input = document.getElementById(id);
    const icon  = btn.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'bi bi-eye-slash';
    } else {
        input.type = 'password';
        icon.className = 'bi bi-eye';
    }
}

function updateRoleOpts() {
    document.querySelectorAll('.role-option').forEach(el => el.classList.remove('selected'));
    const checked = document.querySelector('input[name=role]:checked');
    if (checked) checked.closest('.role-option').classList.add('selected');
}
</script>
@endpush