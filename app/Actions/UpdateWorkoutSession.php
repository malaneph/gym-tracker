<?php

namespace App\Actions;

use App\Enums\WorkoutStatus;
use App\Models\WorkoutSession;
use DB;

class UpdateWorkoutSession
{
    public function __construct() {}

    public function __invoke(WorkoutSession $workoutSession, array $attributes): void
    {
        if (isset($attributes['status']) && $attributes['status'] === WorkoutStatus::FINISHED->value) {
            $attributes['finished_at'] = now();
        }

        DB::transaction(function () use ($workoutSession, $attributes) {
            $workoutSession->update($attributes);
        });
    }
}
