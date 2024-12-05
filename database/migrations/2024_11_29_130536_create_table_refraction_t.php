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
        Schema::create('refraction_t', function (Blueprint $table) {
            $table->increments('refraction_id');
            $table->unsignedInteger('mcu_id')->nullable();
            $table->string('refraction_code', 16)->nullable();
            $table->timestamp('refraction_date')->nullable();
            $table->string('left_spherical', 8)->nullable();
            $table->string('left_cylinder', 8)->nullable();
            $table->string('left_axis', 8)->nullable();
            $table->string('left_add', 8)->nullable();
            $table->string('left_pd', 8)->nullable();
            $table->string('uncorrected_vision_left_od', 8)->nullable();
            $table->string('uncorrected_vision_left_os', 8)->nullable();
            $table->string('right_spherical', 8)->nullable();
            $table->string('right_cylinder', 8)->nullable();
            $table->string('right_axis', 8)->nullable();
            $table->string('right_add', 8)->nullable();
            $table->string('right_pd', 8)->nullable();
            $table->string('uncorrected_vision_right_od', 8)->nullable();
            $table->string('uncorrected_vision_right_os', 8)->nullable();
            $table->string('image_file', 100)->nullable();
            $table->string('refraction_therapy_result', 100)->nullable();
            $table->text('conclusion')->nullable();
            $table->text('notes')->nullable();
            $table->text('doctor_id')->nullable();
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
        Schema::dropIfExists('refraction_t');
    }
};
