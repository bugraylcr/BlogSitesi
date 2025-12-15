<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Admin | Hikayeler</title>
    <style>
        body { font-family: system-ui, -apple-system, sans-serif; margin: 24px; background:#f5f5f8; }
        h1 { margin-bottom: 16px; }
        a { text-decoration:none; color:#1f4e79; }
        table { border-collapse: collapse; width: 100%; background:#fff; box-shadow:0 8px 18px rgba(0,0,0,.04); }
        th, td { padding: 10px 12px; border-bottom:1px solid #e5e7eb; font-size:14px; text-align:left; }
        th { background:#f3f4f6; }
        .btn { display:inline-block; padding:8px 12px; border-radius:6px; border:none; background:#1f4e79; color:#fff; font-size:14px; }
        .top { margin-bottom:12px; display:flex; justify-content:space-between; align-items:center; }
        .status { color:#6b7280; font-size:13px; }
    </style>
</head>
<body>
    <div class="top">
        <h1>Hikayeler</h1>
        <div style="display:flex; gap:8px; align-items:center;">
            <a class="btn btn-muted" href="{{ route('admin.dashboard') }}">← Dashboard</a>
            <a class="btn" href="{{ route('admin.stories.create') }}">Yeni Hikaye Ekle</a>
        </div>
    </div>
    @if(session('status'))
        <p class="status">{{ session('status') }}</p>
    @endif
    <table>
        <thead>
            <tr>
                <th>Başlık</th>
                <th>Kategori</th>
                <th>Yayın Tarihi</th>
                <th>Yorum Sayısı</th>
            </tr>
        </thead>
        <tbody>
        @forelse($stories as $story)
            <tr>
                <td>{{ $story->title }}</td>
                <td>{{ $story->category }}</td>
                <td>{{ optional($story->published_at)->format('d.m.Y H:i') }}</td>
                <td>{{ $story->comments()->count() }}</td>
            </tr>
        @empty
            <tr><td colspan="4">Henüz hikaye eklenmemiş.</td></tr>
        @endforelse
        </tbody>
    </table>
</body>
</html>


