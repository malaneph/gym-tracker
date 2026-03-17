<?php

namespace App\Actions;

use App\Models\WorkoutPlanExercise;
use DB;

class UpdateWorkoutPlanExercise
{
    public function __construct() {}

    public function __invoke(WorkoutPlanExercise $exercise, array $attributes): void
    {
        DB::transaction(function () use ($exercise, $attributes) {
            $exercise->update($attributes);
        });
    }
}
