<?php

namespace Database\Seeders;

use App\Models\Materi;
use App\Models\Nilai;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::create(['name' => 'Admin SIRAMA', 'email' => 'admin@sirama.test', 'password' => 'password123', 'role' => 'admin']);
        $dosen = User::create(['name' => 'Dosen SIRAMA', 'email' => 'dosen@sirama.test', 'password' => 'password123', 'role' => 'dosen']);
        $mhs1 = User::create(['name' => 'Mahasiswa Satu', 'email' => 'mahasiswa@sirama.test', 'password' => 'password123', 'role' => 'mahasiswa']);
        $mhs2 = User::create(['name' => 'Mahasiswa Dua', 'email' => 'mahasiswa2@sirama.test', 'password' => 'password123', 'role' => 'mahasiswa']);

        Materi::create(['judul' => 'Pengantar Middleware', 'deskripsi' => 'Konsep dan alur kerja middleware pada Laravel.', 'user_id' => $dosen->id]);
        Materi::create(['judul' => 'Authentication vs Authorization', 'deskripsi' => 'Perbedaan autentikasi dan otorisasi.', 'user_id' => $dosen->id]);
        Materi::create(['judul' => 'Role-Based Access Control', 'deskripsi' => 'Pembatasan akses berdasarkan role pengguna.', 'user_id' => $admin->id]);

        Nilai::create(['user_id' => $mhs1->id, 'mata_kuliah' => 'Pemrograman Web', 'nilai' => 85]);
        Nilai::create(['user_id' => $mhs1->id, 'mata_kuliah' => 'Basis Data', 'nilai' => 90]);
        Nilai::create(['user_id' => $mhs2->id, 'mata_kuliah' => 'Pemrograman Web', 'nilai' => 78]);
    }
}
