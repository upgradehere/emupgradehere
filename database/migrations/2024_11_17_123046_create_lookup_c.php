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
        Schema::create('lookup_c', function (Blueprint $table) {
            $table->smallInteger('lookup_id')->unsigned()->primary();
            $table->string('lookup_code', 16)->nullable();
            $table->string('lookup_type', 16)->nullable();
            $table->string('lookup_name', 100)->nullable();
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
        Schema::dropIfExists('lookup_c');
    }
};
