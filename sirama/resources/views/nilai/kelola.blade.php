@extends('layouts.app')
@section('title', 'Kelola Nilai')

@section('content')
<div class="card">
    <h2>Input Nilai</h2>
    <form method="POST" action="{{ route('nilai.store') }}">
        @csrf
        <label>Mahasiswa</label>
        <select name="user_id" required>
            @foreach($mahasiswas as $m)
                <option value="{{ $m->id }}" @selected((string) old('user_id') === (string) $m->id)>{{ $m->name }}</option>
            @endforeach
        </select>
        <label>Mata Kuliah</label>
        <input type="text" name="mata_kuliah" value="{{ old('mata_kuliah') }}" required>
        <label>Nilai (0-100)</label>
        <input type="number" name="nilai" min="0" max="100" value="{{ old('nilai') }}" required>
        <button type="submit">Simpan</button>
    </form>
</div>

<div class="card">
    <h2>Semua Nilai</h2>
    <table>
        <tr><th>Mahasiswa</th><th>Mata Kuliah</th><th>Nilai</th><th>Aksi</th></tr>
        @forelse($nilais as $n)
        <tr>
            <td>{{ $n->mahasiswa->name }}</td>
            <td>{{ $n->mata_kuliah }}</td>
            <td>{{ $n->nilai }}</td>
            <td>
                <form class="inline" method="POST" action="{{ route('nilai.destroy', $n) }}" onsubmit="return confirm('Hapus nilai ini?')">
                    @csrf @method('DELETE')
                    <button class="kecil" type="submit">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="4">Belum ada nilai.</td></tr>
        @endforelse
    </table>
</div>
@endsection
