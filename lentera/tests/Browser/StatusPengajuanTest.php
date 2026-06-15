<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\PengajuanBantuan;

class StatusPengajuanTest extends DuskTestCase
{
    private function loginAsMasyarakat(Browser $browser)
    {
        $user = User::firstOrCreate(
            ['email' => 'ilham2@gmail.com'],
            [
                'name'     => 'ilham2',
                'password' => bcrypt('password123'),
                'role'     => 'masyarakat',
            ]
        );

        $browser->loginAs($user, 'web')
                ->visit('/masyarakat/pengajuan')
                ->pause(2000);
    }

    private function getPengajuanId()
    {
        $user = User::where('email', 'ilham2@gmail.com')->first();

        $pengajuan = PengajuanBantuan::firstOrCreate(
            ['id_users' => $user->id],
            [
                'nama_lengkap'        => 'ilham2',
                'nik'                 => '1234567890123456',
                'jenis_bantuan'       => 'Bantuan Pangan',
                'jumlah_tanggungan'   => 3,
                'penghasilan'         => 1500000,
                'deskripsi_kebutuhan' => 'Test status pengajuan',
                'status_pengajuan'    => 'pending',
                'tanggal_pengajuan'   => now()->toDateString(),
            ]
        );

        return $pengajuan->id_pengajuan;
    }

    // TC.PBI33.001 - Positive
    public function test_StatusPengajuanPositive()
    {
        $this->browse(function (Browser $browser) {
            $this->loginAsMasyarakat($browser);
            $id = $this->getPengajuanId();

            $browser->visit('/masyarakat/pengajuan')
                    ->pause(2000)
                    ->assertSee('Riwayat & Status')
                    ->assertSee('Bantuan Pangan')
                    ->click('tr[onclick]')
                    ->pause(1000)
                    ->assertSee('Detail Progress')
                    ->assertSee('Permohonan Dikirim');
        });
    }

    // TC.PBI33.002 - Negative
    public function test_StatusPengajuanSearchNegative()
    {
        $this->browse(function (Browser $browser) {
            $this->loginAsMasyarakat($browser);

            $browser->visit('/masyarakat/pengajuan')
                    ->pause(2000)
                    ->assertSee('Riwayat & Status')
                    ->type('search', 'Bantuan XYZ')
                    ->keys('input[name="search"]', '{enter}')
                    ->pause(2000)
                    ->assertSee('Belum ada pengajuan bantuan');
        });
    }
}