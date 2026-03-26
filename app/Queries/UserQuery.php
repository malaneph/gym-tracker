<?php

namespace App\Queries;

use App\Models\User;

class UserQuery
{
    public function __construct() {}

    public function __invoke(): User
    {
        return auth()->user();
    }
}
