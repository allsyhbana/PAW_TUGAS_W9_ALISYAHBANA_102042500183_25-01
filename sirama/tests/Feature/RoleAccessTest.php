<?php

namespace Tests\Feature;

use App\Models\Nilai;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    private function akun(string $role): User
    {
        return User::factory()->create(['role' => $role]);
    }

    public function test_admin_boleh_akses_admin(): void
    {
        $this->actingAs($this->akun('admin'))->get('/admin')->assertOk();
    }

    public function test_admin_boleh_akses_kelola_materi(): void
    {
        $this->actingAs($this->akun('admin'))->get('/kelola-materi')->assertOk();
    }

    public function test_dosen_boleh_akses_dosen(): void
    {
        $this->actingAs($this->akun('dosen'))->get('/dosen')->assertOk();
    }

    public function test_dosen_ditolak_akses_admin(): void
    {
        $this->actingAs($this->akun('dosen'))->get('/admin')->assertForbidden();
    }

    public function test_dosen_ditolak_lihat_nilai_pribadi(): void
    {
        $this->actingAs($this->akun('dosen'))->get('/nilai-saya')->assertForbidden();
    }

    public function test_mahasiswa_boleh_akses_mahasiswa(): void
    {
        $this->actingAs($this->akun('mahasiswa'))->get('/mahasiswa')->assertOk();
    }

    public function test_mahasiswa_ditolak_kelola_materi(): void
    {
        $this->actingAs($this->akun('mahasiswa'))->get('/kelola-materi')->assertForbidden();
    }

    public function test_mahasiswa_ditolak_manajemen_pengguna(): void
    {
        $this->actingAs($this->akun('mahasiswa'))->get('/pengguna')->assertForbidden();
    }

    public function test_belum_login_dialihkan_ke_login(): void
    {
        $this->get('/admin')->assertRedirect(route('login'));
    }

    public function test_mahasiswa_hanya_melihat_nilai_miliknya(): void
    {
        $a = $this->akun('mahasiswa');
        $b = $this->akun('mahasiswa');
        Nilai::create(['user_id' => $a->id, 'mata_kuliah' => 'Matkul Milik A', 'nilai' => 80]);
        Nilai::create(['user_id' => $b->id, 'mata_kuliah' => 'Matkul Milik B', 'nilai' => 70]);

        $this->actingAs($a)->get('/nilai-saya')
            ->assertOk()
            ->assertSee('Matkul Milik A')
            ->assertDontSee('Matkul Milik B');
    }

    public function test_login_dan_logout(): void
    {
        $user = User::factory()->create(['role' => 'dosen', 'password' => 'password123']);

        $this->post('/login', ['email' => $user->email, 'password' => 'password123'])
            ->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($user);

        $this->post('/logout')->assertRedirect(route('login'));
        $this->assertGuest();
    }
}
