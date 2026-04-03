<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('workout_plan_exercises', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('workout_plan')->constrained('workout_plans');
            $table->foreignUuid('exercise')->constrained('exercises');
            $table->integer('position');
            $table->integer('is_optional')->default(0);
            $table->text('notes')->nullable();
            $table->integer('sets')->nullable();
            $table->integer('reps')->nullable();
            $table->integer('rest_seconds')->nullable();
            $table->foreignUuid('exercise_variation')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workout_plan_exercises');
    }
};
