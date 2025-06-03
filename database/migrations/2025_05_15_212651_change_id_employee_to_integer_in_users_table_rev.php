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
        Schema::table('users', function (Blueprint $table) {
            // Drop kolom jika ada
            if (Schema::hasColumn('users', 'id_employee')) {
                $table->dropColumn('id_employee');
            }
        });

        // Tambahkan kembali kolom sebagai integer nullable
        Schema::table('users', function (Blueprint $table) {
            $table->integer('id_employee')->nullable();
        });
    }


    public function down(): void
    {
        // Rollback: drop jika ada, lalu buat ulang kolom sebelumnya (misal string)
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'id_employee')) {
                $table->dropColumn('id_employee');
            }
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('id_employee')->nullable();
        });
    }
};
