@extends('layouts.app')

@section('title', 'HMNS.BLADE Katalog')

@section('content')
<section class="page-container">
      <h1>HMNS<br />Parfume Collection</h1>

      <div class="perfume-grid">
        <!-- HMNS Alpha -->
        <div class="perfume-card">
          <img src="{{ asset('img/hmns_alpha.png') }}" alt="HMNS Alpha" />
          <h3>HMNS Alpha</h3>
          <p class="price">Rp 320.000</p>
          <p>Segar, modern, clean – citrus & marine.</p>

          <button
            class="add-to-cart"
            data-id="hmns-alpha"
            data-name="HMNS Alpha"
            data-price="320000"
            data-img="{{ asset('img/hmns_alpha.png') }}"
          >
            Tambah ke Keranjang
          </button>
        </div>

        <!-- HMNS Orgasm -->
        <div class="perfume-card">
          <img src="{{ asset('img/hmns_orgasm.jpg') }}" alt="HMNS Orgasm" />
          <h3>HMNS Orgasm</h3>
          <p class="price">Rp 370.000</p>
          <p>Woody–aromatic yang clean dan elegan.</p>

          <button
            class="add-to-cart"
            data-id="hmns-orgasm"
            data-name="HMNS Orgasm"
            data-price="370000"
            data-img="{{ asset('img/hmns_orgasm.jpg') }}"
          >
            Tambah ke Keranjang
          </button>
        </div>

        <!-- HMNS Farhampthon -->
        <div class="perfume-card">
          <img src="{{ asset('img/hmns_farhampthon.png') }}" alt="HMNS Farhampthon" />
          <h3>HMNS Farhampthon</h3>
          <p class="price">Rp 370.000</p>
          <p>Hangat, spicy, dan sensual.</p>

          <button
            class="add-to-cart"
            data-id="hmns-farhampthon"
            data-name="HMNS Farhampthon"
            data-price="370000"
            data-img="{{ asset('img/hmns_farhampthon.png') }}"
          >
            Tambah ke Keranjang
          </button>
        </div>
      </div>
    </section>
@endsection

