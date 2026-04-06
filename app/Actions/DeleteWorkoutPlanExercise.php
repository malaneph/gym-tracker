<?php

namespace App\Actions;

use App\Models\WorkoutPlanExercise;
use DB;

class DeleteWorkoutPlanExercise
{
    public function __construct() {}

    public function __invoke(WorkoutPlanExercise $exercise): void
    {
        DB::transaction(function () use ($exercise) {
            $exercise->delete();
        });
    }
}
