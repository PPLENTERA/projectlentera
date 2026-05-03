<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    // TC.Login.001 - Positive
    public function test_login_berhasil()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->assertSee('Selamat Datang')
                    ->type('email', 'budisantoso@gmail.com')
                    ->type('password', 'password')
                    ->press('Masuk')
                    ->assertPathIs('/masyarakat/dashboard')
                    ->assertSee('Ini halaman Dashboard Masyarakat.');
        });
    }

    // TC.Login.002 - Negative
    public function test_login_gagal()
    {
       $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->assertSee('Selamat Datang')
                    ->type('email', 'budisantoso@gmail.com')
                    ->type('password', 'password12')
                    ->press('Masuk')
                    ->assertSee('Email atau kata sandi salah.');
        });
    }
}
