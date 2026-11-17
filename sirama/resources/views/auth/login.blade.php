@extends('layouts.app')
@section('title', 'Login')

@section('content')
<div class="card" style="max-width:420px;margin:0 auto;">
    <h2>Login SIRAMA</h2>
    <p>Sistem Informasi Rekap Akademik Mahasiswa - Telkom University</p>
    <form method="POST" action="{{ route('login.store') }}">
        @csrf
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required autofocus>
        <label>Password</label>
        <input type="password" name="password" required>
        <label style="display:flex;gap:8px;align-items:center;">
            <input type="checkbox" name="remember" value="1" style="width:auto;margin:0;"> Ingat saya
        </label>
        <br>
        <button type="submit">Masuk</button>
    </form>
</div>
@endsection
