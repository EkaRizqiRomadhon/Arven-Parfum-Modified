@extends('layouts.app')

@section('title', 'Daftar - ARVEN PARFUME')

@section('content')
<style>
    .auth-page {
        min-height: calc(100vh - 64px);
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--canvas);
        padding: var(--spacing-section) 20px;
    }

    .auth-box {
        width: 100%;
        max-width: 420px;
        background: var(--canvas);
        padding: 40px;
        border: 1px solid var(--hairline);
        border-radius: 12px;
    }

    .auth-logo {
        text-align: left;
        margin-bottom: var(--spacing-md);
    }
    .auth-logo h1 {
        color: var(--ink);
        font-family: "Helvetica Now Display Medium", "Inter", sans-serif;
        font-size: 24px;
        font-weight: 500;
        letter-spacing: -0.5px;
    }

    .auth-subtitle {
        color: var(--charcoal);
        font-size: 16px;
        margin-bottom: var(--spacing-xl);
    }

    .auth-form-group {
        margin-bottom: var(--spacing-lg);
    }
    
    .auth-form-group input {
        width: 100%;
        padding: 14px 16px;
        background: var(--soft-cloud);
        border: 1px solid transparent;
        border-radius: 8px; /* Rounded rectangle */
        color: var(--ink);
        font-size: 16px;
        font-family: "Helvetica Now Text", "Inter", sans-serif;
        outline: none;
        box-shadow: none !important;
        transition: all 0.2s ease;
    }

    .auth-form-group input::placeholder {
        color: var(--mute);
    }

    .auth-form-group input:focus {
        background: var(--canvas);
        border-color: var(--ink);
        box-shadow: 0 0 0 2px rgba(17, 17, 17, 0.1) !important;
        position: relative;
        z-index: 1;
    }

    .auth-form-group input.is-invalid {
        border-color: var(--sale);
        box-shadow: 0 0 0 2px rgba(211, 0, 5, 0.1) !important;
    }

    .auth-form-group input.is-valid {
        border-color: var(--success-bright);
        box-shadow: 0 0 0 2px rgba(30, 170, 82, 0.1) !important;
    }

    .auth-input-wrapper {
        position: relative;
    }

    .password-toggle {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: var(--mute);
        font-size: 14px;
        user-select: none;
        font-weight: 500;
    }

    .password-toggle:hover {
        color: var(--ink);
    }

    .field-error {
        color: var(--sale);
        font-size: 12px;
        margin-top: 6px;
        display: block;
        font-weight: 500;
    }

    .password-strength {
        margin-top: 8px;
        height: 4px;
        background: var(--soft-cloud);
        border-radius: 2px;
        overflow: hidden;
        position: relative;
        z-index: 10;
    }
    .password-strength-bar { 
        height: 100%; 
        width: 0; 
        transition: all 0.3s ease; 
        border-radius: 2px; 
    }
    .password-strength-text { 
        font-size: 12px; 
        margin-top: 6px; 
        color: var(--mute);
        font-weight: 500; 
    }

    .terms-checkbox {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: var(--spacing-xl);
    }

    .terms-checkbox input[type="checkbox"] {
        width: 16px;
        height: 16px;
        cursor: pointer;
        accent-color: var(--ink);
        margin-top: 2px;
    }

    .terms-checkbox label {
        color: var(--ink);
        font-size: 14px;
        line-height: 1.5;
        cursor: pointer;
        user-select: none;
    }

    .terms-checkbox label a {
        color: var(--ink);
        text-decoration: underline;
        font-weight: 500;
    }

    .auth-btn {
        width: 100%;
        background: var(--ink);
        color: var(--on-primary);
        font-family: "Helvetica Now Text Medium", "Inter", sans-serif;
        font-size: 16px;
        font-weight: 500;
        border: none;
        border-radius: 8px;
        padding: 16px;
        cursor: pointer;
        transition: opacity 0.2s, transform 0.1s;
    }

    .auth-btn:hover {
        opacity: 0.8;
    }
    
    .auth-btn:active {
        transform: scale(0.98);
        opacity: 0.5;
    }

    .auth-footer {
        text-align: center;
        margin-top: var(--spacing-xl);
        color: var(--mute);
        font-size: 14px;
    }

    .auth-footer a {
        color: var(--ink);
        font-weight: 500;
        text-decoration: underline;
    }

    .auth-alert {
        padding: 12px 16px;
        border-radius: 8px;
        margin-bottom: 24px;
        font-size: 14px;
        background: #fef0f0;
        color: var(--sale);
        border: 1px solid #fcdcdc;
    }
</style>

<main class="auth-page">
    <div class="auth-box">
        <div class="auth-logo">
            <h1>DAFTAR</h1>
            <p class="auth-subtitle">Buat akun untuk checkout lebih cepat.</p>
        </div>

        @if($errors->any())
            <div class="auth-alert">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('register.attempt') }}" method="POST">
            @csrf

            <div class="auth-form-group">
                <input
                    type="text"
                    id="name"
                    name="name"
                    placeholder="Nama Lengkap"
                    value="{{ old('name') }}"
                    required
                    autocomplete="name"
                    class="{{ $errors->has('name') ? 'is-invalid' : '' }}"
                >
                @error('name')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="auth-form-group">
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Alamat Email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email"
                    class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                >
                @error('email')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="auth-form-group">
                <div class="auth-input-wrapper">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Password (Minimal 6 karakter)"
                        required
                        autocomplete="new-password"
                        class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                    >
                    <span class="password-toggle" id="togglePassword">SHOW</span>
                </div>
                <div class="password-strength">
                    <div class="password-strength-bar" id="strengthBar"></div>
                </div>
                <div class="password-strength-text" id="strengthText"></div>
                @error('password')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="auth-form-group">
                <div class="auth-input-wrapper">
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Ulangi Password"
                        required
                        autocomplete="new-password"
                    >
                    <span class="password-toggle" id="toggleConfirm">SHOW</span>
                </div>
                <div id="confirmMsg" class="field-error" style="display:none">Password tidak cocok</div>
            </div>

            <div class="terms-checkbox">
                <input type="checkbox" id="agreeTerms" name="agreeTerms" required>
                <label for="agreeTerms">
                    Saya setuju dengan <a href="#" id="termsLink">syarat &amp; ketentuan</a> yang berlaku
                </label>
            </div>

            <button type="submit" class="auth-btn" id="registerBtn">DAFTAR SEKARANG</button>
        </form>

        <div class="auth-footer">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk.</a>
        </div>
    </div>
</main>

<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const input = document.getElementById('password');
        const isPass = input.type === 'password';
        input.type = isPass ? 'text' : 'password';
        this.textContent = isPass ? 'HIDE' : 'SHOW';
    });
    document.getElementById('toggleConfirm').addEventListener('click', function () {
        const input = document.getElementById('password_confirmation');
        const isPass = input.type === 'password';
        input.type = isPass ? 'text' : 'password';
        this.textContent = isPass ? 'HIDE' : 'SHOW';
    });

    document.getElementById('password').addEventListener('input', function () {
        const val = this.value;
        let strength = 0;
        if (val.length >= 6)  strength++;
        if (val.length >= 10) strength++;
        if (/[a-z]/.test(val) && /[A-Z]/.test(val)) strength++;
        if (/\d/.test(val)) strength++;
        if (/[^a-zA-Z\d]/.test(val)) strength++;

        const colors = ['#d30005','#d30005','#d30005','#1eaa52','#007d48'];
        const texts  = ['Sangat Lemah','Lemah','Cukup','Kuat','Sangat Kuat'];
        const bar  = document.getElementById('strengthBar');
        const text = document.getElementById('strengthText');

        if (val.length > 0) {
            bar.style.width      = ((strength + 1) * 20) + '%';
            bar.style.background = colors[strength] || colors[4];
            text.textContent     = texts[strength]  || texts[4];
            text.style.color     = colors[strength] || colors[4];
        } else {
            bar.style.width  = '0';
            text.textContent = '';
        }
    });

    document.getElementById('password_confirmation').addEventListener('input', function () {
        const match = this.value === document.getElementById('password').value;
        document.getElementById('confirmMsg').style.display = (!match && this.value) ? 'block' : 'none';
        this.classList.toggle('is-invalid', !match && !!this.value);
        this.classList.toggle('is-valid',    match && !!this.value);
    });

    document.getElementById('termsLink').addEventListener('click', function (e) {
        e.preventDefault();
        alert('Syarat & Ketentuan:\n\n1. Pengguna harus berusia 17+ tahun\n2. Data yang diberikan harus valid\n3. Password harus dijaga kerahasiaannya\n4. Bertanggung jawab atas akun Anda');
    });
</script>
@endsection