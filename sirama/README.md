# SIRAMA Telkom University

Sistem Informasi Rekap Akademik Mahasiswa - Tugas Praktikum Middleware & Pembatasan Hak Akses (Laravel 13).
Tiga role: Admin, Dosen, Mahasiswa. Database: MySQL (Laragon), nama database `sirama`.

## Menjalankan

1. Nyalakan Laragon (Start All) agar MySQL aktif.
2. Buat database kosong bernama `sirama` (HeidiSQL di Laragon, atau phpMyAdmin).
3. Di terminal, dalam folder proyek:

```bash
php artisan migrate --seed
php artisan serve
```

Buka http://127.0.0.1:8000

Mengulang dari awal (hapus semua data lalu isi ulang): `php artisan migrate:fresh --seed`

## Akun uji (password semua: `password123`)

| Role | Email |
|---|---|
| Admin | admin@sirama.test |
| Dosen | dosen@sirama.test |
| Mahasiswa | mahasiswa@sirama.test |
| Mahasiswa (pembanding) | mahasiswa2@sirama.test |

## Matriks hak akses

| Fitur | Route | Middleware | Admin | Dosen | Mahasiswa |
|---|---|---|---|---|---|
| Dashboard | /dashboard | auth | Ya | Ya | Ya |
| Manajemen pengguna | /pengguna | auth, role:admin | Ya | - | - |
| Kelola materi | /kelola-materi | auth, role:admin,dosen | Ya | Ya | - |
| Lihat materi | /materi | auth | Ya | Ya | Ya |
| Kelola nilai | /kelola-nilai | auth, role:admin,dosen | Ya | Ya | - |
| Lihat nilai pribadi | /nilai-saya | auth, role:admin,mahasiswa | Ya | - | Ya |
| Halaman per role | /admin, /dosen, /mahasiswa | auth, role:... | sesuai role | sesuai role | sesuai role |

## Skenario pengujian manual (isi "Hasil aktual" + screenshot)

| No | Pengguna | URL | Hasil yang diharapkan | Hasil aktual |
|---|---|---|---|---|
| 1 | Admin | /admin | Diizinkan (200) | |
| 2 | Admin | /kelola-materi | Diizinkan (200) | |
| 3 | Dosen | /dosen | Diizinkan (200) | |
| 4 | Dosen | /admin | Ditolak (403) | |
| 5 | Dosen | /nilai-saya | Ditolak (403) | |
| 6 | Mahasiswa | /mahasiswa | Diizinkan (200) | |
| 7 | Mahasiswa | /kelola-materi | Ditolak (403) | |
| 8 | Mahasiswa | /pengguna | Ditolak (403) | |
| 9 | Belum login | /admin | Dialihkan ke /login | |
| 10 | Mahasiswa | /nilai-saya | Hanya nilai milik sendiri tampil | |

Pengujian otomatis: `php artisan test`. Daftar route: `php artisan route:list`.

## File penting

- `app/Http/Middleware/CheckRole.php` - middleware pembatas role
- `bootstrap/app.php` - pendaftaran alias `role`
- `routes/web.php` - route dengan `auth` + `role:...`
- `database/migrations/*add_role_to_users_table.php` - kolom role
- `tests/Feature/RoleAccessTest.php` - pengujian otomatis
