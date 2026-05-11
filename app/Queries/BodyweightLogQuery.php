<?php

namespace App\Queries;

use App\Models\BodyweightLog;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class BodyweightLogQuery
{
    private User $user;

    public function __construct()
    {
        $this->user = auth()->user();
    }

    /**
     * @return EloquentBuilder<BodyweightLog>
     */
    public function builder(): EloquentBuilder
    {
        return BodyweightLog::query()->where('user', $this->user->id);
    }

    public function index(string $date_period): EloquentBuilder
    {
        $subDays = match ($date_period) {
            '1w' => today()->subWeek(),
            '1m' => today()->subMonth(),
            '3m' => today()->subMonths(3),
        };

        return $this->builder()->where('date', '>=', $subDays);
    }
}
