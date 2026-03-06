<?php

namespace App\Actions;

use App\Models\User;
use DB;

class UpdateUserSettingsAction
{
    public function __construct()
    {
    }

    public function __invoke(array $attributes): User|null
    {
        DB::transaction(function ($attributes) {
            $user = auth()->user();
            $user->settings->update($attributes);

            return $user->refresh();
        });

        return null;
    }
}
