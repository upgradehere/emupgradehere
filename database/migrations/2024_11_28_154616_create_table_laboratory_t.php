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
        Schema::create('laboratory_t', function (Blueprint $table) {
            $table->increments('laboratory_id');
            $table->string('laboratory_code', 16)->nullable();
            $table->unsignedInteger('mcu_id')->nullable();
            $table->timestamp('laboratory_date')->nullable();
            $table->string('image_file', 100)->nullable();
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
        Schema::dropIfExists('laboratory_t');
    }
};
