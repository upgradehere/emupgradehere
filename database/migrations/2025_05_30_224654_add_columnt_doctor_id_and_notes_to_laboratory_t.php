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
        if (!Schema::hasColumn('laboratory_t', 'doctor_id')) {
            Schema::table('laboratory_t', function (Blueprint $table) {
                $table->unsignedInteger('doctor_id')->nullable();
            });
        }

        if (!Schema::hasColumn('laboratory_t', 'notes')) {
            Schema::table('laboratory_t', function (Blueprint $table) {
                $table->text('notes')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('laboratory_t', 'doctor_id')) {
            Schema::table('laboratory_t', function (Blueprint $table) {
                $table->dropColumn('doctor_id');
            });
        }

        if (Schema::hasColumn('laboratory_t', 'notes')) {
            Schema::table('laboratory_t', function (Blueprint $table) {
                $table->dropColumn('notes');
            });
        }
    }
};
