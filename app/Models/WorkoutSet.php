<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkoutSet extends Model
{
    use HasUuids;

    protected $fillable = [
        'workout_session',
        'workout_plan_exercise',
        'set_index',
        'reps',
        'weight',
        'rpe',
        'notes',
    ];

    public function workoutSession(): BelongsTo
    {
        return $this->belongsTo(WorkoutSession::class, 'workout_session');
    }

    public function workoutPlanExercise(): BelongsTo
    {
        return $this->belongsTo(WorkoutPlanExercise::class, 'workout_plan_exercise');
    }

    protected function casts(): array
    {
        return [
            'id' => 'string',
        ];
    }
}
