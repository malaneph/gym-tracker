<?php

namespace App\Queries;

use App\Models\User;
use App\Models\WorkoutSession;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class WorkoutSessionQuery
{
    private User $user;

    public function __construct()
    {
        $this->user = auth()->user();
    }

    public function builder(): EloquentBuilder
    {
        return WorkoutSession::query()->where('user', $this->user->id);
    }
}
