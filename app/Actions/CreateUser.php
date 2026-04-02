<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class CreateUser
{
    public function __construct()
    {
    }

    public function __invoke(array $attributes): void
    {
        DB::transaction(function () use ($attributes) {
            $attributes['telegram_id'] = $attributes['id'];
            $user = User::create($attributes);
            $user->settings()->create([
                'language' => $attributes['language'] ?? config('app.locale'),
                'timezone' => $attributes['timezone'] ?? config('app.timezone'),
                'units_system' => $attributes['units'] ?? 'metric',
            ]);
        });
    }
}
