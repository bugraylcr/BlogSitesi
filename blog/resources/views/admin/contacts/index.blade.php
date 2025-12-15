<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Admin | İletişim Mesajları</title>
    <style>
        body { font-family: system-ui, -apple-system, sans-serif; margin:24px; background:#f5f5f8; }
        h1 { margin-bottom:16px; }
        table { border-collapse: collapse; width:100%; background:#fff; box-shadow:0 8px 18px rgba(0,0,0,.04); }
        th, td { padding:10px 12px; border-bottom:1px solid #e5e7eb; font-size:14px; text-align:left; vertical-align:top; }
        th { background:#f3f4f6; }
        .status { color:#6b7280; font-size:13px; margin-bottom:10px; }
        .top { display:flex; justify-content:space-between; align-items:center; margin-bottom:10px; }
        .btn-back { text-decoration:none; padding:8px 12px; border-radius:6px; background:#6b7280; color:#fff; font-size:13px; }
    </style>
</head>
<body>
    <div class="top">
        <h1>İletişim Mesajları</h1>
        <a class="btn-back" href="{{ route('admin.dashboard') }}">← Dashboard</a>
    </div>
    @if(session('status'))
        <p class="status">{{ session('status') }}</p>
    @endif
    <table>
        <thead>
            <tr>
                <th>Ad / E-posta</th>
                <th>Konu</th>
                <th>Mesaj</th>
                <th>Tarih</th>
                <th>İşlem</th>
            </tr>
        </thead>
        <tbody>
            @forelse($messages as $msg)
                <tr>
                    <td>
                        <strong>{{ $msg->name }}</strong><br>
                        <small>{{ $msg->email }}</small>
                    </td>
                    <td>{{ $msg->subject }}</td>
                    <td>{{ $msg->message }}</td>
                    <td>{{ $msg->created_at->format('d.m.Y H:i') }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.contacts.destroy', $msg) }}" onsubmit="return confirm('Mesajı silmek istediğinize emin misiniz?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="padding:6px 10px;border:none;border-radius:6px;background:#b91c1c;color:#fff;font-size:13px;cursor:pointer;">Sil</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">Henüz mesaj yok.</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>


