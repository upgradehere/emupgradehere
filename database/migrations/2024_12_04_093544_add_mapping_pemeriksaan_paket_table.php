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
        Schema::table('package_m', function (Blueprint $table) {
            $table->integer('anamnesis')->nullable();
            $table->integer('rontgen')->nullable();
            $table->integer('audiometry')->nullable();
            $table->integer('spirometry')->nullable();
            $table->integer('ekg')->nullable();
            $table->integer('usg')->nullable();
            $table->integer('treadmill')->nullable();
            $table->integer('papsmear')->nullable();
            $table->integer('resume')->nullable();
            $table->text('lab')->nullable();
            $table->integer('refraction')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('package_m', function (Blueprint $table) {
            $table->dropColumn('anamnesis');
            $table->dropColumn('rontgen');
            $table->dropColumn('audiometry');
            $table->dropColumn('spirometry');
            $table->dropColumn('ekg');
            $table->dropColumn('usg');
            $table->dropColumn('treadmill');
            $table->dropColumn('papsmear');
            $table->dropColumn('resume');
            $table->dropColumn('lab');
            $table->dropColumn('refraction');
        });
    }
};
