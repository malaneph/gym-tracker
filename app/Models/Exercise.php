<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected function casts(): array
    {
        return [
            'uuid' => 'string',
        ];
    }
}
