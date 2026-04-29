@extends('layouts.app')

@section('title', 'SAFFNCO.BLADE Katalog')

@section('content')
<section class="page-container">
      <h1>Saff & Co<br />Parfume Collection</h1>

      <div class="perfume-grid">
        <div class="perfume-card">
          <img src="{{ asset('img/saffcascavel.jpg') }}" alt="Saff & Co Cascavel" />
          <h3>Cascavel</h3>
          <p class="price">Rp 289.000</p>
          <p>Parfum Middle Eastern, bold dan mewah.</p>

          <button
            class="add-to-cart"
            data-id="saff-cascavel"
            data-name="Saff & Co Cascavel"
            data-price="289000"
            data-img="{{ asset('img/saffcascavel.jpg') }}"
          >
            Tambah ke Keranjang
          </button>
        </div>

        <div class="perfume-card">
          <img src="{{ asset('img/saffloui.png') }}" alt="Saff & Co Loui" />
          <h3>Loui</h3>
          <p class="price">Rp 150.000</p>
          <p>Floral manis dan feminin.</p>

          <button
            class="add-to-cart"
            data-id="saff-loui"
            data-name="Saff & Co Loui"
            data-price="150000"
            data-img="{{ asset('img/saffloui.png') }}"
          >
            Tambah ke Keranjang
          </button>
        </div>

        <div class="perfume-card">
          <img src="{{ asset('img/saffsotb.jpg') }}" alt="Saff & Co SOTB" />
          <h3>SOTB</h3>
          <p class="price">Rp 300.000</p>
          <p>Fresh marine maskulin.</p>

          <button
            class="add-to-cart"
            data-id="saff-sotb"
            data-name="Saff & Co SOTB"
            data-price="300000"
            data-img="{{ asset('img/saffsotb.jpg') }}"
          >
            Tambah ke Keranjang
          </button>
        </div>

        <div class="perfume-card">
          <img src="{{ asset('img/saffcoco.png') }}" alt="Saff & Co COCO" />
          <h3>COCO</h3>
          <p class="price">Rp 300.000</p>
          <p>Summer fresh dengan vibe pantai.</p>

          <button
            class="add-to-cart"
            data-id="saff-coco"
            data-name="Saff & Co COCO"
            data-price="300000"
            data-img="{{ asset('img/saffcoco.png') }}"
          >
            Tambah ke Keranjang
          </button>
        </div>
      </div>
    </section>
@endsection

