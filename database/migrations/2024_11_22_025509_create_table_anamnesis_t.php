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
        Schema::create('anamnesis_t', function (Blueprint $table) {
            $table->increments('anamnesis_id');
            $table->string('anamnesis_code', 16);
            $table->timestamp('anamnesis_date')->nullable();
            $table->unsignedInteger('mcu_id')->nullable();
            $table->float('systolic')->nullable();
            $table->float('diastolic')->nullable();
            $table->float('pulse_rate')->nullable();
            $table->float('breathing')->nullable();
            $table->float('height')->nullable();
            $table->float('weight')->nullable();
            $table->float('bmi')->nullable();
            $table->float('body_temprature')->nullable();
            $table->string('bmi_classification', 100)->nullable();
            $table->string('skin_condition', 100)->nullable();
            $table->text('medical_history')->nullable();
            $table->text('eyes')->nullable();
            $table->text('ears')->nullable();
            $table->text('nose')->nullable();
            $table->text('oral_cavity')->nullable();
            $table->text('teeth')->nullable();
            $table->text('neck')->nullable();
            $table->text('chest')->nullable();
            $table->text('abdomen')->nullable();
            $table->text('spine')->nullable();
            $table->text('upper_extremities')->nullable();
            $table->text('lower_extremities')->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('anamnesis_t');
    }
};
