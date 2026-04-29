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
  </main>
@endsection
