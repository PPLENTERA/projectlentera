<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LokasiBantuanTest extends DuskTestCase
{
    // TC.PETA.ADMIN.001 - Positive
    public function test_LokasiBantuanPositive()
    {
        $this->browse(function (Browser $browser) {

            $browser->visit('/login')
                    ->type('email', 'fr@gmail.com')
                    ->type('password', '12345678')
                    ->press('Masuk')
                    ->pause(3000)

                    ->visit('/admin/lokasi-bantuan')
                    ->pause(2000)

                    ->assertSee('Lokasi Bantuan')

                    ->screenshot('lokasi-bantuan-positive');
        });
    }

    // TC.PETA.ADMIN.002 - Negative
    public function test_LokasiBantuanNegative()
    {
        $this->browse(function (Browser $browser) {

            $browser->visit('/login')
                    ->type('email', 'fr@gmail.com')
                    ->type('password', '12345678')
                    ->press('Masuk')
                    ->pause(3000)

                    ->visit('/admin/lokasi-bantuan')
                    ->pause(2000)

                    ->press('Simpan Lokasi')
                    ->pause(2000)

                    ->assertSee('404')
                    ->assertSee('NOT FOUND')

                    ->screenshot('lokasi-bantuan-negative');
        });
    }
}