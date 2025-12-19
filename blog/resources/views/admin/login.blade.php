<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Giriş | BAUM</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --brand: #1e40af;
            --brand-light: #3b82f6;
            --brand-dark: #1e3a8a;
            --text: #0f172a;
            --text-secondary: #475569;
            --muted: #64748b;
            --bg: #f8fafc;
            --card: #ffffff;
            --border: #e2e8f0;
            --error: #ef4444;
            --error-bg: #fef2f2;
            --radius: 12px;
            --radius-lg: 16px;
            --radius-xl: 20px;
            --transition: 200ms cubic-bezier(0.4, 0, 0.2, 1);
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 50%, #1e40af 100%);
            padding: 24px;
            position: relative;
            overflow: hidden;
        }
        body::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at 30% 30%, rgba(59,130,246,0.15) 0%, transparent 50%),
                        radial-gradient(circle at 70% 70%, rgba(30,64,175,0.2) 0%, transparent 50%);
            animation: pulse 15s ease-in-out infinite;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        .login-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 420px;
        }
        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 32px;
        }
        .logo img {
            width: 48px;
            height: 48px;
            border-radius: var(--radius);
            box-shadow: 0 8px 24px rgba(0,0,0,0.3);
        }
        .logo span {
            font-size: 28px;
            font-weight: 800;
            color: #fff;
            letter-spacing: -0.5px;
        }
        .card {
            background: var(--card);
            border-radius: var(--radius-xl);
            padding: 40px 36px;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.4);
        }
        .card-header {
            text-align: center;
            margin-bottom: 32px;
        }
        .card-header h1 {
            font-size: 26px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 8px;
        }
        .card-header p {
            font-size: 14px;
            color: var(--muted);
        }
        .error-message {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 14px 16px;
            background: var(--error-bg);
            border-radius: var(--radius);
            margin-bottom: 24px;
            border: 1px solid rgba(239,68,68,0.2);
        }
        .error-message svg {
            width: 20px;
            height: 20px;
            color: var(--error);
            flex-shrink: 0;
        }
        .error-message span {
            font-size: 14px;
            color: #991b1b;
            font-weight: 500;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 8px;
            color: var(--text);
        }
        input {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid var(--border);
            border-radius: var(--radius);
            font-family: 'Inter', sans-serif;
            font-size: 15px;
            color: var(--text);
            background: var(--card);
            transition: all var(--transition);
        }
        input:focus {
            outline: none;
            border-color: var(--brand-light);
            box-shadow: 0 0 0 4px rgba(59,130,246,0.1);
        }
        input::placeholder {
            color: var(--muted);
        }
        .submit-btn {
            width: 100%;
            padding: 16px 24px;
            background: linear-gradient(135deg, var(--brand) 0%, var(--brand-light) 100%);
            color: #fff;
            font-family: 'Inter', sans-serif;
            font-size: 15px;
            font-weight: 600;
            border: none;
            border-radius: var(--radius);
            cursor: pointer;
            transition: all var(--transition);
            box-shadow: 0 4px 14px rgba(30,64,175,0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(30,64,175,0.5);
        }
        .submit-btn:active {
            transform: translateY(0);
        }
        .submit-btn svg {
            width: 18px;
            height: 18px;
        }
        .hint {
            margin-top: 24px;
            padding: 16px;
            background: var(--bg);
            border-radius: var(--radius);
            text-align: center;
        }
        .hint p {
            font-size: 13px;
            color: var(--muted);
            margin-bottom: 8px;
        }
        .hint code {
            display: inline-block;
            padding: 4px 8px;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 6px;
            font-family: 'SF Mono', 'Consolas', monospace;
            font-size: 12px;
            color: var(--brand);
        }
        .back-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-top: 24px;
            font-size: 14px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: color var(--transition);
        }
        .back-link:hover {
            color: #fff;
        }
        .back-link svg {
            width: 16px;
            height: 16px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <img src="https://birimler.atauni.edu.tr/atabaum/wp-content/uploads/sites/17/2021/07/logo3.png" alt="BAUM">
            <span>BAUM</span>
        </div>

        <div class="card">
            <div class="card-header">
                <h1>Admin Giriş</h1>
                <p>Yönetim paneline erişmek için giriş yapın</p>
            </div>

            @if($errors->any())
                <div class="error-message">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.post') }}">
                @csrf
                <div class="form-group">
                    <label for="email">E-posta Adresi</label>
                    <input id="email" name="email" type="email" placeholder="admin@example.com" value="{{ old('email','baum@gmail.com') }}" required>
                </div>

                <div class="form-group">
                    <label for="password">Şifre</label>
                    <input id="password" name="password" type="password" placeholder="Şifrenizi girin" value="1234" required>
                </div>

                <button type="submit" class="submit-btn">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    Giriş Yap
                </button>
            </form>

            <div class="hint">
                <p>Demo giriş bilgileri:</p>
                <code>baum@gmail.com</code> / <code>1234</code>
            </div>
        </div>

        <a href="/" class="back-link">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Ana Sayfaya Dön
        </a>
    </div>
</body>
</html>
