<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ValidasiDokumenTest extends DuskTestCase
{
    private function loginAsAdmin(Browser $browser)
    {
        $admin = User::factory()->create([
            'email'    => 'admin' . time() . '@gmail.com',
            'password' => bcrypt('password123'),
            'role'     => 'admin',
        ]);

        $browser->visit('/login')
                ->type('email', $admin->email)
                ->type('password', 'password123')
                ->press('Masuk')
                ->assertPathIs('/admin/dashboard');

        return $admin;
    }

    private function createPengajuan()
    {
        $user = User::factory()->create([
            'email'    => 'masyarakat' . time() . '@gmail.com',
            'password' => bcrypt('password123'),
            'role'     => 'masyarakat',
        ]);

        return PengajuanBantuan::create([
            'id_users'            => $user->id,
            'jenis_bantuan'       => 'Bantuan Pangan',
            'jumlah_tanggungan'   => 3,
            'penghasilan'         => 1500000,
            'deskripsi_kebutuhan' => 'Test pengajuan untuk validasi',
            'status_pengajuan'    => 'pending',
            'tanggal_pengajuan'   => now()->toDateString(),
        ]);
    }

    // TC.PBI8.001 - Positive
    public function test_admin_validasi_dokumen_berhasil()
    {
        $this->browse(function (Browser $browser) {
            $this->loginAsAdmin($browser);
            $pengajuan = $this->createPengajuan();

            $browser->visit('/admin/validasi')
                    ->assertSee('Validasi & Verifikasi')
                    ->assertSee('Daftar Pengajuan Masuk')
                    ->clickLink('Periksa')
                    ->assertPathContains('/admin/validasi/')
                    ->assertSee('Detail Pengajuan')
                    ->select('status_validasi', 'valid')
                    ->type('catatan', 'Dokumen lengkap dan valid')
                    ->press('Simpan Validasi')
                    ->assertPathIs('/admin/validasi')
                    ->assertSee('Validasi berhasil disimpan');
        });
    }

    // TC.PBI8.002 - Negative
    public function test_admin_validasi_gagal_tanpa_pilih_status()
    {
        $this->browse(function (Browser $browser) {
            $this->loginAsAdmin($browser);
            $pengajuan = $this->createPengajuan();

            $browser->visit('/admin/validasi/' . $pengajuan->id_pengajuan)
                    ->assertSee('Detail Pengajuan')
                    ->press('Simpan Validasi')
                    ->assertPathContains('/admin/validasi/')
                    ->assertSee('required');
        });
    }
}