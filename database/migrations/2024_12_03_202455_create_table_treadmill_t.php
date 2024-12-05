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
        Schema::create('treadmill_t', function (Blueprint $table) {
            $table->increments('treadmill_id');
            $table->unsignedInteger('mcu_id')->nullable();
            $table->string('treadmill_code', 16)->nullable();
            $table->timestamp('treadmill_date')->nullable();
            $table->string('resting_ekg')->nullable();
            $table->float('max_heart_rate_target')->nullable();
            $table->float('reached')->nullable();
            $table->float('end_test_minute')->nullable();
            $table->string('heart_rate_response')->nullable();
            $table->string('blood_preassure_response')->nullable();
            $table->string('aritmia')->nullable();
            $table->string('chest_pain')->nullable();
            $table->text('other_symptoms')->nullable();
            $table->string('during_after_training_test')->nullable();
            $table->string('mm_lead')->nullable();
            $table->string('at_the_minute')->nullable();
            $table->string('st_normalization_after')->nullable();
            $table->string('functional_class')->nullable();
            $table->string('freshness_level')->nullable();
            $table->string('aerobic_capacity')->nullable();
            $table->string('conc_normalization_after')->nullable();
            $table->unsignedInteger('doctor_id')->nullable();
            $table->boolean('is_abnormal')->nullable();
            $table->text('image_file')->nullable();
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
        Schema::dropIfExists('treadmill_t');
    }
};
