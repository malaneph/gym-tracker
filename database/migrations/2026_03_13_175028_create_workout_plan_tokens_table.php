<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('workout_plan_export_tokens', function (Blueprint $table) {
            $table->id()->primary();
            $table->foreignUuid('workout_plan')->constrained('workout_plans');
            $table->string('token');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workout_plan_tokens');
    }
};
