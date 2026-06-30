@extends('layouts.app')

@section('title', $brand->name . ' Collection - ARVEN PARFUME')
@section('description', 'Koleksi parfum ' . $brand->name . ' terbaik hanya di ARVEN PARFUME.')

@section('content')
<section class="page-container">
  <h1>{{ $brand->name }}<br />Parfume Collection</h1>

  @if($products->isEmpty())
    <div style="text-align:center; padding: 4rem 1rem; color: #aaa;">
      <p>Belum ada produk untuk brand ini.</p>
    </div>
  @else
    <div class="perfume-grid">
      @foreach ($products as $product)
        <div class="perfume-card">
          <img src="{{ asset('img/' . $product->image) }}" alt="{{ $product->name }}" />
          <h3>{{ $product->name }}</h3>
          <p class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
          <p style="font-size: 12px; color: {{ $product->stock > 0 ? '#666' : '#ef4444' }}; font-weight: 500; margin-bottom: 8px;">
            Sisa Stok: {{ $product->stock }}
          </p>
          <p>{{ $product->description }}</p>

          <button
            class="add-to-cart"
            data-id="{{ $product->id }}"
            data-name="{{ $product->name }}"
            data-price="{{ $product->price }}"
            data-img="{{ asset('img/' . $product->image) }}"
            data-stock="{{ $product->stock }}"
            {{ $product->stock < 1 ? 'disabled style=opacity:0.5;cursor:not-allowed;' : '' }}
          >
            {{ $product->stock < 1 ? 'Stok Habis' : 'Tambah ke Keranjang' }}
          </button>
        </div>
      @endforeach
    </div>
  @endif
</section>
@endsection
