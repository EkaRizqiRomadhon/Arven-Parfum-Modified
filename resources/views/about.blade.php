@extends('layouts.app')

@section('title', 'Tentang Kami - ARVEN PARFUME')
@section('description', 'Informasi tentang ARVEN PARFUME, toko parfum premium di Surabaya, Indonesia.')

@section('content')
  <main>
    <div class="about-content">
      <h1>Tentang Kami</h1>

      <p>
        Arven Parfume menghadirkan koleksi parfum dari berbagai merek ternama
        dengan kualitas terbaik. Setiap aroma dipilih dengan cermat untuk
        memberikan pengalaman wangi yang memikat, tahan lama, dan penuh
        karakter. Temukan wewangian yang mencerminkan kepribadian Anda hanya
        di Arven Parfume, tempat di mana keharuman menjadi seni.
      </p>

      <div class="contact-info">
        <strong>ARVEN PARFUME</strong>
        <address>
          Tunjungan Plaza 3rd Floor<br />
          Jl. Balai pemuda No. 19-20<br />
          Tegalsari, Surabaya
        </address>
        <p>
          Tlp: 6563439<br />
          Email: contact@arvenparfume.com
        </p>
      </div>
    </div>

    <section class="contact-section">
      <h2>HUBUNGI KAMI</h2>
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
            <a href="https://www.instagram.com/arvenparfume/" target="_blank">
              <i class="fab fa-instagram"></i>
            </a>

            <a href="https://www.tiktok.com/@arvenparfume" target="_blank">
              <i class="fab fa-tiktok"></i>
            </a>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection
