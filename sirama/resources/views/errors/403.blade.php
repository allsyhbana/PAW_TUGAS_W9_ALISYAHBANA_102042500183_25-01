<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>403 - Akses Ditolak</title>
    <style>
        body { font-family:system-ui,Arial,sans-serif; background:#f3f4f6; display:flex; min-height:100vh; align-items:center; justify-content:center; margin:0; }
        .box { background:#fff; padding:40px; border-radius:8px; text-align:center; box-shadow:0 1px 3px rgba(0,0,0,.1); }
        h1 { color:#E31E24; font-size:64px; margin:0; }
        a { color:#E31E24; }
    </style>
</head>
<body>
    <div class="box">
        <h1>403</h1>
        <p>{{ $exception->getMessage() ?: 'Anda tidak memiliki hak akses!' }}</p>
        <a href="{{ url('/dashboard') }}">Kembali ke Dashboard</a>
    </div>
</body>
</html>
