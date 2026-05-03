<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PengajuanBantuanTest extends DuskTestCase
{
    private function loginAsMasyarakat(Browser $browser)
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

        return $user;
    }

    // TC.PBI10.001 - Positive
    public function test_pengajuan_bantuan_berhasil_dengan_data_lengkap()
    {
        $this->browse(function (Browser $browser) {
            $this->loginAsMasyarakat($browser);

            $browser->visit('/masyarakat/pengajuan/create')
                    ->assertSee('Pengajuan Bantuan')
                    ->assertSee('Langkah 1 dari 2')
                    ->select('jenis_bantuan', 'Bantuan Pangan')
                    ->type('penghasilan', '1500000')
                    ->type('jumlah_tanggungan', '3')
                    ->type('deskripsi_kebutuhan', 'Keluarga saya membutuhkan bantuan pangan')
                    ->press('Selanjutnya')
                    ->assertPathContains('/upload')
                    ->assertSee('Langkah 2 dari 2');
        });
    }

    // TC.PBI10.002 - Negative
    public function test_pengajuan_bantuan_gagal_form_kosong()
    {
        $this->browse(function (Browser $browser) {
            $this->loginAsMasyarakat($browser);

            $browser->visit('/masyarakat/pengajuan/create')
                    ->assertSee('Pengajuan Bantuan')
                    ->press('Selanjutnya')
                    ->assertPathIs('/masyarakat/pengajuan')
                    ->assertSee('required');
        });
    }
}