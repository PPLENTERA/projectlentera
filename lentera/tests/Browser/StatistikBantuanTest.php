<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class StatistikBantuanTest extends DuskTestCase
{
    // TC.STAT.ADMIN.001 - Positive
    public function test_StatistikBantuanPositive()
    {
        $this->browse(function (Browser $browser) {

            $browser->visit('/login')
                    ->type('email', 'fr@gmail.com')
                    ->type('password', '12345678')
                    ->press('Masuk')
                    ->pause(3000)

                    ->visit('/admin/statistik-bantuan')
                    ->pause(3000)

                    ->assertSee('Statistik Distribusi Bantuan')

                    ->screenshot('statistik-bantuan-positive');
        });
    }

    // TC.STAT.ADMIN.002 - Negative
    public function test_StatistikBantuanNegative()
    {
        $this->browse(function (Browser $browser) {

            $browser->visit('/admin/statistik-bantuan')
                    ->pause(3000)

                    ->assertSee('Total Bantuan')

                    ->screenshot('statistik-bantuan-negative');
        });
    }
}