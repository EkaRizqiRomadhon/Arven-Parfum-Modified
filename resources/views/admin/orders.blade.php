@extends('layouts.admin')

@section('title', 'Kelola Pesanan - ARVEN PARFUME')
@section('header-title', 'Management Pesanan')

@section('content')
    <div class="admin-card">
        <div class="card-header">
            <h2 class="card-title">DAFTAR PESANAN</h2>
            <button class="btn-primary" onclick="alert('Export fitur belum tersedia')">Export Data</button>
        </div>
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr>
                        <th style="padding: 16px 0; border-bottom: 1px solid var(--hairline); color: var(--mute); font-weight: 600; font-size: 12px; text-transform: uppercase;">ID Pesanan</th>
                        <th style="padding: 16px 0; border-bottom: 1px solid var(--hairline); color: var(--mute); font-weight: 600; font-size: 12px; text-transform: uppercase;">Pelanggan</th>
                        <th style="padding: 16px 0; border-bottom: 1px solid var(--hairline); color: var(--mute); font-weight: 600; font-size: 12px; text-transform: uppercase;">Total</th>
                        <th style="padding: 16px 0; border-bottom: 1px solid var(--hairline); color: var(--mute); font-weight: 600; font-size: 12px; text-transform: uppercase;">Status</th>
                        <th style="padding: 16px 0; border-bottom: 1px solid var(--hairline); color: var(--mute); font-weight: 600; font-size: 12px; text-transform: uppercase;">Tanggal</th>
                        <th style="padding: 16px 0; border-bottom: 1px solid var(--hairline); color: var(--mute); font-weight: 600; font-size: 12px; text-transform: uppercase; text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td style="padding: 16px 0; border-bottom: 1px solid var(--hairline-soft); font-size: 14px; font-weight: 500;">#{{ $order->order_id }}</td>
                            <td style="padding: 16px 0; border-bottom: 1px solid var(--hairline-soft); font-size: 14px;">
                                <div style="font-weight: 500; color: var(--ink);">{{ optional($order->user)->full_name ?? 'Guest' }}</div>
                                <div style="font-size: 12px; color: var(--mute);">{{ optional($order->user)->email ?? '-' }}</div>
                            </td>
                            <td style="padding: 16px 0; border-bottom: 1px solid var(--hairline-soft); font-size: 14px;">Rp {{ number_format($order->gross_amount, 0, ',', '.') }}</td>
                            <td style="padding: 16px 0; border-bottom: 1px solid var(--hairline-soft);">
                                @php
                                    $badgeClass = 'badge-neutral';
                                    if(in_array($order->status, ['settlement', 'capture', 'success'])) {
                                        $badgeClass = 'badge-success';
                                    } elseif(in_array($order->status, ['cancel', 'deny', 'expire', 'failure'])) {
                                        $badgeClass = 'badge-sale';
                                    }
                                @endphp
                                <span class="badge {{ $badgeClass }}" style="text-transform: capitalize;">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td style="padding: 16px 0; border-bottom: 1px solid var(--hairline-soft); font-size: 14px; color: var(--mute);">{{ $order->created_at->format('d M Y, H:i') }}</td>
                            <td style="padding: 16px 0; border-bottom: 1px solid var(--hairline-soft); text-align: right;">
                                <a href="#" style="font-size: 14px; color: var(--ink); text-decoration: underline; font-weight: 500;">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding: 32px 0; text-align: center; color: var(--mute); font-size: 14px;">
                                Belum ada data pesanan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($orders->hasPages())
            <div style="margin-top: 24px; display: flex; justify-content: flex-end;">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
@endsection
