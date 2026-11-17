@extends('layouts.app')
@section('title', $judul)

@section('content')
<div class="card">
    <h2>{{ $judul }}</h2>
    <p>{{ $deskripsi }}</p>
</div>
@endsection
