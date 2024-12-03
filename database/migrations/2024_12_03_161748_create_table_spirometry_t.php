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
        Schema::create('spirometry_t', function (Blueprint $table) {
            $table->increments('spirometry_id');
            $table->unsignedInteger('mcu_id')->nullable();
            $table->string('spirometry_code', 16)->nullable();
            $table->timestamp('spirometry_date')->nullable();
            $table->float('prediction_value')->nullable();
            $table->float('kvp')->nullable();
            $table->float('kvp_percentage')->nullable();
            $table->float('vep')->nullable();
            $table->float('vep_percetage')->nullable();
            $table->float('ape')->nullable();
            $table->float('ape_total')->nullable();
            $table->text('classification')->nullable();
            $table->text('conclusion')->nullable();
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
        Schema::dropIfExists('spirometry_t');
    }
};
