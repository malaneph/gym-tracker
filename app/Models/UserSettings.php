<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
