<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkoutPlanExercise extends Model
{
    use HasUuids;

    protected $fillable = [
        'workout_plan',
        'exercise',
        'exercise_variation',
        'position',
        'is_optional',
        'notes',
        'sets',
        'reps',
        'rest_seconds',
    ];

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
            'id' => 'string',
        ];
    }
}
