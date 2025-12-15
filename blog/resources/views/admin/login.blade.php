<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Admin Giriş | BAUM</title>
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: system-ui, -apple-system, sans-serif;
            background: linear-gradient(135deg, #1f4e79, #0f172a);
        }
        .card {
            background: #ffffff;
            border-radius: 16px;
            padding: 32px 28px;
            width: 360px;
            box-shadow: 0 20px 45px rgba(0,0,0,0.25);
        }
        h1 {
            margin: 0 0 8px;
            font-size: 22px;
            text-align: center;
        }
        p.sub {
            margin: 0 0 20px;
            text-align: center;
            font-size: 13px;
            color: #6b7280;
        }
        label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            font-size: 14px;
        }
        input {
            width: 100%;
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid #d1d5db;
            margin-bottom: 14px;
            font-size: 14px;
        }
        button {
            width: 100%;
            padding: 10px 14px;
            border-radius: 999px;
            border: none;
            background: #1f4e79;
            color: #fff;
            font-weight: 600;
            cursor: pointer;
            font-size: 14px;
        }
        .error {
            color: #b91c1c;
            font-size: 13px;
            margin-bottom: 10px;
        }
        .hint {
            margin-top: 12px;
            font-size: 12px;
            color: #9ca3af;
        }
        .hint code { background:#f3f4f6; padding:2px 4px; border-radius:4px; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Admin Giriş</h1>
        <p class="sub">BAUM blog yönetim paneline giriş yapın.</p>

        @if($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf
            <label for="email">E-posta</label>
            <input id="email" name="email" type="email" value="{{ old('email','baum@gmail.com') }}" required>

            <label for="password">Şifre</label>
            <input id="password" name="password" type="password" value="1234" required>

            <button type="submit">Giriş Yap</button>
        </form>

        <div class="hint">
            Örnek giriş: <code>baum@gmail.com</code> / <code>1234</code>
        </div>
    </div>
</body>
</html>


