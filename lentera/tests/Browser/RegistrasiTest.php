<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegistrasiTest extends DuskTestCase
{
    // TC.Reg.001 - Positive
    public function test_registrasi_berhasil_dengan_data_valid()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->assertSee('Selamat Datang')
                    ->type('name', 'Ilham Test')
                    ->type('email', 'ilhamtest' . time() . '@gmail.com')
                    ->type('password', 'password123')
                    ->type('password_confirmation', 'password123')
                    ->press('Daftar')
                    ->assertPathIs('/login')
                    ->assertSee('Registrasi berhasil');
        });
    }

    // TC.Reg.002 - Negative
    public function test_registrasi_gagal_dengan_email_sudah_terdaftar()
    {
        User::factory()->create([
            'email' => 'existing@gmail.com',
            'password' => bcrypt('password123'),
        ]);

        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->assertSee('Selamat Datang')
                    ->type('name', 'User Test')
                    ->type('email', 'existing@gmail.com')
                    ->type('password', 'password123')
                    ->type('password_confirmation', 'password123')
                    ->press('Daftar')
                    ->assertPathIs('/register')
                    ->assertSee('has already been taken');
        });
    }
}
