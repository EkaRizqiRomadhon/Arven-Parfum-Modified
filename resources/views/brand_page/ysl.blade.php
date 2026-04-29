@extends('layouts.app')

@section('title', 'YSL.BLADE Katalog')

@section('content')
<section class="page-container">
      <h1>Yves Saint Laurent<br />Parfume Collection</h1>

      <div class="perfume-grid">
        <!-- YSL Y EDP -->
        <div class="perfume-card">
          <img src="{{ asset('img/ysl_y_edp.jpg') }}" alt="YSL Y EDP" />
          <h3>YSL Y Eau de Parfum</h3>
          <p class="price">Rp 1.800.000</p>
          <p>Parfum maskulin modern, segar dan clean.</p>

          <button
            class="add-to-cart"
            data-id="ysl-y-edp"
            data-name="YSL Y Eau de Parfum"
            data-price="1800000"
            data-img="{{ asset('img/ysl_y_edp.jpg') }}"
          >
            Tambah ke Keranjang
          </button>
        </div>

        <!-- La Nuit De L'Homme -->
        <div class="perfume-card">
          <img src="{{ asset('img/ysl_lanuit.jpg') }}" alt="La Nuit De L'Homme" />
          <h3>La Nuit De L'Homme</h3>
          <p class="price">Rp 2.500.000</p>
          <p>Parfum malam sensual dan warm.</p>

          <button
            class="add-to-cart"
            data-id="ysl-lanuit"
            data-name="YSL La Nuit De L'Homme"
            data-price="2500000"
            data-img="{{ asset('img/ysl_lanuit.jpg') }}"
          >
            Tambah ke Keranjang
          </button>
        </div>

        <!-- YSL L'Homme -->
        <div class="perfume-card">
          <img src="{{ asset('img/ysl_lhomme.jpg') }}" alt="YSL L'Homme" />
          <h3>YSL L'Homme</h3>
          <p class="price">Rp 1.700.000</p>
          <p>Fresh woody yang classy dan elegant.</p>

          <button
            class="add-to-cart"
            data-id="ysl-lhomme"
            data-name="YSL L'Homme"
            data-price="1700000"
            data-img="{{ asset('img/ysl_lhomme.jpg') }}"
          >
            Tambah ke Keranjang
          </button>
        </div>

        <!-- YSL Y Le Parfum -->
        <div class="perfume-card">
          <img src="{{ asset('img/ysl_y_leparfum.jpg') }}" alt="YSL Y Le Parfum" />
          <h3>YSL Y Le Parfum</h3>
          <p class="price">Rp 2.848.000</p>
          <p>Versi intense dan lebih gelap.</p>

          <button
            class="add-to-cart"
            data-id="ysl-y-leparfum"
            data-name="YSL Y Le Parfum"
            data-price="2848000"
            data-img="{{ asset('img/ysl_y_leparfum.jpg') }}"
          >
            Tambah ke Keranjang
          </button>
        </div>

        <!-- YSL Kouros -->
        <div class="perfume-card">
          <img src="{{ asset('img/ysl_kouros.png') }}" alt="YSL Kouros" />
          <h3>YSL Kouros</h3>
          <p class="price">Rp 1.233.000</p>
          <p>Klasik maskulin dengan karakter kuat.</p>

          <button
            class="add-to-cart"
            data-id="ysl-kouros"
            data-name="YSL Kouros"
            data-price="1233000"
            data-img="{{ asset('img/ysl_kouros.png') }}"
          >
            Tambah ke Keranjang
          </button>
        </div>

        <!-- YSL Black Opium -->
        <div class="perfume-card">
          <img src="{{ asset('img/ysl_BlackOpium.jpg') }}" alt="YSL Black Opium" />
          <h3>YSL Black Opium</h3>
          <p class="price">Rp 1.644.000</p>
          <p>Manis, bold, dan addictive.</p>

          <button
            class="add-to-cart"
            data-id="ysl-black-opium"
            data-name="YSL Black Opium"
            data-price="1644000"
            data-img="{{ asset('img/ysl_BlackOpium.jpg') }}"
          >
            Tambah ke Keranjang
          </button>
        </div>
      </div>
    </section>
@endsection

