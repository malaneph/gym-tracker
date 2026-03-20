<?php

namespace App\Actions;

use App\Models\User;
use App\Models\UserSettings;
use DB;

class UpdateUserSettings
{
    public function __construct() {}

    public function __invoke(User $user, array $attributes): void
    {
        DB::transaction(function () use ($user, $attributes) {
            if (! isset($user->settings)) {
                UserSettings::create([
                    'user' => $user->id,
                    'language' => $attributes['language'] ?? config('app.locale'),
                    'timezone' => $attributes['timezone'] ?? config('app.timezone'),
                    'units_system' => $attributes['units'] ?? 'metric',
                ]);
            } else {
                $user->settings->update($attributes);
            }
        });
    }
}
