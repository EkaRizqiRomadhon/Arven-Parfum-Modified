@extends('layouts.app')

@section('title', 'Lupa Password - ARVEN PARFUME')

@section('content')
<style>
    .auth-page { min-height: calc(100vh - 64px); display: flex; align-items: center; justify-content: center; background: var(--canvas); padding: var(--spacing-section) 20px; }
    .auth-box { width: 100%; max-width: 420px; background: var(--canvas); padding: 40px; border: 1px solid var(--hairline); border-radius: 12px; }
    .auth-logo h1 { color: var(--ink); font-family: "Helvetica Now Display Medium", "Inter", sans-serif; font-size: 24px; font-weight: 500; letter-spacing: -0.5px; }
    .auth-subtitle { color: var(--charcoal); font-size: 16px; margin-bottom: var(--spacing-xl); }
    .auth-form-group { margin-bottom: var(--spacing-lg); }
    .auth-form-group input { width: 100%; padding: 14px 16px; background: var(--soft-cloud); border: 1px solid transparent; border-radius: 8px; color: var(--ink); font-size: 16px; font-family: "Helvetica Now Text", "Inter", sans-serif; outline: none; }
    .auth-form-group input:focus { background: var(--canvas); border-color: var(--ink); }
    .auth-btn { width: 100%; background: var(--ink); color: var(--on-primary); font-family: "Helvetica Now Text Medium", "Inter", sans-serif; font-size: 16px; font-weight: 500; border: none; border-radius: 8px; padding: 16px; cursor: pointer; }
    .auth-btn:hover { opacity: 0.8; }
    .auth-footer { text-align: center; margin-top: var(--spacing-xl); color: var(--mute); font-size: 14px; }
    .auth-footer a { color: var(--ink); font-weight: 500; text-decoration: underline; }
    .field-error { color: var(--sale); font-size: 12px; margin-top: 6px; display: block; font-weight: 500; }
    .auth-alert { padding: 12px 16px; border-radius: 8px; margin-bottom: 24px; font-size: 14px; background: #fef0f0; color: var(--sale); border: 1px solid #fcdcdc; }
    .auth-success { padding: 16px; border-radius: 8px; margin-bottom: 24px; font-size: 14px; background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; line-height: 1.5; }
    .auth-success a { color: #166534; font-weight: bold; text-decoration: underline; }
</style>

<main class="auth-page">
    <div class="auth-box">
        <div class="auth-logo" style="margin-bottom:20px;">
            <h1>LUPA PASSWORD</h1>
            <p class="auth-subtitle">Masukkan email Anda untuk reset password.</p>
        </div>

        @if(session('success'))
            <div class="auth-success">
                {{ session('success') }}
                <br><br>
                <a href="{{ session('reset_link') }}">Klik Disini Untuk Reset Password</a>
            </div>
        @endif

        @if($errors->any())
            <div class="auth-alert">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="auth-form-group">
                <input type="email" name="email" placeholder="Alamat Email" value="{{ old('email') }}" required>
            </div>
            <button type="submit" class="auth-btn">KIRIM LINK RESET</button>
        </form>

        <div class="auth-footer">
            <a href="{{ route('login') }}">Kembali ke halaman Login</a>
        </div>
    </div>
</main>
@endsection
