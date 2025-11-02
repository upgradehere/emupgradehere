<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('lab_result_items', function (Blueprint $t) {
            $t->id();
            $t->foreignId('lab_result_id')->constrained('lab_results')->cascadeOnDelete();
            $t->foreignId('analyte_id')->nullable()->constrained('lab_analytes')->nullOnDelete();

            $t->string('source_name');        // exactly as sent: test_name / parameter_name
            $t->string('value')->nullable();  // store as string; we can cast later if needed
            $t->string('unit')->nullable();
            $t->string('flag')->nullable();       // H/L/…
            $t->string('ref_range')->nullable();  // e.g. "4.0-10.0"
            $t->timestampTz('measured_at')->nullable();

            // optional bookkeeping later: $t->unsignedBigInteger('attached_to_id')->nullable();

            $t->timestamps();

            $t->index(['lab_result_id']);
            $t->index(['analyte_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lab_result_items');
    }
};
