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
        Schema::create('laboratory_detail_t', function (Blueprint $table) {
            $table->increments('laboratory_detail_id');
            $table->unsignedInteger('laboratory_id')->nullable();
            $table->unsignedInteger('laboratory_examination_id')->nullable();
            $table->unsignedInteger('laboratory_reference_value_id')->nullable();
            $table->string('result', 16)->nullable();
            $table->boolean('is_abnormal')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laboratory_detail_t');
    }
};
