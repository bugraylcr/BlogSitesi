<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İletişim | BAUM Blog</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --brand: #1e40af;
            --brand-light: #3b82f6;
            --brand-dark: #1e3a8a;
            --text: #0f172a;
            --text-secondary: #475569;
            --muted: #64748b;
            --bg: #f8fafc;
            --bg-secondary: #f1f5f9;
            --card: #ffffff;
            --border: #e2e8f0;
            --success: #22c55e;
            --success-bg: #f0fdf4;
            --shadow-sm: 0 1px 2px rgba(0,0,0,0.04);
            --shadow: 0 4px 6px -1px rgba(0,0,0,0.07), 0 2px 4px -2px rgba(0,0,0,0.07);
            --shadow-md: 0 10px 15px -3px rgba(0,0,0,0.08), 0 4px 6px -4px rgba(0,0,0,0.08);
            --shadow-lg: 0 20px 25px -5px rgba(0,0,0,0.08), 0 8px 10px -6px rgba(0,0,0,0.08);
            --shadow-xl: 0 25px 50px -12px rgba(0,0,0,0.15);
            --radius-sm: 8px;
            --radius: 12px;
            --radius-lg: 16px;
            --radius-xl: 20px;
            --radius-2xl: 24px;
            --transition-fast: 150ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition: 200ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-slow: 300ms cubic-bezier(0.4, 0, 0.2, 1);
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.6;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        a { color: inherit; text-decoration: none; }

        /* Header */
        header {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid rgba(226,232,240,0.8);
        }
        .nav {
            max-width: 1280px;
            margin: 0 auto;
            padding: 16px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            font-size: 24px;
            font-weight: 800;
            color: var(--brand);
            letter-spacing: -0.5px;
            transition: transform var(--transition);
        }
        .brand:hover { transform: scale(1.02); }
        .brand img {
            width: 44px;
            height: 44px;
            border-radius: var(--radius);
            object-fit: cover;
            box-shadow: var(--shadow);
        }
        .menu {
            display: flex;
            gap: 8px;
            align-items: center;
        }
        .menu a {
            font-weight: 500;
            font-size: 15px;
            color: var(--text-secondary);
            padding: 10px 16px;
            border-radius: var(--radius);
            transition: all var(--transition);
        }
        .menu a:hover {
            color: var(--brand);
            background: rgba(30,64,175,0.06);
        }
        .menu a.active {
            color: var(--brand);
            background: rgba(30,64,175,0.08);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, rgba(15,23,42,0.95) 0%, rgba(30,58,138,0.9) 100%);
            padding: 64px 32px;
            text-align: center;
            color: #fff;
            position: relative;
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('https://images.unsplash.com/photo-1423666639041-f56000c27a9a?auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
            opacity: 0.1;
            z-index: 0;
        }
        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 600px;
            margin: 0 auto;
        }
        .hero .breadcrumb {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 14px;
            color: rgba(255,255,255,0.7);
            margin-bottom: 24px;
        }
        .hero .breadcrumb a {
            color: rgba(255,255,255,0.7);
            transition: color var(--transition);
        }
        .hero .breadcrumb a:hover { color: #fff; }
        .hero .breadcrumb svg {
            width: 16px;
            height: 16px;
            opacity: 0.5;
        }
        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(36px, 5vw, 52px);
            font-weight: 700;
            margin-bottom: 16px;
            letter-spacing: -0.5px;
        }
        .hero p {
            font-size: 17px;
            color: rgba(255,255,255,0.8);
            line-height: 1.7;
        }

        /* Main Content */
        .main {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 32px;
        }
        .content-grid {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 32px;
            margin-top: -48px;
            position: relative;
            z-index: 2;
        }

        /* Contact Card */
        .contact-card {
            background: var(--card);
            border-radius: var(--radius-2xl);
            box-shadow: var(--shadow-lg);
            padding: 48px;
            border: 1px solid var(--border);
        }
        .contact-card h2 {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }
        .contact-card .subtitle {
            color: var(--muted);
            font-size: 15px;
            margin-bottom: 32px;
        }

        /* Success Message */
        .success-message {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 16px;
            background: var(--success-bg);
            border-radius: var(--radius);
            margin-bottom: 24px;
            border: 1px solid rgba(34,197,94,0.2);
        }
        .success-message svg {
            width: 24px;
            height: 24px;
            color: var(--success);
            flex-shrink: 0;
        }
        .success-message p {
            font-size: 14px;
            color: #166534;
            font-weight: 500;
        }

        /* Form */
        .form-group {
            margin-bottom: 24px;
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        label {
            display: block;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 8px;
            color: var(--text);
        }
        label .hint {
            font-weight: 400;
            color: var(--muted);
        }
        label .required {
            color: #ef4444;
        }
        input, textarea {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid var(--border);
            border-radius: var(--radius);
            font-family: 'Inter', sans-serif;
            font-size: 15px;
            color: var(--text);
            background: var(--card);
            transition: all var(--transition);
        }
        input:focus, textarea:focus {
            outline: none;
            border-color: var(--brand-light);
            box-shadow: 0 0 0 4px rgba(59,130,246,0.1);
        }
        input::placeholder, textarea::placeholder {
            color: var(--muted);
        }
        textarea {
            min-height: 160px;
            resize: vertical;
        }
        .submit-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 16px 28px;
            background: linear-gradient(135deg, var(--brand) 0%, var(--brand-light) 100%);
            color: #fff;
            font-family: 'Inter', sans-serif;
            font-size: 15px;
            font-weight: 600;
            border: none;
            border-radius: var(--radius);
            cursor: pointer;
            transition: all var(--transition);
            box-shadow: 0 4px 14px rgba(30,64,175,0.3);
        }
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(30,64,175,0.4);
        }
        .submit-btn:active {
            transform: translateY(0);
        }
        .submit-btn svg {
            width: 18px;
            height: 18px;
        }

        /* Info Card */
        .info-card {
            background: var(--card);
            border-radius: var(--radius-2xl);
            box-shadow: var(--shadow-lg);
            padding: 40px;
            border: 1px solid var(--border);
            height: fit-content;
        }
        .info-card h3 {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 24px;
        }
        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            padding: 20px 0;
            border-bottom: 1px solid var(--border);
        }
        .info-item:last-of-type {
            border-bottom: none;
        }
        .info-icon {
            width: 48px;
            height: 48px;
            border-radius: var(--radius);
            background: linear-gradient(135deg, rgba(30,64,175,0.1) 0%, rgba(59,130,246,0.1) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .info-icon svg {
            width: 22px;
            height: 22px;
            color: var(--brand);
        }
        .info-content h4 {
            font-weight: 600;
            font-size: 15px;
            margin-bottom: 4px;
        }
        .info-content p {
            color: var(--muted);
            font-size: 14px;
        }
        .info-content a {
            color: var(--brand);
            transition: color var(--transition);
        }
        .info-content a:hover {
            color: var(--brand-dark);
        }

        /* Social Section */
        .social-section {
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid var(--border);
        }
        .social-section h4 {
            font-weight: 600;
            font-size: 15px;
            margin-bottom: 16px;
            color: var(--text);
        }
        .social-links {
            display: flex;
            gap: 12px;
        }
        .social-links a {
            width: 46px;
            height: 46px;
            border-radius: var(--radius);
            background: var(--bg-secondary);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all var(--transition);
        }
        .social-links a:hover {
            background: var(--brand);
            transform: translateY(-3px);
            box-shadow: 0 8px 16px rgba(30,64,175,0.3);
        }
        .social-links a svg {
            width: 20px;
            height: 20px;
            fill: var(--text-secondary);
            transition: fill var(--transition);
        }
        .social-links a:hover svg {
            fill: #fff;
        }

        /* Footer */
        .footer {
            background: linear-gradient(180deg, #0f172a 0%, #020617 100%);
            color: rgba(255,255,255,0.8);
            padding: 48px 32px;
            margin-top: 80px;
            text-align: center;
        }
        .footer-brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            font-size: 24px;
            font-weight: 800;
            color: #fff;
            margin-bottom: 12px;
        }
        .footer-brand img {
            width: 40px;
            height: 40px;
            border-radius: var(--radius);
        }
        .footer p {
            color: rgba(255,255,255,0.5);
            font-size: 14px;
        }
        .footer a {
            color: rgba(255,255,255,0.7);
            transition: color var(--transition);
        }
        .footer a:hover {
            color: #fff;
        }

        /* Responsive */
        @media (max-width: 968px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
            .info-card {
                order: -1;
            }
        }
        @media (max-width: 768px) {
            .nav {
                padding: 12px 20px;
            }
            .menu {
                display: none;
            }
            .hero {
                padding: 48px 20px;
            }
            .hero h1 {
                font-size: 32px;
            }
            .main {
                padding: 0 16px;
            }
            .content-grid {
                margin-top: -32px;
            }
            .contact-card {
                padding: 28px 20px;
            }
            .info-card {
                padding: 28px 20px;
            }
            .form-row {
                grid-template-columns: 1fr;
            }
            .footer {
                padding: 32px 20px;
                margin-top: 48px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="nav">
            <a href="/" class="brand">
                <img src="https://birimler.atauni.edu.tr/atabaum/wp-content/uploads/sites/17/2021/07/logo3.png" alt="BAUM">
                <span>BAUM</span>
            </a>
            <nav class="menu">
                <a href="/">Ana Sayfa</a>
                <a href="/bilgilendirme-sayfa.html">Hakkımda</a>
                <a href="/iletisim" class="active">İletişim</a>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="hero-content">
            <nav class="breadcrumb">
                <a href="/">Ana Sayfa</a>
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>İletişim</span>
            </nav>
            <h1>İletişime Geçin</h1>
            <p>Sorularınız, önerileriniz veya işbirliği teklifleriniz için bize ulaşabilirsiniz.</p>
        </div>
    </section>

    <main class="main">
        <div class="content-grid">
            <div class="contact-card">
                <h2>Mesaj Gönderin</h2>
                <p class="subtitle">Formu doldurarak bize ulaşabilirsiniz. En kısa sürede dönüş yapacağız.</p>

                @if(session('status'))
                    <div class="success-message">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p>{{ session('status') }}</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.store') }}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Adınız <span class="required">*</span></label>
                            <input id="name" name="name" type="text" placeholder="Adınızı girin" value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">E-posta <span class="required">*</span></label>
                            <input id="email" name="email" type="email" placeholder="ornek@email.com" value="{{ old('email') }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="subject">Konu <span class="hint">(isteğe bağlı)</span></label>
                        <input id="subject" name="subject" type="text" placeholder="Mesajınızın konusu" value="{{ old('subject') }}">
                    </div>

                    <div class="form-group">
                        <label for="message">Mesajınız</label>
                        <textarea id="message" name="message" placeholder="Mesajınızı buraya yazın...">{{ old('message') }}</textarea>
                    </div>

                    <button type="submit" class="submit-btn">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                        Mesajı Gönder
                    </button>
                </form>
            </div>

            <div class="info-card">
                <h3>İletişim Bilgileri</h3>

                <div class="info-item">
                    <div class="info-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="info-content">
                        <h4>E-posta</h4>
                        <p><a href="mailto:info@baum.edu.tr">info@baum.edu.tr</a></p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div class="info-content">
                        <h4>Adres</h4>
                        <p>Atatürk Üniversitesi<br>Erzurum, Türkiye</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="info-content">
                        <h4>Çalışma Saatleri</h4>
                        <p>Pazartesi - Cuma<br>09:00 - 18:00</p>
                    </div>
                </div>

                <div class="social-section">
                    <h4>Bizi Takip Edin</h4>
                    <div class="social-links">
                        <a href="https://facebook.com/atabaum" aria-label="Facebook">
                            <svg viewBox="0 0 320 512"><path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06H296V6.26S259.5 0 225.36 0C141.09 0 89.09 54.42 89.09 153.12v74.22H0v92.66h89.09V512h107.78V288z"/></svg>
                        </a>
                        <a href="https://instagram.com/atabaum" aria-label="Instagram">
                            <svg viewBox="0 0 448 512"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9 114.9-51.3 114.9-114.9S287.7 141 224.1 141zm0 189.6c-41.2 0-74.7-33.4-74.7-74.7s33.4-74.7 74.7-74.7 74.7 33.4 74.7 74.7-33.5 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-.5-35.3-9.8-66.7-35.6-92.6C385.9 45.8 354.5 36.5 319.2 36c-35.4-.5-141.7-.5-177.1 0-35.3.5-66.7 9.8-92.6 35.6C23.7 97.4 14.4 128.8 13.9 164.1c-.5 35.4-.5 141.7 0 177.1.5 35.3 9.8 66.7 35.6 92.6 25.9 25.9 57.3 35.1 92.6 35.6 35.4.5 141.7.5 177.1 0 35.3-.5 66.7-9.8 92.6-35.6 25.9-25.9 35.1-57.3 35.6-92.6.5-35.4.5-141.7 0-177.1zM398.8 388c-7.8 19.5-22.9 34.6-42.4 42.4-29.4 11.7-99.2 9-132.4 9s-103 2.6-132.4-9c-19.5-7.8-34.6-22.9-42.4-42.4-11.7-29.4-9-99.2-9-132.4s-2.6-103 9-132.4c7.8-19.5 22.9-34.6 42.4-42.4 29.4-11.7 99.2-9 132.4-9s103-2.6 132.4 9c19.5 7.8 34.6 22.9 42.4 42.4 11.7 29.4 9 99.2 9 132.4s2.7 103-9 132.4z"/></svg>
                        </a>
                        <a href="https://www.youtube.com/" aria-label="YouTube">
                            <svg viewBox="0 0 576 512"><path d="M549.65 124.08a68.78 68.78 0 0 0-48.46-48.53C458.8 64 288 64 288 64s-170.8 0-213.19 11.55a68.78 68.78 0 0 0-48.46 48.53C16 166.53 16 256 16 256s0 89.47 10.35 131.92a68.78 68.78 0 0 0 48.46 48.53C117.2 448 288 448 288 448s170.8 0 213.19-11.55a68.78 68.78 0 0 0 48.46-48.53C560 345.47 560 256 560 256s0-89.47-10.35-131.92ZM232 336V176l142 80Z"/></svg>
                        </a>
                        <a href="https://www.linkedin.com/in/atabaum" aria-label="LinkedIn">
                            <svg viewBox="0 0 448 512"><path d="M100.28 448H7.4V148.9h92.88zm-46.44-341C24.3 107 0 82.7 0 53.64a53.64 53.64 0 0 1 107.28 0C107.28 82.7 83 107 53.84 107zM447.9 448h-92.4V302.4c0-34.7-.7-79.3-48.3-79.3-48.3 0-55.7 37.7-55.7 76.7V448h-92.4V148.9h88.7v40.8h1.3c12.4-23.5 42.7-48.3 87.9-48.3 94 0 111.3 61.9 111.3 142.3z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer">
        <div class="footer-brand">
            <img src="https://birimler.atauni.edu.tr/atabaum/wp-content/uploads/sites/17/2021/07/logo3.png" alt="BAUM">
            <span>BAUM</span>
        </div>
        <p>&copy; {{ date('Y') }} BAUM Blog. Tüm hakları saklıdır. | <a href="/">Ana Sayfa</a></p>
    </footer>
</body>
</html>
