@extends('layouts.app')

@section('title', 'Login - ARVEN PARFUME')

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
        transition: all 0.2s ease;
    }

    .auth-form-group input::placeholder {
        color: var(--mute);
    }

    .auth-form-group input:focus {
        background: var(--canvas);
        border-color: var(--ink);
    }

    .auth-form-group input.is-invalid {
        border-color: var(--sale);
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

    .remember-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: var(--spacing-xl);
    }

    .remember-me {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .remember-me input[type="checkbox"] {
        width: 16px;
        height: 16px;
        accent-color: var(--ink);
        cursor: pointer;
    }

    .remember-me label {
        color: var(--ink);
        font-size: 14px;
        cursor: pointer;
        user-select: none;
    }

    .forgot-link {
        color: var(--mute);
        font-size: 14px;
        text-decoration: underline;
    }

    .forgot-link:hover {
        color: var(--ink);
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
            <h1>LOGIN</h1>
            <p class="auth-subtitle">Masuk untuk melanjutkan belanja.</p>
        </div>

        @if($errors->any())
            <div class="auth-alert">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('login.attempt') }}" method="POST">
            @csrf

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
                        placeholder="Password"
                        required
                        autocomplete="current-password"
                        class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                    >
                    <span class="password-toggle" id="togglePassword">SHOW</span>
                </div>
                @error('password')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="remember-row">
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">Ingat saya</label>
                </div>
                <a href="{{ route('password.request') }}" class="forgot-link">Lupa password?</a>
            </div>

            <button type="submit" class="auth-btn">MASUK</button>
        </form>

        <div class="auth-footer">
            Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang.</a>
        </div>
    </div>
</main>

<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const input = document.getElementById('password');
        const isPassword = input.type === 'password';
        input.type = isPassword ? 'text' : 'password';
        this.textContent = isPassword ? 'HIDE' : 'SHOW';
    });
</script>
@endsection