<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>@yield('title', 'ARVEN PARFUME - A Classy Perfume')</title>
    <meta name="description" content="@yield('description', 'Temukan koleksi parfum elegan dan berkelas di ARVEN PARFUME, Surabaya.')" />

    {{--
        ╔══════════════════════════════════════════════════════╗
        ║  VITE ASSETS — satu baris ini menggantikan SEMUA     ║
        ║  <link href="...css"> dan <script src="...js">       ║
        ║                                                      ║
        ║  CSS yang dibundle (public/build/assets/arven-*.css):║
        ║    style.css, auth_styles.css, styleindex.css,       ║
        ║    styleabout.css, stylekoleksi.css,                 ║
        ║    stylecontact.css, stylecart.css                   ║
        ║                                                      ║
        ║  JS yang dibundle (public/build/assets/app-*.js):   ║
        ║    bootstrap.js, auth.js, animation.js,              ║
        ║    navbar.js, cart.js                                ║
        ╚══════════════════════════════════════════════════════╝
    --}}
    @vite(['resources/css/arven.css', 'resources/js/app.js'])

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="auth-check" content="{{ Auth::check() ? 'true' : 'false' }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    {{-- Slot untuk CSS/meta tambahan per-halaman --}}
    @stack('head')
  </head>
  <body>
    {{-- ── HEADER & NAV (sama di semua halaman) ──────────────────────── --}}
    <header id="siteHeader">
      <div class="logo">
        <a href="{{ url('/') }}">ARVEN PARFUME</a>
      </div>

      <div class="header-right-nav">
        <nav>
          <ul>
            <li><a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">BERANDA</a></li>
            <li><a href="{{ url('/about') }}" class="nav-link {{ request()->is('about') ? 'active' : '' }}">TENTANG KAMI</a></li>
            <li><a href="{{ url('/koleksi') }}" class="nav-link {{ request()->is('koleksi') ? 'active' : '' }}">KOLEKSI</a></li>
            <li><a href="{{ url('/contact') }}" class="nav-link {{ request()->is('contact') ? 'active' : '' }}">KONTAK</a></li>
            <li style="display: flex; align-items: center; gap: 4px;">
              <a href="{{ url('/cart') }}" class="icon-circular" title="Keranjang">
                <i class="fas fa-shopping-cart"></i>
                <span id="cartBadge" class="cart-badge" style="display:none;">0</span>
              </a>
              @if(Auth::check())
              <a href="{{ route('checkout.history') }}" class="icon-circular {{ request()->routeIs('checkout.history') ? 'active' : '' }}" title="Riwayat Pesanan">
                <i class="fas fa-receipt"></i>
              </a>
              <a href="{{ route('profile.edit') }}" class="icon-circular {{ request()->routeIs('profile.edit') ? 'active' : '' }}" title="Profil Saya">
                <i class="fas fa-user"></i>
              </a>
              @endif
            </li>

            {{-- ── Tombol Auth: SSR Laravel menggantikan auth.js lama ──────────── --}}

            @if(Auth::check())
              @if(Auth::user()->role === 'admin')
                <li style="margin-left: 12px;">
                  <a href="{{ route('admin.dashboard') }}" class="btn-primary" style="background: var(--sale);">
                    Admin Panel
                  </a>
                </li>
              @endif
              <li style="display: flex; align-items: center; gap: 16px; margin-left: 12px;">
                <span style="color: var(--ink); font-size: 14px; font-weight: 500;">
                  Halo, {{ Auth::user()->full_name }}
                </span>
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                  @csrf
                  <button type="submit" class="btn-secondary">Logout</button>
                </form>
              </li>
            @else
              <li style="margin-left: 12px;">
                <a href="{{ route('login') }}" class="btn-primary">
                  Login
                </a>
              </li>
            @endif

          </ul>
        </nav>
        <div class="header-icons"></div>
      </div>
    </header>


    {{-- ── KONTEN UTAMA (berbeda tiap halaman) ───────────────────────── --}}
    @yield('content')

    {{-- ── SCRIPT TAMBAHAN PER-HALAMAN (opsional) ────────────────────── --}}
    @stack('scripts')

    {{-- ── TOAST NOTIFICATION CONTAINER ─────────────────────────────── --}}
    <div id="toastContainer" style="
        position: fixed;
        bottom: 32px;
        right: 32px;
        z-index: 9999;
        display: flex;
        flex-direction: column;
        gap: 10px;
        pointer-events: none;
    "></div>

    <style>
        .arven-toast {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 16px 20px;
            background: var(--ink);
            color: var(--canvas);
            font-family: "Helvetica Now Text", "Inter", sans-serif;
            font-size: 14px;
            font-weight: 500;
            min-width: 280px;
            max-width: 360px;
            border: none;
            border-left: 3px solid var(--canvas);
            box-shadow: 0 8px 24px rgba(0,0,0,0.2);
            pointer-events: all;
            cursor: default;
            opacity: 0;
            transform: translateX(20px);
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .arven-toast.show {
            opacity: 1;
            transform: translateX(0);
        }
        .arven-toast.toast-success { border-left-color: #1eaa52; }
        .arven-toast.toast-error   { border-left-color: #d30005; }
        .arven-toast.toast-info    { border-left-color: #cacacb; }
        .arven-toast-icon {
            font-size: 16px;
            line-height: 1;
            margin-top: 1px;
            flex-shrink: 0;
        }
        .arven-toast-body { flex: 1; line-height: 1.5; }
        .arven-toast-title {
            font-weight: 600;
            letter-spacing: 0.02em;
            margin-bottom: 2px;
            text-transform: uppercase;
            font-size: 11px;
            opacity: 0.6;
        }
        .arven-toast-msg { font-size: 14px; }
    </style>

    <script>
        function showToast(message, type = 'success', title = null) {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `arven-toast toast-${type}`;

            const icons = { success: '✓', error: '✕', info: '→' };
            const defaultTitles = { success: 'Berhasil', error: 'Gagal', info: 'Info' };

            toast.innerHTML = `
                <div class="arven-toast-icon">${icons[type] || '→'}</div>
                <div class="arven-toast-body">
                    <div class="arven-toast-title">${title || defaultTitles[type]}</div>
                    <div class="arven-toast-msg">${message}</div>
                </div>
            `;

            container.appendChild(toast);
            requestAnimationFrame(() => {
                requestAnimationFrame(() => toast.classList.add('show'));
            });

            setTimeout(() => {
                toast.classList.remove('show');
                toast.addEventListener('transitionend', () => toast.remove(), { once: true });
            }, 3500);
        }
    </script>
  </body>
</html>
