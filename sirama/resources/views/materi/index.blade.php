@extends('layouts.app')
@section('title', 'Lihat Materi')

@section('content')
<div class="card">
    <h2>Daftar Materi</h2>
    <table>
        <tr><th>Judul</th><th>Deskripsi</th><th>Pengunggah</th></tr>
        @forelse($materis as $m)
        <tr>
            <td>{{ $m->judul }}</td>
            <td>{{ $m->deskripsi }}</td>
            <td>{{ $m->pengunggah->name }}</td>
        </tr>
        @empty
        <tr><td colspan="3">Belum ada materi.</td></tr>
        @endforelse
    </table>
</div>
@endsection
