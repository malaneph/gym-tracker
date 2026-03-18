<?php

namespace App\Queries;

use App\Models\WorkoutSession;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class GetWorkoutSessionQuery
{
    public function __construct() {}

    public function builder(): EloquentBuilder
    {
        return WorkoutSession::query();
    }
}
