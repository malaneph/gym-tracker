<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

/**
 * @property string $id
 * @property \App\Models\User $user
 * @property string $name
 * @property string $category
 * @property int $is_default
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WorkoutPlanExercise> $exercises
 * @property-read int|null $exercises_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WorkoutPlanExportToken> $exportTokens
 * @property-read int|null $export_tokens_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WorkoutSession> $sessions
 * @property-read int|null $sessions_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutPlan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutPlan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutPlan query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutPlan whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutPlan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutPlan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutPlan whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutPlan whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutPlan whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutPlan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkoutPlan whereUser($value)
 * @mixin \Eloquent
 */
class WorkoutPlan extends Model
{
    use HasUuids;

    protected $fillable = [
        'user',
        'name',
        'category',
        'is_default',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }

    public function exercises()
    {
        return $this->hasMany(WorkoutPlanExercise::class, 'workout_plan', 'id');
    }

    public function exportTokens()
    {
        return $this->hasMany(WorkoutPlanExportToken::class, 'workout_plan', 'id');
    }

    public function sessions()
    {
        return $this->hasMany(WorkoutSession::class, 'workout_plan', 'id');
    }

    public function createToken(): void
    {
        $this->exportTokens()->create(
            [
                'token' => (string) Str::uuid(),
            ],
        );
    }

    public function getToken(): array
    {
        return $this->exportTokens()->latest()->first('token')->toArray();
    }

    protected function casts(): array
    {
        return [
            'id' => 'string',
            'is_default' => 'integer',
            'status' => 'integer',
        ];
    }
}
