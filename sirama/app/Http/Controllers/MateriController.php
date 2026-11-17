<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    // Lihat materi: semua role yang login
    public function index()
    {
        return view('materi.index', [
            'materis' => Materi::with('pengunggah')->latest()->get(),
        ]);
    }

    // Kelola materi: admin & dosen
    public function kelola()
    {
        return view('materi.kelola', [
            'materis' => Materi::with('pengunggah')->latest()->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
        ]);

        Materi::create($data + ['user_id' => $request->user()->id]);

        return back()->with('status', 'Materi berhasil ditambahkan.');
    }

    public function destroy(Materi $materi): RedirectResponse
    {
        $materi->delete();

        return back()->with('status', 'Materi berhasil dihapus.');
    }
}
