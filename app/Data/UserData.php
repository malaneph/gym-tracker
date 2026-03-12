<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class UserData extends Data
{
    public function __construct(
        public string $id,
        public string $username,
        public ?int $telegram_id,
        public ?string $avatar,
        public ?int $auth_date
    ) {
    }
}
