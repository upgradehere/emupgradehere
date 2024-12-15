<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("TRUNCATE TABLE lookup_c");
        $sql = file_get_contents(database_path('sql/insert_into_lookup_c.sql'));
        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("TRUNCATE TABLE lookup_c");
    }
};
