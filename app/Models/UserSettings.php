<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property \App\Models\User $user
 * @property string $language
 * @property string $timezone
 * @property string $units_system
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserSettings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserSettings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserSettings query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserSettings whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserSettings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserSettings whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserSettings whereTimezone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserSettings whereUnitsSystem($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserSettings whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserSettings whereUser($value)
 * @mixin \Eloquent
 */
class UserSettings extends Model
{
    use HasUuids;

    public $table = 'users_settings';

    protected $fillable = [
        'user',
        'language',
        'timezone',
        'units_system',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }

    protected function casts(): array
    {
        return [
            'id' => 'string',
        ];
    }
}
