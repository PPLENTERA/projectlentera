<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegistrasiTest extends DuskTestCase
{
    // TC.Reg.001 - Positive
    public function test_RegistrasiPositive()
    {

        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->assertPathIs('/register')
                    ->pause(3000)
                    ->assertSee('Selamat Datang')
                    ->type('name', 'Ilham Test3')
                    ->type('email', 'ilhamtest3' . time() . '@gmail.com')
                    ->type('password', 'password123')
                    ->type('password_confirmation', 'password123')
                    ->press('Daftar')
                    ->waitForLocation('/login', 15)
                    ->assertPathIs('/login');
        });
    }

    // TC.Reg.002 - Negative
    public function test_RegistrasiNegative()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->pause(2000)
                    ->assertSee('Selamat Datang')
                    ->type('name', 'User Test')
                    ->type('email', 'ilhamtest3@gmail.com')
                    ->type('password', 'password123')
                    ->type('password_confirmation', 'password123')
                    ->press('Daftar')
                    ->pause(2000)
                    ->assertPathIs('/register')
                    ->assertSee('has already been taken');
        });
    }
}