@extends('layouts.admin')
@section('title', 'Manajemen Produk - ARVEN PARFUME')
@section('header-title', 'Manajemen Produk')

@section('content')
    @if(session('success'))
        <script>document.addEventListener('DOMContentLoaded', () => showToast('{{ session('success') }}', 'success'));</script>
    @endif

    {{-- Filter & Tambah --}}
    <div class="admin-card" style="margin-bottom: 24px;">
        <form method="GET" action="{{ route('admin.products.index') }}" style="display:flex; gap:12px; flex-wrap:wrap; align-items:center;">
            <input
                type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari nama produk..."
                style="flex:1; min-width:200px; padding:10px 14px; border:1px solid var(--hairline); border-radius:8px; background:var(--surface); color:var(--ink); font-size:14px;"
            >
            <select name="brand" style="padding:10px 14px; border:1px solid var(--hairline); border-radius:8px; background:var(--surface); color:var(--ink); font-size:14px;">
                <option value="">Semua Brand</option>
                @foreach($brands as $b)
                    <option value="{{ $b->slug }}" {{ request('brand') == $b->slug ? 'selected' : '' }}>{{ $b->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn-primary" style="padding:10px 20px; white-space:nowrap;">Filter</button>
            @if(request()->hasAny(['search','brand']))
                <a href="{{ route('admin.products.index') }}" style="padding:10px 16px; font-size:14px; color:var(--mute); text-decoration:underline;">Reset</a>
            @endif
            <a href="{{ route('admin.products.create') }}" class="btn-primary" style="padding:10px 20px; text-decoration:none; white-space:nowrap; margin-left:auto;">+ Tambah Produk</a>
        </form>
    </div>

    <div class="admin-card">
        <div class="card-header">
            <h2 class="card-title">DAFTAR PRODUK</h2>
            <span style="color:var(--mute); font-size:14px;">{{ $products->total() }} produk</span>
        </div>
        <div style="overflow-x:auto;">
            <table style="width:100%; border-collapse:collapse; text-align:left;">
                <thead>
                    <tr>
                        <th style="padding:16px 8px 16px 0; border-bottom:1px solid var(--hairline); color:var(--mute); font-size:12px; font-weight:600; text-transform:uppercase;">Gambar</th>
                        <th style="padding:16px 8px; border-bottom:1px solid var(--hairline); color:var(--mute); font-size:12px; font-weight:600; text-transform:uppercase;">Produk</th>
                        <th style="padding:16px 8px; border-bottom:1px solid var(--hairline); color:var(--mute); font-size:12px; font-weight:600; text-transform:uppercase;">Brand</th>
                        <th style="padding:16px 8px; border-bottom:1px solid var(--hairline); color:var(--mute); font-size:12px; font-weight:600; text-transform:uppercase;">Harga</th>
                        <th style="padding:16px 8px; border-bottom:1px solid var(--hairline); color:var(--mute); font-size:12px; font-weight:600; text-transform:uppercase;">Stok</th>
                        <th style="padding:16px 8px; border-bottom:1px solid var(--hairline); color:var(--mute); font-size:12px; font-weight:600; text-transform:uppercase; text-align:right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td style="padding:12px 8px 12px 0; border-bottom:1px solid var(--hairline-soft);">
                                <img src="{{ asset('img/' . $product->image) }}" alt="{{ $product->name }}"
                                     style="width:52px; height:52px; object-fit:cover; border-radius:8px; background:var(--surface);"
                                     onerror="this.style.display='none'">
                            </td>
                            <td style="padding:12px 8px; border-bottom:1px solid var(--hairline-soft);">
                                <div style="font-weight:500; font-size:14px;">{{ $product->name }}</div>
                                <div style="font-size:12px; color:var(--mute); margin-top:2px;">{{ Str::limit($product->description, 50) }}</div>
                            </td>
                            <td style="padding:12px 8px; border-bottom:1px solid var(--hairline-soft);">
                                <span class="badge badge-neutral" style="text-transform:capitalize;">{{ $product->brand }}</span>
                            </td>
                            <td style="padding:12px 8px; border-bottom:1px solid var(--hairline-soft); font-size:14px; white-space:nowrap;">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </td>
                            <td style="padding:12px 8px; border-bottom:1px solid var(--hairline-soft); font-size:14px;">
                                <span style="color: {{ $product->stock <= 5 ? 'var(--error, #ef4444)' : 'var(--ink)' }}; font-weight:{{ $product->stock <= 5 ? '600' : '400' }}">
                                    {{ $product->stock }}
                                </span>
                            </td>
                            <td style="padding:12px 8px; border-bottom:1px solid var(--hairline-soft); text-align:right; white-space:nowrap;">
                                <a href="{{ route('admin.products.edit', $product) }}" style="font-size:13px; color:var(--ink); text-decoration:underline; font-weight:500; margin-right:12px;">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus produk {{ addslashes($product->name) }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" style="font-size:13px; color:#ef4444; background:none; border:none; cursor:pointer; font-weight:500; font-family:inherit; text-decoration:underline; padding:0;">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" style="padding:32px 0; color:var(--mute); font-size:14px;">Belum ada produk.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($products->hasPages())
            <div style="margin-top:24px;">{{ $products->links() }}</div>
        @endif
    </div>
@endsection
