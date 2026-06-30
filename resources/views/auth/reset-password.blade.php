@extends('layouts.app')

@section('title', 'Reset Password - ARVEN PARFUME')

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
    .field-error { color: var(--sale); font-size: 12px; margin-top: 6px; display: block; font-weight: 500; }
    .auth-alert { padding: 12px 16px; border-radius: 8px; margin-bottom: 24px; font-size: 14px; background: #fef0f0; color: var(--sale); border: 1px solid #fcdcdc; }
</style>

<main class="auth-page">
    <div class="auth-box">
        <div class="auth-logo" style="margin-bottom:20px;">
            <h1>RESET PASSWORD</h1>
            <p class="auth-subtitle">Masukkan password baru Anda.</p>
        </div>

        @if($errors->any())
            <div class="auth-alert">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <div class="auth-form-group">
                <input type="password" name="password" placeholder="Password Baru" required>
            </div>
            <div class="auth-form-group">
                <input type="password" name="password_confirmation" placeholder="Konfirmasi Password Baru" required>
            </div>
            <button type="submit" class="auth-btn">SIMPAN PASSWORD BARU</button>
        </form>
    </div>
</main>
@endsection
