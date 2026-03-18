<?php

namespace App\Actions;

use App\Models\WorkoutSession;
use DB;

class CreateWorkoutSession
{
    public function __construct() {}

    public function __invoke(array $attributes)
    {
        $attributes['user'] = auth()->id();

        DB::transaction(function () use ($attributes) {
            WorkoutSession::create($attributes);
        });
    }
}
