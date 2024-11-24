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
        $sql = file_get_contents(database_path('sql/auto_generated_mcu_code_mcu_t.sql'));
        DB::unprepared($sql);
        DB::statement('DROP TRIGGER IF EXISTS mcu_code_trigger ON mcu_t');
        DB::statement('CREATE TRIGGER mcu_code_trigger
                    BEFORE INSERT ON mcu_t
                    FOR EACH ROW
                    EXECUTE FUNCTION generate_mcu_code();');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP FUNCTION IF EXISTS generate_mcu_code()');
        DB::statement('DROP TRIGGER IF EXISTS mcu_code_trigger ON mcu_t');
    }
};
