<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\PendaftaranBantuan;
use App\Models\Notification;

class BroadcastTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Disable CSRF middleware for all tests since they run in local environment under Dusk
        $this->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class);
    }

    public function test_admin_can_send_broadcast_to_matching_recipients(): void
    {
        // 1. Setup Admin & Users
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@lentera.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $userEligible = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@lentera.com',
            'password' => bcrypt('password'),
            'role' => 'masyarakat',
        ]);

        $userNotEligible = User::create([
            'name' => 'Rich User',
            'email' => 'rich@lentera.com',
            'password' => bcrypt('password'),
            'role' => 'masyarakat',
        ]);

        // 2. Setup Pendaftaran data (which determines eligibility)
        PendaftaranBantuan::create([
            'user_id' => $userEligible->id,
            'nama_lengkap' => 'Budi Santoso',
            'tanggal_lahir' => '1990-01-01',
            'nik' => '1234567890123456',
            'nomor_kk' => '1234567890123456',
            'nomor_hp' => '08123456789',
            'jenis_kelamin' => 'Laki-laki',
            'alamat_lengkap' => 'Jl. Bojongsoang No. 12',
            'pekerjaan' => 'Buruh',
            'penghasilan_per_bulan' => 1000000, // Eligible: <= 1.5M
            'pengeluaran_bulanan' => 800000,
            'jumlah_tanggungan' => 3, // Eligible: >= 2
            'status_rumah' => 'Sewa',
            'dokumen_ktp' => 'dummy.pdf',
            'dokumen_kk' => 'dummy.pdf',
            'dokumen_rumah' => 'dummy.pdf',
            'dokumen_sktm' => 'dummy.pdf',
            'status' => 'pending',
        ]);

        PendaftaranBantuan::create([
            'user_id' => $userNotEligible->id,
            'nama_lengkap' => 'Rich User',
            'tanggal_lahir' => '1992-02-02',
            'nik' => '9876543210987654',
            'nomor_kk' => '9876543210987654',
            'nomor_hp' => '08765432109',
            'jenis_kelamin' => 'Laki-laki',
            'alamat_lengkap' => 'Jl. Buahbatu No. 100',
            'pekerjaan' => 'Pengusaha',
            'penghasilan_per_bulan' => 5000000, // Not eligible: > 1.5M
            'pengeluaran_bulanan' => 3000000,
            'jumlah_tanggungan' => 1, // Not eligible: < 2
            'status_rumah' => 'Milik Sendiri',
            'dokumen_ktp' => 'dummy.pdf',
            'dokumen_kk' => 'dummy.pdf',
            'dokumen_rumah' => 'dummy.pdf',
            'dokumen_sktm' => 'dummy.pdf',
            'status' => 'pending',
        ]);

        // 3. Admin submits targeted broadcast
        $response = $this->actingAs($admin)->post(route('admin.broadcast.send'), [
            'title' => 'Bantuan Pangan Mandiri Dibuka',
            'message' => 'Segera lakukan pengajuan Bantuan Pangan Mandiri.',
            'jenis_bantuan' => 'Bantuan Pangan',
            'max_income' => 1500000,
            'min_dependents' => 2,
        ]);

        // 4. Assert Redirect and Notifications Table
        $response->assertRedirect(route('admin.broadcast.index'));
        $response->assertSessionHas('success');

        // Eligible user should have received a notification
        $this->assertDatabaseHas('notifications', [
            'user_id' => $userEligible->id,
            'title' => 'Bantuan Pangan Mandiri Dibuka',
            'message' => 'Segera lakukan pengajuan Bantuan Pangan Mandiri.',
            'status_badge' => 'PROGRAM BARU',
        ]);

        // Non-eligible user should NOT have received a notification
        $this->assertDatabaseMissing('notifications', [
            'user_id' => $userNotEligible->id,
            'title' => 'Bantuan Pangan Mandiri Dibuka',
        ]);
    }

    public function test_broadcast_fails_if_no_matching_recipients(): void
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@lentera.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Admin submits targeted broadcast with very strict criteria
        $response = $this->actingAs($admin)->post(route('admin.broadcast.send'), [
            'title' => 'Bantuan Pangan Mandiri Dibuka',
            'message' => 'Segera lakukan pengajuan Bantuan Pangan Mandiri.',
            'jenis_bantuan' => 'Bantuan Pangan',
            'max_income' => 500000,
            'min_dependents' => 10,
        ]);

        // Assert error message and warning
        $response->assertSessionHas('error', 'Tidak ada calon penerima yang memenuhi kriteria tersebut.');
        $this->assertDatabaseCount('notifications', 0);
    }
}
