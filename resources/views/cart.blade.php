@extends('layouts.app')

@section('title', 'Keranjang Belanja - ARVEN PARFUME')
@section('description', 'Review koleksi parfum pilihan Anda sebelum melakukan checkout.')

@section('content')
  <main class="container">
    <h1 class="page-title">Keranjang Belanja</h1>
    <div class="sub-title">
      Review item pilihan eksklusif Anda sebelum checkout.
    </div>

    <div class="cart-wrap">
      <section class="cart-list" id="cartList">
        <div class="empty-state">Memuat keranjang...</div>
      </section>

      <aside class="cart-summary" id="cartSummary">
        <h2>Ringkasan Pesanan</h2>

        <div class="summary-row">
          <div>Subtotal</div>
          <div id="subtotalText">Rp 0</div>
        </div>

        <div class="summary-row">
          <div>Pajak &amp; Layanan</div>
          <div id="taxText">Rp 0</div>
        </div>

        <div class="summary-row total">
          <div>Total Estimasi</div>
          <div id="totalText">Rp 0</div>
        </div>

        <button id="checkoutBtn" class="btn btn-primary">Secure Checkout</button>
        <button id="clearBtn" class="btn btn-ghost">Kosongkan Keranjang</button>
      </aside>
    </div>

    {{-- Modal Konfirmasi Kosongkan Keranjang --}}
    <div id="clearCartModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 1000; justify-content: center; align-items: center; backdrop-filter: blur(2px);">
        <div style="background: var(--canvas); width: 100%; max-width: 400px; padding: 40px 32px; border: 1px solid var(--hairline); position: relative;">
            <h2 style="font-family: 'Helvetica Now Display Medium', 'Inter', sans-serif; font-size: 22px; font-weight: 600; color: var(--ink); margin-bottom: 12px; letter-spacing: -0.5px;">KOSONGKAN KERANJANG?</h2>
            <p style="color: var(--mute); font-size: 15px; margin-bottom: 32px; line-height: 1.6;">Semua item yang ada di keranjang akan dihapus. Tindakan ini tidak dapat dibatalkan.</p>
            <div style="display: flex; gap: 12px;">
                <button id="clearCartConfirm" style="flex: 1; background: var(--sale); color: #fff; border: none; padding: 14px; font-size: 15px; font-weight: 600; cursor: pointer; border-radius: 30px; transition: opacity 0.2s;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">YA, KOSONGKAN</button>
                <button id="clearCartCancel" style="flex: 1; background: var(--soft-cloud); color: var(--ink); border: none; padding: 14px; font-size: 15px; font-weight: 600; cursor: pointer; border-radius: 30px; transition: opacity 0.2s;" onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'">BATAL</button>
            </div>
        </div>
    </div>

    <div id="paymentModal" class="payment-modal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.85); z-index: 1000; justify-content: center; align-items: center; backdrop-filter: blur(5px); font-family: 'Inter', sans-serif;">
        <!-- Nike MD Style Modal -->
        <div style="background: #111; width: 100%; max-width: 420px; border-radius: 16px; padding: 40px; text-align: center; position: relative; border: 1px solid #333;">
            <button id="closeModalBtn" style="position: absolute; top: 20px; right: 24px; background: none; border: none; color: #fff; font-size: 28px; font-weight: 300; cursor: pointer; line-height: 1;">&times;</button>
            
            <h2 style="color: #fff; margin-bottom: 4px; font-size: 22px; font-weight: 800; letter-spacing: -0.5px; text-transform: uppercase;">ARVEN PAY <span style="font-size: 14px; vertical-align: middle;">✔</span></h2>
            <p style="color: #888; font-size: 13px; margin-bottom: 32px; font-weight: 500;">Simulasi Payment Gateway</p>
            
            <!-- 1. Pilihan Metode -->
            <div id="paymentMethodsView">
                <div style="font-size: 11px; color: #888; margin-bottom: 6px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase;">Total Tagihan</div>
                <div id="modalTotalText" style="font-size: 32px; font-weight: 900; margin-bottom: 4px; color: #fff; letter-spacing: -1px;">Rp 0</div>
                <div id="modalOrderIdText" style="font-size: 12px; color: #666; margin-bottom: 28px; font-family: monospace; letter-spacing: 0.5px;">—</div>

                <div style="display: flex; flex-direction: column; gap: 12px; text-align: left;">
                    <button class="pay-method-btn" onclick="processSimulatedPayment('QRIS', this)" style="background: #1a1a1a; border: 1px solid #333; padding: 18px 24px; border-radius: 12px; color: #fff; cursor: pointer; display: flex; justify-content: space-between; align-items: center; transition: all 0.2s; font-weight: 600; font-size: 14px;">
                        <span><span style="color: #aaa; margin-right: 12px;">📱</span> QRIS (OVO, GoPay, Dana)</span>
                        <span style="color: #555; font-size: 10px;">▶</span>
                    </button>
                    <button class="pay-method-btn" onclick="processSimulatedPayment('Virtual Account BCA', this)" style="background: #1a1a1a; border: 1px solid #333; padding: 18px 24px; border-radius: 12px; color: #fff; cursor: pointer; display: flex; justify-content: space-between; align-items: center; transition: all 0.2s; font-weight: 600; font-size: 14px;">
                        <span><span style="color: #aaa; margin-right: 12px;">🏦</span> Virtual Account BCA</span>
                        <span style="color: #555; font-size: 10px;">▶</span>
                    </button>
                    <button class="pay-method-btn" onclick="processSimulatedPayment('Virtual Account Mandiri', this)" style="background: #1a1a1a; border: 1px solid #333; padding: 18px 24px; border-radius: 12px; color: #fff; cursor: pointer; display: flex; justify-content: space-between; align-items: center; transition: all 0.2s; font-weight: 600; font-size: 14px;">
                        <span><span style="color: #aaa; margin-right: 12px;">🏦</span> Virtual Account Mandiri</span>
                        <span style="color: #555; font-size: 10px;">▶</span>
                    </button>
                </div>
            </div>

            <!-- 2. Loading / Processing -->
            <div id="paymentLoadingView" style="display: none; padding: 30px 0;">
                <div style="width: 50px; height: 50px; border: 3px solid #333; border-top-color: #fff; border-radius: 50%; animation: spin 1s linear infinite; margin: 0 auto 24px;"></div>
                <h3 style="color: #fff; font-size: 18px; font-weight: 700; margin-bottom: 12px;">Memproses Pembayaran</h3>
                <p style="color: #888; font-size: 13px; line-height: 1.5; max-width: 280px; margin: 0 auto;">Mohon tunggu sebentar, kami sedang memverifikasi pembayaran Anda.</p>
            </div>
            
            <!-- 3. Success -->
            <div id="paymentSuccessView" style="display: none; padding: 20px 0 10px;">
                <div style="width: 56px; height: 56px; background: #16a34a; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                    <span style="color: #fff; font-size: 28px; font-weight: bold;">✓</span>
                </div>
                <h3 style="color: #fff; font-size: 22px; font-weight: 800; margin-bottom: 10px; letter-spacing: -0.5px;">Pembayaran Berhasil!</h3>
                <p style="color: #999; font-size: 13px; margin-bottom: 30px;">Terima kasih, pembayaran Anda telah kami terima.</p>
                
                <div style="background: #1a1a1a; padding: 20px; border-radius: 12px; text-align: left; margin-bottom: 30px; border: 1px solid #2a2a2a;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 12px;">
                        <span style="color: #888; font-size: 12px; font-weight: 500;">No. Pesanan</span>
                        <span id="successOrderId" style="color: #fff; font-size: 12px; font-weight: 600;">-</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 12px;">
                        <span style="color: #888; font-size: 12px; font-weight: 500;">Total Pembayaran</span>
                        <span id="successTotal" style="color: #fff; font-size: 12px; font-weight: 600;">-</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span style="color: #888; font-size: 12px; font-weight: 500;">Metode</span>
                        <span id="successMethod" style="color: #fff; font-size: 12px; font-weight: 600;">-</span>
                    </div>
                </div>
                
                <a href="{{ route('home') }}" style="display: block; width: 100%; padding: 16px; background: #fff; color: #111; text-decoration: none; border-radius: 30px; font-weight: 700; font-size: 13px; letter-spacing: 1px; transition: transform 0.2s;">KEMBALI KE BERANDA</a>
            </div>
        </div>
    </div>

    <style>
        .pay-method-btn:hover { background: #222 !important; border-color: #555 !important; }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    </style>

  </main>
@endsection
