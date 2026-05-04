<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\PengajuanBantuan;

class ValidasiDokumenTest extends DuskTestCase
{
    private function loginAsAdmin(Browser $browser)
    {
        $browser->visit('/')
                ->pause(1000);

        try {
            $browser->press('Logout')->pause(1000);
        } catch (\Exception $e) {
        }

        $browser->visit('/login')
                ->waitFor('input[name=email]', 5)
                ->type('email', 'adminlentera@gmail.com')
                ->type('password', 'password')
                ->press('Masuk')
                ->pause(3000)
                ->assertPathIsNot('/login')
                ->visit('/admin/validasi')
                ->waitForText('Validasi', 5);
    }

    private function getPengajuanId()
    {
        $pengajuan = PengajuanBantuan::latest()->first();

        if (!$pengajuan) {
            $user = User::factory()->create([
                'role' => 'masyarakat',
            ]);

            $pengajuan = PengajuanBantuan::create([
                'id_users'            => $user->id,
                'jenis_bantuan'       => 'Bantuan Pangan',
                'jumlah_tanggungan'   => 3,
                'penghasilan'         => 1500000,
                'deskripsi_kebutuhan' => 'Test pengajuan untuk validasi',
                'status_pengajuan'    => 'pending',
                'tanggal_pengajuan'   => now()->toDateString(),
            ]);
        }

        return $pengajuan->id_pengajuan;
    }

    // TC.PBI8.001 - Positive
    public function test_ValidasiDokumenPositive()
    {
        $this->browse(function (Browser $browser) {
            $this->loginAsAdmin($browser);
            $id = $this->getPengajuanId();

            $browser->assertSee('Validasi')
                    ->assertSee('PENGAJUAN') 
                    ->visit('/admin/validasi/' . $id)
                    ->waitForText('Detail Pengajuan', 5)
                    ->assertSee('Detail Pengajuan')
                    ->select('status_validasi', 'valid')
                    ->type('catatan', 'Dokumen lengkap dan valid')
                    ->press('Simpan Validasi')
                    ->waitForLocation('/admin/validasi', 5)
                    ->assertSee('Validasi berhasil disimpan');
        });
    }

    // TC.PBI8.002 - Negative
    public function test_ValidasiDokumenNegative()
    {
        $this->browse(function (Browser $browser) {
            $this->loginAsAdmin($browser);
            $id = $this->getPengajuanId();

            $browser->visit('/admin/validasi/' . $id)
                    ->waitForText('Detail Pengajuan', 5)
                    ->assertSee('Detail Pengajuan');

            $browser->script("document.querySelectorAll('[required]').forEach(el => el.removeAttribute('required'));");

            $browser->press('Simpan Validasi')
                    ->pause(1000)
                    ->assertPathIs('/admin/validasi/' . $id);
        });
    }
}