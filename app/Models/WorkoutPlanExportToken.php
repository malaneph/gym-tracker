<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $workout_plan
 * @property string $token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\WorkoutPlan $workoutPlan
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutPlanExportToken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutPlanExportToken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutPlanExportToken query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutPlanExportToken whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutPlanExportToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutPlanExportToken whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutPlanExportToken whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutPlanExportToken whereWorkoutPlan($value)
 * @mixin \Eloquent
 */
class WorkoutPlanExportToken extends Model
{
    protected $fillable = [
        'workout_plan',
        'token',
    ];

    public function workoutPlan(): BelongsTo
    {
        return $this->belongsTo(WorkoutPlan::class, 'workout_plan', 'id');
    }
}
