@extends('layouts.admin')
@section('title', 'Pesan dari ' . $message->name . ' - ARVEN')
@section('header-title', 'Detail Pesan')

@section('content')
    <div style="margin-bottom:24px;">
        <a href="{{ route('admin.messages.index') }}" style="color:var(--mute); font-size:14px; text-decoration:underline;">← Kembali ke Pesan Kontak</a>
    </div>

    <div style="display:grid; grid-template-columns:1fr 280px; gap:24px; align-items:start;">
        {{-- Isi Pesan --}}
        <div class="admin-card">
            <div class="card-header">
                <div>
                    <h2 class="card-title">{{ $message->subject }}</h2>
                    <p style="font-size:13px; color:var(--mute); margin-top:4px;">{{ $message->created_at->format('d M Y, H:i') }}</p>
                </div>
                <span class="badge {{ $message->status === 'unread' ? 'badge-sale' : 'badge-neutral' }}">
                    {{ $message->status === 'unread' ? 'Belum Dibaca' : 'Sudah Dibaca' }}
                </span>
            </div>
            <div style="margin-bottom:24px; padding-bottom:24px; border-bottom:1px solid var(--hairline-soft);">
                <p style="font-size:12px; color:var(--mute); text-transform:uppercase; font-weight:600; margin-bottom:4px;">Dari</p>
                <p style="font-size:15px; font-weight:500;">{{ $message->name }}</p>
                <p style="font-size:13px; color:var(--mute);">{{ $message->email }}</p>
            </div>
            <div>
                <p style="font-size:12px; color:var(--mute); text-transform:uppercase; font-weight:600; margin-bottom:12px;">Pesan</p>
                <p style="font-size:15px; line-height:1.8; color:var(--charcoal); white-space:pre-line;">{{ $message->message }}</p>
            </div>
        </div>

        {{-- Aksi --}}
        <div>
            <div class="admin-card">
                <div class="card-header"><h2 class="card-title">AKSI</h2></div>
                @if($message->status === 'unread')
                    <form action="{{ route('admin.messages.markRead', $message->id) }}" method="POST" style="margin-bottom:12px;">
                        @csrf @method('PATCH')
                        <button type="submit" class="btn-primary" style="width:100%; text-align:center;">TANDAI SUDAH DIBACA</button>
                    </form>
                @endif
                <a href="mailto:{{ $message->email }}" class="btn-primary" style="display:block; text-align:center; background:var(--charcoal); margin-bottom:12px;">BALAS VIA EMAIL</a>
                <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Hapus pesan ini secara permanen?')">
                    @csrf @method('DELETE')
                    <button type="submit" style="width:100%; padding:12px; background:var(--sale); color:#fff; border:none; border-radius:30px; font-size:14px; font-weight:600; cursor:pointer;">HAPUS PESAN</button>
                </form>
            </div>
        </div>
    </div>
@endsection
