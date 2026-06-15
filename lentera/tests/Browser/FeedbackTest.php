<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Feedback;

class FeedbackTest extends DuskTestCase
{
    //use DatabaseMigrations;

    /**
     * PBI #1 - TC.Feedback.001 - Menguji form input feedback
     */
    public function testFeedbackValid(): void
    {
        $user = User::factory()->create(['role' => 'masyarakat']);
        $this->createPendaftaranBantuan($user);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->maximize()
                    ->visit('/masyarakat/feedback')
                    ->type('nama_lengkap', 'via')
                    ->type('nomor_telepon', '08123456789')
                    ->select('kategori_masukan', 'Saran')
                    ->type('deskripsi_masukan', 'Ini adalah saran dari user.')
                    ->press('Kirim Feedback')
                    ->assertSee('Terima kasih, masukan Anda telah dikirim');

             // Cek database
            $this->assertDatabaseHas('feedbacks', [
                'nama_lengkap' => 'via',
                'nomor_telepon' => '08123456789',
                'kategori_masukan' => 'Saran',
                'deskripsi_masukan' => 'Ini adalah saran dari user.'
            ]);
        });
    }

    /**
     * PBI #1 - TC.Feedback.002 - Menguji form input feedback dengan input kosong
     */
     public function testFeedbackKosong()
    {
        $user = User::factory()->create(['role' => 'masyarakat']);
        $this->createPendaftaranBantuan($user);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->maximize()
                    ->visit('/masyarakat/feedback')
                    ->clear('nama_lengkap')
                    ->press('Kirim Feedback')
                    ->pause(1000)
                    ->assertSee('The nama lengkap field is required');
        });
    }

    /**
     * PBI #2 - TC.Feedback.003 - Menguji penyimpanan feedback
     */
    public function testFeedbackTersimpan()
    {
        $user = User::factory()->create(['role' => 'masyarakat']);
        $this->createPendaftaranBantuan($user);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->maximize()
                    ->visit('/masyarakat/feedback')
                    ->clear('nama_lengkap')
                    ->type('nama_lengkap', 'Budi')
                    ->type('nomor_telepon', '08987654321')
                    ->select('kategori_masukan', 'Laporan')
                    ->type('deskripsi_masukan', 'Feedback untuk PBI #2')
                    ->press('Kirim Feedback')
                    ->pause(1000)
                    ->assertSee('Terima kasih, masukan Anda telah dikirim');

            //Pengecekan database
            $this->assertDatabaseHas('feedbacks', [
                'nama_lengkap' => 'Budi',
                'nomor_telepon' => '08987654321',
                'kategori_masukan' => 'Laporan',
                'deskripsi_masukan' => 'Feedback untuk PBI #2'
            ]);
        });
    } 

    /**
     * PBI #3 - TC.Feedback.004 - Admin melihat daftar feedback
     */
    public function testDaftarFeedback()
    {
        $admin = User::factory()->admin()->create();
        Feedback::factory()->create([
            'nama_lengkap' => 'Nama User Test Feedback'
        ]);

        $this->browse(function (Browser $browser) use ($admin) {
            $browser->loginAs($admin)
                    ->visit('/admin/feedback')
                    ->assertSee('Nama User Test Feedback');
        });
    }

    /**
     * PBI #3 - TC.Feedback.005 - Admin menandai feedback sudah ditindaklanjuti
     */
    public function testTindakLanjutiFeedback()
    {
        $admin = User::factory()->admin()->create();
        $feedback = Feedback::factory()->create([
            'nama_lengkap' => 'User Test Status',
            'status' => 'belum_ditinjau'
        ]);

        $this->browse(function (Browser $browser) use ($admin, $feedback) {
            $browser->loginAs($admin)
                    ->maximize()
                    ->visit('/admin/feedback')
                    ->assertSee('User Test Status')
                    ->clickLink('Lihat')
                    ->assertPathIs('/admin/feedback/' . $feedback->id . '/edit')
                    ->select('status', 'sudah_ditindaklanjuti')
                    ->press('Simpan')
                    ->assertPathIs('/admin/feedback')
                    ->assertSee('Sudah Ditindaklanjuti');

            $this->assertDatabaseHas('feedbacks', [
                'id' => $feedback->id,
                'status' => 'sudah_ditindaklanjuti'
            ]);
        });
    }

    /**
     * PBI #2 - TC.Feedback.006 - Feedback invalid tidak tersimpan
     */
    public function testFeedbackInvalidTidakTersimpan()
    {
        $initialCount = Feedback::count();
        $user = User::factory()->create(['role' => 'masyarakat']);
        $this->createPendaftaranBantuan($user);

        $this->browse(function (Browser $browser) use ($initialCount, $user) {
            $browser->loginAs($user)
                    ->maximize()
                    ->visit('/masyarakat/feedback')
                    ->clear('nama_lengkap')
                    // Membiarkan form kosong
                    ->press('Kirim Feedback')
                    ->pause(1000)
                    ->assertSee('The nama lengkap field is required');
                    
            // Memastikan data tidak masuk ke database
            $this->assertDatabaseCount('feedbacks', $initialCount);
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