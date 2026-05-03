<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pendaftaran_bantuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_lengkap');
            $table->date('tanggal_lahir');
            $table->string('nik', 16);
            $table->string('nomor_kk', 16);
            $table->string('nomor_hp');
            $table->string('jenis_kelamin');
            $table->text('alamat_lengkap');
            $table->string('pekerjaan');
            $table->decimal('penghasilan_per_bulan', 15, 2);
            $table->decimal('pengeluaran_bulanan', 15, 2);
            $table->integer('jumlah_tanggungan');
            $table->string('status_rumah');
            $table->string('dokumen_ktp')->nullable();
            $table->string('dokumen_kk')->nullable();
            $table->string('dokumen_rumah')->nullable();
            $table->string('dokumen_sktm')->nullable();
            $table->enum('status', ['pending', 'diproses', 'disetujui', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_bantuans');
    }
};
