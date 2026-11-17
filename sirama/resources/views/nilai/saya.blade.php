@extends('layouts.app')
@section('title', 'Nilai Saya')

@section('content')
<div class="card">
    <h2>Nilai Saya</h2>
    <table>
        <tr><th>Mata Kuliah</th><th>Nilai</th></tr>
        @forelse($nilais as $n)
        <tr><td>{{ $n->mata_kuliah }}</td><td>{{ $n->nilai }}</td></tr>
        @empty
        <tr><td colspan="2">Belum ada nilai.</td></tr>
        @endforelse
    </table>
</div>
@endsection
