<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Paneli | BAUM</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
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
            --warning: #f59e0b;
            --shadow-sm: 0 1px 2px rgba(0,0,0,0.04);
            --shadow: 0 4px 6px -1px rgba(0,0,0,0.07), 0 2px 4px -2px rgba(0,0,0,0.07);
            --shadow-md: 0 10px 15px -3px rgba(0,0,0,0.08), 0 4px 6px -4px rgba(0,0,0,0.08);
            --shadow-lg: 0 20px 25px -5px rgba(0,0,0,0.08), 0 8px 10px -6px rgba(0,0,0,0.08);
            --radius-sm: 8px;
            --radius: 12px;
            --radius-lg: 16px;
            --radius-xl: 20px;
            --radius-2xl: 24px;
            --transition: 200ms cubic-bezier(0.4, 0, 0.2, 1);
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.6;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        /* Sidebar */
        .layout {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
            padding: 24px;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 50;
        }
        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding-bottom: 24px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 24px;
        }
        .sidebar-brand img {
            width: 44px;
            height: 44px;
            border-radius: var(--radius);
        }
        .sidebar-brand-text {
            display: flex;
            flex-direction: column;
        }
        .sidebar-brand-text span {
            font-size: 20px;
            font-weight: 800;
            color: #fff;
        }
        .sidebar-brand-text small {
            font-size: 12px;
            color: rgba(255,255,255,0.5);
        }
        .sidebar-nav {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 16px;
            border-radius: var(--radius);
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: all var(--transition);
        }
        .nav-link:hover {
            background: rgba(255,255,255,0.08);
            color: #fff;
        }
        .nav-link.active {
            background: linear-gradient(135deg, var(--brand) 0%, var(--brand-light) 100%);
            color: #fff;
            box-shadow: 0 4px 12px rgba(30,64,175,0.4);
        }
        .nav-link svg {
            width: 20px;
            height: 20px;
        }
        .nav-link .badge {
            margin-left: auto;
            padding: 4px 10px;
            background: rgba(255,255,255,0.15);
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
        }
        .nav-link.active .badge {
            background: rgba(255,255,255,0.25);
        }
        .sidebar-footer {
            padding-top: 24px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }
        .logout-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            padding: 14px 16px;
            border-radius: var(--radius);
            background: rgba(239,68,68,0.1);
            border: none;
            color: #fca5a5;
            font-family: 'Inter', sans-serif;
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
            transition: all var(--transition);
        }
        .logout-btn:hover {
            background: rgba(239,68,68,0.2);
            color: #fff;
        }
        .logout-btn svg {
            width: 20px;
            height: 20px;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 32px;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 32px;
        }
        .header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            font-weight: 700;
            color: var(--text);
        }
        .header-actions {
            display: flex;
            gap: 12px;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            border-radius: var(--radius);
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            transition: all var(--transition);
            border: none;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--brand) 0%, var(--brand-light) 100%);
            color: #fff;
            box-shadow: 0 4px 12px rgba(30,64,175,0.3);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(30,64,175,0.4);
        }
        .btn-secondary {
            background: var(--card);
            color: var(--text);
            border: 1px solid var(--border);
        }
        .btn-secondary:hover {
            background: var(--bg);
            border-color: var(--brand-light);
        }
        .btn svg {
            width: 18px;
            height: 18px;
        }

        /* Welcome Card */
        .welcome-card {
            background: linear-gradient(135deg, var(--brand-dark) 0%, var(--brand) 50%, var(--brand-light) 100%);
            border-radius: var(--radius-2xl);
            padding: 40px;
            color: #fff;
            margin-bottom: 32px;
            position: relative;
            overflow: hidden;
        }
        .welcome-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            border-radius: 50%;
        }
        .welcome-card h2 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            position: relative;
        }
        .welcome-card p {
            font-size: 16px;
            opacity: 0.9;
            position: relative;
            max-width: 500px;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }
        .stat-card {
            background: var(--card);
            border-radius: var(--radius-xl);
            padding: 28px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
            transition: all var(--transition);
        }
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }
        .stat-card-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 16px;
        }
        .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: var(--radius);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .stat-icon svg {
            width: 26px;
            height: 26px;
        }
        .stat-icon.blue {
            background: linear-gradient(135deg, rgba(30,64,175,0.1) 0%, rgba(59,130,246,0.1) 100%);
            color: var(--brand);
        }
        .stat-icon.green {
            background: linear-gradient(135deg, rgba(34,197,94,0.1) 0%, rgba(74,222,128,0.1) 100%);
            color: var(--success);
        }
        .stat-icon.amber {
            background: linear-gradient(135deg, rgba(245,158,11,0.1) 0%, rgba(251,191,36,0.1) 100%);
            color: var(--warning);
        }
        .stat-icon.purple {
            background: linear-gradient(135deg, rgba(139,92,246,0.1) 0%, rgba(167,139,250,0.1) 100%);
            color: #8b5cf6;
        }
        .stat-value {
            font-size: 36px;
            font-weight: 800;
            color: var(--text);
            line-height: 1;
            margin-bottom: 4px;
        }
        .stat-label {
            font-size: 14px;
            color: var(--muted);
            font-weight: 500;
        }
        .stat-link {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            margin-top: 16px;
            font-size: 13px;
            font-weight: 600;
            color: var(--brand);
            text-decoration: none;
            transition: all var(--transition);
        }
        .stat-link:hover {
            gap: 8px;
        }
        .stat-link svg {
            width: 16px;
            height: 16px;
        }

        /* Quick Actions */
        .quick-actions {
            background: var(--card);
            border-radius: var(--radius-xl);
            padding: 28px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
        }
        .quick-actions h3 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--text);
        }
        .action-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
        }
        .action-card {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 20px;
            background: var(--bg);
            border-radius: var(--radius);
            text-decoration: none;
            transition: all var(--transition);
            border: 1px solid transparent;
        }
        .action-card:hover {
            background: var(--card);
            border-color: var(--brand-light);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }
        .action-card .icon {
            width: 48px;
            height: 48px;
            border-radius: var(--radius);
            background: linear-gradient(135deg, var(--brand) 0%, var(--brand-light) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }
        .action-card .icon svg {
            width: 24px;
            height: 24px;
        }
        .action-card .text h4 {
            font-size: 15px;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 2px;
        }
        .action-card .text p {
            font-size: 13px;
            color: var(--muted);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .sidebar {
                width: 80px;
                padding: 16px;
            }
            .sidebar-brand-text,
            .nav-link span,
            .nav-link .badge,
            .logout-btn span {
                display: none;
            }
            .sidebar-brand {
                justify-content: center;
            }
            .nav-link {
                justify-content: center;
                padding: 14px;
            }
            .logout-btn {
                justify-content: center;
            }
            .main-content {
                margin-left: 80px;
            }
        }
        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }
            .main-content {
                margin-left: 0;
                padding: 20px;
            }
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }
            .welcome-card {
                padding: 28px;
            }
            .welcome-card h2 {
                font-size: 22px;
            }
        }
    </style>
</head>
<body>
    <div class="layout">
        <aside class="sidebar">
            <div class="sidebar-brand">
                <img src="https://birimler.atauni.edu.tr/atabaum/wp-content/uploads/sites/17/2021/07/logo3.png" alt="BAUM">
                <div class="sidebar-brand-text">
                    <span>BAUM</span>
                    <small>Admin Panel</small>
                </div>
            </div>

            <nav class="sidebar-nav">
                <a href="{{ route('admin.dashboard') }}" class="nav-link active">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.stories.index') }}" class="nav-link">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                    <span>Hikayeler</span>
                </a>
                <a href="{{ route('admin.comments.index') }}" class="nav-link">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    <span>Yorumlar</span>
                </a>
                <a href="{{ route('admin.contacts.index') }}" class="nav-link">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span>Mesajlar</span>
                </a>
                <a href="{{ route('home') }}" class="nav-link">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    <span>Siteyi Görüntüle</span>
                </a>
            </nav>

            <div class="sidebar-footer">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span>Çıkış Yap</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="main-content">
            <div class="header">
                <h1>Dashboard</h1>
                <div class="header-actions">
                    <a href="{{ route('admin.stories.create') }}" class="btn btn-primary">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Yeni Hikaye
                    </a>
                </div>
            </div>

            <div class="welcome-card">
                <h2>Hoş Geldiniz, Admin!</h2>
                <p>BAUM Blog yönetim paneline hoş geldiniz. Buradan hikayeleri yönetebilir, yorumları onaylayabilir ve iletişim mesajlarını görüntüleyebilirsiniz.</p>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-card-header">
                        <div class="stat-icon blue">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="stat-value">{{ \App\Models\Story::count() }}</div>
                    <div class="stat-label">Toplam Hikaye</div>
                    <a href="{{ route('admin.stories.index') }}" class="stat-link">
                        Hikayeleri Görüntüle
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>

                <div class="stat-card">
                    <div class="stat-card-header">
                        <div class="stat-icon amber">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="stat-value">{{ \App\Models\Comment::where('approved', false)->count() }}</div>
                    <div class="stat-label">Bekleyen Yorum</div>
                    <a href="{{ route('admin.comments.index') }}" class="stat-link">
                        Yorumları Onayla
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>

                <div class="stat-card">
                    <div class="stat-card-header">
                        <div class="stat-icon green">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="stat-value">{{ \App\Models\Comment::where('approved', true)->count() }}</div>
                    <div class="stat-label">Onaylı Yorum</div>
                    <a href="{{ route('admin.comments.index') }}" class="stat-link">
                        Tümünü Görüntüle
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>

                <div class="stat-card">
                    <div class="stat-card-header">
                        <div class="stat-icon purple">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="stat-value">{{ \App\Models\ContactMessage::count() }}</div>
                    <div class="stat-label">İletişim Mesajı</div>
                    <a href="{{ route('admin.contacts.index') }}" class="stat-link">
                        Mesajları Görüntüle
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="quick-actions">
                <h3>Hızlı İşlemler</h3>
                <div class="action-grid">
                    <a href="{{ route('admin.stories.create') }}" class="action-card">
                        <div class="icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </div>
                        <div class="text">
                            <h4>Yeni Hikaye Ekle</h4>
                            <p>Blog için yeni hikaye oluştur</p>
                        </div>
                    </a>
                    <a href="{{ route('admin.comments.index') }}" class="action-card">
                        <div class="icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="text">
                            <h4>Yorumları Onayla</h4>
                            <p>Bekleyen yorumları incele</p>
                        </div>
                    </a>
                    <a href="{{ route('admin.contacts.index') }}" class="action-card">
                        <div class="icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                        </div>
                        <div class="text">
                            <h4>Mesajları Görüntüle</h4>
                            <p>İletişim formundan gelen mesajlar</p>
                        </div>
                    </a>
                    <a href="{{ route('home') }}" class="action-card">
                        <div class="icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </div>
                        <div class="text">
                            <h4>Siteyi Önizle</h4>
                            <p>Blog sitesini görüntüle</p>
                        </div>
                    </a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
