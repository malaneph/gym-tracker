<?php

namespace App\Http\Middleware;

use App\Models\User;
use Auth;
use Closure;
use DB;
use Illuminate\Http\Request;
use SergiX44\Nutgram\Nutgram;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$bearer = $request->bearerToken()) {
            if ($request->input('initData')) {
                $webappData = app(Nutgram::class)->validateWebAppData($request->input('initData'));
                $request->attributes->add(['webAppData' => $webappData->toArray()]);

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
