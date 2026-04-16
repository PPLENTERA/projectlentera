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
        Schema::create('pengajuan_bantuan', function (Blueprint $table) {
            $table->id('id_pengajuan');
            $table->foreignId('id_users')->constrained('users');
            $table->string('jenis_bantuan');
            $table->integer('jumlah_tanggungan');
            $table->decimal('penghasilan', 15, 2);
            $table->text('deskripsi_kebutuhan')->nullable();
            $table->enum('status_pengajuan', ['pending', 'diverifikasi', 'diterima', 'ditolak'])->default('pending');
            $table->date('tanggal_pengajuan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_bantuan');
    }
};
