@extends('layouts.admin')
@section('title', 'Detail Pelanggan - ARVEN')
@section('header-title', 'Detail Pelanggan')

@section('content')
    @if(session('success'))
        <script>document.addEventListener('DOMContentLoaded', () => showToast('{{ session('success') }}', 'success'));</script>
    @endif

    <div style="margin-bottom:24px;">
        <a href="{{ route('admin.customers.index') }}" style="color:var(--mute); font-size:14px; text-decoration:underline;">← Kembali ke Daftar Pelanggan</a>
    </div>

    <div style="display:grid; grid-template-columns:1fr 300px; gap:24px; align-items:start;">
        {{-- Kolom Kiri: Info & Riwayat Pesanan --}}
        <div>
            <div class="admin-card">
                <div class="card-header">
                    <h2 class="card-title">{{ $customer->full_name }}</h2>
                    @if($customer->is_active)
                        <span class="badge badge-success">Aktif</span>
                    @else
                        <span class="badge badge-sale">Nonaktif</span>
                    @endif
                </div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
                    <div>
                        <p style="font-size:12px; color:var(--mute); text-transform:uppercase; font-weight:600; margin-bottom:4px;">Email</p>
                        <p style="font-size:15px; font-weight:500;">{{ $customer->email }}</p>
                    </div>
                    <div>
                        <p style="font-size:12px; color:var(--mute); text-transform:uppercase; font-weight:600; margin-bottom:4px;">Bergabung</p>
                        <p style="font-size:15px; font-weight:500;">{{ $customer->created_at->format('d M Y') }}</p>
                    </div>
                    <div>
                        <p style="font-size:12px; color:var(--mute); text-transform:uppercase; font-weight:600; margin-bottom:4px;">Total Pesanan</p>
                        <p style="font-size:20px; font-weight:700;">{{ $customer->checkouts->count() }}</p>
                    </div>
                    <div>
                        <p style="font-size:12px; color:var(--mute); text-transform:uppercase; font-weight:600; margin-bottom:4px;">Total Belanja</p>
                        <p style="font-size:20px; font-weight:700;">Rp {{ number_format($customer->checkouts->sum('gross_amount'), 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <div class="admin-card">
                <div class="card-header"><h2 class="card-title">RIWAYAT PESANAN</h2></div>
                @forelse($customer->checkouts->sortByDesc('created_at') as $order)
                    @php
                        $bc = 'badge-neutral';
                        if(in_array($order->status, ['settlement','capture','success'])) $bc = 'badge-success';
                        elseif(in_array($order->status, ['cancel','deny','expire','failure'])) $bc = 'badge-sale';
                    @endphp
                    <div style="display:flex; justify-content:space-between; align-items:center; padding:14px 0; border-bottom:1px solid var(--hairline-soft);">
                        <div>
                            <div style="font-size:14px; font-weight:500;">#{{ $order->order_id }}</div>
                            <div style="font-size:12px; color:var(--mute);">{{ $order->created_at->format('d M Y') }}</div>
                        </div>
                        <div style="display:flex; align-items:center; gap:12px;">
                            <span class="badge {{ $bc }}" style="text-transform:capitalize;">{{ $order->status }}</span>
                            <span style="font-size:14px; font-weight:600;">Rp {{ number_format($order->gross_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                @empty
                    <p style="color:var(--mute); font-size:14px; padding:16px 0;">Belum ada riwayat pesanan.</p>
                @endforelse
            </div>
        </div>

        {{-- Kolom Kanan: Aksi --}}
        <div>
            <div class="admin-card">
                <div class="card-header"><h2 class="card-title">AKSI</h2></div>
                <form action="{{ route('admin.customers.toggleActive', $customer->id) }}" method="POST" style="margin-bottom:12px;">
                    @csrf @method('PATCH')
                    <button type="submit" class="btn-primary" style="width:100%; text-align:center; background:{{ $customer->is_active ? '#39393b' : 'var(--ink)' }};">
                        {{ $customer->is_active ? 'NONAKTIFKAN AKUN' : 'AKTIFKAN AKUN' }}
                    </button>
                </form>
                <form action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST" onsubmit="return confirm('Yakin hapus pelanggan ini? Semua data akan terhapus permanen.')">
                    @csrf @method('DELETE')
                    <button type="submit" style="width:100%; padding:12px; background:var(--sale); color:#fff; border:none; border-radius:30px; font-size:14px; font-weight:600; cursor:pointer;">HAPUS PELANGGAN</button>
                </form>
            </div>
        </div>
    </div>
@endsection
