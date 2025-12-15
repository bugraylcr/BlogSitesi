<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Admin | Yorumlar</title>
    <style>
        body { font-family: system-ui, -apple-system, sans-serif; margin:24px; background:#f5f5f8; }
        h1 { margin-bottom:16px; }
        table { border-collapse: collapse; width:100%; background:#fff; box-shadow:0 8px 18px rgba(0,0,0,.04); }
        th, td { padding:10px 12px; border-bottom:1px solid #e5e7eb; font-size:14px; text-align:left; vertical-align:top; }
        th { background:#f3f4f6; }
        form { display:inline; }
        .btn { padding:6px 10px; border-radius:5px; border:none; font-size:13px; cursor:pointer; }
        .btn-approve { background:#16a34a; color:#fff; }
        .btn-delete { background:#b91c1c; color:#fff; }
        .badge { padding:2px 6px; border-radius:999px; font-size:12px; }
        .badge-ok { background:#dcfce7; color:#15803d; }
        .badge-wait { background:#fef3c7; color:#92400e; }
        .status { color:#6b7280; font-size:13px; margin-bottom:10px; }
    </style>
</head>
<body>
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
        <h1 style="margin:0;">Yorumlar</h1>
        <a href="{{ route('admin.dashboard') }}" style="text-decoration:none; padding:8px 12px; border-radius:6px; background:#6b7280; color:#fff; font-size:13px;">← Dashboard</a>
    </div>
    @if(session('status'))
        <p class="status">{{ session('status') }}</p>
    @endif
    <table>
        <thead>
            <tr>
                <th>Durum</th>
                <th>Hikaye</th>
                <th>İsim / E-posta</th>
                <th>Yorum</th>
                <th>Tarih</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            @forelse($comments as $comment)
                <tr>
                    <td>
                        @if($comment->approved)
                            <span class="badge badge-ok">Onaylı</span>
                        @else
                            <span class="badge badge-wait">Bekliyor</span>
                        @endif
                    </td>
                    <td>{{ optional($comment->story)->title }}</td>
                    <td>
                        <strong>{{ $comment->name }}</strong><br>
                        <small>{{ $comment->email }}</small>
                    </td>
                    <td>{{ $comment->body }}</td>
                    <td>{{ $comment->created_at->format('d.m.Y H:i') }}</td>
                    <td>
                        @unless($comment->approved)
                            <form method="POST" action="{{ route('admin.comments.approve', $comment) }}">
                                @csrf
                                <button class="btn btn-approve" type="submit">Onayla</button>
                            </form>
                        @endunless
                        <form method="POST" action="{{ route('admin.comments.destroy', $comment) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-delete" type="submit">Sil</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">Henüz yorum yok.</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>


