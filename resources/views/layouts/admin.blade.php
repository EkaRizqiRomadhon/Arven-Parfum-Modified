<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - ARVEN PARFUME')</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --ink: #111111;
            --canvas: #ffffff;
            --surface: #f9f9f9;
            --soft-cloud: #f5f5f5;
            --charcoal: #39393b;
            --mute: #707072;
            --hairline: #cacacb;
            --hairline-soft: #e5e5e5;
            --sale: #d30005;
            --success: #007d48;
            
            --admin-sidebar-width: 240px;
            --admin-header-height: 64px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Helvetica Now Text", "Inter", sans-serif;
        }

        body {
            background-color: var(--soft-cloud);
            color: var(--ink);
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* Sidebar Styles */
        .admin-sidebar {
            width: var(--admin-sidebar-width);
            background-color: var(--canvas);
            border-right: 1px solid var(--hairline-soft);
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            display: flex;
            flex-direction: column;
            z-index: 100;
        }

        .sidebar-brand {
            height: var(--admin-header-height);
            display: flex;
            align-items: center;
            padding: 0 24px;
            font-size: 16px;
            font-weight: 700;
            color: var(--ink);
            border-bottom: 1px solid var(--hairline-soft);
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .sidebar-nav {
            padding: 24px 0;
            flex-grow: 1;
        }

        .sidebar-label {
            padding: 0 24px;
            font-size: 11px;
            font-weight: 600;
            color: var(--mute);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 12px;
            display: block;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 12px 24px;
            color: var(--charcoal);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 2px;
            border-left: 3px solid transparent;
        }

        .nav-item:hover {
            background: var(--soft-cloud);
            color: var(--ink);
        }

        .nav-item.active {
            color: var(--ink);
            border-left-color: var(--ink);
            background: var(--soft-cloud);
            font-weight: 600;
        }

        /* Main Content Styles */
        .admin-main {
            flex-grow: 1;
            margin-left: var(--admin-sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header Styles */
        .admin-header {
            height: var(--admin-header-height);
            background-color: var(--canvas);
            border-bottom: 1px solid var(--hairline-soft);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 48px;
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .header-title {
            font-family: "Helvetica Now Display Medium", "Inter", sans-serif;
            font-size: 20px;
            font-weight: 600;
            color: var(--ink);
            letter-spacing: -0.5px;
        }

        .header-user {
            display: flex;
            align-items: center;
            gap: 24px;
        }

        .user-name {
            font-size: 14px;
            font-weight: 500;
            color: var(--ink);
        }

        .logout-btn {
            background: transparent;
            border: none;
            color: var(--mute);
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            text-decoration: underline;
        }

        .logout-btn:hover {
            color: var(--ink);
        }

        /* Content Area */
        .admin-content {
            padding: 48px;
            flex-grow: 1;
            background-color: var(--soft-cloud);
            max-width: 1440px;
            width: 100%;
            margin: 0 auto;
        }

        /* Card Styles */
        .admin-card {
            background-color: var(--canvas);
            border: 1px solid var(--hairline-soft);
            padding: 32px;
            margin-bottom: 24px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--hairline);
        }

        .card-title {
            font-family: "Helvetica Now Display Medium", "Inter", sans-serif;
            font-size: 18px;
            font-weight: 600;
            color: var(--ink);
        }

        /* Utility classes for Nike style */
        .btn-primary {
            background: var(--ink);
            color: var(--canvas);
            padding: 12px 24px;
            border-radius: 30px;
            border: none;
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
            transition: opacity 0.2s;
            text-decoration: none;
            display: inline-block;
        }
        .btn-primary:hover { opacity: 0.8; }
        
        .badge {
            padding: 4px 12px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 500;
        }
        .badge-success { background: #e8f5ed; color: var(--success); }
        .badge-sale { background: #fef0f0; color: var(--sale); }
        .badge-neutral { background: var(--soft-cloud); color: var(--charcoal); }

        .sidebar-nav {
            padding: 24px 0;
            flex-grow: 1;
            overflow-y: auto;
        }

        .sidebar-section-label {
            padding: 16px 24px 6px;
            font-size: 10px;
            font-weight: 700;
            color: var(--mute);
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

    </style>

    <style>
        /* Toast notification */
        .admin-toast {
            position: fixed; bottom: 32px; right: 32px;
            background: var(--ink); color: #fff;
            padding: 14px 22px; border-radius: 8px;
            font-size: 14px; font-weight: 500;
            z-index: 9999; opacity: 0;
            transform: translateY(12px);
            transition: all 0.3s ease;
            pointer-events: none;
        }
        .admin-toast.show { opacity: 1; transform: translateY(0); }
        .admin-toast.error { background: var(--sale); }
    </style>

    <script>
    function showToast(msg, type = 'success') {
        const t = document.createElement('div');
        t.className = 'admin-toast' + (type === 'error' ? ' error' : '');
        t.textContent = msg;
        document.body.appendChild(t);
        requestAnimationFrame(() => { t.classList.add('show'); });
        setTimeout(() => { t.classList.remove('show'); setTimeout(() => t.remove(), 300); }, 3500);
    }
    </script>
</head>
<body>

    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <div class="sidebar-brand">
            MASTER PORTAL
        </div>
        <nav class="sidebar-nav">
            <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                Dashboard
            </a>
            <a href="{{ route('admin.orders.index') }}" class="nav-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                Pesanan
            </a>
            <a href="{{ route('admin.customers.index') }}" class="nav-item {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">
                Pelanggan
            </a>
            <a href="{{ route('admin.messages.index') }}" class="nav-item {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                Pesan Kontak
                @if(($adminUnreadMessagesCount ?? 0) > 0)
                    <span style="margin-left: auto; background: var(--sale); color: #fff; font-size: 11px; font-weight: 600; padding: 2px 8px; border-radius: 30px;">{{ $adminUnreadMessagesCount }}</span>
                @endif
            </a>

            <div class="sidebar-section-label">Katalog</div>
            <a href="{{ route('admin.products.index') }}" class="nav-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                Produk
            </a>
            <a href="{{ route('admin.brands.index') }}" class="nav-item {{ request()->routeIs('admin.brands.*') ? 'active' : '' }}">
                Brand
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="admin-main">
        <!-- Header -->
        <header class="admin-header">
            <div class="header-title">
                @yield('header-title', 'Dashboard')
            </div>
            <div class="header-user">
                <div class="user-name">{{ Auth::guard('admin')->user()->full_name ?? 'Admin' }}</div>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </div>
        </header>

        <!-- Dynamic Content Area -->
        <div class="admin-content">
            @yield('content')
        </div>
    </main>

</body>
</html>
