<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('lab_analytes', function (Blueprint $t) {
            $t->id();
            $t->string('code')->unique();        // canonical code: WBC, RBC, HGB, ...
            $t->string('display_name');          // human label
            $t->string('default_unit')->nullable();
            $t->decimal('ref_lo', 12, 4)->nullable();
            $t->decimal('ref_hi', 12, 4)->nullable();
            $t->json('synonyms')->nullable();            // ["WBC","Leukocytes"]
            $t->json('instrument_synonyms')->nullable(); // {"TEK8520":["WBC"],"TC3060":["WBC"]}
            $t->timestamps();
        });

        if (DB::getDriverName() === 'pgsql') {
            DB::statement('ALTER TABLE lab_analytes ALTER COLUMN synonyms TYPE jsonb USING synonyms::jsonb');
            DB::statement('ALTER TABLE lab_analytes ALTER COLUMN instrument_synonyms TYPE jsonb USING instrument_synonyms::jsonb');
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('lab_analytes');
    }
};
