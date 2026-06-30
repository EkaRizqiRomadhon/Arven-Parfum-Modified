<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - ARVEN PARFUME</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --ink: #111111;
            --canvas: #ffffff;
            --soft-cloud: #f5f5f5;
            --charcoal: #39393b;
            --mute: #707072;
            --hairline: #cacacb;
            --sale: #d30005;
        }

        body {
            font-family: "Inter", "Helvetica Neue", sans-serif;
            background: var(--soft-cloud);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            -webkit-font-smoothing: antialiased;
        }

        .auth-box {
            width: 100%;
            max-width: 420px;
            background: var(--canvas);
            padding: 40px;
            border: 1px solid var(--hairline);
            border-radius: 12px;
        }

        /* ─── PERBEDAAN dari user login: badge merah di atas ─── */
        .admin-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #fff0f0;
            border: 1px solid #fcd5d5;
            border-radius: 30px;
            padding: 4px 12px;
            font-size: 11px;
            font-weight: 600;
            color: var(--sale);
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        .admin-badge::before {
            content: '';
            width: 6px;
            height: 6px;
            background: var(--sale);
            border-radius: 50%;
        }

        .auth-logo h1 {
            color: var(--ink);
            font-size: 24px;
            font-weight: 500;
            letter-spacing: -0.5px;
            margin-bottom: 6px;
        }

        .auth-subtitle {
            color: var(--mute);
            font-size: 15px;
            margin-bottom: 32px;
        }

        .auth-form-group { margin-bottom: 20px; }

        .auth-form-group input {
            width: 100%;
            padding: 14px 16px;
            background: var(--soft-cloud);
            border: 1px solid transparent;
            border-radius: 8px;
            color: var(--ink);
            font-size: 16px;
            font-family: "Inter", sans-serif;
            outline: none;
            transition: all 0.2s ease;
        }

        .auth-form-group input::placeholder { color: var(--mute); }
        .auth-form-group input:focus {
            background: var(--canvas);
            border-color: var(--ink);
        }
        .auth-form-group input.is-invalid { border-color: var(--sale); }

        .auth-input-wrapper { position: relative; }

        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--mute);
            font-size: 13px;
            font-weight: 600;
            user-select: none;
        }
        .password-toggle:hover { color: var(--ink); }

        .field-error {
            color: var(--sale);
            font-size: 12px;
            margin-top: 6px;
            display: block;
            font-weight: 500;
        }

        .auth-alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            background: #fef0f0;
            color: var(--sale);
            border: 1px solid #fcdcdc;
        }

        .auth-alert.info {
            background: #f0f7ff;
            color: #1d6fa5;
            border-color: #c8e0f4;
        }

        .auth-btn {
            width: 100%;
            background: var(--ink);
            color: #fff;
            font-size: 16px;
            font-weight: 500;
            border: none;
            border-radius: 8px;
            padding: 16px;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.1s;
            font-family: "Inter", sans-serif;
            margin-top: 8px;
        }
        .auth-btn:hover { opacity: 0.8; }
        .auth-btn:active { transform: scale(0.98); }

        .auth-footer {
            text-align: center;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid var(--hairline);
            font-size: 14px;
            color: var(--mute);
        }

        .auth-footer a {
            color: var(--ink);
            font-weight: 500;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="auth-box">

        {{-- PERBEDAAN: badge admin --}}
        <div class="admin-badge">Admin Portal</div>

        <div class="auth-logo">
            <h1>LOGIN</h1>
        </div>
        <p class="auth-subtitle">Masuk ke panel administrator.</p>

        @if($errors->any())
            <div class="auth-alert">
                @foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach
            </div>
        @endif

        @if(session('info'))
            <div class="auth-alert info">{{ session('info') }}</div>
        @endif

        <form action="{{ route('admin.login.attempt') }}" method="POST">
            @csrf

            <div class="auth-form-group">
                <input
                    type="email" name="email" id="email"
                    placeholder="Alamat Email"
                    value="{{ old('email') }}"
                    autocomplete="email" required
                    class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                >
                @error('email')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="auth-form-group">
                <div class="auth-input-wrapper">
                    <input
                        type="password" name="password" id="password"
                        placeholder="Password"
                        autocomplete="current-password" required
                        class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                    >
                    <span class="password-toggle" id="togglePassword">SHOW</span>
                </div>
                @error('password')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <button type="submit" class="auth-btn">MASUK</button>
        </form>

        <div class="auth-footer">
            <a href="{{ route('home') }}">← Kembali ke website</a>
        </div>
    </div>

    <script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const input = document.getElementById('password');
        const isPassword = input.type === 'password';
        input.type = isPassword ? 'text' : 'password';
        this.textContent = isPassword ? 'HIDE' : 'SHOW';
    });
    </script>
</body>
</html>
