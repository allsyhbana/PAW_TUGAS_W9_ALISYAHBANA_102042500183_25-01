<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

// ---------- Login / Logout ----------
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// ---------- Semua route di bawah wajib login (auth) ----------
Route::middleware('auth')->group(function () {

    // Semua role
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/materi', [MateriController::class, 'index'])->name('materi.index');

    // Admin saja
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin', fn () => view('halaman-role', [
            'judul' => 'Halaman Admin',
            'deskripsi' => 'Area khusus Admin SIRAMA.',
        ]))->name('admin');

        Route::get('/pengguna', [UserController::class, 'index'])->name('pengguna.index');
        Route::post('/pengguna', [UserController::class, 'store'])->name('pengguna.store');
        Route::delete('/pengguna/{user}', [UserController::class, 'destroy'])->name('pengguna.destroy');
    });

    // Dosen saja
    Route::middleware('role:dosen')->get('/dosen', fn () => view('halaman-role', [
        'judul' => 'Dashboard Dosen',
        'deskripsi' => 'Area khusus Dosen SIRAMA.',
    ]))->name('dosen');

    // Mahasiswa saja
    Route::middleware('role:mahasiswa')->get('/mahasiswa', fn () => view('halaman-role', [
        'judul' => 'Dashboard Mahasiswa',
        'deskripsi' => 'Area khusus Mahasiswa SIRAMA.',
    ]))->name('mahasiswa');

    // Admin + Dosen: kelola materi & nilai
    Route::middleware('role:admin,dosen')->group(function () {
        Route::get('/kelola-materi', [MateriController::class, 'kelola'])->name('materi.kelola');
        Route::post('/kelola-materi', [MateriController::class, 'store'])->name('materi.store');
        Route::delete('/kelola-materi/{materi}', [MateriController::class, 'destroy'])->name('materi.destroy');

        Route::get('/kelola-nilai', [NilaiController::class, 'kelola'])->name('nilai.kelola');
        Route::post('/kelola-nilai', [NilaiController::class, 'store'])->name('nilai.store');
        Route::delete('/kelola-nilai/{nilai}', [NilaiController::class, 'destroy'])->name('nilai.destroy');
    });

    // Admin + Mahasiswa: lihat nilai pribadi (dosen tidak)
    Route::middleware('role:admin,mahasiswa')->get('/nilai-saya', [NilaiController::class, 'saya'])->name('nilai.saya');
});
