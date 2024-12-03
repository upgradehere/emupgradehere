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
        Schema::create('ekg_t', function (Blueprint $table) {
            $table->increments('ekg_id');
            $table->unsignedInteger('mcu_id')->nullable();
            $table->string('ekg_code', 16)->nullable();
            $table->timestamp('ekg_date')->nullable();
            $table->string('rhythm')->nullable();
            $table->string('rate')->nullable();
            $table->string('axis')->nullable();
            $table->string('abnormality')->nullable();
            $table->string('conclusion')->nullable();
            $table->string('suggestion')->nullable();
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
        Schema::dropIfExists('ekg_t');
    }
};
