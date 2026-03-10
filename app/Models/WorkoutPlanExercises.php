<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkoutPlanExercises extends Model
{
    public function workoutPlan(): BelongsTo
    {
        return $this->belongsTo(WorkoutPlan::class, 'workout_plan');
    }

    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class, 'exercise');
    }

    public function exerciseVariation(): BelongsTo
    {
        return $this->belongsTo(Exercise::class, 'exercise_variation');
    }

    protected function casts(): array
    {
        return [
            'uuid' => 'string',
        ];
    }
}
