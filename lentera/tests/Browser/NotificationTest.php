<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\PengajuanBantuan;
use App\Models\Notification;

class NotificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_validate_and_trigger_notifications(): void
    {
        // 1. Setup Users
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@lentera.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $user = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@lentera.com',
            'password' => bcrypt('password'),
            'role' => 'masyarakat',
        ]);

        // 2. Setup Pengajuan
        $pengajuan = PengajuanBantuan::create([
            'id_users' => $user->id,
            'nama_lengkap' => 'Budi Santoso',
            'nik' => '1234567890123456',
            'jenis_bantuan' => 'Bantuan Pangan',
            'jumlah_tanggungan' => 2,
            'penghasilan' => 1000000,
            'deskripsi_kebutuhan' => 'Kebutuhan mendesak',
            'bukti_pendukung' => null,
            'status_pengajuan' => 'pending',
            'tanggal_pengajuan' => now()->toDateString(),
        ]);

        // 3. Act as Admin and update validation
        $response = $this->actingAs($admin)->put(route('admin.validasi.update', $pengajuan->id_pengajuan), [
            'status_validasi' => 'valid',
            'catatan' => 'Berkas lengkap dan sesuai.',
            'tanggal_pengambilan' => now()->addDay()->toDateString(), // besok
            'waktu_pengambilan' => '09:00',
            'lokasi_pengambilan' => 'Kantor Pos Bojongsoang',
        ]);

        // 4. Assert Redirect & Database Updates
        $response->assertRedirect(route('admin.validasi.index'));
        
        $pengajuan->refresh();
        $this->assertEquals('diverifikasi', $pengajuan->status_pengajuan);

        // 5. Assert Notifications Created
        // Status update notification
        $this->assertDatabaseHas('notifications', [
            'user_id' => $user->id,
            'type' => 'status_update',
            'title' => 'Pengajuan Anda telah Disetujui',
        ]);

        // Reminder notification
        $this->assertDatabaseHas('notifications', [
            'user_id' => $user->id,
            'type' => 'reminder',
            'title' => 'Jadwal Pengambilan Bantuan: Besok',
        ]);
    }

    public function test_masyarakat_can_see_notifications(): void
    {
        $user = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@lentera.com',
            'password' => bcrypt('password'),
            'role' => 'masyarakat',
        ]);

        Notification::create([
            'user_id' => $user->id,
            'title' => 'Jadwal Pengambilan Bantuan: Besok',
            'message' => 'Jangan lupa membawa Kartu Keluarga (KK) asli.',
            'type' => 'reminder',
            'icon' => 'calendar',
        ]);

        $response = $this->actingAs($user)->get(route('masyarakat.notifikasi.index'));

        $response->assertStatus(200);
        $response->assertSee('Jadwal Pengambilan Bantuan: Besok');
        $response->assertSee('Jangan lupa membawa Kartu Keluarga (KK) asli.');
    }

    public function test_masyarakat_can_mark_all_read(): void
    {
        $user = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@lentera.com',
            'password' => bcrypt('password'),
            'role' => 'masyarakat',
        ]);

        $notification1 = Notification::create([
            'user_id' => $user->id,
            'title' => 'Notification 1',
            'message' => 'Message 1',
            'type' => 'status_update',
            'icon' => 'check',
        ]);

        $notification2 = Notification::create([
            'user_id' => $user->id,
            'title' => 'Notification 2',
            'message' => 'Message 2',
            'type' => 'reminder',
            'icon' => 'calendar',
        ]);

        $this->assertNull($notification1->read_at);
        $this->assertNull($notification2->read_at);

        $response = $this->actingAs($user)->post(route('masyarakat.notifikasi.read_all'));

        $response->assertRedirect();
        
        $this->assertNotNull($notification1->refresh()->read_at);
        $this->assertNotNull($notification2->refresh()->read_at);
    }
}
