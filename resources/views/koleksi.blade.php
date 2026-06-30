@extends('layouts.app')

@section('title', 'Koleksi Brand - ARVEN PARFUME')
@section('description', 'Temukan 6 koleksi parfum mewah dari brand ternama dunia di ARVEN PARFUME.')

@section('content')
  <main class="brand-section">
    <h1>PILIH BRAND PARFUM</h1>

    <div class="brand-grid">
      @foreach ($brands as $brand)
        <a href="{{ route('brand.show', $brand->slug) }}" class="brand-card">
          <div class="brand-card-inner">
            <img src="{{ asset($brand->logo) }}" alt="{{ $brand->name }} Brand" />
            <h3>{{ $brand->name }}</h3>
            <p>{{ $brand->description }}</p>
          </div>
        </a>
      @endforeach
    </div>
  </main>

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
          <a href="https://www.instagram.com/arvenparfume/" target="_blank"><i class="fab fa-instagram"></i></a>
          <a href="https://www.tiktok.com/@arvenparfume" target="_blank"><i class="fab fa-tiktok"></i></a>
        </div>
      </div>
    </div>
  </section>
@endsection
