<?php

namespace App\Queries;

use App\Models\Exercise;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class GetExerciseQuery
{
    public function __construct()
    {
    }

    /**
     * @return EloquentBuilder<Exercise>
     */
    public function builder(): EloquentBuilder
    {
        return Exercise::query();
    }

    public function search(string $search): EloquentBuilder
    {
        return $this->builder()->where('name', 'like', $search);
    }
}
