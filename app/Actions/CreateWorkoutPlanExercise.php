<?php

namespace App\Actions;

use App\Models\Exercise;
use App\Models\WorkoutPlan;
use App\Models\WorkoutPlanExercise;
use DB;
use Exception;

class CreateWorkoutPlanExercise
{
    public function __construct() {}

    public function __invoke(WorkoutPlan $workoutPlan, array $attributes): void
    {
        DB::transaction(function () use ($workoutPlan, $attributes) {
            $count = $workoutPlan->exercises()->count();

            if (isset($attributes['exercise_name'])) {
                $exercise = Exercise::firstOrCreate(['name' => $attributes['exercise_name']]);
            } else {
                $exercise = Exercise::find($attributes['exercise']);
            }

            WorkoutPlanExercise::create([
                'workout_plan' => $workoutPlan->id,
                'exercise' => $exercise->id ?? throw new Exception('Exercise not found'),
                'position' => $count + 1,
                ...$attributes,
            ]);
        });
    }
}
