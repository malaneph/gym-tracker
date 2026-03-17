<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class CreateUser
{
    public function __construct() {}

    public function __invoke(array $attributes): void
    {
        DB::transaction(function () use ($attributes) {
            User::create($attributes);
        });
    }
}
