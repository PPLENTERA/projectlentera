<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class UploadBuktiPendukungTest extends DuskTestCase
{
    private function loginAsMasyarakat(Browser $browser)
    {
        $browser->visit('/logout')
                ->pause(1000);

        $user = User::firstOrCreate(
            ['email' => 'ilham3@gmail.com'],
            [
                'name'     => 'ilham3',
                'password' => bcrypt('password123'),
                'role'     => 'masyarakat',
            ]
        );

        $browser->loginAs($user, 'web')
                ->visit('/masyarakat/pengajuan/create')
                ->pause(2000);
    }

    public function test_UploadBuktiPendukungPositive()
    {
        $this->browse(function (Browser $browser) {
            $this->loginAsMasyarakat($browser);

            $browser->visit('/masyarakat/pengajuan/create')
                    ->pause(2000)
                    ->assertSee('Pengajuan Bantuan')
                    ->type('nama_lengkap', 'Ilham Testing')
                    ->type('nik', '1234567890123456')
                    ->select('jenis_bantuan', 'Bantuan Pangan')
                    ->type('deskripsi_kebutuhan', 'Test upload bukti pendukung')
                    ->attach('bukti_pendukung', __DIR__ . '/files/test_ktp.jpg')
                    ->press('Kirim Pengajuan Bantuan')
                    ->pause(3000)
                    ->assertSee('Pengajuan Saya');
        });
    }

    public function test_UploadBuktiPendukungNegative()
    {
        $this->browse(function (Browser $browser) {
            $this->loginAsMasyarakat($browser);

            $browser->visit('/masyarakat/pengajuan/create')
                    ->pause(2000)
                    ->assertSee('Pengajuan Bantuan')
                    ->type('nama_lengkap', 'Ilham Testing')
                    ->type('nik', '1234567890123456')
                    ->select('jenis_bantuan', 'Bantuan Pangan')
                    ->type('deskripsi_kebutuhan', 'Test upload format salah');

            $browser->script("
                document.querySelector('input[name=\"bukti_pendukung\"]').removeAttribute('accept');
            ");

            $browser->attach('bukti_pendukung', __DIR__ . '/files/file_invalid.txt')
                    ->press('Kirim Pengajuan Bantuan')
                    ->pause(3000)
                    ->assertSee('The bukti pendukung field must be a file of type: pdf, jpg, jpeg, png.');
        });
    }
}