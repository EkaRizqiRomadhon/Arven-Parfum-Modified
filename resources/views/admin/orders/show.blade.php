@extends('layouts.admin')
@section('title', 'Detail Pesanan #' . $order->order_id . ' - ARVEN')
@section('header-title', 'Detail Pesanan')

@section('content')
    @if(session('success'))
        <script>document.addEventListener('DOMContentLoaded', () => showToast('{{ session('success') }}', 'success'));</script>
    @endif

    <div style="margin-bottom:24px;">
        <a href="{{ route('admin.orders.index') }}" style="color:var(--mute); font-size:14px; text-decoration:underline;">← Kembali ke Daftar Pesanan</a>
    </div>

    <div style="display:grid; grid-template-columns:1fr 340px; gap:24px; align-items:start;">
        {{-- Kolom Kiri --}}
        <div>
            {{-- Info Pesanan --}}
            <div class="admin-card">
                <div class="card-header">
                    <h2 class="card-title">PESANAN #{{ $order->order_id }}</h2>
                    @php
                        $badgeClass = 'badge-neutral';
                        if(in_array($order->status, ['settlement','capture','success'])) $badgeClass = 'badge-success';
                        elseif(in_array($order->status, ['cancel','deny','expire','failure'])) $badgeClass = 'badge-sale';
                    @endphp
                    <span class="badge {{ $badgeClass }}" style="text-transform:capitalize; font-size:13px; padding:6px 16px;">{{ $order->status }}</span>
                </div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
                    <div>
                        <p style="font-size:12px; color:var(--mute); text-transform:uppercase; font-weight:600; margin-bottom:4px;">Pelanggan</p>
                        <p style="font-size:15px; font-weight:500;">{{ optional($order->user)->full_name ?? 'Guest' }}</p>
                        <p style="font-size:13px; color:var(--mute);">{{ optional($order->user)->email ?? '-' }}</p>
                    </div>
                    <div>
                        <p style="font-size:12px; color:var(--mute); text-transform:uppercase; font-weight:600; margin-bottom:4px;">Tanggal Pesanan</p>
                        <p style="font-size:15px; font-weight:500;">{{ $order->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div>
                        <p style="font-size:12px; color:var(--mute); text-transform:uppercase; font-weight:600; margin-bottom:4px;">Metode Pembayaran</p>
                        <p style="font-size:15px; font-weight:500;">{{ $order->payment_type ?? '-' }}</p>
                    </div>
                    <div>
                        <p style="font-size:12px; color:var(--mute); text-transform:uppercase; font-weight:600; margin-bottom:4px;">Total</p>
                        <p style="font-size:20px; font-weight:700;">Rp {{ number_format($order->gross_amount, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            {{-- Item Pesanan --}}
            <div class="admin-card">
                <div class="card-header"><h2 class="card-title">ITEM PESANAN</h2></div>
                @forelse($order->items as $item)
                    <div style="display:flex; justify-content:space-between; align-items:center; padding:16px 0; border-bottom:1px solid var(--hairline-soft);">
                        <div>
                            <div style="font-size:14px; font-weight:500;">{{ $item->name }}</div>
                            <div style="font-size:12px; color:var(--mute);">Rp {{ number_format($item->price, 0, ',', '.') }} × {{ $item->quantity }}</div>
                        </div>
                        <div style="font-size:14px; font-weight:600;">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</div>
                    </div>
                @empty
                    <p style="color:var(--mute); font-size:14px; padding:16px 0;">Tidak ada item tercatat.</p>
                @endforelse
            </div>
        </div>

        {{-- Kolom Kanan --}}
        <div>
            {{-- Update Status --}}
            <div class="admin-card">
                <div class="card-header"><h2 class="card-title">UPDATE STATUS</h2></div>
                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                    @csrf @method('PATCH')
                    <select name="status" style="width:100%; padding:12px 14px; background:var(--soft-cloud); border:1px solid var(--hairline); color:var(--ink); font-size:14px; margin-bottom:16px; outline:none; border-radius:8px;">
                        @foreach(['pending','settlement','cancel','expire','deny','failure'] as $s)
                            <option value="{{ $s }}" {{ $order->status === $s ? 'selected' : '' }} style="text-transform:capitalize;">{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn-primary" style="width:100%; text-align:center;">SIMPAN STATUS</button>
                </form>
            </div>

            {{-- Hapus Pesanan --}}
            <div class="admin-card">
                <div class="card-header"><h2 class="card-title" style="color:var(--sale);">HAPUS PESANAN</h2></div>
                <p style="font-size:13px; color:var(--mute); margin-bottom:16px; line-height:1.6;">Menghapus pesanan ini secara permanen dari database. Tindakan ini tidak dapat dibatalkan.</p>
                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Yakin hapus pesanan ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" style="width:100%; padding:12px; background:var(--sale); color:#fff; border:none; border-radius:30px; font-size:14px; font-weight:600; cursor:pointer;">HAPUS PESANAN</button>
                </form>
            </div>
        </div>
    </div>
@endsection
