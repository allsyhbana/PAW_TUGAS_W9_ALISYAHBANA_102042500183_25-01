<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'SIRAMA') - SIRAMA Telkom University</title>
    <style>
        :root { --merah:#E31E24; --gelap:#1f2937; --abu:#f3f4f6; }
        * { box-sizing:border-box; }
        body { margin:0; font-family:system-ui,Segoe UI,Arial,sans-serif; background:var(--abu); color:var(--gelap); }
        header { background:var(--merah); color:#fff; padding:14px 24px; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:10px; }
        header h1 { margin:0; font-size:20px; }
        header small { opacity:.9; }
        nav { background:#fff; padding:10px 24px; display:flex; gap:16px; flex-wrap:wrap; border-bottom:1px solid #e5e7eb; }
        nav a { color:var(--gelap); text-decoration:none; font-weight:600; }
        nav a:hover { color:var(--merah); }
        main { max-width:960px; margin:24px auto; padding:0 16px; }
        .card { background:#fff; border-radius:8px; padding:20px; margin-bottom:20px; box-shadow:0 1px 3px rgba(0,0,0,.08); }
        table { width:100%; border-collapse:collapse; }
        th, td { text-align:left; padding:8px 10px; border-bottom:1px solid #e5e7eb; }
        th { background:var(--abu); }
        input, select, textarea { width:100%; padding:8px; margin:4px 0 12px; border:1px solid #d1d5db; border-radius:6px; font:inherit; }
        button { background:var(--merah); color:#fff; border:0; padding:8px 16px; border-radius:6px; cursor:pointer; font:inherit; }
        button.kecil { padding:4px 10px; background:#6b7280; }
        .ok { background:#dcfce7; color:#166534; padding:10px; border-radius:6px; margin-bottom:16px; }
        .err { background:#fee2e2; color:#991b1b; padding:10px; border-radius:6px; margin-bottom:16px; }
        .badge { background:var(--gelap); color:#fff; padding:2px 8px; border-radius:99px; font-size:12px; }
        form.inline { display:inline; margin:0; }
    </style>
</head>
<body>
<header>
    <div>
        <h1>SIRAMA</h1>
        <small>Telkom University</small>
    </div>
    @auth
    <div>
        {{ auth()->user()->name }} <span class="badge">{{ auth()->user()->role }}</span>
        <form class="inline" method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="kecil" type="submit">Logout</button>
        </form>
    </div>
    @endauth
</header>

@auth
<nav>
    <a href="{{ route('dashboard') }}">Dashboard</a>
    <a href="{{ route('materi.index') }}">Lihat Materi</a>
    @if(auth()->user()->hasRole('admin', 'dosen'))
        <a href="{{ route('materi.kelola') }}">Kelola Materi</a>
        <a href="{{ route('nilai.kelola') }}">Kelola Nilai</a>
    @endif
    @if(auth()->user()->hasRole('admin', 'mahasiswa'))
        <a href="{{ route('nilai.saya') }}">Nilai Saya</a>
    @endif
    @if(auth()->user()->hasRole('admin'))
        <a href="{{ route('pengguna.index') }}">Manajemen Pengguna</a>
    @endif
</nav>
@endauth

<main>
    @if(session('status'))
        <div class="ok">{{ session('status') }}</div>
    @endif
    @if($errors->any())
        <div class="err">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    @yield('content')
</main>
</body>
</html>
