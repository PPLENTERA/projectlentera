<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\PengajuanBantuan;

class ValidasiVerifikasiTest2 extends DuskTestCase
{
    private function loginAsAdmin(Browser $browser)
    {
        $admin = User::updateOrCreate(
            ['email' => 'adminlentera@gmail.com'],
            [
                'name'     => 'Admin',
                'password' => 'password',
                'role'     => 'admin',
            ]
        );

        $browser->loginAs($admin, 'web')
                ->visit('/admin/validasi')
                ->pause(3000);
    }

    private function getPengajuanId()
    {
        $user = User::updateOrCreate(
            ['email' => 'ilham2@gmail.com'],
            [
                'name'     => 'ilham2',
                'password' => 'password123',
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
                'deskripsi_kebutuhan' => 'Test verifikasi data',
                'status_pengajuan'    => 'pending',
                'tanggal_pengajuan'   => now()->toDateString(),
            ]
        );

        $pengajuan->update(['status_pengajuan' => 'pending']);

        return $pengajuan->id_pengajuan;
    }

    public function test_ValidasiVerifikasiPositive()
    {
        $this->browse(function (Browser $browser) {
            $this->loginAsAdmin($browser);
            $this->getPengajuanId();

            $browser->waitForText('Validasi Pengajuan Bantuan', 10)
                    ->clickLink('Periksa')
                    ->pause(1000)
                    ->waitForText('Detail Pengajuan', 10)
                    ->assertSee('Detail Pengajuan')
                    ->waitFor('select[name="status_validasi"]', 10)
                    ->assertPresent('select[name="status_validasi"]')
                    ->select('status_validasi', 'valid')
                    ->type('catatan', 'Data lengkap dan valid')
                    ->press('Simpan Validasi')
                    ->pause(3000)
                    ->assertPathIs('/admin/validasi')
                    ->assertSee('Validasi berhasil disimpan');
        });
    }

    // TC.PBI31.002 - Negative
    public function test_ValidasiVerifikasiNegative()
    {
        $this->browse(function (Browser $browser) {
            $this->loginAsAdmin($browser);
            $id = $this->getPengajuanId();

            $browser->visit('/admin/validasi/' . $id)
                    ->pause(1000)
                    ->waitForText('Detail Pengajuan', 10)
                    ->assertSee('Detail Pengajuan')
                    ->waitFor('select[name="status_validasi"]', 10)
                    ->assertPresent('select[name="status_validasi"]');

            $browser->script("document.querySelectorAll('[required]').forEach(el => el.removeAttribute('required'));");

            $browser->press('Simpan Validasi')
                    ->pause(2000)
                    ->assertPathIs('/admin/validasi/' . $id);
        });
    }
}