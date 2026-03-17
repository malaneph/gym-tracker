<?php

namespace App\Actions;

use App\Models\WorkoutPlan;
use DB;

class DeleteWorkoutPlan
{
    public function __construct() {}

    public function __invoke(WorkoutPlan $plan): void
    {
        DB::transaction(function () use ($plan) {
            $plan->delete();
        });
    }
}
