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
        Schema::table('validasi_verifikasi', function (Blueprint $table) {
            $table->date('tanggal_pengambilan')->nullable();
            $table->time('waktu_pengambilan')->nullable();
            $table->string('lokasi_pengambilan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('validasi_verifikasi', function (Blueprint $table) {
            $table->dropColumn(['tanggal_pengambilan', 'waktu_pengambilan', 'lokasi_pengambilan']);
        });
    }
};
