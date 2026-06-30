@extends('layouts.admin')
@section('title', 'Tambah Produk - ARVEN PARFUME')
@section('header-title', 'Tambah Produk Baru')

@section('content')
<div class="admin-card" style="max-width:720px;">
    <div class="card-header" style="margin-bottom:28px;">
        <h2 class="card-title">FORM PRODUK</h2>
        <a href="{{ route('admin.products.index') }}" style="font-size:14px; color:var(--mute); text-decoration:underline;">← Kembali</a>
    </div>

    @if($errors->any())
        <div style="background:#fee2e2; border-radius:8px; padding:14px 18px; margin-bottom:24px; font-size:14px; color:#b91c1c;">
            <ul style="margin:0; padding-left:18px;">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
            <div style="grid-column:1/-1;">
                <label style="display:block; font-size:12px; font-weight:600; color:var(--mute); text-transform:uppercase; margin-bottom:8px;">Nama Produk *</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    style="width:100%; padding:12px 14px; border:1px solid var(--hairline); border-radius:8px; background:var(--surface); color:var(--ink); font-size:15px; box-sizing:border-box;">
            </div>

            <div>
                <label style="display:block; font-size:12px; font-weight:600; color:var(--mute); text-transform:uppercase; margin-bottom:8px;">Brand *</label>
                <select name="brand" required style="width:100%; padding:12px 14px; border:1px solid var(--hairline); border-radius:8px; background:var(--surface); color:var(--ink); font-size:15px; box-sizing:border-box;">
                    <option value="">-- Pilih Brand --</option>
                    @foreach($brands as $b)
                        <option value="{{ $b->slug }}" {{ old('brand') == $b->slug ? 'selected' : '' }}>{{ $b->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label style="display:block; font-size:12px; font-weight:600; color:var(--mute); text-transform:uppercase; margin-bottom:8px;">Harga (Rp) *</label>
                <input type="number" name="price" value="{{ old('price') }}" min="0" required
                    style="width:100%; padding:12px 14px; border:1px solid var(--hairline); border-radius:8px; background:var(--surface); color:var(--ink); font-size:15px; box-sizing:border-box;">
            </div>

            <div>
                <label style="display:block; font-size:12px; font-weight:600; color:var(--mute); text-transform:uppercase; margin-bottom:8px;">Stok *</label>
                <input type="number" name="stock" value="{{ old('stock', 0) }}" min="0" required
                    style="width:100%; padding:12px 14px; border:1px solid var(--hairline); border-radius:8px; background:var(--surface); color:var(--ink); font-size:15px; box-sizing:border-box;">
            </div>

            <div style="grid-column:1/-1;">
                <label style="display:block; font-size:12px; font-weight:600; color:var(--mute); text-transform:uppercase; margin-bottom:8px;">Deskripsi</label>
                <textarea name="description" rows="3"
                    style="width:100%; padding:12px 14px; border:1px solid var(--hairline); border-radius:8px; background:var(--surface); color:var(--ink); font-size:15px; box-sizing:border-box; resize:vertical;">{{ old('description') }}</textarea>
            </div>

            <div style="grid-column:1/-1;">
                <label style="display:block; font-size:12px; font-weight:600; color:var(--mute); text-transform:uppercase; margin-bottom:8px;">Gambar Produk</label>
                <input type="file" name="image" accept="image/*" id="img-input"
                    style="width:100%; padding:10px 14px; border:1px solid var(--hairline); border-radius:8px; background:var(--surface); color:var(--ink); font-size:14px; box-sizing:border-box;">
                <img id="img-preview" src="" alt="Preview" style="display:none; margin-top:12px; max-height:140px; border-radius:8px; object-fit:cover;">
            </div>
        </div>

        <div style="display:flex; gap:12px; margin-top:28px;">
            <button type="submit" class="btn-primary" style="padding:12px 28px;">Simpan Produk</button>
            <a href="{{ route('admin.products.index') }}" style="padding:12px 20px; font-size:14px; color:var(--mute); text-decoration:underline; display:flex; align-items:center;">Batal</a>
        </div>
    </form>
</div>

<script>
document.getElementById('img-input').addEventListener('change', function () {
    const preview = document.getElementById('img-preview');
    if (this.files && this.files[0]) {
        preview.src = URL.createObjectURL(this.files[0]);
        preview.style.display = 'block';
    }
});
</script>
@endsection
