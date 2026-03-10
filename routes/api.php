<?php

use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkoutPlanController;
use Illuminate\Support\Facades\Route;
use Nutgram\Laravel\Middleware\ValidateWebAppData;
use SergiX44\Nutgram\Nutgram;

Route::middleware(ValidateWebAppData::class)->post('/auth/init', [UserController::class, 'authUser']);

Route::middleware(ValidateWebAppData::class)->controller(UserController::class)->group(function () {
    Route::post('/user/settings', 'updateUserSettings');
    Route::post('/auth/init', 'authUser');
});

Route::post('/bot/webhook', fn(Nutgram $bot) => $bot->run());

Route::controller(ExerciseController::class)->prefix('/exercises')->group(function () {
    Route::get('/', 'index');
    Route::get('/search', 'search');
});

Route::controller(WorkoutPlanController::class)->prefix('/plans')->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{workoutPlan}', 'show');
    Route::patch('/{workoutPlan}', 'update');
    Route::delete('/{workoutPlan}', 'destroy');
});
