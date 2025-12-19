<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $story->title }} | BAUM Blog</title>
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
            line-height: 1.7;
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
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background: var(--bg-secondary);
            border-radius: var(--radius);
            font-weight: 500;
            font-size: 14px;
            color: var(--text-secondary);
            transition: all var(--transition);
        }
        .back-link:hover {
            background: var(--border);
            color: var(--text);
        }
        .back-link svg {
            width: 18px;
            height: 18px;
            transition: transform var(--transition);
        }
        .back-link:hover svg {
            transform: translateX(-4px);
        }

        /* Hero Header */
        .story-hero {
            background: linear-gradient(135deg, rgba(15,23,42,0.95) 0%, rgba(30,58,138,0.9) 100%);
            padding: 64px 32px;
            text-align: center;
            color: #fff;
            position: relative;
            overflow: hidden;
        }
        .story-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('{{ $story->cover_image_url ?? "https://images.unsplash.com/photo-1441974231531-c6227db76b6e?auto=format&fit=crop&w=1920&q=80" }}') center/cover no-repeat;
            opacity: 0.15;
            z-index: 0;
        }
        .story-hero-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            margin: 0 auto;
        }
        .story-hero .breadcrumb {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 14px;
            color: rgba(255,255,255,0.7);
            margin-bottom: 24px;
        }
        .story-hero .breadcrumb a {
            color: rgba(255,255,255,0.7);
            transition: color var(--transition);
        }
        .story-hero .breadcrumb a:hover {
            color: #fff;
        }
        .story-hero .breadcrumb svg {
            width: 16px;
            height: 16px;
            opacity: 0.5;
        }
        .story-category-badge {
            display: inline-block;
            padding: 6px 14px;
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(10px);
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 16px;
            border: 1px solid rgba(255,255,255,0.2);
        }
        .story-hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(32px, 5vw, 48px);
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 16px;
            letter-spacing: -0.5px;
        }
        .story-hero-meta {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            color: rgba(255,255,255,0.8);
            font-size: 14px;
        }
        .story-hero-meta span {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .story-hero-meta svg {
            width: 16px;
            height: 16px;
            opacity: 0.7;
        }

        /* Main Content */
        .page {
            max-width: 900px;
            margin: -40px auto 0;
            padding: 0 24px 80px;
            position: relative;
            z-index: 2;
        }

        /* Story Card */
        .story-card {
            background: var(--card);
            border-radius: var(--radius-2xl);
            box-shadow: var(--shadow-lg);
            padding: 48px;
            margin-bottom: 32px;
            border: 1px solid var(--border);
        }
        .story-content {
            font-size: 17px;
            line-height: 1.85;
            color: var(--text-secondary);
        }
        .story-content p {
            margin-bottom: 20px;
        }
        .story-content p:last-child {
            margin-bottom: 0;
        }

        /* Comments Section */
        .comments-section {
            background: var(--card);
            border-radius: var(--radius-2xl);
            box-shadow: var(--shadow);
            padding: 40px;
            border: 1px solid var(--border);
        }
        .comments-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 32px;
            padding-bottom: 24px;
            border-bottom: 1px solid var(--border);
        }
        .comments-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .comments-count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 32px;
            height: 32px;
            padding: 0 10px;
            background: linear-gradient(135deg, var(--brand) 0%, var(--brand-light) 100%);
            color: #fff;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            font-weight: 700;
            border-radius: 999px;
        }

        /* Comment Item */
        .comment-list {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }
        .comment-item {
            display: flex;
            gap: 16px;
            padding: 24px;
            background: var(--bg);
            border-radius: var(--radius-lg);
            transition: all var(--transition);
        }
        .comment-item:hover {
            background: var(--bg-secondary);
        }
        .comment-item.reply {
            margin-left: 56px;
            background: linear-gradient(135deg, rgba(30,64,175,0.04) 0%, rgba(59,130,246,0.04) 100%);
            border-left: 3px solid var(--brand-light);
        }
        .avatar {
            width: 52px;
            height: 52px;
            min-width: 52px;
            border-radius: var(--radius);
            background: linear-gradient(135deg, var(--brand) 0%, var(--brand-light) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 18px;
            text-transform: uppercase;
        }
        .comment-body-wrapper {
            flex: 1;
            min-width: 0;
        }
        .comment-header {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 8px;
        }
        .comment-name {
            font-weight: 700;
            font-size: 15px;
            color: var(--text);
        }
        .comment-date {
            font-size: 13px;
            color: var(--muted);
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .comment-date svg {
            width: 14px;
            height: 14px;
        }
        .comment-text {
            font-size: 15px;
            line-height: 1.7;
            color: var(--text-secondary);
            margin-bottom: 12px;
        }
        .reply-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            background: transparent;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            font-size: 13px;
            font-weight: 500;
            color: var(--brand);
            cursor: pointer;
            transition: all var(--transition);
        }
        .reply-btn:hover {
            background: rgba(30,64,175,0.06);
            border-color: var(--brand-light);
        }
        .reply-btn svg {
            width: 14px;
            height: 14px;
        }

        /* Empty Comments */
        .empty-comments {
            text-align: center;
            padding: 48px 24px;
            background: var(--bg);
            border-radius: var(--radius-lg);
        }
        .empty-comments svg {
            width: 56px;
            height: 56px;
            color: var(--muted);
            margin-bottom: 16px;
            opacity: 0.5;
        }
        .empty-comments h3 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 4px;
        }
        .empty-comments p {
            color: var(--muted);
            font-size: 14px;
        }

        /* Comment Form */
        .comment-form {
            margin-top: 40px;
            padding-top: 40px;
            border-top: 1px solid var(--border);
        }
        .comment-form h3 {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 24px;
        }
        .replying-notice {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 16px;
            background: linear-gradient(135deg, rgba(30,64,175,0.06) 0%, rgba(59,130,246,0.06) 100%);
            border-radius: var(--radius);
            margin-bottom: 20px;
            border: 1px solid rgba(30,64,175,0.15);
        }
        .replying-notice span {
            font-size: 14px;
            color: var(--brand);
            font-weight: 500;
        }
        .replying-notice button {
            padding: 6px 12px;
            background: transparent;
            border: none;
            color: var(--brand);
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            border-radius: var(--radius-sm);
            transition: all var(--transition);
        }
        .replying-notice button:hover {
            background: rgba(30,64,175,0.1);
        }
        .form-group {
            margin-bottom: 20px;
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
            min-height: 140px;
            resize: vertical;
        }
        .submit-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 14px 28px;
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

        /* Responsive */
        @media (max-width: 768px) {
            .nav {
                padding: 12px 20px;
            }
            .story-hero {
                padding: 48px 20px;
            }
            .story-hero h1 {
                font-size: 28px;
            }
            .page {
                margin-top: -24px;
                padding: 0 16px 48px;
            }
            .story-card {
                padding: 28px 20px;
            }
            .comments-section {
                padding: 28px 20px;
            }
            .form-row {
                grid-template-columns: 1fr;
            }
            .comment-item {
                padding: 16px;
            }
            .comment-item.reply {
                margin-left: 32px;
            }
            .avatar {
                width: 44px;
                height: 44px;
                min-width: 44px;
                font-size: 16px;
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
            <a href="/" class="back-link">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Ana Sayfaya Dön
            </a>
        </div>
    </header>

    <section class="story-hero">
        <div class="story-hero-content">
            <nav class="breadcrumb">
                <a href="/">Ana Sayfa</a>
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Hikaye</span>
            </nav>
            @if($story->category)
                <span class="story-category-badge">{{ $story->category }}</span>
            @endif
            <h1>{{ $story->title }}</h1>
            <div class="story-hero-meta">
                <span>
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    {{ optional($story->published_at)->format('d M Y') }}
                </span>
                <span>
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    {{ $comments->count() }} yorum
                </span>
            </div>
        </div>
    </section>

    <main class="page">
        <article class="story-card">
            <div class="story-content">
                {!! nl2br(e($story->body)) !!}
            </div>
        </article>

        <section class="comments-section">
            <div class="comments-header">
                <h2>
                    Yorumlar
                    <span class="comments-count">{{ $comments->count() }}</span>
                </h2>
            </div>

            @if($comments->count() > 0)
                <div class="comment-list">
                    @foreach($comments as $comment)
                        <div class="comment-item">
                            <div class="avatar">{{ strtoupper(mb_substr($comment->name, 0, 2, 'UTF-8')) }}</div>
                            <div class="comment-body-wrapper">
                                <div class="comment-header">
                                    <span class="comment-name">{{ $comment->name }}</span>
                                    <span class="comment-date">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $comment->created_at->format('d.m.Y H:i') }}
                                    </span>
                                </div>
                                <p class="comment-text">{{ $comment->body }}</p>
                                <button type="button" class="reply-btn" onclick="startReply({{ $comment->id }}, '{{ addslashes($comment->name) }}')">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/>
                                    </svg>
                                    Cevapla
                                </button>
                            </div>
                        </div>

                        @foreach($comment->replies as $reply)
                            <div class="comment-item reply">
                                <div class="avatar">{{ strtoupper(mb_substr($reply->name, 0, 2, 'UTF-8')) }}</div>
                                <div class="comment-body-wrapper">
                                    <div class="comment-header">
                                        <span class="comment-name">{{ $reply->name }}</span>
                                        <span class="comment-date">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            {{ $reply->created_at->format('d.m.Y H:i') }}
                                        </span>
                                    </div>
                                    <p class="comment-text">{{ $reply->body }}</p>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            @else
                <div class="empty-comments">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    <h3>Henüz yorum yok</h3>
                    <p>Bu hikayeye ilk yorumu siz yapın!</p>
                </div>
            @endif

            <form class="comment-form" id="comment-form" method="POST" action="{{ route('stories.comment', $story->slug) }}">
                @csrf
                <h3>Yorum Yaz</h3>

                <div id="replying-to" class="replying-notice" style="display: none;">
                    <span id="replying-text"></span>
                    <button type="button" onclick="cancelReply()">Iptal</button>
                </div>

                <input type="hidden" name="parent_id" id="parent_id" value="">

                <div class="form-group">
                    <label for="comment">Yorumunuz</label>
                    <textarea id="comment" name="comment" placeholder="Düşüncelerinizi paylaşın...">{{ old('comment') }}</textarea>
                </div>

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

                <button type="submit" class="submit-btn">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                    Yorum Gönder
                </button>
            </form>
        </section>
    </main>

    <script>
        function startReply(commentId, name) {
            document.getElementById('parent_id').value = commentId;
            const box = document.getElementById('replying-to');
            const text = document.getElementById('replying-text');
            text.textContent = name + ' kullanıcısına cevap yazıyorsunuz';
            box.style.display = 'flex';
            document.getElementById('comment').focus();
            document.getElementById('comment-form').scrollIntoView({ behavior: 'smooth', block: 'center' });
        }

        function cancelReply() {
            document.getElementById('parent_id').value = '';
            document.getElementById('replying-to').style.display = 'none';
        }
    </script>
</body>
</html>
