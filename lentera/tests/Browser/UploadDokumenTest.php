<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UploadDokumenTest extends DuskTestCase
{
    private function loginAndCreatePengajuan(Browser $browser)
    {
        $user = User::factory()->create([
            'email'    => 'masyarakat' . time() . '@gmail.com',
            'password' => bcrypt('password123'),
            'role'     => 'masyarakat',
        ]);

        $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', 'password123')
                ->press('Masuk')
                ->assertPathIs('/masyarakat/dashboard');

        $pengajuan = PengajuanBantuan::create([
            'id_users'          => $user->id,
            'jenis_bantuan'     => 'Bantuan Pangan',
            'jumlah_tanggungan' => 3,
            'penghasilan'       => 1500000,
            'deskripsi_kebutuhan' => 'Test pengajuan',
            'status_pengajuan'  => 'pending',
            'tanggal_pengajuan' => now()->toDateString(),
        ]);

        return $pengajuan;
    }

    // TC.PBI11.001 - Positive
    public function test_upload_dokumen_berhasil_dengan_file_valid()
    {
        $this->browse(function (Browser $browser) {
            $pengajuan = $this->loginAndCreatePengajuan($browser);

            $browser->visit('/masyarakat/pengajuan/' . $pengajuan->id_pengajuan . '/upload')
                    ->assertSee('Upload Dokumen')
                    ->assertSee('Langkah 2 dari 2')
                    ->attach('dokumen[ktp]', __DIR__ . '/files/test_ktp.jpg')
                    ->attach('dokumen[kk]', __DIR__ . '/files/test_kk.jpg')
                    ->attach('dokumen[sktm]', __DIR__ . '/files/test_sktm.jpg')
                    ->press('Kirim Pengajuan')
                    ->assertPathIs('/masyarakat/pengajuan')
                    ->assertSee('Pengajuan berhasil dikirim');
        });
    }

    // TC.PBI11.002 - Negative
    public function test_upload_dokumen_gagal_tanpa_file()
    {
        $this->browse(function (Browser $browser) {
            $pengajuan = $this->loginAndCreatePengajuan($browser);

            $browser->visit('/masyarakat/pengajuan/' . $pengajuan->id_pengajuan . '/upload')
                    ->assertSee('Upload Dokumen')
                    ->press('Kirim Pengajuan')
                    ->assertPathContains('/upload')
                    ->assertSee('required');
        });
    }
}