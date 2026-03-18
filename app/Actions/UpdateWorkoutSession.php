<?php

namespace App\Actions;

use App\Models\WorkoutSession;
use DB;

class UpdateWorkoutSession
{
    public function __construct() {}

    public function __invoke(WorkoutSession $workoutSession, array $attributes): void
    {
        DB::transaction(function () use ($workoutSession, $attributes) {
            $workoutSession->update($attributes);
        });
    }
}
