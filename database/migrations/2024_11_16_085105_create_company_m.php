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
        Schema::create('company_m', function (Blueprint $table) {
            $table->increments('company_id');
            $table->string('company_code', 8);
            $table->string('company_name', 100)->nullable();
            $table->string('npwp_company_number', 20)->nullable();
            $table->string('pic_name', 100)->nullable();
            $table->string('pic_email', 20)->nullable();
            $table->string('pic_phone_number', 20)->nullable();
            $table->text('company_address')->nullable();
            $table->unsignedInteger('subdistrict_id')->nullable();
            $table->unsignedInteger('district_id')->nullable();
            $table->unsignedInteger('city_id')->nullable();
            $table->unsignedInteger('province_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_m');
    }
};
