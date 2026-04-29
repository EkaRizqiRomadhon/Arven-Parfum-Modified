@extends('layouts.app')

@section('title', 'MYKONOS.BLADE Katalog')

@section('content')
<section class="page-container">
      <h1>Mykonos<br />Parfume Collection</h1>

      <div class="perfume-grid">
        <!-- Aphrodite -->
        <div class="perfume-card">
          <img src="{{ asset('img/mykonos_aphrodite.png') }}" alt="Mykonos Aphrodite" />
          <h3>Aphrodite</h3>
          <p class="price">Rp 250.000</p>
          <p>Aroma pantai yang segar, citrus & sea-breeze.</p>
          <button
            class="add-to-cart"
            data-id="mykonos-aphrodite"
            data-name="Mykonos Aphrodite"
            data-price="250000"
            data-img="{{ asset('img/mykonos_aphrodite.png') }}"
          >
            Tambah ke Keranjang
          </button>
        </div>

        <!-- Luminos -->
        <div class="perfume-card">
          <img src="{{ asset('img/mykonos_luminos.png') }}" alt="Mykonos Luminos" />
          <h3>Luminos</h3>
          <p class="price">Rp 150.000</p>
          <p>Ringan dan segar untuk aktivitas outdoor.</p>
          <button
            class="add-to-cart"
            data-id="mykonos-luminos"
            data-name="Mykonos Luminos"
            data-price="150000"
            data-img="{{ asset('img/mykonos_luminos.png') }}"
          >
            Tambah ke Keranjang
          </button>
        </div>

        <!-- Monaco Royal -->
        <div class="perfume-card">
          <img src="{{ asset('img/mykonos_monaco royal.jpg') }}" alt="Mykonos Monaco Royal" />
          <h3>Monaco Royal</h3>
          <p class="price">Rp 150.000</p>
          <p>Versi malam yang hangat dan sensual.</p>
          <button
            class="add-to-cart"
            data-id="mykonos-monaco"
            data-name="Mykonos Monaco Royal"
            data-price="150000"
            data-img="{{ asset('img/mykonos_monaco royal.jpg') }}"
          >
            Tambah ke Keranjang
          </button>
        </div>

        <!-- Glitch -->
        <div class="perfume-card">
          <img src="{{ asset('img/mykonos_glitch.png') }}" alt="Mykonos Glitch" />
          <h3>Glitch</h3>
          <p class="price">Rp 250.000</p>
          <p>Fresh modern scent dengan karakter unik.</p>
          <button
            class="add-to-cart"
            data-id="mykonos-glitch"
            data-name="Mykonos Glitch"
            data-price="250000"
            data-img="{{ asset('img/mykonos_glitch.png') }}"
          >
            Tambah ke Keranjang
          </button>
        </div>

        <!-- Enchanted -->
        <div class="perfume-card">
          <img src="{{ asset('img/mykonos_enchanted.png') }}" alt="Mykonos Enchanted" />
          <h3>Enchanted</h3>
          <p class="price">Rp 150.000</p>
          <p>Soft & elegant untuk daily use.</p>
          <button
            class="add-to-cart"
            data-id="mykonos-enchanted"
            data-name="Mykonos Enchanted"
            data-price="150000"
            data-img="{{ asset('img/mykonos_enchanted.png') }}"
          >
            Tambah ke Keranjang
          </button>
        </div>
      </div>
    </section>
@endsection

