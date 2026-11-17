@extends('layouts.app')
@section('title', 'Kelola Materi')

@section('content')
<div class="card">
    <h2>Tambah Materi</h2>
    <form method="POST" action="{{ route('materi.store') }}">
        @csrf
        <label>Judul</label>
        <input type="text" name="judul" value="{{ old('judul') }}" required>
        <label>Deskripsi</label>
        <textarea name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
        <button type="submit">Simpan</button>
    </form>
</div>

<div class="card">
    <h2>Kelola Materi</h2>
    <table>
        <tr><th>Judul</th><th>Pengunggah</th><th>Aksi</th></tr>
        @forelse($materis as $m)
        <tr>
            <td>{{ $m->judul }}</td>
            <td>{{ $m->pengunggah->name }}</td>
            <td>
                <form class="inline" method="POST" action="{{ route('materi.destroy', $m) }}" onsubmit="return confirm('Hapus materi ini?')">
                    @csrf @method('DELETE')
                    <button class="kecil" type="submit">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="3">Belum ada materi.</td></tr>
        @endforelse
    </table>
</div>
@endsection
