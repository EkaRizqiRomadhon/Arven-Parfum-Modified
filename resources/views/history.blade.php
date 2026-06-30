@extends('layouts.app')

@section('title', 'Riwayat Pesanan - ARVEN PARFUME')
@section('description', 'Lihat seluruh riwayat belanja parfum eksklusif Anda di ARVEN PARFUME.')

@section('content')
<style>
    .history-page {
        min-height: calc(100vh - 64px);
        background: var(--canvas);
        padding: var(--spacing-section) 0;
    }

    .history-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 24px;
    }

    .history-heading {
        font-family: "Helvetica Now Display Medium", "Inter", sans-serif;
        font-size: 32px;
        font-weight: 600;
        color: var(--ink);
        letter-spacing: -0.5px;
        margin-bottom: 6px;
    }

    .history-sub {
        color: var(--mute);
        font-size: 15px;
        margin-bottom: 48px;
    }

    .order-card {
        border: 1px solid var(--hairline-soft);
        margin-bottom: 20px;
        overflow: hidden;
    }

    .order-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 24px;
        border-bottom: 1px solid var(--hairline-soft);
        background: var(--soft-cloud);
    }

    .order-id {
        font-family: "Helvetica Now Display Medium", "Inter", sans-serif;
        font-size: 15px;
        font-weight: 600;
        color: var(--ink);
        letter-spacing: 0.5px;
    }

    .order-date {
        font-size: 13px;
        color: var(--mute);
        margin-top: 2px;
    }

    .order-badge {
        padding: 5px 14px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-success { background: #e8f5ed; color: #007d48; }
    .badge-pending { background: #fff8e6; color: #b08000; }
    .badge-failed  { background: #fef0f0; color: #d30005; }
    .badge-default { background: var(--soft-cloud); color: var(--charcoal); }

    .order-items {
        padding: 0 24px;
    }

    .order-item-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 0;
        border-bottom: 1px solid var(--hairline-soft);
    }

    .order-item-row:last-child {
        border-bottom: none;
    }

    .item-name {
        font-size: 14px;
        font-weight: 500;
        color: var(--ink);
    }

    .item-qty {
        font-size: 13px;
        color: var(--mute);
        margin-top: 2px;
    }

    .item-subtotal {
        font-size: 14px;
        font-weight: 600;
        color: var(--ink);
    }

    .order-card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 24px;
        border-top: 1px solid var(--hairline);
    }

    .total-label {
        font-size: 14px;
        color: var(--mute);
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .total-amount {
        font-family: "Helvetica Now Display Medium", "Inter", sans-serif;
        font-size: 20px;
        font-weight: 700;
        color: var(--ink);
    }

    .empty-history {
        text-align: center;
        padding: 80px 0;
    }

    .empty-history h2 {
        font-family: "Helvetica Now Display Medium", "Inter", sans-serif;
        font-size: 24px;
        font-weight: 600;
        color: var(--ink);
        margin-bottom: 12px;
    }

    .empty-history p {
        font-size: 15px;
        color: var(--mute);
        margin-bottom: 32px;
    }

    .btn-pill {
        background: var(--ink);
        color: var(--canvas);
        padding: 14px 32px;
        border-radius: 30px;
        font-size: 15px;
        font-weight: 500;
        text-decoration: none;
        display: inline-block;
        transition: opacity 0.2s;
    }

    .btn-pill:hover { opacity: 0.8; }
</style>

<main class="history-page">
    <div class="history-container">
        <h1 class="history-heading">RIWAYAT PESANAN</h1>
        <p class="history-sub">Halo, {{ auth()->user()->full_name }}. Berikut seluruh riwayat belanja Anda.</p>

        @forelse($orders as $order)
            @php
                $status = $order->status;
                if(in_array($status, ['settlement','capture','success'])) {
                    $badgeClass = 'badge-success'; $label = 'Berhasil';
                } elseif($status === 'pending') {
                    $badgeClass = 'badge-pending'; $label = 'Menunggu';
                } elseif(in_array($status, ['cancel','deny','expire','failure'])) {
                    $badgeClass = 'badge-failed'; $label = 'Dibatalkan';
                } else {
                    $badgeClass = 'badge-default'; $label = ucfirst($status);
                }
            @endphp

            <div class="order-card">
                {{-- Header Pesanan --}}
                <div class="order-card-header">
                    <div>
                        <div class="order-id">#{{ $order->order_id }}</div>
                        <div class="order-date">{{ $order->created_at->format('d M Y, H:i') }}</div>
                    </div>
                    <span class="order-badge {{ $badgeClass }}">{{ $label }}</span>
                </div>

                {{-- Item Pesanan --}}
                <div class="order-items">
                    @foreach($order->items as $item)
                        <div class="order-item-row">
                            <div>
                                <div class="item-name">{{ $item->name }}</div>
                                <div class="item-qty">{{ $item->quantity }} item × Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                            </div>
                            <div class="item-subtotal">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</div>
                        </div>
                    @endforeach
                </div>

                {{-- Footer Total --}}
                <div class="order-card-footer">
                    <span class="total-label">Total Pembayaran</span>
                    <span class="total-amount">Rp {{ number_format($order->gross_amount, 0, ',', '.') }}</span>
                </div>
            </div>
        @empty
            <div class="empty-history">
                <h2>Belum Ada Pesanan</h2>
                <p>Anda belum pernah melakukan pembelian. Temukan koleksi parfum eksklusif kami sekarang.</p>
                <a href="{{ route('koleksi') }}" class="btn-pill">LIHAT KOLEKSI</a>
            </div>
        @endforelse

        @if($orders->hasPages())
            <div style="margin-top: 32px; display: flex; justify-content: center;">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</main>
@endsection
