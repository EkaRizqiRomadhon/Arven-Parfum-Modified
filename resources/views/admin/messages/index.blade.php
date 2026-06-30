@extends('layouts.admin')
@section('title', 'Pesan Kontak - ARVEN')
@section('header-title', 'Pesan Kontak')

@section('content')
    @if(session('success'))
        <script>document.addEventListener('DOMContentLoaded', () => showToast('{{ session('success') }}', 'success'));</script>
    @endif

    <div class="admin-card">
        <div class="card-header">
            <h2 class="card-title">PESAN MASUK</h2>
            @if($unreadCount > 0)
                <span style="font-size:14px; color:var(--sale); font-weight:600;">{{ $unreadCount }} belum dibaca</span>
            @else
                <span style="font-size:14px; color:var(--mute);">Semua sudah dibaca</span>
            @endif
        </div>
        <div style="overflow-x:auto;">
            <table style="width:100%; border-collapse:collapse; text-align:left;">
                <thead>
                    <tr>
                        <th style="padding:16px 0; border-bottom:1px solid var(--hairline); color:var(--mute); font-size:12px; font-weight:600; text-transform:uppercase; width:20px;"></th>
                        <th style="padding:16px 0; border-bottom:1px solid var(--hairline); color:var(--mute); font-size:12px; font-weight:600; text-transform:uppercase;">Pengirim</th>
                        <th style="padding:16px 0; border-bottom:1px solid var(--hairline); color:var(--mute); font-size:12px; font-weight:600; text-transform:uppercase;">Subjek</th>
                        <th style="padding:16px 0; border-bottom:1px solid var(--hairline); color:var(--mute); font-size:12px; font-weight:600; text-transform:uppercase;">Tanggal</th>
                        <th style="padding:16px 0; border-bottom:1px solid var(--hairline); color:var(--mute); font-size:12px; font-weight:600; text-transform:uppercase; text-align:right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $msg)
                        <tr style="{{ $msg->status === 'unread' ? 'background: #fafafa;' : '' }}">
                            <td style="padding:16px 0; border-bottom:1px solid var(--hairline-soft);">
                                @if($msg->status === 'unread')
                                    <div style="width:8px; height:8px; background:var(--sale); border-radius:50%;"></div>
                                @endif
                            </td>
                            <td style="padding:16px 0; border-bottom:1px solid var(--hairline-soft); font-size:14px;">
                                <div style="font-weight:{{ $msg->status === 'unread' ? '600' : '400' }};">{{ $msg->name }}</div>
                                <div style="font-size:12px; color:var(--mute);">{{ $msg->email }}</div>
                            </td>
                            <td style="padding:16px 0; border-bottom:1px solid var(--hairline-soft); font-size:14px; font-weight:{{ $msg->status === 'unread' ? '600' : '400' }};">{{ $msg->subject }}</td>
                            <td style="padding:16px 0; border-bottom:1px solid var(--hairline-soft); font-size:14px; color:var(--mute);">{{ $msg->created_at->format('d M Y') }}</td>
                            <td style="padding:16px 0; border-bottom:1px solid var(--hairline-soft); text-align:right; display:flex; gap:12px; justify-content:flex-end; align-items:center;">
                                <a href="{{ route('admin.messages.show', $msg->id) }}" style="font-size:14px; color:var(--ink); text-decoration:underline; font-weight:500;">Baca</a>
                                <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" style="font-size:14px; color:var(--sale); text-decoration:underline; font-weight:500; background:none; border:none; cursor:pointer;">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" style="padding:32px 0; color:var(--mute); font-size:14px;">Belum ada pesan masuk.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($messages->hasPages())
            <div style="margin-top:24px;">{{ $messages->links() }}</div>
        @endif
    </div>
@endsection
