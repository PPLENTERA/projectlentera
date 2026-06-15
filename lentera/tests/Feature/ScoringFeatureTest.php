<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\PengajuanBantuan;
use App\Models\PendaftaranBantuan;
use App\Models\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ScoringFeatureTest extends TestCase
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

  
    public function test_penentuan_penerima_automatically_rejects_low_scores(): void
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
            'penghasilan_per_bulan' => 4000000, // High income -> 10 pts
            'pengeluaran_bulanan' => 500000,
            'jumlah_tanggungan' => 1,           // Few dependents -> 10 pts
            'status_rumah' => 'Milik Sendiri',  // Owns home -> 10 pts
            'dokumen_sktm' => null,             // No SKTM -> 0 pts
            'status' => 'disetujui',
        ]);

        
        $pengajuan = PengajuanBantuan::create([
            'id_users' => $this->applicant->id,
            'nama_lengkap' => $this->applicant->name,
            'nik' => '1234567890123456',
            'jenis_bantuan' => 'Pangan',
            'penghasilan' => 4000000,
            'jumlah_tanggungan' => 1,
            'deskripsi_kebutuhan' => 'Pendek',  // < 20 chars -> 0 pts
            'bukti_pendukung' => null,           // No proof -> 0 pts
            'status_pengajuan' => 'diverifikasi',
            'tanggal_pengajuan' => now()->toDateString(),
            'skor_kelayakan' => null,
        ]);

        
        $response = $this->actingAs($this->admin)
            ->get(route('admin.validasi.penentuan'));

        $response->assertStatus(200);

       
        $this->assertDatabaseHas('pengajuan_bantuan', [
            'id_pengajuan' => $pengajuan->id_pengajuan,
            'status_pengajuan' => 'ditolak',
            'skor_kelayakan' => 30,
        ]);

        // Verify rejection notification for low score was created
        $this->assertDatabaseHas('notifications', [
            'user_id' => $this->applicant->id,
            'type' => 'status_update',
            'title' => 'Pengajuan Bantuan Ditolak (Skor Kurang Layak)',
        ]);
    }

    

   
    public function test_penentuan_penerima_automatically_calculates_score_and_admin_accepts_application(): void
    {
        
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
            'penghasilan_per_bulan' => 800000,   // Low income -> 40 pts
            'pengeluaran_bulanan' => 500000,
            'jumlah_tanggungan' => 4,           // High dependents -> 30 pts
            'status_rumah' => 'Sewa/Kontrak',  // Rental -> 30 pts
            'dokumen_sktm' => 'sktm.pdf',       // SKTM exists -> 25 pts
            'status' => 'disetujui',
        ]);

       
        $pengajuan = PengajuanBantuan::create([
            'id_users' => $this->applicant->id,
            'nama_lengkap' => $this->applicant->name,
            'nik' => '1234567890123456',
            'jenis_bantuan' => 'Pangan',
            'penghasilan' => 800000,
            'jumlah_tanggungan' => 4,
            'deskripsi_kebutuhan' => 'Saya sangat memerlukan bantuan pangan ini karena tidak ada penghasilan lain.', // >= 20 chars -> 10 pts
            'bukti_pendukung' => 'bukti.jpg',  // Proof exists -> 15 pts
            'status_pengajuan' => 'diverifikasi',
            'tanggal_pengajuan' => now()->toDateString(),
            'skor_kelayakan' => null,
        ]);

        
        $response = $this->actingAs($this->admin)
            ->get(route('admin.validasi.penentuan'));

        $response->assertStatus(200);

        
        $this->assertDatabaseHas('pengajuan_bantuan', [
            'id_pengajuan' => $pengajuan->id_pengajuan,
            'status_pengajuan' => 'diverifikasi',
            'skor_kelayakan' => 150,
        ]);

        
        $responseStatus = $this->actingAs($this->admin)
            ->post(route('admin.validasi.update_status', $pengajuan->id_pengajuan), [
                'status' => 'diterima',
            ]);

        $responseStatus->assertRedirect(route('admin.validasi.penentuan'));
        $responseStatus->assertSessionHas('success');

        
        $this->assertDatabaseHas('pengajuan_bantuan', [
            'id_pengajuan' => $pengajuan->id_pengajuan,
            'status_pengajuan' => 'diterima',
        ]);

        
        $this->assertDatabaseHas('notifications', [
            'user_id' => $this->applicant->id,
            'type' => 'status_update',
            'icon' => 'check',
            'title' => 'Pengajuan Bantuan Diterima',
        ]);
    }
}
