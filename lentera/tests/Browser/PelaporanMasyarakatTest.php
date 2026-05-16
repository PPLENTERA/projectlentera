<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\LaporanPenyalahgunaan;

class PelaporanMasyarakatTest extends DuskTestCase
{
    /**
     * TC.Pelaporan.001
     * Menguji fungsionalitas pengiriman laporan penyalahgunaan (Positive)
     */
    public function test_tc_pelaporan_001()
    {
        $user = User::factory()->create(['role' => 'masyarakat']);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit('/masyarakat/pelaporan') 
                    ->type('deskripsi_kejadian', 'Terjadi pungli bantuan di Desa')
                    ->attach('bukti', __DIR__.'/stubs/bukti.png')
                    ->type('lokasi_kejadian', 'Wilayah A')
                    ->press('Kirim Laporan')
                    ->assertPathIs('/masyarakat/pelaporan')
                    ->assertSee('Laporan penyalahgunaan berhasil dikirim. Terima kasih atas partisipasi Anda.');
        });
    }

    /**
     * TC.Pelaporan.002
     * Menguji validasi input formulir pelaporan (Negative)
     */
    public function test_tc_pelaporan_002()
    {
        $user = User::factory()->create(['role' => 'masyarakat']);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit('/masyarakat/pelaporan')
                    ->pause(1000) // Memberi waktu render agar tidak Stale
                    ->script("document.querySelector('form').setAttribute('novalidate', 'novalidate');");
            
            $browser->pause(500)
                    ->clear('deskripsi_kejadian') 
                    ->press('Kirim Laporan')
                    // Menggunakan waitForText agar menunggu halaman selesai reload
                    ->waitForText('The deskripsi kejadian field is required.', 5);
        });
    }

    /**
     * TC.Pelaporan.003
     * Menguji proses validasi laporan oleh Admin (Positive)
     */
    public function test_tc_pelaporan_003()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $masyarakat = User::factory()->create(['role' => 'masyarakat']);
        
        LaporanPenyalahgunaan::create([
            'user_id' => $masyarakat->id,
            'deskripsi_kejadian' => 'Bukti fiktif',
            'lokasi_kejadian' => 'Wilayah Test',
            'status' => 'menunggu_tindak_lanjut',
            'tanggal_kejadian' => now()
        ]);

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                    ->visit('/admin/laporan')
                    ->pause(3000) // Beri jeda fisik 3 detik untuk render sempurna
                    ->waitForText('Laporan', 15) // Tunggu lebih lama
                    ->assertPathIs('/admin/laporan')
                    ->clickLink('Periksa')
                    ->waitForText('Detail', 10)
                    ->select('status', 'selesai')
                    ->press('Simpan Perubahan Status')
                    ->waitForText('berhasil', 10);
        });
    }

    /** 
     * TC.Pelaporan.004
     * Menguji keamanan akses fitur validasi (Negative)
     */
    public function test_tc_pelaporan_004()
    {
        $user = User::factory()->create(['role' => 'masyarakat']);

        $this->browse(function (Browser $browser) use ($user) {
            // Mencoba akses URL admin tanpa izin (sebagai masyarakat)
            $browser->loginAs($user)
                    ->visit('/admin/laporan')
                    ->assertSee('403')
                    ->assertSee('UNAUTHORIZED ACCESS');
        });
    }

    /**
     * TC.Pelaporan.005
     * Menguji visibilitas statistik titik rawan (Positive)
     */
    public function test_tc_pelaporan_005()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        
        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                    ->visit('/admin/laporan')
                    // Gunakan teks kapital sesuai yang terlihat di layar untuk menghindari case-sensitivity error
                    ->waitForText('STATISTIK TITIK RAWAN PER WILAYAH', 15)
                    ->assertSee('STATISTIK TITIK RAWAN PER WILAYAH')
                    // Karena chart butuh waktu render, pastikan ID-nya benar-benar muncul
                    ->waitFor('#chartWilayah', 15)
                    ->assertVisible('#chartWilayah')
                    ->assertSee('10 WILAYAH TERATAS');
        });
    }

    /**
     * TC.Pelaporan.006
     * Menguji penanganan data kosong pada statistik (Negative)
     */
    public function test_tc_pelaporan_006()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        
        $this->browse(function (Browser $browser) use ($admin) {
            // Kita asumsikan tidak ada laporan di database, sehingga tabel dan statistik kosong
            LaporanPenyalahgunaan::query()->delete();

            $browser->loginAs($admin)
                    ->visit('/admin/laporan')
                    ->assertSee('Belum ada data wilayah.')
                    ->assertSee('Belum ada laporan penyalahgunaan masuk.');
        });
    }
}