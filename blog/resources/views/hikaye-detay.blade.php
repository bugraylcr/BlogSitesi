<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hikaye Detay | BAUM</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        :root {
            --accent: #1f4e79;
            --bg: #f7f8fb;
            --text: #1b2533;
            --muted: #6b7280;
            --card: #fff;
            --border: #e6e9f0;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: 'Inter', system-ui, sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.6;
        }
        a { color: var(--accent); text-decoration: none; }
        .hero {
            padding: 42px 18px 26px;
            text-align: center;
            background: #fff;
            border-bottom: 1px solid var(--border);
        }
        .hero h1 {
            margin: 0 0 10px;
            font-family: 'Playfair Display', serif;
            font-size: 36px;
            letter-spacing: -0.3px;
        }
        .breadcrumb {
            color: var(--muted);
            font-weight: 600;
        }
        .breadcrumb a:hover { text-decoration: underline; }
        .page {
            max-width: 1080px;
            margin: 0 auto;
            padding: 26px 18px 60px;
        }
        .story-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            box-shadow: 0 12px 32px rgba(0,0,0,0.05);
            padding: 24px;
            margin-bottom: 26px;
        }
        .story-meta {
            color: var(--muted);
            font-size: 14px;
            margin-bottom: 12px;
        }
        .story-content p { margin: 0 0 14px; }
        .comments {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            box-shadow: 0 10px 26px rgba(0,0,0,0.04);
            padding: 24px;
        }
        .comments h2 {
            margin: 0 0 18px;
            font-size: 22px;
        }
        .comment-item {
            display: grid;
            grid-template-columns: 50px 1fr;
            gap: 12px;
            padding: 14px 0;
            border-top: 1px solid var(--border);
        }
        .comment-item:first-of-type { border-top: none; }
        .comment-item.reply {
            background: #f6f9ff;
            border-left: 3px solid var(--accent);
            border-radius: 10px;
            padding: 14px;
            margin-left: 52px;
            margin-top: 8px;
        }
        .avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #dfe6f2;
            display: grid;
            place-items: center;
            color: var(--accent);
            font-weight: 700;
        }
        .comment-header {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 4px;
        }
        .comment-name { font-weight: 700; }
        .comment-date { color: var(--muted); font-size: 13px; }
        .comment-body { margin: 0; color: #2c3647; }
        .reply { margin-left: 58px; font-size: 14px; color: var(--accent); }
        .comment-form {
            margin-top: 24px;
            border-top: 1px solid var(--border);
            padding-top: 20px;
        }
        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 14px;
        }
        label { font-weight: 600; margin-bottom: 6px; display: block; }
        input, textarea {
            width: 100%;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 12px 14px;
            font-family: 'Inter', sans-serif;
            font-size: 15px;
            transition: border-color .2s, box-shadow .2s;
        }
        input:focus, textarea:focus {
            outline: none;
            border-color: rgba(31,78,121,0.35);
            box-shadow: 0 0 0 3px rgba(31,78,121,0.12);
        }
        textarea { min-height: 140px; resize: vertical; }
        .btn {
            margin-top: 12px;
            padding: 12px 18px;
            border: none;
            border-radius: 10px;
            background: var(--accent);
            color: #fff;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(31,78,121,0.18);
            transition: transform .15s ease, box-shadow .2s ease;
        }
        .btn:hover { transform: translateY(-1px); box-shadow: 0 12px 24px rgba(31,78,121,0.22); }
        .back-link {
            display:inline-block;
            margin-bottom:12px;
            font-size:14px;
            color: var(--accent);
        }
        .replying {
            font-size:13px;
            color: var(--muted);
            margin-bottom:8px;
        }
        @media (max-width: 640px) {
            .comment-item { grid-template-columns: 40px 1fr; }
            .avatar { width: 40px; height: 40px; font-size: 13px; }
        }
    </style>
</head>
<body>
    <div class="hero">
        <h1>{{ $story->title }}</h1>
        <div class="breadcrumb"><a href="/">Ana sayfa</a> / Hikaye</div>
    </div>

    <div class="page">
        <div class="story-card">
            <div class="story-meta">
                {{ optional($story->published_at)->format('d F Y') }}
                @if($story->category)
                    • {{ $story->category }}
                @endif
            </div>
            <div class="story-content">
                {!! nl2br(e($story->body)) !!}
            </div>
        </div>

        <div class="comments">
            <h2>Yorumlar</h2>

            @forelse($comments as $comment)
                <div class="comment-item">
                    <div class="avatar">{{ strtoupper(mb_substr($comment->name,0,2,'UTF-8')) }}</div>
                    <div>
                        <div class="comment-header">
                            <span class="comment-name">{{ $comment->name }}</span>
                            <span class="comment-date">{{ $comment->created_at->format('d.m.Y H:i') }}</span>
                        </div>
                        <p class="comment-body">{{ $comment->body }}</p>
                        <a href="#comment-form" class="reply" onclick="startReply({{ $comment->id }}, '{{ addslashes($comment->name) }}'); return false;">Cevapla</a>
                    </div>
                </div>

                @foreach($comment->replies as $reply)
                    <div class="comment-item reply">
                        <div class="avatar">{{ strtoupper(mb_substr($reply->name,0,2,'UTF-8')) }}</div>
                        <div>
                            <div class="comment-header">
                                <span class="comment-name">{{ $reply->name }}</span>
                                <span class="comment-date">{{ $reply->created_at->format('d.m.Y H:i') }}</span>
                            </div>
                            <p class="comment-body">{{ $reply->body }}</p>
                        </div>
                    </div>
                @endforeach
            @empty
                <p>Henüz yorum yok. İlk yorumu sen yaz!</p>
            @endforelse

            <form class="comment-form" id="comment-form" method="POST" action="{{ route('stories.comment', $story->slug) }}">
                @csrf
                <h3>Bir cevap yazın</h3>
                <div id="replying-to" class="replying" style="display:none;">
                    <span id="replying-text"></span>
                    <button type="button" onclick="cancelReply()" style="margin-left:8px;border:none;background:none;color:var(--accent);cursor:pointer;">İptal</button>
                </div>
                <input type="hidden" name="parent_id" id="parent_id" value="">
                <div class="field" style="margin-bottom:16px;">
                    <label for="comment">Yorum</label>
                    <textarea id="comment" name="comment" placeholder="Yorumunuzu yazın">{{ old('comment') }}</textarea>
                </div>
                <div class="form-row">
                    <div>
                        <label for="name">İsim*</label>
                        <input id="name" name="name" type="text" placeholder="İsminiz" value="{{ old('name') }}">
                    </div>
                    <div>
                        <label for="email">E-posta*</label>
                        <input id="email" name="email" type="email" placeholder="ornek@eposta.com" value="{{ old('email') }}">
                    </div>
                </div>
                <button class="btn" type="submit">Yorum Gönder</button>
            </form>
        </div>
    </div>

    <script>
        function startReply(commentId, name) {
            document.getElementById('parent_id').value = commentId;
            const box = document.getElementById('replying-to');
            const text = document.getElementById('replying-text');
            text.textContent = name + ' kullanıcısına cevap yazıyorsunuz.';
            box.style.display = 'block';
        }
        function cancelReply() {
            document.getElementById('parent_id').value = '';
            document.getElementById('replying-to').style.display = 'none';
        }
    </script>
</body>
</html>


