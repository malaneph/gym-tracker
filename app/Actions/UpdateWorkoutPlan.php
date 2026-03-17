<?php

namespace App\Actions;

use App\Models\WorkoutPlan;
use DB;

class UpdateWorkoutPlan
{
    public function __construct() {}

    public function __invoke(WorkoutPlan $plan, array $attributes): void
    {
        DB::transaction(function () use ($plan, $attributes) {
            $plan->update($attributes);
        });
    }
}
