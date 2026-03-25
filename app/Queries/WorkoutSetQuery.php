<?php

namespace App\Queries;

use App\Models\WorkoutPlanExercise;
use App\Models\WorkoutSet;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class WorkoutSetQuery
{
    public function __construct()
    {
    }

    /**
     * @return EloquentBuilder<WorkoutSet>
     */
    public function builder(): EloquentBuilder
    {
        return WorkoutSet::query();
    }

    public function personalBest(WorkoutPlanExercise $planExercise): EloquentBuilder
    {
        return $this->builder()
            ->where('workout_plan_exercise', $planExercise->id)
            ->orderBy('weight', 'desc')
            ->limit(1);
    }

    public function prevSet(WorkoutPlanExercise $planExercise, WorkoutSet $workoutSet): EloquentBuilder
    {
        return $this->builder()
            ->where('workout_plan_exercise', $planExercise->id)
            ->where('set_index', '=', $workoutSet->set_index)
            ->orderBy('created_at', 'desc')
            ->limit(1);
    }
}
