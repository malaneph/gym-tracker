<?php

namespace App\Actions;

use DB;

class UpdateUserSettings
{
    public function __construct() {}

    public function __invoke(array $attributes): void
    {
        DB::transaction(function ($attributes) {
            $user = auth()->user();
            $user->settings->update($attributes);
        });
    }
}
