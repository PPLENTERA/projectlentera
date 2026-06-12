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
        Schema::table('scoring_rules', function (Blueprint $table) {
            $table->string('value', 255)->change();
            $table->string('value_max', 255)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('scoring_rules', function (Blueprint $table) {
            $table->decimal('value', 15, 2)->change();
            $table->decimal('value_max', 15, 2)->nullable()->change();
        });
    }
};
