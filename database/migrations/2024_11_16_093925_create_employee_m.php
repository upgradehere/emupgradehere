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
        Schema::create('employee_m', function (Blueprint $table) {
            $table->increments('employee_id');
            $table->string('employee_code', 8);
            $table->string('employee_name', 100)->nullable();
            $table->string('nik', 16)->nullable();
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('departement_id')->nullable();
            $table->timestamp('dob')->nullable();
            $table->string('phone_number', 20)->nullable();
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
        Schema::dropIfExists('employee_m');
    }
};
