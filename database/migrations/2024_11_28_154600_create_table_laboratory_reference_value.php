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
        Schema::create('laboratory_reference_value', function (Blueprint $table) {
            $table->increments('laboratory_reference_value_id');
            $table->unsignedInteger('laboratory_examination_id')->nullable();
            $table->string('laboratory_reference_value_name', 100)->nullable();
            $table->float('min_male')->nullable();
            $table->float('max_male')->nullable();
            $table->float('min_female')->nullable();
            $table->float('max_female')->nullable();
            $table->string('unit', 50)->nullable();
            $table->string('information', 100)->nullable();
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
        Schema::dropIfExists('laboratory_reference_value');
    }
};
