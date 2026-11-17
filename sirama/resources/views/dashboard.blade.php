@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="card">
    <h2>Selamat datang, {{ auth()->user()->name }}</h2>
    <p>Anda login sebagai <strong>{{ auth()->user()->role }}</strong>. Menu yang tampil sesuai hak akses Anda, dan setiap route tetap dilindungi di sisi server oleh middleware <code>CheckRole</code>.</p>
</div>

<div class="card">
    <h3>Ringkasan Hak Akses</h3>
    <table>
        <tr><th>Fitur</th><th>Akses Anda</th></tr>
        <tr><td>Dashboard</td><td>Ya</td></tr>
        <tr><td>Manajemen pengguna</td><td>{{ auth()->user()->hasRole('admin') ? 'Ya' : 'Tidak' }}</td></tr>
        <tr><td>Kelola materi</td><td>{{ auth()->user()->hasRole('admin','dosen') ? 'Ya' : 'Tidak' }}</td></tr>
        <tr><td>Lihat materi</td><td>Ya</td></tr>
        <tr><td>Kelola nilai</td><td>{{ auth()->user()->hasRole('admin','dosen') ? 'Ya' : 'Tidak' }}</td></tr>
        <tr><td>Lihat nilai pribadi</td><td>{{ auth()->user()->hasRole('admin','mahasiswa') ? 'Ya' : 'Tidak' }}</td></tr>
    </table>
</div>
@endsection
