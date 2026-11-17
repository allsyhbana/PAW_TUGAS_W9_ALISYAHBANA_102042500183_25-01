<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    // Lihat nilai PRIBADI: hanya milik pengguna yang sedang login
    // (pembatasan level data: query selalu difilter berdasarkan user login)
    public function saya(Request $request)
    {
        return view('nilai.saya', [
            'nilais' => $request->user()->nilais()->orderBy('mata_kuliah')->get(),
        ]);
    }

    // Kelola nilai: admin & dosen
    public function kelola()
    {
        return view('nilai.kelola', [
            'nilais' => Nilai::with('mahasiswa')->latest()->get(),
            'mahasiswas' => User::where('role', 'mahasiswa')->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'mata_kuliah' => ['required', 'string', 'max:255'],
            'nilai' => ['required', 'integer', 'between:0,100'],
        ]);

        // Nilai hanya boleh diberikan kepada akun berrole mahasiswa
        abort_unless(User::whereKey($data['user_id'])->where('role', 'mahasiswa')->exists(), 422, 'Penerima nilai harus mahasiswa.');

        Nilai::create($data);

        return back()->with('status', 'Nilai berhasil disimpan.');
    }

    public function destroy(Nilai $nilai): RedirectResponse
    {
        $nilai->delete();

        return back()->with('status', 'Nilai berhasil dihapus.');
    }
}
