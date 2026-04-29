@extends('layouts.app')

@section('title', 'DIOR.BLADE Katalog')

@section('content')
<section class="page-container">
      <h1>Dior<br />Parfume Collection</h1>

      <div class="perfume-grid">
        <!-- Dior Sauvage EDT -->
        <div class="perfume-card">
          <img src="{{ asset('img/dior_sauvage_edt.jpg') }}" alt="Dior Sauvage EDT" />
          <h3>Dior Sauvage EDT</h3>
          <p class="price">Rp 2.200.000</p>
          <p>Spicy fresh maskulin dengan ketahanan kuat.</p>

          <button
            class="add-to-cart"
            data-id="dior-sauvage-edt"
            data-name="Dior Sauvage EDT"
            data-price="2200000"
            data-img="{{ asset('img/dior_sauvage_edt.jpg') }}"
          >
            Tambah ke Keranjang
          </button>
        </div>

        <!-- Dior Sauvage EDP -->
        <div class="perfume-card">
          <img src="{{ asset('img/dior_sauvage_edp.jpg') }}" alt="Dior Sauvage EDP" />
          <h3>Dior Sauvage EDP</h3>
          <p class="price">Rp 2.400.000</p>
          <p>Lebih deep, smooth, dan elegan.</p>

          <button
            class="add-to-cart"
            data-id="dior-sauvage-edp"
            data-name="Dior Sauvage EDP"
            data-price="2400000"
            data-img="{{ asset('img/dior_sauvage_edp.jpg') }}"
          >
            Tambah ke Keranjang
          </button>
        </div>

        <!-- Dior Homme Intense -->
        <div class="perfume-card">
          <img src="{{ asset('img/dior_homme_intense.jpg') }}" alt="Dior Homme Intense" />
          <h3>Dior Homme Intense</h3>
          <p class="price">Rp 1.950.000</p>
          <p>Iris powdery yang elegan dan gentleman.</p>

          <button
            class="add-to-cart"
            data-id="dior-homme-intense"
            data-name="Dior Homme Intense"
            data-price="1950000"
            data-img="{{ asset('img/dior_homme_intense.jpg') }}"
          >
            Tambah ke Keranjang
          </button>
        </div>

        <!-- Dior Fahrenheit -->
        <div class="perfume-card">
          <img src="{{ asset('img/dior_fahrenheit.jpg') }}" alt="Dior Fahrenheit" />
          <h3>Dior Fahrenheit</h3>
          <p class="price">Rp 1.975.000</p>
          <p>Leather klasik dengan karakter kuat.</p>

          <button
            class="add-to-cart"
            data-id="dior-fahrenheit"
            data-name="Dior Fahrenheit"
            data-price="1975000"
            data-img="{{ asset('img/dior_fahrenheit.jpg') }}"
          >
            Tambah ke Keranjang
          </button>
        </div>

        <!-- Dior Homme -->
        <div class="perfume-card">
          <img src="{{ asset('img/dior_homme.jpg') }}" alt="Dior Homme" />
          <h3>Dior Homme</h3>
          <p class="price">Rp 2.869.000</p>
          <p>Modern clean woody yang versatile.</p>

          <button
            class="add-to-cart"
            data-id="dior-homme"
            data-name="Dior Homme"
            data-price="2869000"
            data-img="{{ asset('img/dior_homme.jpg') }}"
          >
            Tambah ke Keranjang
          </button>
        </div>

        <!-- Dior Homme Sport -->
        <div class="perfume-card">
          <img src="{{ asset('img/dior_homme_sport.jpg') }}" alt="Dior Homme Sport" />
          <h3>Dior Homme Sport</h3>
          <p class="price">Rp 2.750.000</p>
          <p>Fresh citrus energik untuk outdoor.</p>

          <button
            class="add-to-cart"
            data-id="dior-homme-sport"
            data-name="Dior Homme Sport"
            data-price="2750000"
            data-img="{{ asset('img/dior_homme_sport.jpg') }}"
          >
            Tambah ke Keranjang
          </button>
        </div>
      </div>
    </section>
@endsection

