<?php

namespace App\Actions;

use App\Models\WorkoutPlanExercises;
use DB;

class CreateWorkoutPlanExercise
{
    public function __construct()
    {
    }

    public function __invoke(array $attributes): void
    {
        DB::transaction(function () use ($attributes) {
            WorkoutPlanExercises::create($attributes);
        });
    }
}
