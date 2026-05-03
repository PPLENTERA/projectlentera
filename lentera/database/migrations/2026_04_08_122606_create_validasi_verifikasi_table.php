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
        Schema::create('validasi_verifikasi', function (Blueprint $table) {
            $table->id('id_validasi');
            $table->foreignId('id_pengajuan')->constrained('pengajuan_bantuan', 'id_pengajuan');
            $table->foreignId('id_admin')->constrained('users');
            $table->enum('status_validasi', ['pending', 'valid', 'tidak_valid'])->default('pending');
            $table->text('catatan')->nullable();
            $table->date('tanggal_verifikasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('validasi_verifikasi');
    }
};
