<?php

namespace App\Queries;

use App\Models\User;
use App\Models\WorkoutPlan;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class WorkoutPlanQuery
{
    private User $user;

    public function __construct()
    {
        $this->user = auth()->user();
    }

    public function builder(): EloquentBuilder
    {
        return WorkoutPlan::query()->where('user', $this->user->id);
    }
}
