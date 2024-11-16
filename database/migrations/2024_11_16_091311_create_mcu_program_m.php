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
        Schema::create('mcu_program_m', function (Blueprint $table) {
            $table->increments('mcu_program_id');
            $table->string('mcu_program_code', 8);
            $table->string('mcu_program_name', 100)->nullable();
            $table->unsignedInteger('company_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mcu_program_m');
    }
};
