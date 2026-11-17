@extends('layouts.app')
@section('title', 'Manajemen Pengguna')

@section('content')
<div class="card">
    <h2>Tambah Pengguna</h2>
    <form method="POST" action="{{ route('pengguna.store') }}">
        @csrf
        <label>Nama</label>
        <input type="text" name="name" value="{{ old('name') }}" required>
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
        <label>Password (min. 8 karakter)</label>
        <input type="password" name="password" required>
        <label>Role</label>
        <select name="role" required>
            @foreach(\App\Models\User::ROLES as $role)
                <option value="{{ $role }}" @selected(old('role') === $role)>{{ ucfirst($role) }}</option>
            @endforeach
        </select>
        <button type="submit">Simpan</button>
    </form>
</div>

<div class="card">
    <h2>Daftar Pengguna</h2>
    <table>
        <tr><th>Nama</th><th>Email</th><th>Role</th><th>Aksi</th></tr>
        @foreach($users as $u)
        <tr>
            <td>{{ $u->name }}</td>
            <td>{{ $u->email }}</td>
            <td><span class="badge">{{ $u->role }}</span></td>
            <td>
                @unless($u->is(auth()->user()))
                <form class="inline" method="POST" action="{{ route('pengguna.destroy', $u) }}" onsubmit="return confirm('Hapus pengguna ini?')">
                    @csrf @method('DELETE')
                    <button class="kecil" type="submit">Hapus</button>
                </form>
                @endunless
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
