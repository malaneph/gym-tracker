<?php

namespace App\Models;

use App\Queries\WorkoutSetQuery;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property string $workout_session
 * @property string $workout_plan_exercise
 * @property int $set_index
 * @property int $reps
 * @property numeric $weight
 * @property int|null $rpe
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\WorkoutPlanExercise|null $workoutPlanExercise
 * @property-read \App\Models\WorkoutSession|null $workoutSession
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutSet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutSet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutSet query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutSet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutSet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutSet whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutSet whereReps($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutSet whereRpe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutSet whereSetIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutSet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutSet whereWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutSet whereWorkoutPlanExercise($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutSet whereWorkoutSession($value)
 * @mixin \Eloquent
 */
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

    public function previousSet(): ?array
    {
        $previous_set = (new WorkoutSetQuery())
            ->builder()
            ->where('workout_plan_exercise', $this->workoutPlanExercise->id)
            ->orderByDesc('created_at')
            ->first();

        if ($previous_set) {
            return [
                'previous_set' => $previous_set->weight . ' x ' . $previous_set->reps,
            ];
        }

        return null;
    }

    protected function casts(): array
    {
        return [
            'id' => 'string',
        ];
    }
}
