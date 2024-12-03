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
        Schema::create('resume_mcu_t', function (Blueprint $table) {
            $table->increments('resume_mcu_id');
            $table->unsignedInteger('mcu_id')->nullable();
            $table->string('resume_mcu_code', 16)->nullable();
            $table->timestamp('resume_mcu_date')->nullable();
            $table->text('physical_impression')->nullable();
            $table->text('rontgen_impression')->nullable();
            $table->text('ekg_impression')->nullable();
            $table->text('audiometry_impression')->nullable();
            $table->text('usg_impression')->nullable();
            $table->text('spirometry_impression')->nullable();
            $table->text('refreaction_impression')->nullable();
            $table->text('laboratory_impression')->nullable();
            $table->text('result_conclusion')->nullable();
            $table->text('suggestion')->nullable();
            $table->unsignedInteger('doctor_id')->nullable();
            $table->text('additional_data')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resume_mcu_t');
    }
};
