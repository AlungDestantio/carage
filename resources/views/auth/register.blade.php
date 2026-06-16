@extends('layouts.app')
@section('title', 'Daftar Akun')

@push('styles')
<style>
/* ── MAIN WRAP ── */
.auth-wrap {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 48px 16px;
    position: relative;
}
.auth-wrap::before {
    content: '';
    position: fixed; inset: 0;
    background-image:
        linear-gradient(rgba(59,130,246,0.04) 1px, transparent 1px),
        linear-gradient(90deg, rgba(59,130,246,0.04) 1px, transparent 1px);
    background-size: 48px 48px;
    pointer-events: none; z-index: 0;
}

/* ── CARD ── */
.auth-card {
    background: white;
    border-radius: var(--radius-xl);
    border: 1px solid var(--slate-200);
    box-shadow: 0 4px 6px rgba(15,23,42,0.04), 0 20px 48px rgba(37,99,235,0.09);
    width: 100%; max-width: 520px;
    padding: 40px 40px 36px;
    position: relative; z-index: 1;
    animation: fadeUp .45s ease both;
}
@keyframes fadeUp {
    from { opacity:0; transform:translateY(16px); }
    to   { opacity:1; transform:translateY(0); }
}

/* ── HEADER ── */
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
    font-size: .84rem; color: var(--slate-400);
    font-weight: 500; margin-bottom: 28px;
}
.auth-sub a { color: var(--blue-600); font-weight: 700; text-decoration: none; }
.auth-sub a:hover { text-decoration: underline; }



/* ── ALERTS ── */
.alert-err {
    background: #FEF2F2; border: 1px solid #FECACA;
    border-radius: var(--radius-md); padding: 11px 14px;
    margin-bottom: 18px; font-size: .82rem; color: #DC2626;
    font-weight: 600; display: flex; align-items: center; gap: 8px;
}

/* ── FIELDS ── */
.auth-field { margin-bottom: 15px; }
.auth-field label {
    display: block; font-size: .78rem; font-weight: 700;
    color: var(--slate-700); margin-bottom: 6px;
}
.auth-field label .opt {
    color: var(--slate-300); font-weight: 500;
    text-transform: none; letter-spacing: 0; font-size: .75rem;
}
.field-row { display: flex; gap: 12px; }
.field-row .auth-field { flex: 1; min-width: 0; }

.input-wrap { position: relative; }
.input-wrap .iicon {
    position: absolute; left: 13px; top: 50%;
    transform: translateY(-50%);
    color: var(--slate-300); font-size: .9rem;
    pointer-events: none; transition: color .2s;
}
.input-wrap input {
    width: 100%; background: white;
    border: 1.5px solid var(--slate-200);
    border-radius: var(--radius-md);
    padding: 11px 14px 11px 40px;
    color: var(--slate-900); font-family: var(--font-body);
    font-size: .9rem; font-weight: 500;
    transition: border-color .2s, box-shadow .2s; outline: none;
}
.input-wrap input::placeholder { color: var(--slate-300); }
.input-wrap input:focus {
    border-color: var(--blue-500);
    box-shadow: 0 0 0 3px rgba(59,130,246,0.12);
}
.input-wrap:focus-within .iicon { color: var(--blue-500); }
.toggle-pw {
    position: absolute; right: 11px; top: 50%; transform: translateY(-50%);
    background: none; border: none; color: var(--slate-300);
    cursor: pointer; font-size: .88rem; padding: 4px; transition: color .15s;
}
.toggle-pw:hover { color: var(--blue-600); }
.has-toggle { padding-right: 40px; }
.field-error {
    font-size: .74rem; color: #DC2626; font-weight: 600;
    margin-top: 5px; display: flex; align-items: center; gap: 4px;
}

/* ── PASSWORD STRENGTH ── */
.pw-strength { margin-top: 8px; }
.pw-bars { display: flex; gap: 4px; margin-bottom: 4px; }
.pw-bar {
    height: 3px; flex: 1; border-radius: 2px;
    background: var(--slate-100); transition: background .3s;
}
.pw-bar.weak   { background: #EF4444; }
.pw-bar.medium { background: #F59E0B; }
.pw-bar.strong { background: #10B981; }
.pw-label { font-size: .7rem; font-weight: 700; color: var(--slate-300); }

/* ── TERMS ── */
.terms-check {
    display: flex; align-items: flex-start; gap: 10px;
    margin-bottom: 22px; margin-top: 4px;
}
.terms-check input[type="checkbox"] {
    width: 15px; height: 15px; flex-shrink: 0; margin-top: 2px;
    accent-color: var(--blue-600); cursor: pointer;
}
.terms-check span {
    font-size: .8rem; color: var(--slate-500);
    font-weight: 500; line-height: 1.6;
}
.terms-check span a { color: var(--blue-600); font-weight: 700; text-decoration: none; }
.terms-check span a:hover { text-decoration: underline; }

/* ── SUBMIT ── */
.btn-submit {
    width: 100%; background: var(--blue-600); color: white;
    border: none; border-radius: var(--radius-md); padding: 13px;
    font-family: var(--font-body); font-weight: 700; font-size: .92rem;
    cursor: pointer; transition: background .15s, transform .15s, box-shadow .15s;
    display: flex; align-items: center; justify-content: center; gap: 8px;
}
.btn-submit:hover {
    background: var(--blue-700); transform: translateY(-1px);
    box-shadow: 0 8px 24px rgba(37,99,235,0.25);
}
.btn-submit:active { transform: translateY(0); }

/* ── DIVIDER ── */
.auth-divider {
    display: flex; align-items: center; gap: 12px;
    margin: 22px 0; font-size: .74rem; font-weight: 600; color: var(--slate-300);
}
.auth-divider::before, .auth-divider::after {
    content: ''; flex: 1; height: 1px; background: var(--slate-200);
}

/* ── BOTTOM ── */
.auth-bottom {
    text-align: center; font-size: .84rem; color: var(--slate-400); font-weight: 500;
}
.auth-bottom a { color: var(--blue-600); font-weight: 700; text-decoration: none; }
.auth-bottom a:hover { text-decoration: underline; }

/* ── TRUST STRIP ── */
.auth-trust {
    display: flex; align-items: center; justify-content: center;
    gap: 24px; margin-top: 24px; flex-wrap: wrap;
    position: relative; z-index: 1;
}
.auth-trust-item {
    display: flex; align-items: center; gap: 5px;
    font-size: .72rem; font-weight: 600; color: var(--slate-400);
}
.auth-trust-item i { color: var(--blue-500); font-size: .8rem; }

/* ── RESPONSIVE ── */
@media (max-width: 767px) {
    .auth-wrap { padding: 20px 16px 28px; }

    .auth-card {
        padding: 22px 18px 20px;
        border-radius: 16px;
        box-shadow: 0 4px 6px rgba(15,23,42,0.04), 0 10px 28px rgba(37,99,235,0.07);
    }

    /* Header */
    .auth-eyebrow { font-size: .6rem; letter-spacing: 2px; margin-bottom: 5px; }
    .auth-title   { font-size: 1.5rem; letter-spacing: -.5px; margin-bottom: 4px; }
    .auth-sub     { font-size: .72rem; margin-bottom: 16px; }

    /* Alert */
    .alert-err { font-size: .72rem; padding: 9px 11px; border-radius: 8px; gap: 6px; margin-bottom: 13px; }

    /* Fields */
    .auth-field { margin-bottom: 11px; }
    .auth-field label { font-size: .68rem; margin-bottom: 4px; }
    .auth-field label .opt { font-size: .64rem; }

    /* field-row jadi 1 kolom */
    .field-row { flex-direction: column; gap: 0; }

    /* Inputs */
    .input-wrap .iicon { font-size: .82rem; left: 10px; }
    .input-wrap input {
        font-size: .8rem;
        padding: 9px 12px 9px 34px;
        border-radius: 8px;
    }
    .has-toggle { padding-right: 34px; }
    .toggle-pw  { font-size: .8rem; right: 9px; }
    .field-error { font-size: .66rem; margin-top: 4px; }

    /* Password strength */
    .pw-strength { margin-top: 6px; }
    .pw-bars { gap: 3px; margin-bottom: 3px; }
    .pw-bar  { height: 2px; }
    .pw-label { font-size: .62rem; }

    /* Terms */
    .terms-check { gap: 8px; margin-bottom: 16px; margin-top: 2px; }
    .terms-check input[type="checkbox"] { width: 13px; height: 13px; }
    .terms-check span { font-size: .7rem; line-height: 1.55; }

    /* Submit */
    .btn-submit { padding: 11px; font-size: .8rem; border-radius: 9px; gap: 6px; }

    /* Divider & bottom */
    .auth-divider { margin: 14px 0; font-size: .66rem; }
    .auth-bottom  { font-size: .72rem; }

    /* Trust */
    .auth-trust { gap: 12px; margin-top: 16px; }
    .auth-trust-item { font-size: .6rem; gap: 4px; }
    .auth-trust-item i { font-size: .7rem; }
}
</style>
@endpush

@section('content')
<div class="auth-wrap">

    <div class="auth-card">

        {{-- Header --}}
        <div class="auth-eyebrow">Bergabung Sekarang</div>
        <h1 class="auth-title">Buat Akun <span class="hl">Carage</span></h1>
        <p class="auth-sub">Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini →</a></p>

        {{-- Error --}}
        @if($errors->any())
        <div class="alert-err">
            <i class="bi bi-exclamation-circle-fill"></i> {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Nama --}}
            <div class="auth-field">
                <label for="name">Nama Lengkap</label>
                <div class="input-wrap">
                    <i class="bi bi-person iicon"></i>
                    <input type="text" id="name" name="name"
                           placeholder="Nama lengkap kamu"
                           value="{{ old('name') }}"
                           autocomplete="name" autofocus required>
                </div>
                @error('name')
                <div class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            {{-- Email + Telepon --}}
            <div class="field-row">
                <div class="auth-field">
                    <label for="email">Alamat Email</label>
                    <div class="input-wrap">
                        <i class="bi bi-envelope iicon"></i>
                        <input type="email" id="email" name="email"
                               placeholder="contoh@email.com"
                               value="{{ old('email') }}"
                               autocomplete="email" required>
                    </div>
                    @error('email')
                    <div class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
                <div class="auth-field">
                    <label for="phone">No. Telepon <span class="opt">(opsional)</span></label>
                    <div class="input-wrap">
                        <i class="bi bi-telephone iicon"></i>
                        <input type="tel" id="phone" name="phone"
                               placeholder="08xx-xxxx-xxxx"
                               value="{{ old('phone') }}"
                               autocomplete="tel">
                    </div>
                </div>
            </div>

            {{-- Password + Konfirmasi --}}
            <div class="field-row">
                <div class="auth-field">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <i class="bi bi-lock iicon"></i>
                        <input type="password" id="password" name="password"
                               placeholder="Min. 8 karakter"
                               class="has-toggle"
                               autocomplete="new-password" required
                               oninput="checkStrength(this.value)">
                        <button type="button" class="toggle-pw" onclick="togglePw('password', this)">
                            <i class="bi bi-eye-slash"></i>
                        </button>
                    </div>
                    <div class="pw-strength">
                        <div class="pw-bars">
                            <div class="pw-bar" id="bar1"></div>
                            <div class="pw-bar" id="bar2"></div>
                            <div class="pw-bar" id="bar3"></div>
                            <div class="pw-bar" id="bar4"></div>
                        </div>
                        <div class="pw-label" id="pw-label">Masukkan password</div>
                    </div>
                    @error('password')
                    <div class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
                <div class="auth-field">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <div class="input-wrap">
                        <i class="bi bi-lock-fill iicon"></i>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               placeholder="Ulangi password"
                               class="has-toggle"
                               autocomplete="new-password" required>
                        <button type="button" class="toggle-pw" onclick="togglePw('password_confirmation', this)">
                            <i class="bi bi-eye-slash"></i>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Terms --}}
            <div class="terms-check">
                <input type="checkbox" id="terms" required>
                <span>
                    Dengan mendaftar, saya menyetujui
                    <a href="#">Syarat & Ketentuan</a> dan
                    <a href="#">Kebijakan Privasi</a> Carage
                </span>
            </div>

            <button type="submit" class="btn-submit">
                <i class="bi bi-person-check-fill"></i> Buat Akun Sekarang
            </button>
        </form>

        <div class="auth-divider">atau</div>

        <div class="auth-bottom">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk sekarang</a>
        </div>

    </div>

    {{-- Trust badges --}}
    <div class="auth-trust">
        <div class="auth-trust-item"><i class="bi bi-shield-lock-fill"></i> Transaksi Aman</div>
        <div class="auth-trust-item"><i class="bi bi-patch-check-fill"></i> Produk Original</div>
        <div class="auth-trust-item"><i class="bi bi-truck-front-fill"></i> Kirim Hari Ini</div>
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

function checkStrength(val) {
    const bars  = [1,2,3,4].map(i => document.getElementById('bar' + i));
    const label = document.getElementById('pw-label');
    if (!label) return;

    let score = 0;
    if (val.length >= 8)           score++;
    if (/[A-Z]/.test(val))         score++;
    if (/[0-9]/.test(val))         score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;

    bars.forEach(b => b.className = 'pw-bar');

    if (!val.length) {
        label.textContent = 'Masukkan password';
        label.style.color = 'var(--slate-300)';
        return;
    }

    const configs = [
        { text: 'Sangat Lemah', color: '#EF4444', cls: 'weak',   fill: 1 },
        { text: 'Lemah',        color: '#F97316', cls: 'weak',   fill: 2 },
        { text: 'Sedang',       color: '#F59E0B', cls: 'medium', fill: 3 },
        { text: 'Kuat',         color: '#10B981', cls: 'strong', fill: 4 },
    ];
    const c = configs[Math.min(score, 3)];
    for (let i = 0; i < c.fill; i++) bars[i].classList.add(c.cls);
    label.textContent = c.text;
    label.style.color = c.color;
}
</script>
@endpush