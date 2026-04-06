<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Nutgram\Laravel\Middleware\ValidateWebAppData;

class WebAppDataMiddleware extends ValidateWebAppData
{
    public function handle(Request $request, Closure $next): mixed
    {
        if (app()->environment('local')) {
            return $next($request);
        }

        if (! $request->has('initData')) {
            $auth_data = $request->header('Authorization');
            if (str_starts_with($auth_data, 'tma ')) {
                $request->merge(['initData' => substr($auth_data, 4)]);
            }
        }

        return parent::handle($request, $next);
    }
}
