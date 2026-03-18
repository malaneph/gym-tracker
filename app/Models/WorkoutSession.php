<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
            'started_at' => 'timestamp',
            'finished_at' => 'timestamp',
            'status' => 'integer',
        ];
    }
}
