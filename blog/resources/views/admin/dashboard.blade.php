<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Admin Paneli | BAUM</title>
    <style>
        body { font-family: system-ui, -apple-system, sans-serif; margin: 24px; background:#f3f4f6; }
        h1 { margin-bottom: 10px; }
        p { margin-top: 0; color:#6b7280; }
        .actions { display:flex; flex-wrap:wrap; gap:12px; margin-top:20px; }
        a.btn, button.btn {
            display:inline-flex;
            align-items:center;
            justify-content:center;
            padding:10px 16px;
            border-radius:10px;
            border:none;
            font-size:14px;
            font-weight:600;
            cursor:pointer;
            text-decoration:none;
            color:#fff;
        }
        .btn-primary { background:#1f4e79; }
        .btn-secondary { background:#0f172a; }
        .btn-muted { background:#6b7280; }
        form { margin:0; }
    </style>
</head>
<body>
    <h1>BAUM Admin Paneli</h1>
    <p>Buradan hikayeleri yönetebilir ve kullanıcı yorumlarını onaylayabilirsiniz.</p>

    <div class="actions">
        <a href="{{ route('admin.stories.index') }}" class="btn btn-primary">Hikaye Ekle</a>
        <a href="{{ route('admin.comments.index') }}" class="btn btn-secondary">Yorumları Onayla</a>
        <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">İletişim Mesajları</a>
        <a href="{{ route('home') }}" class="btn btn-muted">Ana Sayfaya Git</a>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="btn btn-muted">Çıkış Yap</button>
        </form>
    </div>
</body>
</html>


