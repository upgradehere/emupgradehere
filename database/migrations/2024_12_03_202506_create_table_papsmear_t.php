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
        Schema::create('papsmear_t', function (Blueprint $table) {
            $table->increments('papsmear_id');
            $table->unsignedInteger('mcu_id')->nullable();
            $table->string('papsmear_code', 16)->nullable();
            $table->timestamp('papsmear_date')->nullable();
            $table->text('conclusion')->nullable();
            $table->text('classification')->nullable();
            $table->text('speciment')->nullable();
            $table->text('clinical_description')->nullable();
            $table->text('general_category')->nullable();
            $table->text('recommendations')->nullable();
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
        Schema::dropIfExists('papsmear_t');
    }
};
