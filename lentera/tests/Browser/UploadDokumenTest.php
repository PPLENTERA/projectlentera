<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\PengajuanBantuan;

class UploadDokumenTest extends DuskTestCase
{
    private function loginAsMasyarakat(Browser $browser)
    {
        $browser->visit('/login')
                ->pause(2000)
                ->type('email', 'ilhamtest2@gmail.com')
                ->type('password', 'password123')
                ->press('Masuk')
                ->pause(3000);
    }

    private function getPengajuanId()
    {
        $user = User::where('email', 'ilhamtest2@gmail.com')->first();

        $pengajuan = PengajuanBantuan::firstOrCreate(
            ['id_users' => $user->id],
            [
                'jenis_bantuan'       => 'Bantuan Pangan',
                'jumlah_tanggungan'   => 3,
                'penghasilan'         => 1500000,
                'deskripsi_kebutuhan' => 'Test upload dokumen',
                'status_pengajuan'    => 'pending',
                'tanggal_pengajuan'   => now()->toDateString(),
            ]
        );

        $pengajuan->dokumen()->delete();
        
        return $pengajuan->id_pengajuan;
    }

    // TC.PBI11.001 - Positive
    public function test_UploadDokumenPositive()
    {
        $this->browse(function (Browser $browser) {
            $this->loginAsMasyarakat($browser);
            $id = $this->getPengajuanId();

            $browser->visit('/masyarakat/pengajuan/' . $id . '/upload')
                    ->pause(2000)
                    ->assertSee('Upload Dokumen')
                    ->assertSee('Langkah 2 dari 2')
                    ->attach('dokumen[ktp]', __DIR__ . '/files/test_ktp.jpg')
                    ->attach('dokumen[kk]', __DIR__ . '/files/test_kk.jpg')
                    ->attach('dokumen[sktm]', __DIR__ . '/files/test_sktm.jpg')
                    ->press('Kirim Pengajuan')
                    ->pause(3000)
                    ->assertPathIs('/masyarakat/pengajuan')
                    ->assertSee('Pengajuan berhasil dikirim');
        });
    }

    // TC.PBI11.002 - Negative
    public function test_UploadDokumenNegative()
    {
        $this->browse(function (Browser $browser) {
            $this->loginAsMasyarakat($browser);
            $id = $this->getPengajuanId();

            $browser->visit('/masyarakat/pengajuan/' . $id . '/upload')
                    ->pause(2000)
                    ->assertSee('Upload Dokumen');

            $browser->script("document.querySelectorAll('[required]').forEach(el => el.removeAttribute('required'));");

            $browser->press('Kirim Pengajuan')
                    ->pause(2000)
                    ->assertPathIs('/masyarakat/pengajuan/' . $id . '/upload');
        });
    }
}