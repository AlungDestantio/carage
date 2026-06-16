@extends('layouts.app')
@section('title', 'Login')

@push('styles')
<style>
/* ── MAIN WRAP ── */
.auth-wrap {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 48px 16px;
    position: relative; z-index: 1;
}

/* ── CARD ── */
.auth-card {
    background: white;
    border-radius: var(--radius-xl);
    border: 1px solid var(--slate-200);
    box-shadow: 0 4px 6px rgba(15,23,42,0.04), 0 16px 40px rgba(37,99,235,0.07);
    width: 100%; max-width: 440px;
    padding: 40px 40px 36px;
    animation: fadeUp .45s ease both;
}
@keyframes fadeUp {
    from { opacity:0; transform:translateY(16px); }
    to   { opacity:1; transform:translateY(0); }
}

/* ── CARD HEADER ── */
.auth-eyebrow {
    font-size: .68rem; font-weight: 700;
    letter-spacing: 3px; text-transform: uppercase;
    color: var(--blue-600); margin-bottom: 8px;
}
.auth-title {
    font-family: var(--font-display);
    font-weight: 800; font-size: 2rem;
    color: var(--slate-900); letter-spacing: -1px;
    line-height: 1.05; margin-bottom: 6px;
}
.auth-title .hl { color: var(--blue-600); }
.auth-sub {
    font-size: .85rem; color: var(--slate-400);
    font-weight: 500; margin-bottom: 30px;
}
.auth-sub a { color: var(--blue-600); font-weight: 700; text-decoration: none; }
.auth-sub a:hover { text-decoration: underline; }

/* ── ALERTS ── */
.alert-err {
    background: #FEF2F2; border: 1px solid #FECACA;
    border-radius: var(--radius-md); padding: 12px 14px;
    margin-bottom: 20px; font-size: .82rem; color: #DC2626;
    font-weight: 600; display: flex; align-items: center; gap: 8px;
}
.alert-ok {
    background: #F0FDF4; border: 1px solid #BBF7D0;
    border-radius: var(--radius-md); padding: 12px 14px;
    margin-bottom: 20px; font-size: .82rem; color: #15803D;
    font-weight: 600; display: flex; align-items: center; gap: 8px;
}

/* ── FIELDS ── */
.field { margin-bottom: 16px; }
.field label {
    display: block; font-size: .78rem; font-weight: 700;
    color: var(--slate-700); margin-bottom: 7px;
}
.input-wrap { position: relative; }
.input-wrap .iicon {
    position: absolute; left: 13px; top: 50%;
    transform: translateY(-50%);
    color: var(--slate-300); font-size: .95rem;
    pointer-events: none; transition: color .2s;
}
.input-wrap input {
    width: 100%;
    background: white;
    border: 1.5px solid var(--slate-200);
    border-radius: var(--radius-md);
    padding: 11px 14px 11px 40px;
    color: var(--slate-900);
    font-family: var(--font-body);
    font-size: .9rem; font-weight: 500;
    transition: border-color .2s, box-shadow .2s;
    outline: none;
}
.input-wrap input::placeholder { color: var(--slate-300); }
.input-wrap input:focus {
    border-color: var(--blue-500);
    box-shadow: 0 0 0 3px rgba(59,130,246,0.12);
}
.input-wrap:focus-within .iicon { color: var(--blue-500); }
.toggle-pw {
    position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
    background: none; border: none; color: var(--slate-300);
    cursor: pointer; font-size: .9rem; padding: 4px; transition: color .15s;
}
.toggle-pw:hover { color: var(--blue-600); }
.has-toggle { padding-right: 40px; }
.field-error {
    font-size: .75rem; color: #DC2626; font-weight: 600;
    margin-top: 5px; display: flex; align-items: center; gap: 4px;
}

/* ── EXTRAS ── */
.form-extras {
    display: flex; justify-content: space-between; align-items: center;
    margin-bottom: 22px;
}
.custom-check { display: flex; align-items: center; gap: 8px; cursor: pointer; }
.custom-check input[type="checkbox"] { width: 15px; height: 15px; accent-color: var(--blue-600); cursor: pointer; }
.custom-check span { font-size: .82rem; color: var(--slate-500); font-weight: 600; }
.forgot-link { font-size: .82rem; color: var(--blue-600); text-decoration: none; font-weight: 700; }
.forgot-link:hover { text-decoration: underline; }

/* ── BUTTON ── */
.btn-submit {
    width: 100%; background: var(--blue-600); color: white;
    border: none; border-radius: var(--radius-md); padding: 13px;
    font-family: var(--font-body); font-weight: 700; font-size: .9rem;
    cursor: pointer; transition: background .15s, transform .15s, box-shadow .15s;
    display: flex; align-items: center; justify-content: center; gap: 8px;
}
.btn-submit:hover {
    background: var(--blue-700); transform: translateY(-1px);
    box-shadow: 0 8px 24px rgba(37,99,235,0.25);
}
.btn-submit:active { transform: translateY(0); }

/* ── DIVIDER ── */
.divider-line {
    display: flex; align-items: center; gap: 12px;
    margin: 22px 0; font-size: .75rem; font-weight: 600; color: var(--slate-300);
}
.divider-line::before, .divider-line::after {
    content: ''; flex: 1; height: 1px; background: var(--slate-200);
}

/* ── BOTTOM ── */
.bottom-link { text-align: center; font-size: .85rem; color: var(--slate-400); font-weight: 500; }
.bottom-link a { color: var(--blue-600); font-weight: 700; text-decoration: none; }
.bottom-link a:hover { text-decoration: underline; }

/* ── TRUST STRIP ── */
.auth-trust {
    display: flex; align-items: center; justify-content: center;
    gap: 24px; margin-top: 28px; flex-wrap: wrap;
}
.trust-item {
    display: flex; align-items: center; gap: 6px;
    font-size: .72rem; font-weight: 600; color: var(--slate-400);
}
.trust-item i { color: var(--blue-500); font-size: .82rem; }

/* ── RESPONSIVE ── */
@media (max-width: 767px) {
    .auth-wrap { padding: 24px 16px 32px; }

    .auth-card {
        padding: 24px 20px 22px;
        border-radius: 16px;
        box-shadow: 0 4px 6px rgba(15,23,42,0.04), 0 10px 28px rgba(37,99,235,0.07);
    }

    .auth-eyebrow { font-size: .6rem; letter-spacing: 2px; margin-bottom: 6px; }
    .auth-title   { font-size: 1.55rem; letter-spacing: -.5px; margin-bottom: 5px; }
    .auth-sub     { font-size: .75rem; margin-bottom: 20px; }

    .alert-err, .alert-ok { font-size: .74rem; padding: 10px 12px; border-radius: 9px; gap: 7px; margin-bottom: 14px; }

    .field { margin-bottom: 13px; }
    .field label { font-size: .7rem; margin-bottom: 5px; }
    .input-wrap .iicon { font-size: .85rem; left: 11px; }
    .input-wrap input {
        font-size: .82rem;
        padding: 9px 12px 9px 36px;
        border-radius: 9px;
    }
    .has-toggle { padding-right: 36px; }
    .toggle-pw  { font-size: .82rem; right: 10px; }
    .field-error { font-size: .68rem; margin-top: 4px; }

    .form-extras { margin-bottom: 16px; }
    .custom-check span { font-size: .72rem; }
    .custom-check input[type="checkbox"] { width: 13px; height: 13px; }
    .forgot-link { font-size: .72rem; }

    .btn-submit { padding: 11px; font-size: .82rem; border-radius: 9px; gap: 6px; }

    .divider-line { margin: 16px 0; font-size: .68rem; }

    .bottom-link { font-size: .75rem; }

    .auth-trust { gap: 14px; margin-top: 20px; }
    .trust-item { font-size: .62rem; gap: 4px; }
    .trust-item i { font-size: .72rem; }
}
</style>
@endpush

@section('content')

<div class="auth-wrap">

    <div class="auth-card">

        <div class="auth-eyebrow">Selamat Datang Kembali</div>
        <h1 class="auth-title">Masuk ke <span class="hl">Carage</span></h1>
        <p class="auth-sub">Belum punya akun? <a href="{{ route('register') }}">Daftar gratis →</a></p>

        @if($errors->any())
        <div class="alert-err">
            <i class="bi bi-exclamation-circle-fill"></i> {{ $errors->first() }}
        </div>
        @endif

        @if(session('status'))
        <div class="alert-ok">
            <i class="bi bi-check-circle-fill"></i> {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="field">
                <label for="email">Alamat Email</label>
                <div class="input-wrap">
                    <i class="bi bi-envelope iicon"></i>
                    <input type="email" id="email" name="email"
                           placeholder="contoh@email.com"
                           value="{{ old('email') }}"
                           autocomplete="email" autofocus required>
                </div>
                @error('email')
                <div class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="password">Password</label>
                <div class="input-wrap">
                    <i class="bi bi-lock iicon"></i>
                    <input type="password" id="password" name="password"
                           placeholder="Masukkan password"
                           class="has-toggle"
                           autocomplete="current-password" required>
                    <button type="button" class="toggle-pw" onclick="togglePw('password', this)">
                        <i class="bi bi-eye-slash"></i>
                    </button>
                </div>
                @error('password')
                <div class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="form-extras">
                <label class="custom-check">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span>Ingat saya</span>
                </label>
                @if(Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="forgot-link">Lupa password?</a>
                @endif
            </div>

            <button type="submit" class="btn-submit">
                <i class="bi bi-box-arrow-in-right"></i> Masuk ke Akun
            </button>
        </form>

        <div class="divider-line">atau</div>

        <div class="bottom-link">
            Belum punya akun? <a href="{{ route('register') }}">Daftar gratis sekarang</a>
        </div>

    </div>

    <div class="auth-trust">
        <div class="trust-item"><i class="bi bi-shield-lock-fill"></i> Transaksi Aman</div>
        <div class="trust-item"><i class="bi bi-patch-check-fill"></i> Produk Original</div>
        <div class="trust-item"><i class="bi bi-truck-front-fill"></i> Kirim Hari Ini</div>
    </div>

</div>

@endsection

@push('scripts')
<script>
function togglePw(id, btn) {
    const input = document.getElementById(id);
    const icon  = btn.querySelector('i');
    input.type  = input.type === 'password' ? 'text' : 'password';
    icon.className = input.type === 'text' ? 'bi bi-eye' : 'bi bi-eye-slash';
}
</script>
@endpush