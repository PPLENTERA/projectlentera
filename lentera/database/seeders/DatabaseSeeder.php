<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Feedback;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Admin',
            'email' => 'adminlentera@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budisantoso@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'masyarakat',
        ]);

        // Seed Sample Feedback Data
        Feedback::create([
            'nama_lengkap' => 'Rudi Hermawan',
            'nomor_telepon' => '+62 812 3456 7890',
            'kategori_masukan' => 'Saran',
            'deskripsi_masukan' => 'Layanan pelayanan sangat responsif dan membantu. Namun, saya menyarankan untuk menambahkan fitur notifikasi real-time agar pengguna dapat memantau progress pengajuan mereka.',
            'status' => 'belum_ditinjau',
        ]);

        Feedback::create([
            'nama_lengkap' => 'Siti Nurhaliza',
            'nomor_telepon' => '+62 812 5678 9012',
            'kategori_masukan' => 'Keluhan',
            'deskripsi_masukan' => 'Proses verifikasi dokumen memakan waktu terlalu lama. Saya menunggu selama 3 minggu dan belum ada informasi update.',
            'status' => 'sedang_ditinjau',
            'catatan_admin' => 'Akan ditindaklanjuti dengan mengecek status dokumen di sistem verifikasi.',
        ]);

        Feedback::create([
            'nama_lengkap' => 'Ahmad Wijaya',
            'nomor_telepon' => '+62 812 9012 3456',
            'kategori_masukan' => 'Laporan',
            'deskripsi_masukan' => 'Ada bug pada form pengajuan ketika memilih kategori tertentu. Form tidak bisa disubmit.',
            'status' => 'sudah_ditindaklanjuti',
            'catatan_admin' => 'Bug sudah diperbaiki di versi terbaru. User diminta update aplikasi.',
        ]);

        Feedback::create([
            'nama_lengkap' => 'Dewi Lestari',
            'nomor_telepon' => '+62 812 3456 7890',
            'kategori_masukan' => 'Pertanyaan',
            'deskripsi_masukan' => 'Apakah ada persyaratan khusus untuk pengajuan bantuan pendidikan? Saya sudah lulus SMA dan ingin melanjutkan ke universitas.',
            'status' => 'belum_ditinjau',
        ]);

        Feedback::create([
            'nama_lengkap' => 'Bambang Suryanto',
            'nomor_telepon' => '+62 812 5678 9012',
            'kategori_masukan' => 'Saran',
            'deskripsi_masukan' => 'Aplikasi sudah bagus, tapi tampilan interface bisa lebih user-friendly untuk pengguna berusia lanjut.',
            'status' => 'belum_ditinjau',
        ]);
    }
}
