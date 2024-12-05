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
        Schema::create('rontgen_t', function (Blueprint $table) {
            $table->increments('rontgen_id');
            $table->unsignedInteger('mcu_id')->nullable();
            $table->string('rontgen_code', 16)->nullable();
            $table->timestamp('rontgen_date')->nullable();
            $table->string('rontgen_examination_type')->nullable();
            $table->string('clinical_diagnosis')->nullable();
            $table->string('cor', 16)->nullable();
            $table->string('pulmo', 16)->nullable();
            $table->string('oss_costae', 16)->nullable();
            $table->string('diaphragmatic_sinus', 16)->nullable();
            $table->text('conclusion')->nullable();
            $table->string('examination_status', 50)->nullable();
            $table->unsignedInteger('doctor_id')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_abnormal')->nullable();
            $table->text('image_file')->nullable();
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
        Schema::dropIfExists('rontgen_t');
    }
};
