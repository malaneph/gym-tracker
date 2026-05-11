<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $user
 * @property numeric $weight
 * @property \Illuminate\Support\Carbon $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BodyweightLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BodyweightLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BodyweightLog query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BodyweightLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BodyweightLog whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BodyweightLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BodyweightLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BodyweightLog whereUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BodyweightLog whereWeight($value)
 * @mixin \Eloquent
 */
class BodyweightLog extends Model
{
    protected $fillable = [
        'user',
        'weight',
        'date',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'datetime',
        ];
    }
}
