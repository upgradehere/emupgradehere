<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('lab_results', function (Blueprint $t) {
            $t->id();
            $t->string('sample_id')->nullable()->index();   // TEK8520: from payload; TC3060 may be order_number
            $t->string('mcu_code')->nullable()->index();    // TEK8520: often patient_id; TC3060 usually null
            $t->json('raw_data');                            // we’ll use JSONB on Postgres (see statement below)
            $t->string('payload_hash')->nullable()->index(); // for future de-dup (optional)
            $t->timestamps();
        });

        // Ensure json -> jsonb on PostgreSQL
        if (DB::getDriverName() === 'pgsql') {
            DB::statement('ALTER TABLE lab_results ALTER COLUMN raw_data TYPE jsonb USING raw_data::jsonb');
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('lab_results');
    }
};
