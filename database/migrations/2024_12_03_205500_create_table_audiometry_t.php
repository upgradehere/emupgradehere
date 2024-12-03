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
        Schema::create('audiometry_t', function (Blueprint $table) {
            $table->increments('audiometry_id');
            $table->unsignedInteger('mcu_id')->nullable();
            $table->string('audiometry_code', 16)->nullable();
            $table->timestamp('audiometry_date')->nullable();
            $table->text('right_air_conduction')->nullable();
            $table->text('left_air_conduction')->nullable();
            $table->text('right_bone_conduction')->nullable();
            $table->text('left_bone_conduction')->nullable();
            $table->string('right_ear')->nullable();
            $table->string('left_ear')->nullable();
            $table->text('conclusion')->nullable();
            $table->text('suggestion')->nullable();
            $table->unsignedInteger('doctor_id')->nullable();
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
        Schema::dropIfExists('audiometry_t');
    }
};
