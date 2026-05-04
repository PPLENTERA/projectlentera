<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class PengajuanBantuanTest extends DuskTestCase
{
    private function loginAsMasyarakat(Browser $browser)
    {
        $browser->visit('/login')
                ->pause(2000)
                ->type('email', 'ilhamtest2@gmail.com')
                ->type('password', 'password123')
                ->press('Masuk')
                ->pause(2000);
    }

    // TC.PBI10.001 - Positive
    public function test_PengajuanPositive()
    {
        $this->browse(function (Browser $browser) {
            $this->loginAsMasyarakat($browser);

            $browser->visit('/masyarakat/pengajuan/create')
                    ->pause(2000)
                    ->assertSee('Pengajuan Bantuan')
                    ->assertSee('Langkah 1 dari 2')
                    ->select('jenis_bantuan', 'Bantuan Pangan')
                    ->type('penghasilan', '1500000')
                    ->type('jumlah_tanggungan', '3')
                    ->type('deskripsi_kebutuhan', 'Keluarga saya membutuhkan bantuan pangan')
                    ->press('Selanjutnya')
                    ->pause(2000)
                    ->assertPathContains('/upload')
                    ->assertSee('Langkah 2 dari 2');
        });
    }

    // TC.PBI10.002 - Negative
    public function test_PengajuanNegative()
    {
        $this->browse(function (Browser $browser) {
            $this->loginAsMasyarakat($browser);

            $browser->visit('/masyarakat/pengajuan/create')
                    ->pause(2000)
                    ->assertSee('Pengajuan Bantuan')
                    ->press('Selanjutnya')
                    ->pause(2000)
                    ->assertPathIs('/masyarakat/pengajuan/create');
        });
    }
}