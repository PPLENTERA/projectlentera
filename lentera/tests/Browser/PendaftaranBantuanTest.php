<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PendaftaranBantuanTest extends DuskTestCase
{

    // TC.RegBantuan.001 - Positive
    public function test_pendaftaran_datadiri_berhasil()
    {
        $user = User::factory()->create([
        'email' => 'test' . time() . '@gmail.com',
        'password' => Hash::make('password'),
        'role' => 'masyarakat'
        ]);
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit('/masyarakat/pendaftaran/create')
                    ->assertSee('Formulir Pendaftaran Bantuan')
                    ->type('nama_lengkap', 'Budi Santoso')
                    ->type('tanggal_lahir', '2000-01-01')
                    ->select('jenis_kelamin', 'L')
                    ->type('nik', '1234567890123456')
                    ->type('nomor_kk', '1234567890123456')
                    ->type('nomor_hp', '081234567890')
                    ->type('alamat_lengkap', 'Jl. Testing No. 1')
                    ->press('Selanjutnya')
                    ->assertSee('Data Kondisi Ekonomi');
        });
    }

    // TC.RegBantuan.002 - Negative
    public function test_pendaftaran_datadiri_gagal()
    {
        $user = User::factory()->create([
        'email' => 'test' . time() . '@gmail.com',
        'password' => Hash::make('password'),
        'role' => 'masyarakat'
        ]);
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit('/masyarakat/pendaftaran/create')
                    ->assertSee('Formulir Pendaftaran Bantuan')
                    ->type('nama_lengkap', 'Budi Santoso')
                    ->type('tanggal_lahir', '2000-01-01')
                    ->select('jenis_kelamin', 'L')
                    ->type('nik', '1234567890123456')
                    ->type('nomor_kk', '1234567890123456')
                    ->type('nomor_hp', '081234567890')
                    ->type('alamat_lengkap', '')
                    ->press('Selanjutnya')
                     ->waitForDialog()
                    ->assertDialogOpened('Mohon lengkapi semua isian wajib di tahap ini.')
                    ->acceptDialog()
                    ->assertPathIs('/masyarakat/pendaftaran/create');
         });
    }
    // TC.RegBantuan.003 - Positive
    public function test_pendaftaran_ekonomi_berhasil()
    {
        $user = User::factory()->create([
        'email' => 'test' . time() . '@gmail.com',
        'password' => Hash::make('password'),
        'role' => 'masyarakat'
        ]);
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit('/masyarakat/pendaftaran/create')
                    ->assertSee('Formulir Pendaftaran Bantuan')
                    ->type('nama_lengkap', 'Budi Santoso')
                    ->type('tanggal_lahir', '2000-01-01')
                    ->select('jenis_kelamin', 'L')
                    ->type('nik', '1234567890123456')
                    ->type('nomor_kk', '1234567890123456')
                    ->type('nomor_hp', '081234567890')
                    ->type('alamat_lengkap', 'Jl. Testing No. 1')

                // PINDAH KE STEP 2
                    ->press('Selanjutnya')
                    ->waitFor('#step-2.step-active')

                // STEP 2
                    ->type('pekerjaan', 'Buruh Tani')
                    ->type('penghasilan_per_bulan', '2000000')
                    ->type('pengeluaran_bulanan', '1000000')
                    ->type('jumlah_tanggungan', '2')
                    ->select('status_rumah', 'Sewa/Kontrak');
             });
    }

    // TC.RegBantuan.004 - Negative
    public function test_pendaftaran_ekonomi_gagal()
    {
        $user = User::factory()->create([
        'email' => 'test' . time() . '@gmail.com',
        'password' => Hash::make('password'),
        'role' => 'masyarakat'
        ]);
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit('/masyarakat/pendaftaran/create')
                    ->assertSee('Formulir Pendaftaran Bantuan')
                    ->type('nama_lengkap', 'Budi Santoso')
                    ->type('tanggal_lahir', '2000-01-01')
                    ->select('jenis_kelamin', 'L')
                    ->type('nik', '1234567890123456')
                    ->type('nomor_kk', '1234567890123456')
                    ->type('nomor_hp', '081234567890')
                    ->type('alamat_lengkap', 'Jl. Testing No. 1')

                // PINDAH KE STEP 2
                    ->press('Selanjutnya')
                    ->waitFor('#step-2.step-active')

                // STEP 2
                    ->type('pekerjaan', 'Buruh Tani')
                    ->type('penghasilan_per_bulan', '2000000')
                    ->type('pengeluaran_bulanan', '1000000')
                    ->type('jumlah_tanggungan', '')
                    ->select('status_rumah', 'Sewa/Kontrak')
                    ->press('Selanjutnya')
                     ->waitForDialog()
                    ->assertDialogOpened('Mohon lengkapi semua isian wajib di tahap ini.')
                    ->acceptDialog()
                    ->assertPathIs('/masyarakat/pendaftaran/create');
             });
    }

    // TC.RegBantuan.005 - Positive
    public function test_pendaftaran_dokumen_berhasil()
    {
        $user = User::factory()->create([
            'email' => 'test' . time() . '@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'masyarakat'
        ]);

        $this->browse(function (Browser $browser) use ($user) {

            $browser->loginAs($user)
                ->visit('/masyarakat/pendaftaran/create')
                ->assertSee('Formulir Pendaftaran Bantuan')

                // STEP 1
                ->type('nama_lengkap', 'Budi Santoso')
                ->type('tanggal_lahir', '2000-01-01')
                ->select('jenis_kelamin', 'L')
                ->type('nik', '1234567890123456')
                ->type('nomor_kk', '1234567890123456')
                ->type('nomor_hp', '081234567890')
                ->type('alamat_lengkap', 'Jl. Testing No. 1')

                // STEP 2
                ->press('Selanjutnya')
                ->waitFor('#step-2.step-active')
                ->type('pekerjaan', 'Buruh Tani')
                ->type('penghasilan_per_bulan', '2000000')
                ->type('pengeluaran_bulanan', '1000000')
                ->type('jumlah_tanggungan', '2')
                ->select('status_rumah', 'Sewa/Kontrak')

                // STEP 3
                ->press('Selanjutnya')
                ->waitFor('#step-3.step-active')
                ->attach('dokumen_ktp', __DIR__ . '/files/test_ktp.jpg')
                ->attach('dokumen_kk', __DIR__ . '/files/test_kk.jpg')
                ->attach('dokumen_rumah', __DIR__ . '/files/test_rumah.jpg')
                ->attach('dokumen_sktm', __DIR__ . '/files/test_sktm.jpg')
                ->press('Ajukan Pendaftaran');
        });
    }

    // TC.RegBantuan.004 - Negative
    public function test_pendaftaran_dokumen_gagal()
    {
        $user = User::factory()->create([
            'email' => 'test' . time() . '@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'masyarakat'
        ]);

        $this->browse(function (Browser $browser) use ($user) {

            $browser->loginAs($user)
                ->visit('/masyarakat/pendaftaran/create')
                ->assertSee('Formulir Pendaftaran Bantuan')

                // STEP 1
                ->type('nama_lengkap', 'Budi Santoso')
                ->type('tanggal_lahir', '2000-01-01')
                ->select('jenis_kelamin', 'L')
                ->type('nik', '1234567890123456')
                ->type('nomor_kk', '1234567890123456')
                ->type('nomor_hp', '081234567890')
                ->type('alamat_lengkap', 'Jl. Testing No. 1')

                // STEP 2
                ->press('Selanjutnya')
                ->waitFor('#step-2.step-active')
                ->type('pekerjaan', 'Buruh Tani')
                ->type('penghasilan_per_bulan', '2000000')
                ->type('pengeluaran_bulanan', '1000000')
                ->type('jumlah_tanggungan', '2')
                ->select('status_rumah', 'Sewa/Kontrak')

                // STEP 3
                ->press('Selanjutnya')
                ->waitFor('#step-3.step-active')
                ->attach('dokumen_ktp', __DIR__ . '/files/test_ktp.jpg')
                ->attach('dokumen_kk', __DIR__ . '/files/test_kk.jpg')
                ->attach('dokumen_rumah', __DIR__ . '/files/test_rumah.jpg')
                ->press('Ajukan Pendaftaran')
                ->assertPathIs('/masyarakat/pendaftaran/create');
        });
    }
}