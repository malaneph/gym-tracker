<?php

namespace App\Actions;

use App\Models\WorkoutPlan;
use DB;

class CreateWorkoutPlan
{
    public function __construct() {}

    public function __invoke(array $attributes): void
    {
        $attributes['user'] = auth()->id();

        DB::transaction(function () use ($attributes) {
            WorkoutPlan::create($attributes);
        });
    }
}
