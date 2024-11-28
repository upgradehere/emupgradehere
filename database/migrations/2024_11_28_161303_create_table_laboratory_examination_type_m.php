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
        Schema::create('laboratory_examination_type_m', function (Blueprint $table) {
            $table->increments('laboratory_examination_type_id');
            $table->unsignedInteger('laboratory_examination_group_id')->nullable();
            $table->string('laboratory_examination_type_code', 16)->nullable();
            $table->string('laboratory_examination_type_name', 100);
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
        Schema::dropIfExists('laboratory_examination_type_m');
    }
};
