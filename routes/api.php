<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Nutgram\Laravel\Middleware\ValidateWebAppData;
use SergiX44\Nutgram\Nutgram;

Route::middleware(ValidateWebAppData::class)->post('/auth/init', [UserController::class, 'authUser']);

Route::post('/bot/webhook', fn(Nutgram $bot) => $bot->run());
