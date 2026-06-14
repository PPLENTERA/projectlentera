<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class DashboardTest extends DuskTestCase
{
    /**
     * PBI #27 - TC.Dashboard.001
     * Admin melihat statistik distribusi bantuan
     */
    public function testStatistikDistribusi(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                    ->visit('/admin/dashboard')
                    ->pause(1000)
                    ->assertSee('Monitoring Distribusi Bantuan')
                    ->assertSee('TOTAL PENGAJUAN')
                    ->assertSee('DISETUJUI')
                    ->assertSee('RATA-RATA SCORE KELAYAKAN')
                    ->assertSee('PENDAFTARAN WARGA');
        });
    }

    /**
     * PBI #27 - TC.Dashboard.002
     * Masyarakat melihat status bantuan pribadi
     */
    public function testStatusBantuanPribadi(): void
    {
        $user = User::factory()->create([
            'role' => 'masyarakat',
        ]);

        $this->createPendaftaranBantuan($user);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit('/masyarakat/dashboard')
                    ->assertSee('Selamat datang kembali')
                    ->assertSee('PENGAJUAN PENDING')
                    ->assertSee('DISETUJUI')
                    ->assertSee('DITOLAK');
        });
    }

    /**
     * PBI #28 - TC.Dashboard.003
     * Admin melihat grafik distribusi bantuan
     */
    public function testGrafikDistribusiBantuanAdmin(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                    ->visit('/admin/dashboard')
                    ->assertSee('Progres Verifikasi per Wilayah')
                    ->assertSee('Penyaluran Bantuan Bulanan')
                    ->assertSee('Kategori Bantuan');
        });
    }

    /**
     * PBI #28 - TC.Dashboard.004
     * Masyarakat melihat grafik distribusi bantuan
     */
    public function testGrafikDistribusiBantuanMasyarakat(): void
    {
        $user = User::factory()->create([
            'role' => 'masyarakat',
        ]);

        $this->createPendaftaranBantuan($user);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit('/masyarakat/dashboard')
                    ->assertSee('Progress Bantuan per Wilayah')
                    ->assertSee('Penyaluran Bantuan Bulanan')
                    ->assertSee('Kategori Bantuan');
        });
    }

    /**
     * PBI #29 - TC.Dashboard.005
     * Admin melihat laporan terbaru
     */
    public function testLaporanTerbaru(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                    ->visit('/admin/dashboard')
                    ->assertSee('Laporan Terkini');
        });
    }

    /**
     * PBI #29 - TC.Dashboard.006
     * Ringkasan laporan saat tidak ada data
     */
    public function testLaporanKosong(): void
    {
        $user = User::factory()->create([
            'role' => 'masyarakat',
        ]);

        $this->createPendaftaranBantuan($user);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit('/masyarakat/dashboard')
                    ->assertSee('Riwayat Laporan Penyalahgunaan');
        });
    }

    /**
     * PBI #30 - TC.Export.007
     * Admin berhasil export laporan CSV
     */
    public function testExportLaporan(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                    ->visit('/admin/dashboard')
                    ->assertSee('Export CSV')
                    ->clickLink('Export CSV');
        });
    }

    /**
     * PBI #30 - TC.Export.008
     * Admin export saat data laporan kosong
     */
    public function testExportLaporanKosong(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                    ->visit('/admin/dashboard')
                    ->assertSee('Export CSV')
                    ->clickLink('Export CSV');
        });
    }

    private function createPendaftaranBantuan($user): void
    {
        \App\Models\PendaftaranBantuan::unguard();
        \App\Models\PendaftaranBantuan::insert([
            'user_id' => $user->id,
            'status' => 'disetujui',
            'nama_lengkap' => $user->name,
            'tanggal_lahir' => '1990-01-01',
            'nik' => '1234567890123456',
            'nomor_kk' => '1234567890123456',
            'nomor_hp' => '081234567890',
            'jenis_kelamin' => 'Laki-laki',
            'alamat_lengkap' => 'Desa Bojongsoang, Kab Bandung',
            'pekerjaan' => 'Buruh',
            'penghasilan_per_bulan' => 1000000,
            'pengeluaran_bulanan' => 500000,
            'jumlah_tanggungan' => 2,
            'status_rumah' => 'Sewa',
            'dokumen_ktp' => 'ktp.jpg',
            'dokumen_kk' => 'kk.jpg',
            'dokumen_rumah' => 'rumah.jpg',
            'dokumen_sktm' => 'sktm.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        \App\Models\PendaftaranBantuan::reguard();
    }
}