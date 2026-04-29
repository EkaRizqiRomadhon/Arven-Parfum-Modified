@extends('layouts.app')

@section('title', 'ARVEN PARFUME - A Classy Perfume')
@section('description', 'Temukan koleksi parfum elegan di ARVEN PARFUME.')

@section('content')
  <main class="hero-section">
    <img
      src="{{ asset('img/halaman depan parfum 3.jpg') }}"
      alt="Latar belakang parfum"
      class="hero-bg-img"
    />
    <div class="hero-content">
      <h2 class="reveal">JOIN MY PARFUME</h2>
      <h1 class="reveal delay-1">A CLASSY PERFUME</h1>
      <a href="#content" class="button ripple delay-2">See More</a>
    </div>
  </main>

  <section id="content" class="scroll-target-section">
    <h2 class="section-title center">BEST PARFUME</h2>
    <p class="section-subtitle center">Elegant, Classy Perfume</p>

    <div id="titleModal" class="modal">
      <div class="modal-backdrop" data-close></div>
      <div class="modal-card">
        <button class="modal-close" aria-label="Tutup" data-close>&times;</button>
        <h4 class="center" style="color: var(--gold)">Tentang "BEST Parfume"</h4>
        <p class="center" style="margin-top: 10px; color: var(--muted)">
          Bagian ini menampilkan koleksi parfum terbaik dari ARVEN,
          menonjolkan aroma elegan dan berkelas untuk pria maupun wanita.
        </p>
      </div>
    </div>

    <div class="featured-grid">
      <article class="featured-item sr">
        <img src="{{ asset('img/ysl_y_leparfum.jpg') }}" alt="YSL Y Le Parfum" class="tilt-img" />
        <h3>YSL Y Le Parfum</h3>
      </article>

      <article class="featured-item sr">
        <img src="{{ asset('img/mykonos_glitch.png') }}" alt="Mykonos Glitch" class="tilt-img open-modal" />
        <h3>Mykonos Glitch</h3>
      </article>

      <article class="featured-item sr">
        <img src="{{ asset('img/bleu_chanel_edp.png') }}" alt="Bleu De Chanel" class="tilt-img open-modal" />
        <h3>Bleu De Chanel</h3>
      </article>
    </div>

    <div class="sparkle-wrapper">
      <canvas id="sparkCanvas" class="spark-canvas"></canvas>
    </div>
  </section>

  <section class="contact-section" style="padding: 60px 20px; text-align: center; color: var(--text)">
    <h2 class="section-title center no-anim">HUBUNGI KAMI</h2>

    <div class="contact-grid"
      style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:30px;max-width:1000px;margin:0 auto;">
      <div class="contact-item">
        <i class="fas fa-phone" style="font-size:24px;color:var(--gold);margin-bottom:15px"></i>
        <h3 style="margin-bottom:10px">Telepon</h3>
        <p style="color:var(--muted)">Layanan Pelanggan:</p>
        <p>+62 812-345-6789</p>
      </div>

      <div class="contact-item">
        <i class="fas fa-map-marker-alt" style="font-size:24px;color:var(--gold);margin-bottom:15px"></i>
        <h3 style="margin-bottom:10px">Lokasi</h3>
        <p style="color:var(--muted)">Jl. Balai Pemuda No. 19-20</p>
        <p>Tegalsari, Surabaya</p>
      </div>

      <div class="contact-item">
        <i class="fas fa-share-alt" style="font-size:24px;color:var(--gold);margin-bottom:15px"></i>
        <h3 style="margin-bottom:10px">Media Sosial</h3>
        <div style="display:flex;gap:15px;justify-content:center;margin-top:10px">
          <a href="https://www.instagram.com/arvenparfume/" target="_blank"
            style="color:var(--text);font-size:20px"><i class="fab fa-instagram"></i></a>
          <a href="https://www.tiktok.com/@arvenparfumeofficial" target="_blank"
            style="color:var(--text);font-size:20px"><i class="fab fa-tiktok"></i></a>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const cartData = JSON.parse(localStorage.getItem("arven_cart_v1")) || [];
      const totalQty = cartData.reduce((sum, item) => sum + (item.qty || 0), 0);
      const badge = document.getElementById("cartBadge");
      if (badge && totalQty > 0) {
        badge.style.display = "inline-flex";
        badge.innerText = totalQty;
      }
      window.addEventListener("scroll", function () {
        const header = document.getElementById("siteHeader");
        if (header) header.classList.toggle("scrolled", window.scrollY > 50);
      });
    });
  </script>
@endpush
