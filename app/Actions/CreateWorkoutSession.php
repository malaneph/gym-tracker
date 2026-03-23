<?php

namespace App\Actions;

use App\Enums\WorkoutStatus;
use App\Models\WorkoutSession;
use DB;

class CreateWorkoutSession
{
    public function __construct() {}

    public function __invoke(array $attributes)
    {
        $attributes['user'] = auth()->id();

        DB::transaction(function () use ($attributes) {
            $active_session = WorkoutSession::whereIn('status', [WorkoutStatus::ACTIVE, WorkoutStatus::DRAFT])->first();

            $attributes['started_at'] = now();

            if (! $active_session) {
                WorkoutSession::create($attributes);
            }
        });
    }
}
