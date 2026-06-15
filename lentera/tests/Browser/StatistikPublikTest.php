<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class StatistikPublikTest extends DuskTestCase
{
    // TC.STAT.PUBLIK.001 - Positive
    public function test_StatistikPublikPositive()
    {
        $this->browse(function (Browser $browser) {

            $browser->visit('/login')
                    ->type('email', 'q@gmail.com')
                    ->type('password', '12345678')
                    ->press('Masuk')
                    ->pause(3000)

                    ->visit('/masyarakat/statistik-publik')
                    ->pause(3000)

                    ->assertSee('Statistik')

                    ->screenshot('statistik-publik-positive');
        });
    }

    // TC.STAT.PUBLIK.002 - Negative
    public function test_StatistikPublikNegative()
    {
        $this->browse(function (Browser $browser) {

            $browser->visit('/masyarakat/statistik-publik')
                    ->pause(3000)

                    ->assertSee('Statistik')

                    ->screenshot('statistik-publik-negative');
        });
    }
}