<?php

namespace App\Queries;

use App\Models\Exercise;
use DB;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class ExerciseQuery
{
    public function __construct() {}

    /**
     * @return EloquentBuilder<Exercise>
     */
    public function builder(): EloquentBuilder
    {
        return Exercise::query();
    }

    public function search(string $search): EloquentBuilder
    {
        return $this->builder()->where(DB::raw('LOWER(name)'), 'like', '%'.strtolower($search).'%');
    }
}
