<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Portal - ARVEN PARFUME</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #111111;
            --canvas: #ffffff;
            --soft-cloud: #f5f5f5;
            --charcoal: #39393b;
            --mute: #707072;
            --hairline: #cacacb;
            --sale: #d30005;
            --spacing-md: 12px;
            --spacing-lg: 18px;
            --spacing-xl: 24px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Helvetica Now Text", "Inter", sans-serif;
        }

        body {
            background-color: var(--canvas);
            color: var(--ink);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .auth-container {
            width: 100%;
            max-width: 420px;
        }

        .auth-box {
            background-color: var(--canvas);
            padding: 40px;
            border: 1px solid var(--hairline);
            border-radius: 12px;
        }

        .auth-logo {
            text-align: left;
            margin-bottom: var(--spacing-md);
        }

        .auth-logo h1 {
            color: var(--ink);
            font-family: "Helvetica Now Display Medium", "Inter", sans-serif;
            font-size: 24px;
            font-weight: 500;
            letter-spacing: -0.5px;
            text-transform: uppercase;
        }

        .auth-subtitle {
            color: var(--charcoal);
            font-size: 16px;
            margin-bottom: var(--spacing-xl);
            font-weight: 400;
        }

        .form-group {
            margin-bottom: var(--spacing-lg);
        }

        .form-group input {
            width: 100%;
            padding: 14px 16px;
            background: var(--soft-cloud);
            border: 1px solid transparent;
            border-radius: 8px; /* Rounded rectangle */
            color: var(--ink);
            font-size: 16px;
            outline: none;
            transition: all 0.2s ease;
        }

        .form-group input:focus {
            background: var(--canvas);
            border-color: var(--ink);
        }

        .form-group input::placeholder {
            color: var(--mute);
        }

        .auth-btn {
            width: 100%;
            background: var(--ink);
            color: var(--canvas);
            font-family: "Helvetica Now Text Medium", "Inter", sans-serif;
            font-size: 16px;
            font-weight: 500;
            border: none;
            border-radius: 30px; /* pill shape based on Nike design */
            padding: 16px 32px;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.1s;
            margin-top: 10px;
            text-transform: uppercase;
        }

        .auth-btn:hover {
            opacity: 0.8;
        }

        .auth-btn:active {
            transform: scale(0.98);
            opacity: 0.5;
        }

        .auth-alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 24px;
            font-size: 14px;
            background: #fef0f0;
            color: var(--sale);
            border: 1px solid #fcdcdc;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 25px;
            color: var(--mute);
            text-decoration: underline;
            font-size: 14px;
            font-weight: 500;
        }

        .back-link:hover {
            color: var(--ink);
        }
    </style>
</head>
<body>

    <div class="auth-container">
        <div class="auth-box">
            <div class="auth-logo">
                <h1>MASTER PORTAL</h1>
            </div>
            <div class="auth-subtitle">Restricted Access. Authorized Personnel Only.</div>

            @if($errors->any())
                <div class="auth-alert">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('admin.login.attempt') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" placeholder="Admin Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                </div>

                <div class="form-group">
                    <input type="password" name="password" placeholder="Admin Password" required autocomplete="current-password">
                </div>

                <button type="submit" class="auth-btn">SECURE LOGIN</button>
            </form>

            <a href="{{ route('home') }}" class="back-link">Return to Public Site</a>
        </div>
    </div>

</body>
</html>
