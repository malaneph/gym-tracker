<?php

namespace App\Queries;

use App\Models\WorkoutPlan;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class GetWorkoutPlanQuery
{
    public function __construct() {}

    public function builder(): EloquentBuilder
    {
        return WorkoutPlan::query();
    }
}
