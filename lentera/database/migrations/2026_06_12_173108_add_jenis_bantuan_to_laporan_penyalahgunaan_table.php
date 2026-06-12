<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('laporan_penyalahgunaan', function (Blueprint $table) {
            $table->string('jenis_bantuan')->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporan_penyalahgunaan', function (Blueprint $table) {
            $table->dropColumn('jenis_bantuan');
        });
    }
};
