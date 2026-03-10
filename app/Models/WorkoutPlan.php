<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkoutPlan extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user');
    }

    protected function casts(): array
    {
        return [
            'uuid' => 'string',
            'is_default' => 'integer',
        ];
    }

    public function exercises()
    {
        return $this->hasMany(WorkoutPlanExercises::class);
    }
}
