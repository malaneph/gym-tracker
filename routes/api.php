<?php

use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkoutPlanController;
use App\Http\Controllers\WorkoutSessionController;
use App\Http\Controllers\WorkoutSetController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;
use SergiX44\Nutgram\Nutgram;

Route::controller(UserController::class)->prefix('/auth')->group(function () {
    Route::post('/login', 'login');
    Route::post('/init', 'authUser');
});

Route::middleware(AuthMiddleware::class)->controller(UserController::class)->group(function () {
    Route::post('/user/settings', 'updateUserSettings');
});

Route::post('/bot/webhook', fn (Nutgram $bot) => $bot->run());

Route::middleware(AuthMiddleware::class)
    ->controller(ExerciseController::class)
    ->prefix('/exercises')
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/search', 'search');
        Route::post('/', 'store');
    });

Route::middleware(AuthMiddleware::class)
    ->controller(WorkoutPlanController::class)
    ->prefix('/plans')
    ->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{workoutPlan}', 'show');
        Route::patch('/{workoutPlan}', 'update');
        Route::delete('/{workoutPlan}', 'destroy');
        Route::post('/{workoutPlan}/exercises', 'addExercise');
        Route::patch('/{workoutPlan}/exercises/{exercise}', 'updateExercise');
        Route::post('/{workoutPlan}/export', 'exportWorkoutPlan');
        Route::post('/import', 'importWorkoutPlan');
    });

Route::middleware(AuthMiddleware::class)
    ->controller(WorkoutSessionController::class)
    ->prefix('/sessions')
    ->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/{workoutSession}', 'show');
        Route::patch('/{workoutSession}', 'update');
        Route::delete('/{workoutSession}', 'destroy');
        Route::get('/active', 'getActiveWorkoutSession');
        Route::post('/{workoutSession}/finish', 'finishWorkoutSession');

        Route::controller(WorkoutSetController::class)->prefix('/{workoutSession}/sets')->group(function () {
            Route::post('/', 'store');
            Route::get('/{workoutSet}', 'show');
            Route::patch('/{workoutSet}', 'update');
            Route::delete('/{workoutSet}', 'destroy');
        });
    });
