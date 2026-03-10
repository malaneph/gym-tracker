<?php

namespace App\Actions;

class DeleteWorkoutPlan
{
    public function __construct()
    {
    }

    public function __invoke(WorkoutPlan $plan): void
    {
        DB::transaction(function () use ($plan) {
            $plan->delete();
        });
    }
}
