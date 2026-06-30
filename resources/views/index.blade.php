@extends('layouts.app')

@section('title', 'ARVEN PARFUME - A Classy Perfume')
@section('description', 'Temukan koleksi parfum elegan di ARVEN PARFUME.')

@section('content')
  <main class="hero-section">
    <img
      src="{{ asset('img/hero-hd.png') }}"
      alt="Latar belakang parfum elegan"
      class="hero-bg-img"
    />
    <div class="hero-content">
      <h2>MEMBER EXCLUSIVE</h2>
      <h1>A CLASSY PERFUME</h1>
      <a href="/koleksi" class="btn-primary" style="display: inline-block;">Belanja Sekarang</a>
    </div>
  </main>

  <section id="content" class="scroll-target-section">
    <h2 class="section-title center">BEST PARFUME</h2>
    <p class="section-subtitle center">Elegant, Classy Perfume</p>

    <div class="featured-grid">
      <article class="featured-item">
        <img src="{{ asset('img/ysl_y_leparfum.jpg') }}" alt="YSL Y Le Parfum" />
        <h3>YSL Y Le Parfum</h3>
      </article>

      <article class="featured-item">
        <img src="{{ asset('img/mykonos_glitch.png') }}" alt="Mykonos Glitch" />
        <h3>Mykonos Glitch</h3>
      </article>

      <article class="featured-item">
        <img src="{{ asset('img/bleu_chanel_edp.png') }}" alt="Bleu De Chanel" />
        <h3>Bleu De Chanel</h3>
      </article>
    </div>
  </section>

  <section class="contact-section">
    <h2 class="section-title center">HUBUNGI KAMI</h2>

    <div class="contact-grid">
      <div class="contact-item">
        <i class="fas fa-phone"></i>
        <h3>Telepon</h3>
        <p>Layanan Pelanggan:</p>
        <p>+62 812-345-6789</p>
      </div>

      <div class="contact-item">
        <i class="fas fa-map-marker-alt"></i>
        <h3>Lokasi</h3>
        <p>Jl. Balai Pemuda No. 19-20</p>
        <p>Tegalsari, Surabaya</p>
      </div>

      <div class="contact-item">
        <i class="fas fa-share-alt"></i>
        <h3>Media Sosial</h3>
        <div class="social-icons">
          <a href="https://www.instagram.com/arvenparfume/" target="_blank"><i class="fab fa-instagram"></i></a>
          <a href="https://www.tiktok.com/@arvenparfumeofficial" target="_blank"><i class="fab fa-tiktok"></i></a>
        </div>
      </div>
    </div>
  </section>
@endsection
