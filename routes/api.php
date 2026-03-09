<?php

use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Nutgram\Laravel\Middleware\ValidateWebAppData;
use SergiX44\Nutgram\Nutgram;

Route::middleware(ValidateWebAppData::class)->post('/auth/init', [UserController::class, 'authUser']);

Route::middleware(ValidateWebAppData::class)->controller(UserController::class)->group(function () {
    Route::post('/settings', 'updateUserSettings')->name('settings.update');
});

Route::post('/bot/webhook', fn(Nutgram $bot) => $bot->run());

Route::controller(ExerciseController::class)->prefix('/exercises')->group(function () {
    Route::get('/', 'index');
    Route::get('/search', 'search');
});
