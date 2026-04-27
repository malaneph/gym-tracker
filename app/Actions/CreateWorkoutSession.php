<?php

namespace App\Actions;

use App\Enums\WorkoutStatus;
use App\Models\WorkoutSession;
use DB;

class CreateWorkoutSession
{
    public function __construct() {}

    public function __invoke(array $attributes): void
    {
        $attributes['user'] = auth()->id();

        DB::transaction(function () use ($attributes): void {
            $active_session = WorkoutSession::where('status', '=', WorkoutStatus::ACTIVE->value)
                ->where('user', '=', $attributes['user'])
                ->first();

            $attributes['started_at'] = now();

            if (!$active_session) {
                WorkoutSession::create($attributes);
            }
        });
    }
}
