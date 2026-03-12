<?php

use App\Models\Exercise;
use App\Models\WorkoutPlan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('workout_plan_exercises', function (Blueprint $table) {
            $table->uuid('id');
            $table->foreignIdFor(WorkoutPlan::class, 'workout_plan');
            $table->foreignIdFor(Exercise::class, 'exercise');
            $table->integer('position');
            $table->integer('is_optional');
            $table->text('notes');
            $table->integer('rest_seconds');
            $table->foreignIdFor(Exercise::class, 'exercise_variation')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workout_plan_exercises');
    }
};
