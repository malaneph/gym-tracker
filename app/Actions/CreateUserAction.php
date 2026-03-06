<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class CreateUserAction
{
    public function __construct()
    {
    }

    public function __invoke(array $attributes): void
    {
        DB::transaction(function () use ($attributes) {
            $user = new User($attributes);
            $user->save();
        });
    }
}
