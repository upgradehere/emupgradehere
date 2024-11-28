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
        Schema::create('laboratory_examination_m', function (Blueprint $table) {
            $table->increments('laboratory_examination_id');
            $table->unsignedInteger('laboratory_examination_type_id')->nullable();
            $table->string('laboratory_examination_code', 16)->nullable();
            $table->string('laboratory_examination_name', 100);
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
        Schema::dropIfExists('laboratory_examination_m');
    }
};
