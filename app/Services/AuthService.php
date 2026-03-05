<?php

namespace App\Services;

class AuthService
{
    public function __construct()
    {
    }

    public static function checkInitData(array $init_data): bool
    {
        return self::isDataValid($init_data) && self::checkTokenDate($init_data);
    }

    public static function isDataValid(array $request_data): bool
    {
        $hash_from_request = $request_data['hash'];
        unset($request_data['hash']);
        $init_data_string = implode('\n', $request_data);
        $token_hash = hash_hmac('sha256', config('services.telegram.bot_token'), 'WebAppData', true);
        $init_data_hash = hash_hmac('sha256', json_encode($init_data_string, JSON_THROW_ON_ERROR), $token_hash);

        return $hash_from_request === $init_data_hash;
    }

    public static function generateAuthHash(array $request_data): string
    {
        $init_data_string = implode('\n', $request_data);
        $token_hash = hash_hmac('sha256', config('services.telegram.bot_token'), 'WebAppData', true);
        $init_data_hash = hash_hmac('sha256', json_encode($init_data_string, JSON_THROW_ON_ERROR), $token_hash);

        return $init_data_hash;
    }

    public static function checkTokenDate(array $init_data): bool
    {
        return (time() - $init_data['auth_date']) < config('services.telegram.auth_token_ttl');
    }
}
