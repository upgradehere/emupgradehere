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
        Schema::create('mcu_t', function (Blueprint $table) {
            $table->increments('mcu_id');
            $table->string('mcu_code', 16);
            $table->timestamp('mcu_date')->nullable();
            $table->unsignedInteger('employee_id')->nullable();
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('mcu_program_id')->nullable();
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
        Schema::dropIfExists('mcu_t');
    }
};
