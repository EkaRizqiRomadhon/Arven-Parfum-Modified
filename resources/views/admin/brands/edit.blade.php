@extends('layouts.admin')
@section('title', 'Edit Brand - ARVEN PARFUME')
@section('header-title', 'Edit Brand')

@section('content')
<div class="admin-card" style="max-width:640px;">
    <div class="card-header" style="margin-bottom:28px;">
        <h2 class="card-title">EDIT: {{ strtoupper($brand->name) }}</h2>
        <a href="{{ route('admin.brands.index') }}" style="font-size:14px; color:var(--mute); text-decoration:underline;">← Kembali</a>
    </div>

    @if($errors->any())
        <div style="background:#fee2e2; border-radius:8px; padding:14px 18px; margin-bottom:24px; font-size:14px; color:#b91c1c;">
            <ul style="margin:0; padding-left:18px;">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.brands.update', $brand) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div style="display:flex; flex-direction:column; gap:20px;">
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
                <div>
                    <label style="display:block; font-size:12px; font-weight:600; color:var(--mute); text-transform:uppercase; margin-bottom:8px;">Nama Brand *</label>
                    <input type="text" name="name" value="{{ old('name', $brand->name) }}" required
                        style="width:100%; padding:12px 14px; border:1px solid var(--hairline); border-radius:8px; background:var(--surface); color:var(--ink); font-size:15px; box-sizing:border-box;">
                </div>
                <div>
                    <label style="display:block; font-size:12px; font-weight:600; color:var(--mute); text-transform:uppercase; margin-bottom:8px;">Slug</label>
                    <input type="text" value="{{ $brand->slug }}" disabled
                        style="width:100%; padding:12px 14px; border:1px solid var(--hairline); border-radius:8px; background:var(--hairline); color:var(--mute); font-size:15px; box-sizing:border-box; cursor:not-allowed;">
                    <p style="font-size:11px; color:var(--mute); margin:4px 0 0;">Slug tidak bisa diubah untuk menjaga konsistensi data produk.</p>
                </div>
            </div>

            <div>
                <label style="display:block; font-size:12px; font-weight:600; color:var(--mute); text-transform:uppercase; margin-bottom:8px;">Deskripsi Singkat</label>
                <textarea name="description" rows="2"
                    style="width:100%; padding:12px 14px; border:1px solid var(--hairline); border-radius:8px; background:var(--surface); color:var(--ink); font-size:15px; box-sizing:border-box; resize:vertical;">{{ old('description', $brand->description) }}</textarea>
            </div>

            <div style="display:grid; grid-template-columns:2fr 1fr; gap:20px;">
                <div>
                    <label style="display:block; font-size:12px; font-weight:600; color:var(--mute); text-transform:uppercase; margin-bottom:8px;">Logo Brand</label>
                    @if($brand->logo)
                        <div style="margin-bottom:10px; display:flex; align-items:center; gap:12px;">
                            <img src="{{ asset($brand->logo) }}" alt="{{ $brand->name }}"
                                style="max-height:60px; object-fit:contain; border-radius:6px;">
                            <span style="font-size:12px; color:var(--mute);">Logo saat ini.<br>Biarkan kosong untuk tidak mengubah.</span>
                        </div>
                    @endif
                    <input type="file" name="logo" accept="image/*" id="logo-input"
                        style="width:100%; padding:10px 14px; border:1px solid var(--hairline); border-radius:8px; background:var(--surface); color:var(--ink); font-size:14px; box-sizing:border-box;">
                    <img id="logo-preview" src="" alt="Preview" style="display:none; margin-top:10px; max-height:80px; object-fit:contain; border-radius:6px;">
                </div>
                <div>
                    <label style="display:block; font-size:12px; font-weight:600; color:var(--mute); text-transform:uppercase; margin-bottom:8px;">Urutan Tampil</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $brand->sort_order) }}" min="0" required
                        style="width:100%; padding:12px 14px; border:1px solid var(--hairline); border-radius:8px; background:var(--surface); color:var(--ink); font-size:15px; box-sizing:border-box;">
                </div>
            </div>
        </div>

        <div style="display:flex; gap:12px; margin-top:28px;">
            <button type="submit" class="btn-primary" style="padding:12px 28px;">Simpan Perubahan</button>
            <a href="{{ route('admin.brands.index') }}" style="padding:12px 20px; font-size:14px; color:var(--mute); text-decoration:underline; display:flex; align-items:center;">Batal</a>
        </div>
    </form>
</div>

<script>
document.getElementById('logo-input').addEventListener('change', function () {
    const preview = document.getElementById('logo-preview');
    if (this.files && this.files[0]) {
        preview.src = URL.createObjectURL(this.files[0]);
        preview.style.display = 'block';
    }
});
</script>
@endsection
