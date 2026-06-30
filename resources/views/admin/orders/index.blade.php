@extends('layouts.admin')
@section('title', 'Pesanan - ARVEN PARFUME')
@section('header-title', 'Management Pesanan')

@section('content')
    @if(session('success'))
        <script>document.addEventListener('DOMContentLoaded', () => showToast('{{ session('success') }}', 'success'));</script>
    @endif

    <div class="admin-card">
        <div class="card-header">
            <h2 class="card-title">DAFTAR PESANAN</h2>
            <span style="color: var(--mute); font-size: 14px;">{{ $orders->total() }} total pesanan</span>
        </div>
        <div style="overflow-x: auto;">
            <table style="width:100%; border-collapse:collapse; text-align:left;">
                <thead>
                    <tr>
                        <th style="padding:16px 0; border-bottom:1px solid var(--hairline); color:var(--mute); font-size:12px; font-weight:600; text-transform:uppercase;">ID Pesanan</th>
                        <th style="padding:16px 0; border-bottom:1px solid var(--hairline); color:var(--mute); font-size:12px; font-weight:600; text-transform:uppercase;">Pelanggan</th>
                        <th style="padding:16px 0; border-bottom:1px solid var(--hairline); color:var(--mute); font-size:12px; font-weight:600; text-transform:uppercase;">Total</th>
                        <th style="padding:16px 0; border-bottom:1px solid var(--hairline); color:var(--mute); font-size:12px; font-weight:600; text-transform:uppercase;">Status</th>
                        <th style="padding:16px 0; border-bottom:1px solid var(--hairline); color:var(--mute); font-size:12px; font-weight:600; text-transform:uppercase;">Tanggal</th>
                        <th style="padding:16px 0; border-bottom:1px solid var(--hairline); color:var(--mute); font-size:12px; font-weight:600; text-transform:uppercase; text-align:right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        @php
                            $badgeClass = 'badge-neutral';
                            if(in_array($order->status, ['settlement','capture','success'])) $badgeClass = 'badge-success';
                            elseif(in_array($order->status, ['cancel','deny','expire','failure'])) $badgeClass = 'badge-sale';
                        @endphp
                        <tr>
                            <td style="padding:16px 0; border-bottom:1px solid var(--hairline-soft); font-size:14px; font-weight:500;">#{{ $order->order_id }}</td>
                            <td style="padding:16px 0; border-bottom:1px solid var(--hairline-soft); font-size:14px;">
                                <div style="font-weight:500;">{{ optional($order->user)->full_name ?? 'Guest' }}</div>
                                <div style="font-size:12px; color:var(--mute);">{{ optional($order->user)->email ?? '-' }}</div>
                            </td>
                            <td style="padding:16px 0; border-bottom:1px solid var(--hairline-soft); font-size:14px;">Rp {{ number_format($order->gross_amount, 0, ',', '.') }}</td>
                            <td style="padding:16px 0; border-bottom:1px solid var(--hairline-soft);">
                                <span class="badge {{ $badgeClass }}" style="text-transform:capitalize;">{{ $order->status }}</span>
                            </td>
                            <td style="padding:16px 0; border-bottom:1px solid var(--hairline-soft); font-size:14px; color:var(--mute);">{{ $order->created_at->format('d M Y') }}</td>
                            <td style="padding:16px 0; border-bottom:1px solid var(--hairline-soft); text-align:right;">
                                <a href="{{ route('admin.orders.show', $order->id) }}" style="font-size:14px; color:var(--ink); text-decoration:underline; font-weight:500;">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" style="padding:32px 0; color:var(--mute); font-size:14px;">Belum ada pesanan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($orders->hasPages())
            <div style="margin-top:24px;">{{ $orders->links() }}</div>
        @endif
    </div>
@endsection
