<?php

namespace App\Actions;

use App\Models\WorkoutPlan;
use App\Models\WorkoutPlanExportToken;

class ImportWorkoutPlan
{
    public function __construct() {}

    public function __invoke(array $attributes)
    {
        $workout_plan_id = WorkoutPlanExportToken::where('token', $attributes['token'])
            ->firstOrFail('workout_plan')
            ->toArray();

        $workout_plan = WorkoutPlan::find($workout_plan_id['workout_plan'])->toArray();

        $workout_plan['user'] = auth()->id();
        $workout_plan['name'] = $attributes['name'];

        WorkoutPlan::create($workout_plan);
    }
}
