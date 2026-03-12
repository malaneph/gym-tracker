<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSettings extends Model
{
    public $table = 'users_settings';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user');
    }

    protected function casts(): array
    {
        return [
            'id' => 'string',
        ];
    }
}
