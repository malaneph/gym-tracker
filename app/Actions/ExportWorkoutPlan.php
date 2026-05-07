<?php

namespace App\Actions;

use App\Models\WorkoutPlan;

class ExportWorkoutPlan
{
    public function __construct() {}

    public function __invoke(WorkoutPlan $workoutPlan): void
    {
        $workoutPlan->createToken();
    }
}
