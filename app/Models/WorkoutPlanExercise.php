<?php

namespace App\Models;

use App\Queries\WorkoutSetQuery;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property string $workout_plan
 * @property \App\Models\Exercise|null $exercise
 * @property int $position
 * @property int $is_optional
 * @property string|null $notes
 * @property int|null $sets
 * @property int|null $reps
 * @property int|null $rest_seconds
 * @property string|null $exercise_variation
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Exercise|null $exerciseVariation
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WorkoutSet> $setsHistory
 * @property-read int|null $sets_history_count
 * @property-read \App\Models\WorkoutPlan|null $workoutPlan
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutPlanExercise newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutPlanExercise newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutPlanExercise query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutPlanExercise whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutPlanExercise whereExercise($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutPlanExercise whereExerciseVariation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutPlanExercise whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutPlanExercise whereIsOptional($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutPlanExercise whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutPlanExercise wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutPlanExercise whereReps($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutPlanExercise whereRestSeconds($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutPlanExercise whereSets($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutPlanExercise whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutPlanExercise whereWorkoutPlan($value)
 * @mixin \Eloquent
 */
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

    public function setsHistory()
    {
        return $this->hasMany(WorkoutSet::class, 'workout_plan_exercise');
    }

    public function getStats(): array
    {
        $personal_best = (new WorkoutSetQuery())->personalBest($this)->first();

        return [
            'personal_best' => $personal_best ? $personal_best->weight . ' x ' . $personal_best->reps : '',
            'date' => $personal_best ? $personal_best->created_at->format('Y-m-d') : '',
        ];
    }

    protected function casts(): array
    {
        return [
            'id' => 'string',
        ];
    }
}
