<?php

namespace App\Actions;

use App\Models\WorkoutSession;
use App\Models\WorkoutSet;
use DB;

class CreateWorkoutSet
{
    public function __construct() {}

    public function __invoke(WorkoutSession $session, array $attributes): void
    {
        $attributes['workout_session'] = $session->id;

        DB::transaction(function () use ($attributes) {
            WorkoutSet::create($attributes);
        });
    }
}
