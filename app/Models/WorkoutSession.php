<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property \App\Models\User $user
 * @property string $workout_plan
 * @property \Illuminate\Support\Carbon $started_at
 * @property \Illuminate\Support\Carbon|null $finished_at
 * @property string|null $notes
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WorkoutSet> $sets
 * @property-read int|null $sets_count
 * @property-read \App\Models\WorkoutPlan $workoutPlan
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutSession newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutSession newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutSession query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutSession whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutSession whereFinishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutSession whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutSession whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutSession whereStartedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutSession whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutSession whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutSession whereUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutSession whereWorkoutPlan($value)
 * @mixin \Eloquent
 */
class WorkoutSession extends Model
{
    use HasUuids;

    protected $fillable = [
        'user',
        'workout_plan',
        'started_at',
        'finished_at',
        'notes',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }

    public function workoutPlan(): BelongsTo
    {
        return $this->belongsTo(WorkoutPlan::class, 'workout_plan', 'id');
    }

    public function sets()
    {
        return $this->hasMany(WorkoutSet::class, 'workout_session', 'id');
    }

    protected function casts(): array
    {
        return [
            'id' => 'string',
            'started_at' => 'datetime',
            'finished_at' => 'datetime',
            'status' => 'integer',
        ];
    }
}
