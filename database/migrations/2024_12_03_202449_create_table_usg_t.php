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
        Schema::create('usg_t', function (Blueprint $table) {
            $table->increments('usg_id');
            $table->unsignedInteger('mcu_id')->nullable();
            $table->string('usg_code', 16)->nullable();
            $table->timestamp('usg_date')->nullable();
            $table->string('liver')->nullable();
            $table->string('gallbladder')->nullable();
            $table->string('pancreas')->nullable();
            $table->string('lien')->nullable();
            $table->string('kidney')->nullable();
            $table->string('bladder')->nullable();
            $table->string('prostat')->nullable();
            $table->string('classification')->nullable();
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
        Schema::dropIfExists('usg_t');
    }
};
