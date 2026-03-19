<?php

namespace App\Actions;

use App\Enums\WorkoutStatus;
use App\Models\WorkoutSession;
use App\Models\WorkoutSet;
use DB;

class CreateWorkoutSet
{
    public function __construct() {}

    public function __invoke(WorkoutSession $session, array $attributes): void
    {
        if ($session->status !== WorkoutStatus::DRAFT->value) {
            throw new \RuntimeException('Cannot create a new set for a workout session that is not in draft status');
        }
        $attributes['workout_session'] = $session->id;

        DB::transaction(function () use ($attributes) {
            WorkoutSet::create($attributes);
        });
    }
}
