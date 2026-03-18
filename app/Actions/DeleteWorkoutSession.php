<?php

namespace App\Actions;

use App\Models\WorkoutSession;
use DB;

class DeleteWorkoutSession
{
    public function __construct() {}

    public function __invoke(WorkoutSession $workout_session): void
    {
        DB::transaction(function () use ($workout_session) {
            $workout_session->delete();
        });
    }
}
