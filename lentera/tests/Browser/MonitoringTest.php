<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\PendaftaranBantuan;
use App\Models\PengajuanBantuan;

class MonitoringTest extends TestCase
{
    use RefreshDatabase;

    private function setupTestData(): array
    {
        // Setup Admin
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@lentera.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Setup User 1 (Bojongsoang, Jawa Barat)
        $user1 = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@lentera.com',
            'password' => bcrypt('password'),
            'role' => 'masyarakat',
        ]);

        PendaftaranBantuan::create([
            'user_id' => $user1->id,
            'nama_lengkap' => 'Budi Santoso',
            'tanggal_lahir' => '1990-01-01',
            'nik' => '1234567890123456',
            'nomor_kk' => '1234567890123456',
            'nomor_hp' => '08123456789',
            'jenis_kelamin' => 'Laki-laki',
            'alamat_lengkap' => 'Jl. Bojongsoang No. 12, Bandung, Jawa Barat',
            'pekerjaan' => 'Buruh',
            'penghasilan_per_bulan' => 1000000,
            'pengeluaran_bulanan' => 800000,
            'jumlah_tanggungan' => 3,
            'status_rumah' => 'Sewa',
            'status' => 'pending',
        ]);

        PengajuanBantuan::create([
            'id_pengajuan' => 101,
            'id_users' => $user1->id,
            'nama_lengkap' => 'Budi Santoso',
            'nik' => '1234567890123456',
            'jenis_bantuan' => 'Bantuan Pendidikan',
            'jumlah_tanggungan' => 3,
            'penghasilan' => 1000000,
            'status_pengajuan' => 'diverifikasi',
            'tanggal_pengajuan' => '2026-05-15',
        ]);

        // Setup User 2 (Surabaya, Jawa Timur)
        $user2 = User::create([
            'name' => 'Siti Aminah',
            'email' => 'siti@lentera.com',
            'password' => bcrypt('password'),
            'role' => 'masyarakat',
        ]);

        PendaftaranBantuan::create([
            'user_id' => $user2->id,
            'nama_lengkap' => 'Siti Aminah',
            'tanggal_lahir' => '1992-05-10',
            'nik' => '9876543210987654',
            'nomor_kk' => '9876543210987654',
            'nomor_hp' => '08765432109',
            'jenis_kelamin' => 'Perempuan',
            'alamat_lengkap' => 'Jl. Gubeng No. 50, Surabaya, Jawa Timur',
            'pekerjaan' => 'Ibu Rumah Tangga',
            'penghasilan_per_bulan' => 800000,
            'pengeluaran_bulanan' => 700000,
            'jumlah_tanggungan' => 2,
            'status_rumah' => 'Milik Sendiri',
            'status' => 'pending',
        ]);

        PengajuanBantuan::create([
            'id_pengajuan' => 102,
            'id_users' => $user2->id,
            'nama_lengkap' => 'Siti Aminah',
            'nik' => '9876543210987654',
            'jenis_bantuan' => 'Bantuan Kesehatan',
            'jumlah_tanggungan' => 2,
            'penghasilan' => 800000,
            'status_pengajuan' => 'diterima',
            'tanggal_pengajuan' => '2026-04-20',
        ]);

        return ['admin' => $admin, 'user1' => $user1, 'user2' => $user2];
    }

    public function test_admin_can_access_monitoring_dashboard(): void
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@lentera.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)->get(route('admin.monitoring'));

        $response->assertStatus(200);
        $response->assertSee('Monitoring Dana');
        $response->assertSee('Filter Audit Penggunaan Dana');
        $response->assertSee('Peta Penyerapan Jawa Barat');
        $response->assertSee('Alokasi Per Kategori');
        $response->assertSee('Perbandingan Bulanan');
        $response->assertSee('Indeks Transparansi');
        $response->assertSee('Jawa Barat');
    }

    public function test_admin_can_filter_monitoring_by_wilayah(): void
    {
        $data = $this->setupTestData();

        // Filter by wilayah Bojongsoang
        $response = $this->actingAs($data['admin'])->get(route('admin.monitoring', [
            'wilayah' => 'Bojongsoang'
        ]));

        $response->assertStatus(200);
        // Rp 1.000.000 (dari Budi Santoso) karena terfilter dan skala berubah ke nominal aslinya
        $response->assertSee('Rp 1.000.000');
        $response->assertSee('Bantuan Pendidikan');
        // Pendaftaran Siti Aminah di Surabaya tidak ikut terhitung
        $response->assertDontSee('Rp 2.000.000');
    }

    public function test_admin_can_filter_monitoring_by_jenis_bantuan(): void
    {
        $data = $this->setupTestData();

        // Filter by jenis bantuan Kesehatan
        $response = $this->actingAs($data['admin'])->get(route('admin.monitoring', [
            'jenis_bantuan' => 'Bantuan Kesehatan'
        ]));

        $response->assertStatus(200);
        $response->assertSee('Rp 1.000.000'); // dari Siti Aminah
        $response->assertSee('Bantuan Kesehatan');
    }

    public function test_admin_can_filter_monitoring_by_date_range(): void
    {
        $data = $this->setupTestData();

        // Filter by date range May 2026
        $response = $this->actingAs($data['admin'])->get(route('admin.monitoring', [
            'start_date' => '2026-05-01',
            'end_date' => '2026-05-31'
        ]));

        $response->assertStatus(200);
        $response->assertSee('Rp 1.000.000'); // dari Budi Santoso (15 May)
        $response->assertDontSee('Rp 2.000.000'); // data April tidak ikut
    }
}
