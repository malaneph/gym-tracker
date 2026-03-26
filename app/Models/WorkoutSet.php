<?php

namespace App\Models;

use App\Queries\WorkoutSetQuery;
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
        return $this->belongsTo(WorkoutSession::class, 'workout_session', 'id');
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

    public function previousSet(): ?array
    {
        $previous_set = (new WorkoutSetQuery)
            ->builder()
            ->where('workout_plan_exercise', $this->workoutPlanExercise->id)
            ->orderByDesc('created_at')
            ->first();

        if ($previous_set) {
            return [
                'previous_set' => $previous_set->weight.' x '.$previous_set->reps,
            ];
        }

        return null;
    }
}
