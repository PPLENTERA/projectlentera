<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\PengajuanBantuan;
use App\Models\PendaftaranBantuan;
use App\Models\Notification;
use App\Models\ValidasiVerifikasi;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatusPengajuanTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;
    private User $applicant;

    protected function setUp(): void
    {
        parent::setUp();

        // Create an admin user
        $this->admin = User::factory()->create([
            'role' => 'admin',
        ]);

        // Create an applicant user
        $this->applicant = User::factory()->create([
            'role' => 'masyarakat',
        ]);
    }

   
    public function test_admin_can_validate_and_verify_request(): void
    {
        // 1. Setup applicant's pendaftaran data
        PendaftaranBantuan::create([
            'user_id' => $this->applicant->id,
            'nama_lengkap' => $this->applicant->name,
            'tanggal_lahir' => '1990-01-01',
            'nik' => '1234567890123456',
            'nomor_kk' => '1234567890123456',
            'nomor_hp' => '081234567890',
            'jenis_kelamin' => 'Laki-laki',
            'alamat_lengkap' => 'Jl. Lentera No. 1',
            'pekerjaan' => 'Buruh',
            'penghasilan_per_bulan' => 800000,
            'pengeluaran_bulanan' => 500000,
            'jumlah_tanggungan' => 4,
            'status_rumah' => 'Sewa/Kontrak',
            'dokumen_sktm' => 'sktm.pdf', // implies SKTM is 'Ada'
            'status' => 'disetujui',
        ]);

        // 2. Setup applicant's pengajuan data
        $pengajuan = PengajuanBantuan::create([
            'id_users' => $this->applicant->id,
            'nama_lengkap' => $this->applicant->name,
            'nik' => '1234567890123456',
            'jenis_bantuan' => 'Pangan',
            'penghasilan' => 800000,
            'jumlah_tanggungan' => 4,
            'deskripsi_kebutuhan' => 'Saya sangat memerlukan bantuan pangan ini karena tidak ada penghasilan lain.', // >= 20 chars
            'bukti_pendukung' => 'bukti.jpg', // implies Bukti is 'Ada'
            'status_pengajuan' => 'pending',
            'tanggal_pengajuan' => now()->toDateString(),
            'skor_kelayakan' => null,
        ]);

        // 3. Act: Send validation request as Admin
        $response = $this->actingAs($this->admin)
            ->put(route('admin.validasi.update', $pengajuan->id_pengajuan), [
                'status_validasi' => 'valid',
                'catatan' => 'Berkas lengkap dan kondisi rumah sesuai.',
                'tanggal_pengambilan' => now()->addDays(2)->toDateString(),
                'waktu_pengambilan' => '09:00',
            ]);

        // 4. Assertions
        $response->assertRedirect(route('admin.validasi.index'));
        $response->assertSessionHas('success');

        // Verify ValidasiVerifikasi record was created
        $this->assertDatabaseHas('validasi_verifikasi', [
            'id_pengajuan' => $pengajuan->id_pengajuan,
            'status_validasi' => 'valid',
            'catatan' => 'Berkas lengkap dan kondisi rumah sesuai.',
        ]);

       
        $this->assertDatabaseHas('pengajuan_bantuan', [
            'id_pengajuan' => $pengajuan->id_pengajuan,
            'status_pengajuan' => 'diverifikasi',
            'skor_kelayakan' => 150,
        ]);

      
        $this->assertDatabaseHas('notifications', [
            'user_id' => $this->applicant->id,
            'type' => 'status_update',
            'icon' => 'check',
        ]);

        // Survey reminder notification
        $this->assertDatabaseHas('notifications', [
            'user_id' => $this->applicant->id,
            'type' => 'reminder',
            'icon' => 'calendar',
        ]);
    }

    
    public function test_admin_rejects_invalid_request(): void
    {
        $pengajuan = PengajuanBantuan::create([
            'id_users' => $this->applicant->id,
            'nama_lengkap' => $this->applicant->name,
            'nik' => '1234567890123456',
            'jenis_bantuan' => 'Pangan',
            'penghasilan' => 1200000,
            'jumlah_tanggungan' => 2,
            'status_pengajuan' => 'pending',
            'tanggal_pengajuan' => now()->toDateString(),
        ]);

        $response = $this->actingAs($this->admin)
            ->put(route('admin.validasi.update', $pengajuan->id_pengajuan), [
                'status_validasi' => 'tidak_valid',
                'catatan' => 'Dokumen NIK tidak terbaca.',
            ]);

        $response->assertRedirect(route('admin.validasi.index'));

        // Verify database updates
        $this->assertDatabaseHas('pengajuan_bantuan', [
            'id_pengajuan' => $pengajuan->id_pengajuan,
            'status_pengajuan' => 'ditolak',
            'skor_kelayakan' => null,
        ]);

        // Verify rejection notification was sent
        $this->assertDatabaseHas('notifications', [
            'user_id' => $this->applicant->id,
            'type' => 'status_update',
            'icon' => 'info',
            'title' => 'Pengajuan Bantuan Ditolak',
        ]);
    }
}
