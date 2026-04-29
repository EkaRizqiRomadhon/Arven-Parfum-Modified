@extends('layouts.app')

@section('title', 'Koleksi Brand - ARVEN PARFUME')
@section('description', 'Temukan 6 koleksi parfum mewah dari brand ternama dunia di ARVEN PARFUME.')

@section('content')
  <main class="brand-section">
    <h1>PILIH BRAND PARFUM</h1>

    <div class="brand-grid">
      <a href="{{ route('brand.show', 'ysl') }}" class="brand-card">
        <div class="brand-card-inner">
          <img src="{{ asset('brand/ysl.png') }}" alt="YSL Brand" />
          <h3>Yves Saint Laurent</h3>
          <p>Parfum mewah dengan karakter elegan dan sophisticated</p>
        </div>
      </a>

      <a href="{{ route('brand.show', 'dior') }}" class="brand-card">
        <div class="brand-card-inner">
          <img src="{{ asset('brand/Dior_Logo.webp') }}" alt="Dior Brand" />
          <h3>Dior</h3>
          <p>Keanggunan klasik Prancis dalam setiap aroma</p>
        </div>
      </a>

      <a href="{{ route('brand.show', 'chanel') }}" class="brand-card">
        <div class="brand-card-inner">
          <img src="{{ asset('brand/chanel.png') }}" alt="Chanel Brand" />
          <h3>Chanel</h3>
          <p>Ikonik, timeless, dan penuh dengan kemewahan</p>
        </div>
      </a>

      <a href="{{ route('brand.show', 'hmns') }}" class="brand-card">
        <div class="brand-card-inner">
          <img src="{{ asset('brand/HMNS.png') }}" alt="HMNS Brand" />
          <h3>HMNS</h3>
          <p>Aroma modern yang fresh dan sophisticated</p>
        </div>
      </a>

      <a href="{{ route('brand.show', 'mykonos') }}" class="brand-card">
        <div class="brand-card-inner">
          <img src="{{ asset('brand/mykonos.jpeg') }}" alt="Mykonos Brand" />
          <h3>Mykonos</h3>
          <p>Kesegaran Mediterania dalam setiap semprotan</p>
        </div>
      </a>

      <a href="{{ route('brand.show', 'saffnco') }}" class="brand-card">
        <div class="brand-card-inner">
          <img src="{{ asset('brand/SAFF N CO.png') }}" alt="Saff & Co Brand" />
          <h3>Saff &amp; Co</h3>
          <p>Koleksi parfum eksklusif dengan sentuhan oriental</p>
        </div>
      </a>
    </div>
  </main>

  <section class="contact-section">
    <h2>HUBUNGI KAMI</h2>
    <div class="contact-grid">
      <div class="contact-item">
        <i class="fas fa-phone"></i>
        <h3>Telepon</h3>
        <p>Layanan Pelanggan:</p>
        <p>+62 812-345-6789 (WhatsApp)</p>
      </div>

      <div class="contact-item">
        <i class="fas fa-map-marker-alt"></i>
        <h3>Alamat Kantor Pusat</h3>
        <p>Jl. Balai pemuda No. 19-20</p>
        <p>Tegalsari, Surabaya</p>
      </div>

      <div class="contact-item">
        <i class="fas fa-share-alt"></i>
        <h3 style="margin-bottom: 20px">Media Sosial</h3>
        <div class="social-icons" style="flex-direction: column; gap: 15px">
          <a href="https://www.instagram.com/arvenparfume/" target="_blank" aria-label="Instagram"
            style="display:flex;align-items:center;justify-content:center;gap:10px;font-size:16px;text-decoration:none;">
            <i class="fab fa-instagram" style="font-size:24px"></i>
            @@arvenparfume
          </a>
          <a href="https://www.tiktok.com/@arvenparfume" target="_blank" aria-label="TikTok"
            style="display:flex;align-items:center;justify-content:center;gap:10px;font-size:16px;text-decoration:none;">
            <i class="fab fa-tiktok" style="font-size:24px"></i>
            @@arvenparfume
          </a>
        </div>
        <p style="margin-top:15px">Ikuti kami untuk update terbaru.</p>
      </div>
    </div>
  </section>
@endsection
