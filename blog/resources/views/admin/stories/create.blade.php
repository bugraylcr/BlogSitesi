<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Admin | Yeni Hikaye</title>
    <style>
        body { font-family: system-ui, -apple-system, sans-serif; margin: 24px; background:#f5f5f8; }
        h1 { margin-bottom: 16px; }
        label { font-weight:600; display:block; margin-bottom:6px; }
        input, textarea { width:100%; padding:8px 10px; border-radius:6px; border:1px solid #d1d5db; margin-bottom:12px; font-size:14px; }
        textarea { min-height:160px; }
        .btn { display:inline-block; padding:8px 14px; border-radius:6px; border:none; background:#1f4e79; color:#fff; font-size:14px; cursor:pointer; }
        .back { margin-bottom:12px; display:inline-block; }
        .error { color:#b91c1c; font-size:13px; }
    </style>
</head>
<body>
    <a href="{{ route('admin.stories.index') }}" class="back">&larr; Listeye dön</a>
    <h1>Yeni Hikaye</h1>

    @if($errors->any())
        <div class="error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.stories.store') }}">
        @csrf
        <label for="title">Başlık</label>
        <input id="title" name="title" value="{{ old('title') }}" required>

        <label for="category">Kategori (ör. Gezi)</label>
        <input id="category" name="category" value="{{ old('category') }}">

        <label for="cover_image_url">Kapak Görseli URL</label>
        <input id="cover_image_url" name="cover_image_url" value="{{ old('cover_image_url') }}">

        <label for="excerpt">Kısa Açıklama</label>
        <textarea id="excerpt" name="excerpt">{{ old('excerpt') }}</textarea>

        <label for="body">Hikaye Metni</label>
        <textarea id="body" name="body">{{ old('body') }}</textarea>

        <button class="btn" type="submit">Kaydet</button>
    </form>
</body>
</html>


