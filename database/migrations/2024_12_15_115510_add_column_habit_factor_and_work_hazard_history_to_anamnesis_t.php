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
            $table->text('habit_factor')->nullable();
            $table->text('work_hazard_history')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anamnesis_t', function (Blueprint $table) {
            $table->dropColumn('habit_factor');
            $table->dropColumn('work_hazard_history');
        });
    }
};
