<?php

namespace App\Http\Middleware;

use App\Models\User;
use Auth;
use Closure;
use DB;
use Illuminate\Http\Request;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @throws \JsonException
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (!$bearer = $request->bearerToken()) {
            if ($webapp_data = $request->webAppData->toArray()) {
                $user_data = json_decode($webapp_data['user'], true, flags: JSON_THROW_ON_ERROR);

                if ($user = User::where('telegram_id', $user_data['id'])->first()) {
                    Auth::login($user);
                }

                return $next($request);
            }

            return response()->json([
                'success' => false,
                'error' => 'Authorization required!',
            ], 401);
        }

        [$id, $token] = explode('|', $bearer, 2);
        $instance = DB::table('personal_access_tokens')->find($id);

        if (hash('sha256', $token) === $instance->token) {
            if ($user = User::find($instance->tokenable_id)) {
                Auth::login($user);

                return $next($request);
            }
        }

        return response()->json([
            'success' => false,
            'error' => 'Access denied.',
        ], 401);
    }
}
