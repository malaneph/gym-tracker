<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkoutPlan extends Model
{
    use HasUuids;

    protected $fillable = [
        'user',
        'name',
        'category',
        'is_default',
        'status'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }

    protected function casts(): array
    {
        return [
            'id' => 'string',
            'is_default' => 'integer',
            'status' => 'integer',
        ];
    }

    public function exercises()
    {
        return $this->hasMany(WorkoutPlanExercises::class);
    }
}
