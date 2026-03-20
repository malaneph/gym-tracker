<?php

namespace App\Http\Middleware;

use App\Models\User;
use Auth;
use Closure;
use DB;
use Nutgram\Laravel\Middleware\ValidateWebAppData;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->input('initData')) {
            return ValidateWebAppData::handle($request, $next);
        }

        if (! $bearer = $request->bearerToken()) {
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
