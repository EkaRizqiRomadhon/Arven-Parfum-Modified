@extends('layouts.app')

@section('title', 'CHANEL.BLADE Katalog')

@section('content')
<section class="page-container">
      <h1>Chanel<br />Parfume Collection</h1>

      <div class="perfume-grid">
        <!-- Bleu de Chanel EDT -->
        <div class="perfume-card">
          <img src="{{ asset('img/bleu_chanel_edt.jpg') }}" alt="Bleu de Chanel EDT" />
          <h3>Bleu de Chanel EDT</h3>
          <p class="price">Rp 2.000.000</p>
          <p>Fresh citrus woody yang versatile.</p>

          <button
            class="add-to-cart"
            data-id="chanel-bleu-edt"
            data-name="Bleu de Chanel EDT"
            data-price="2000000"
            data-img="{{ asset('img/bleu_chanel_edt.jpg') }}"
          >
            Tambah ke Keranjang
          </button>
        </div>

        <!-- Bleu de Chanel EDP -->
        <div class="perfume-card">
          <img src="{{ asset('img/bleu_chanel_edp.png') }}" alt="Bleu de Chanel EDP" />
          <h3>Bleu de Chanel EDP</h3>
          <p class="price">Rp 2.500.000</p>
          <p>Smooth, elegant, dan lebih deep.</p>

          <button
            class="add-to-cart"
            data-id="chanel-bleu-edp"
            data-name="Bleu de Chanel EDP"
            data-price="2500000"
            data-img="{{ asset('img/bleu_chanel_edp.png') }}"
          >
            Tambah ke Keranjang
          </button>
        </div>

        <!-- Allure Homme Sport -->
        <div class="perfume-card">
          <img src="{{ asset('img/allure_homme_sport.png') }}" alt="Allure Homme Sport" />
          <h3>Allure Homme Sport</h3>
          <p class="price">Rp 2.000.000</p>
          <p>Fresh sporty, energik, dan youthful.</p>

          <button
            class="add-to-cart"
            data-id="chanel-allure-sport"
            data-name="Allure Homme Sport"
            data-price="2000000"
            data-img="{{ asset('img/allure_homme_sport.png') }}"
          >
            Tambah ke Keranjang
          </button>
        </div>

        <!-- Égoïste Platinum -->
        <div class="perfume-card">
          <img src="{{ asset('img/egoiste_platinum.png') }}" alt="Chanel Egoiste Platinum" />
          <h3>Chanel Égoïste Platinum</h3>
          <p class="price">Rp 1.644.000</p>
          <p>Clean fougere yang maskulin dan timeless.</p>

          <button
            class="add-to-cart"
            data-id="chanel-egoiste-platinum"
            data-name="Chanel Égoïste Platinum"
            data-price="1644000"
            data-img="{{ asset('img/egoiste_platinum.png') }}"
          >
            Tambah ke Keranjang
          </button>
        </div>

        <!-- Chanel Coco -->
        <div class="perfume-card">
          <img src="{{ asset('img/chanel_coco.png') }}" alt="Chanel Coco" />
          <h3>Chanel Coco</h3>
          <p class="price">Rp 2.648.000</p>
          <p>Elegant, classy, dan iconic.</p>

          <button
            class="add-to-cart"
            data-id="chanel-coco"
            data-name="Chanel Coco"
            data-price="2648000"
            data-img="{{ asset('img/chanel_coco.png') }}"
          >
            Tambah ke Keranjang
          </button>
        </div>
      </div>
    </section>
@endsection

