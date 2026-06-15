<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PetaBantuanTest extends DuskTestCase
{
    // TC.PETA.PUBLIK.001 - Positive
    public function test_PetaBantuanPositive()
    {
        $this->browse(function (Browser $browser) {

           $browser->visit('/login')
                    ->type('email', 'q@gmail.com')
                    ->type('password', '12345678')
                    ->press('Masuk')
                    ->pause(3000)
                    ->visit('/masyarakat/peta-bantuan')
                    ->pause(3000)

                    ->assertSee('Peta Bantuan')

                    ->screenshot('peta-bantuan-positive');
        });
    }

    // TC.PETA.PUBLIK.002 - Negative
    public function test_PetaBantuanNegative()
    {
        $this->browse(function (Browser $browser) {

            $browser->visit('/masyarakat/peta-bantuan')
                    ->pause(3000)

                    ->assertSee('Peta Bantuan')

                    ->screenshot('peta-bantuan-negative');
        });
    }
}