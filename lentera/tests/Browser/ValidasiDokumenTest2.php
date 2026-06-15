<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\PengajuanBantuan;

class ValidasiDokumenTest2 extends DuskTestCase
{
    private function loginAsAdmin(Browser $browser)
    {
        $browser->visit('/logout')
                ->pause(1000);

        $admin = User::firstOrCreate(
            ['email' => 'adminlentera@gmail.com'],
            [
                'name'     => 'Admin',
                'password' => bcrypt('password'),
                'role'     => 'admin',
            ]
        );

        $browser->loginAs($admin, 'web')
                ->visit('/admin/validasi')
                ->waitForText('Validasi Pengajuan Bantuan', 10);
    }

    private function getPengajuanId()
    {
        $user = User::firstOrCreate(
            ['email' => 'ilham2@gmail.com'],
            [
                'name'     => 'ilham2',
                'password' => bcrypt('password123'),
                'role'     => 'masyarakat',
            ]
        );

        $pengajuan = PengajuanBantuan::firstOrCreate(
            ['id_users' => $user->id],
            [
                'nama_lengkap'        => 'ilham2',
                'nik'                 => '1234567890123456',
                'jenis_bantuan'       => 'Bantuan Pangan',
                'jumlah_tanggungan'   => 3,
                'penghasilan'         => 1500000,
                'deskripsi_kebutuhan' => 'Test validasi dokumen',
                'status_pengajuan'    => 'pending',
                'tanggal_pengajuan'   => now()->toDateString(),
            ]
        );

        return $pengajuan->id_pengajuan;
    }

    // TC.PBI32.001 - Positive
    public function test_ValidasiDokumenFilterPositive()
    {
        $this->browse(function (Browser $browser) {
            $this->loginAsAdmin($browser);
            $this->getPengajuanId();

            $browser->waitForText('Validasi Pengajuan Bantuan', 10)
                    ->select('jenis_bantuan', 'Bantuan Pangan')
                    ->press('Terapkan')
                    ->pause(2000)
                    ->assertSee('Bantuan Pangan')
                    ->clickLink('Periksa')
                    ->pause(2000)
                    ->select('status_validasi', 'tidak_valid')
                    ->type('catatan', 'Dokumen tidak lengkap')
                    ->press('Simpan Validasi')
                    ->pause(2000)
                    ->assertPathIs('/admin/validasi')
                    ->assertSee('Validasi berhasil disimpan');
        });
    }

    // TC.PBI32.002 - Negative
    public function test_ValidasiDokumenFilterNegative()
    {
        $this->browse(function (Browser $browser) {
            $this->loginAsAdmin($browser);

            $browser->waitForText('Validasi Pengajuan Bantuan', 10)
                    ->select('status', 'diverifikasi')
                    ->select('jenis_bantuan', 'Bantuan Perumahan')
                    ->press('Terapkan')
                    ->pause(2000)
                    ->assertSee('Belum ada pengajuan masuk');
        });
    }
}