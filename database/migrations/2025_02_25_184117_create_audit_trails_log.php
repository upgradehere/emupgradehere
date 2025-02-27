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
        Schema::create('audit_trails_log', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->nullable();
            $table->text('event')->nullable();
            $table->text('model')->nullable();
            $table->text('url')->nullable();
            $table->text('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->text('device')->nullable();
            $table->text('platform')->nullable();
            $table->text('browser')->nullable();
            $table->text('old_values')->nullable();
            $table->text('new_values')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_trails_log');
    }
};
