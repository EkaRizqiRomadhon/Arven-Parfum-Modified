@extends('layouts.app')

@section('title', 'Profil Saya - ARVEN PARFUME')

@section('content')
<div class="container" style="padding-top: 40px; padding-bottom: 60px;">
    <div style="max-width: 600px; margin: 0 auto;">
        <h1 style="font-family: 'Helvetica Now Display Medium', 'Inter', sans-serif; font-size: 28px; margin-bottom: 8px;">PROFIL SAYA</h1>
        <p style="color: var(--mute); margin-bottom: 32px;">Kelola data diri dan keamanan akun Anda.</p>

        @if(session('success'))
            <div style="background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; padding: 16px; border-radius: 8px; margin-bottom: 24px;">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div style="background: #fef0f0; color: var(--sale); border: 1px solid #fcdcdc; padding: 16px; border-radius: 8px; margin-bottom: 24px;">
                @foreach($errors->all() as $error)
                    <p style="margin:0; font-size: 14px;">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div style="background: var(--canvas); border: 1px solid var(--hairline); padding: 32px; border-radius: 12px;">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 500; margin-bottom: 8px; font-size: 14px;">Nama Lengkap</label>
                    <input type="text" name="full_name" value="{{ old('full_name', $user->full_name) }}" required style="width: 100%; padding: 12px 16px; border: 1px solid var(--hairline); border-radius: 8px; background: var(--soft-cloud); outline: none;">
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 500; margin-bottom: 8px; font-size: 14px;">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required style="width: 100%; padding: 12px 16px; border: 1px solid var(--hairline); border-radius: 8px; background: var(--soft-cloud); outline: none;">
                </div>

                <hr style="border: 0; border-top: 1px solid var(--hairline); margin: 32px 0;">
                <h3 style="font-size: 16px; margin-bottom: 16px;">Ubah Password (Opsional)</h3>
                <p style="font-size: 13px; color: var(--mute); margin-bottom: 20px;">Kosongkan jika Anda tidak ingin mengubah password.</p>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 500; margin-bottom: 8px; font-size: 14px;">Password Baru</label>
                    <input type="password" name="password" style="width: 100%; padding: 12px 16px; border: 1px solid var(--hairline); border-radius: 8px; background: var(--soft-cloud); outline: none;">
                </div>

                <div style="margin-bottom: 32px;">
                    <label style="display: block; font-weight: 500; margin-bottom: 8px; font-size: 14px;">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" style="width: 100%; padding: 12px 16px; border: 1px solid var(--hairline); border-radius: 8px; background: var(--soft-cloud); outline: none;">
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%;">SIMPAN PERUBAHAN</button>
            </form>
        </div>
    </div>
</div>
@endsection
