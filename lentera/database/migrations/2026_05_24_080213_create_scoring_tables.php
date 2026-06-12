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
        Schema::table('pengajuan_bantuan', function (Blueprint $table) {
            $table->integer('skor_kelayakan')->nullable()->after('status_pengajuan');
        });
        Schema::create('scoring_indicators', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('column_name');
            $table->timestamps();
        });
        Schema::create('scoring_rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scoring_indicator_id')->constrained('scoring_indicators')->onDelete('cascade');
            $table->string('operator'); // <, <=, >, >=, =, between
            $table->decimal('value', 15, 2);
            $table->decimal('value_max', 15, 2)->nullable();
            $table->integer('score');
            $table->string('label')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scoring_rules');
        Schema::dropIfExists('scoring_indicators');
        Schema::table('pengajuan_bantuan', function (Blueprint $table) {
            $table->dropColumn('skor_kelayakan');
        });
    }
};
