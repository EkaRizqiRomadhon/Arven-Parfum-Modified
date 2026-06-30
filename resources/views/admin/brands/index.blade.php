@extends('layouts.admin')
@section('title', 'Manajemen Brand - ARVEN PARFUME')
@section('header-title', 'Manajemen Brand')

@section('content')
    @if(session('success'))
        <script>document.addEventListener('DOMContentLoaded', () => showToast('{{ session('success') }}', 'success'));</script>
    @endif
    @if(session('error'))
        <script>document.addEventListener('DOMContentLoaded', () => showToast('{{ session('error') }}', 'error'));</script>
    @endif

    <div style="display:flex; justify-content:flex-end; margin-bottom:24px;">
        <a href="{{ route('admin.brands.create') }}" class="btn-primary" style="padding:10px 22px; text-decoration:none;">+ Tambah Brand</a>
    </div>

    <div class="admin-card">
        <div class="card-header">
            <h2 class="card-title">DAFTAR BRAND</h2>
            <span style="color:var(--mute); font-size:14px;">{{ $brands->count() }} brand</span>
        </div>
        <div style="overflow-x:auto;">
            <table style="width:100%; border-collapse:collapse; text-align:left;">
                <thead>
                    <tr>
                        <th style="padding:16px 8px 16px 0; border-bottom:1px solid var(--hairline); color:var(--mute); font-size:12px; font-weight:600; text-transform:uppercase;">Logo</th>
                        <th style="padding:16px 8px; border-bottom:1px solid var(--hairline); color:var(--mute); font-size:12px; font-weight:600; text-transform:uppercase;">Brand</th>
                        <th style="padding:16px 8px; border-bottom:1px solid var(--hairline); color:var(--mute); font-size:12px; font-weight:600; text-transform:uppercase;">Slug</th>
                        <th style="padding:16px 8px; border-bottom:1px solid var(--hairline); color:var(--mute); font-size:12px; font-weight:600; text-transform:uppercase;">Deskripsi</th>
                        <th style="padding:16px 8px; border-bottom:1px solid var(--hairline); color:var(--mute); font-size:12px; font-weight:600; text-transform:uppercase; text-align:center;">Produk</th>
                        <th style="padding:16px 8px; border-bottom:1px solid var(--hairline); color:var(--mute); font-size:12px; font-weight:600; text-transform:uppercase; text-align:right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($brands as $brand)
                        <tr>
                            <td style="padding:12px 8px 12px 0; border-bottom:1px solid var(--hairline-soft);">
                                <img src="{{ asset($brand->logo) }}" alt="{{ $brand->name }}"
                                     style="height:44px; max-width:80px; object-fit:contain; border-radius:6px;"
                                     onerror="this.style.display='none'">
                            </td>
                            <td style="padding:12px 8px; border-bottom:1px solid var(--hairline-soft);">
                                <div style="font-weight:600; font-size:14px;">{{ $brand->name }}</div>
                                <div style="font-size:12px; color:var(--mute);">Urutan: {{ $brand->sort_order }}</div>
                            </td>
                            <td style="padding:12px 8px; border-bottom:1px solid var(--hairline-soft);">
                                <code style="font-size:13px; background:var(--surface); padding:3px 8px; border-radius:4px; border:1px solid var(--hairline);">{{ $brand->slug }}</code>
                            </td>
                            <td style="padding:12px 8px; border-bottom:1px solid var(--hairline-soft); font-size:13px; color:var(--mute); max-width:240px;">
                                {{ Str::limit($brand->description, 60) }}
                            </td>
                            <td style="padding:12px 8px; border-bottom:1px solid var(--hairline-soft); text-align:center;">
                                <a href="{{ route('admin.products.index', ['brand' => $brand->slug]) }}"
                                   style="font-size:14px; font-weight:600; color:var(--ink); text-decoration:underline;">
                                    {{ $brand->products_count }}
                                </a>
                            </td>
                            <td style="padding:12px 8px; border-bottom:1px solid var(--hairline-soft); text-align:right; white-space:nowrap;">
                                <a href="{{ route('admin.brands.edit', $brand) }}" style="font-size:13px; color:var(--ink); text-decoration:underline; font-weight:500; margin-right:12px;">Edit</a>
                                <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" style="display:inline;"
                                      onsubmit="return confirm('Hapus brand {{ addslashes($brand->name) }}? Pastikan tidak ada produk terkait.')">
                                    @csrf @method('DELETE')
                                    <button type="submit" style="font-size:13px; color:#ef4444; background:none; border:none; cursor:pointer; font-weight:500; font-family:inherit; text-decoration:underline; padding:0;">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" style="padding:32px 0; color:var(--mute); font-size:14px;">Belum ada brand.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
