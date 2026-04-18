<?php

namespace App\Actions;

use App\Models\WorkoutPlanExportToken;
use DB;

class ImportWorkoutPlan
{
    public function __construct() {}

    public function __invoke(array $attributes)
    {
        $workout_plan = WorkoutPlanExportToken::where('token', $attributes['token'])->first()?->workoutPlan;
        $workout_plan->load('exercises');

        DB::transaction(function () use ($workout_plan, $attributes) {
            $imported_plan = $workout_plan->replicate();
            $imported_plan->name = $attributes['name'];
            $imported_plan->user = auth()->id();
            $imported_plan->save();

            $replicated_exercises = $workout_plan->exercises->map(function ($exercise) use ($imported_plan) {
                $exercise_copy = $exercise->replicate();
                $exercise_copy->workout_plan = $imported_plan->id;

                return $exercise_copy;
            });

            $imported_plan->exercises()->saveMany($replicated_exercises);
        });
    }
}
