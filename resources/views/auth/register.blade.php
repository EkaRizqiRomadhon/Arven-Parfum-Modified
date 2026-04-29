<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - ARVEN PARFUME</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            padding: 20px;
        }

        .register-container {
            background: rgba(40, 40, 40, 0.95);
            border-radius: 20px;
            padding: 40px 35px;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(163, 139, 93, 0.2);
        }

        .logo-title { text-align: center; margin-bottom: 10px; }
        .logo-title h1 {
            color: #c4a56a;
            font-size: 32px;
            letter-spacing: 3px;
            font-weight: 800;
            text-shadow: 0 2px 10px rgba(196, 165, 106, 0.3);
        }

        .subtitle { text-align: center; color: #aaa; font-size: 15px; margin-bottom: 35px; }

        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; color: #ddd; font-size: 14px; font-weight: 600; margin-bottom: 8px; }

        .input-wrapper { position: relative; }

        .form-group input {
            width: 100%;
            padding: 14px 16px;
            background: rgba(60, 60, 60, 0.6);
            border: 1px solid rgba(163, 139, 93, 0.3);
            border-radius: 12px;
            color: #fff;
            font-size: 15px;
            transition: all 0.3s ease;
            outline: none;
        }
        .form-group input::placeholder { color: #888; }
        .form-group input:focus {
            border-color: #c4a56a;
            background: rgba(70, 70, 70, 0.7);
            box-shadow: 0 0 0 3px rgba(196, 165, 106, 0.15);
        }
        .form-group input.is-invalid { border-color: #ff6b6b; }
        .form-group input.is-valid   { border-color: #51cf66; }

        .password-toggle {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #888;
            font-size: 18px;
            user-select: none;
            transition: color 0.3s;
        }
        .password-toggle:hover { color: #c4a56a; }

        .field-error { color: #ff6b6b; font-size: 12px; margin-top: 5px; display: block; }

        .password-strength {
            margin-top: 8px;
            height: 4px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 2px;
            overflow: hidden;
        }
        .password-strength-bar { height: 100%; width: 0; transition: all 0.3s ease; border-radius: 2px; }
        .password-strength-text { font-size: 12px; margin-top: 5px; color: #888; }

        .terms-checkbox { display: flex; align-items: flex-start; gap: 10px; margin: 25px 0; }
        .terms-checkbox input[type="checkbox"] { width: 18px; height: 18px; cursor: pointer; accent-color: #c4a56a; margin-top: 2px; }
        .terms-checkbox label { color: #ddd; font-size: 13px; line-height: 1.5; cursor: pointer; user-select: none; }
        .terms-checkbox label a { color: #c4a56a; text-decoration: none; }
        .terms-checkbox label a:hover { text-decoration: underline; }

        .register-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #c4a56a 0%, #a38b5d 100%);
            color: #1a1a1a;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(196, 165, 106, 0.3);
        }
        .register-btn:hover { transform: translateY(-2px); box-shadow: 0 12px 30px rgba(196, 165, 106, 0.4); }
        .register-btn:active { transform: translateY(0); }

        .login-link { text-align: center; margin-top: 25px; color: #aaa; font-size: 14px; }
        .login-link a { color: #c4a56a; text-decoration: none; font-weight: 600; transition: color 0.3s; }
        .login-link a:hover { color: #d4b57a; text-decoration: underline; }

        .alert-box {
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
            background: rgba(220, 53, 69, 0.2);
            border: 1px solid rgba(220, 53, 69, 0.5);
            color: #ff6b6b;
        }

        @media (max-width: 480px) {
            .register-container { padding: 30px 25px; }
            .logo-title h1 { font-size: 26px; }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="logo-title">
            <h1>ARVEN PARFUME</h1>
        </div>
        <p class="subtitle">Buat akun baru</p>

        {{-- Error validasi dari Laravel --}}
        @if($errors->any())
            <div class="alert-box">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        {{--
            Form dikirim ke route 'register.attempt' (POST /register).
            Field names yang PENTING:
              - name="name"                  → AuthController maps ke 'full_name'
              - name="password"              → password
              - name="password_confirmation" → Laravel cek ini untuk rule 'confirmed'
        --}}
        <form action="{{ route('register.attempt') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    placeholder="Masukkan nama lengkap"
                    value="{{ old('name') }}"
                    required
                    autocomplete="name"
                    class="{{ $errors->has('name') ? 'is-invalid' : '' }}"
                >
                @error('name')
                    <span class="field-error">{{ $message }}</span>
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
                    autocomplete="email"
                    class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                >
                @error('email')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrapper">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Minimal 6 karakter"
                        required
                        autocomplete="new-password"
                        class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                    >
                    <span class="password-toggle" id="togglePassword">👁️</span>
                </div>
                <div class="password-strength">
                    <div class="password-strength-bar" id="strengthBar"></div>
                </div>
                <div class="password-strength-text" id="strengthText"></div>
                @error('password')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <div class="input-wrapper">
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Ulangi password"
                        required
                        autocomplete="new-password"
                    >
                    <span class="password-toggle" id="toggleConfirm">👁️</span>
                </div>
                <div id="confirmMsg" class="field-error" style="display:none">Password tidak cocok</div>
            </div>

            <div class="terms-checkbox">
                <input type="checkbox" id="agreeTerms" name="agreeTerms" required>
                <label for="agreeTerms">
                    Saya setuju dengan <a href="#" id="termsLink">syarat &amp; ketentuan</a> yang berlaku
                </label>
            </div>

            <button type="submit" class="register-btn" id="registerBtn">DAFTAR SEKARANG</button>
        </form>

        <div class="login-link">
            Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
        </div>
    </div>

    <script>
        // ── Toggle password visibility ─────────────────────────────────────
        document.getElementById('togglePassword').addEventListener('click', function () {
            const input = document.getElementById('password');
            const isPass = input.type === 'password';
            input.type = isPass ? 'text' : 'password';
            this.textContent = isPass ? '🙈' : '👁️';
        });
        document.getElementById('toggleConfirm').addEventListener('click', function () {
            const input = document.getElementById('password_confirmation');
            const isPass = input.type === 'password';
            input.type = isPass ? 'text' : 'password';
            this.textContent = isPass ? '🙈' : '👁️';
        });

        // ── Password strength indicator ────────────────────────────────────
        document.getElementById('password').addEventListener('input', function () {
            const val = this.value;
            let strength = 0;
            if (val.length >= 6)  strength++;
            if (val.length >= 10) strength++;
            if (/[a-z]/.test(val) && /[A-Z]/.test(val)) strength++;
            if (/\d/.test(val)) strength++;
            if (/[^a-zA-Z\d]/.test(val)) strength++;

            const colors = ['#ff6b6b','#ff922b','#ffd43b','#51cf66','#37b24d'];
            const texts  = ['Sangat Lemah','Lemah','Cukup','Kuat','Sangat Kuat'];
            const bar  = document.getElementById('strengthBar');
            const text = document.getElementById('strengthText');

            if (val.length > 0) {
                bar.style.width      = ((strength + 1) * 20) + '%';
                bar.style.background = colors[strength] || colors[4];
                text.textContent     = texts[strength]  || texts[4];
                text.style.color     = colors[strength] || colors[4];
            } else {
                bar.style.width  = '0';
                text.textContent = '';
            }
        });

        // ── Konfirmasi password real-time ──────────────────────────────────
        document.getElementById('password_confirmation').addEventListener('input', function () {
            const match = this.value === document.getElementById('password').value;
            document.getElementById('confirmMsg').style.display = (!match && this.value) ? 'block' : 'none';
            this.classList.toggle('is-invalid', !match && !!this.value);
            this.classList.toggle('is-valid',    match && !!this.value);
        });

        // ── Terms link ────────────────────────────────────────────────────
        document.getElementById('termsLink').addEventListener('click', function (e) {
            e.preventDefault();
            alert('Syarat & Ketentuan:\n\n1. Pengguna harus berusia 17+ tahun\n2. Data yang diberikan harus valid\n3. Password harus dijaga kerahasiaannya\n4. Bertanggung jawab atas akun Anda');
        });
    </script>
</body>
</html>