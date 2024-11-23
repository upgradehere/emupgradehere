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
        Schema::table('anamnesis_t', function (Blueprint $table) {
            $table->renameColumn('chest', 'thorax');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anamnesis_t', function (Blueprint $table) {
            $table->renameColumn('thorax', 'chest');
        });
    }
};
