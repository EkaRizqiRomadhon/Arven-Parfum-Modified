@extends('layouts.admin')

@section('title', 'Admin Dashboard - ARVEN PARFUME')
@section('header-title', 'Overview Dashboard')

@section('content')
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px; margin-bottom: 48px;">
        <!-- Stat Card 1 -->
        <div class="admin-card" style="margin-bottom: 0;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <p style="color: var(--mute); font-size: 14px; font-weight: 500; margin-bottom: 8px;">TOTAL PESANAN</p>
                    <h3 style="font-family: 'Helvetica Now Display Medium', 'Inter', sans-serif; font-size: 32px; font-weight: 600; color: var(--ink);">{{ number_format($totalOrders) }}</h3>
                </div>
            </div>
            <div style="margin-top: 16px; font-size: 14px; font-weight: 500;">
                @if($todayOrders > 0)
                    <span style="color: var(--success);">↑ {{ $todayOrders }} hari ini</span>
                @else
                    <span style="color: var(--mute);">Belum ada pesanan hari ini</span>
                @endif
            </div>
        </div>

        <!-- Stat Card 2 -->
        <div class="admin-card" style="margin-bottom: 0;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <p style="color: var(--mute); font-size: 14px; font-weight: 500; margin-bottom: 8px;">TOTAL PENDAPATAN</p>
                    <h3 style="font-family: 'Helvetica Now Display Medium', 'Inter', sans-serif; font-size: 32px; font-weight: 600; color: var(--ink);">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                </div>
            </div>
            <div style="margin-top: 16px; font-size: 14px; font-weight: 500; color: var(--mute);">
                Semua waktu
            </div>
        </div>

        <!-- Stat Card 3 -->
        <div class="admin-card" style="margin-bottom: 0;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <p style="color: var(--mute); font-size: 14px; font-weight: 500; margin-bottom: 8px;">PELANGGAN AKTIF</p>
                    <h3 style="font-family: 'Helvetica Now Display Medium', 'Inter', sans-serif; font-size: 32px; font-weight: 600; color: var(--ink);">{{ number_format($totalUsers) }}</h3>
                </div>
            </div>
            <div style="margin-top: 16px; font-size: 14px; font-weight: 500;">
                @if($newUsersToday > 0)
                    <span style="color: var(--success);">↑ {{ $newUsersToday }} baru hari ini</span>
                @else
                    <span style="color: var(--mute);">Tetap sama hari ini</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Recent Orders Table Area -->
    <div class="admin-card">
        <div class="card-header">
            <h2 class="card-title">PESANAN TERBARU</h2>
            <a href="{{ route('admin.orders.index') }}" style="color: var(--ink); text-decoration: underline; font-size: 14px; font-weight: 500;">Lihat Semua</a>
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
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentOrders as $order)
                        <tr>
                            <td style="padding: 16px 0; border-bottom: 1px solid var(--hairline-soft); font-size: 14px; font-weight: 500;">#{{ $order->order_id }}</td>
                            <td style="padding: 16px 0; border-bottom: 1px solid var(--hairline-soft); font-size: 14px;">{{ optional($order->user)->full_name ?? 'Guest' }}</td>
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
                            <td style="padding: 16px 0; border-bottom: 1px solid var(--hairline-soft); font-size: 14px; color: var(--mute);">{{ $order->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="padding: 32px 0; text-align: left; color: var(--mute); font-size: 14px;">
                                Belum ada pesanan masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
