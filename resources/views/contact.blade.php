@extends('layouts.app')

@section('title', 'Hubungi Kami - ARVEN PARFUME')
@section('description', 'Kirim pesan kepada kami untuk pertanyaan, pemesanan, atau informasi parfum.')

@section('content')
  <main class="content-section">
    <h1>HUBUNGI KAMI</h1>
    <p>Silakan isi formulir di bawah ini untuk pertanyaan atau pemesanan.</p>

    {{-- ── Toast Notification menggantikan Alert HTML ───────────────────── --}}
    @if(session('success'))
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          showToast("{{ session('success') }}", 'success');
        });
      </script>
    @endif

    @if($errors->any())
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          @foreach($errors->all() as $error)
            showToast("{{ $error }}", 'error');
          @endforeach
        });
      </script>
    @endif

    <div class="contact-container">
      {{--
          Form dikirim ke route 'contact.send' (POST /contact/send).
          @csrf wajib ada agar Laravel tidak menolak request dengan 419.
      --}}
      <form action="{{ route('contact.send') }}" method="POST">
        @csrf
        <h2 class="form-title">Formulir Kontak</h2>

        <div class="form-group">
          <label for="name">Nama Lengkap</label>
          <input
            type="text"
            id="name"
            name="name"
            placeholder="Masukkan nama lengkap Anda"
            value="{{ old('name') }}"
            required
          />
          @error('name')
            <small class="field-error" style="color:#e74c3c;display:block;margin-top:4px">{{ $message }}</small>
          @enderror
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input
            type="email"
            id="email"
            name="email"
            placeholder="nama@contoh.com"
            value="{{ old('email') }}"
            required
          />
          @error('email')
            <small class="field-error" style="color:#e74c3c;display:block;margin-top:4px">{{ $message }}</small>
          @enderror
        </div>

        <div class="form-group">
          <label for="subject">Subjek</label>
          <input
            type="text"
            id="subject"
            name="subject"
            placeholder="Judul pesan Anda"
            value="{{ old('subject') }}"
            required
          />
          @error('subject')
            <small class="field-error" style="color:#e74c3c;display:block;margin-top:4px">{{ $message }}</small>
          @enderror
        </div>

        <div class="form-group">
          <label for="message">Pesan</label>
          <textarea
            id="message"
            name="message"
            placeholder="Tulis pesan Anda..."
            rows="5"
            required
          >{{ old('message') }}</textarea>
          @error('message')
            <small class="field-error" style="color:#e74c3c;display:block;margin-top:4px">{{ $message }}</small>
          @enderror
        </div>

        <button type="submit" class="submit-btn ripple">KIRIM PESAN</button>
      </form>
    </div>
  </main>
@endsection
