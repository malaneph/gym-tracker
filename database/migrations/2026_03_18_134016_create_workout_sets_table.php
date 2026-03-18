<?php

use App\Models\WorkoutPlanExercise;
use App\Models\WorkoutSession;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('workout_sets', function (Blueprint $table) {
            $table->uuid('id');
            $table->foreignIdFor(WorkoutSession::class, 'workout_session');
            $table->foreignIdFor(WorkoutPlanExercise::class, 'workout_plan_exercise');
            $table->integer('set_index');
            $table->integer('reps');
            $table->decimal('weight');
            $table->integer('rpe')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workout_sets');
    }
};
