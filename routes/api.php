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
    Route::get('/', 'show');
    Route::patch('/user/settings', 'updateUserSettings');
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
        Route::post('/import', 'importWorkoutPlan');

        Route::prefix('/{workoutPlan}')->group(function () {
            Route::get('/', 'show');
            Route::patch('/', 'update');
            Route::delete('/', 'destroy');
            Route::post('/exercises', 'addExercise');
            Route::patch('/exercises/{exercise}', 'updateExercise');
            Route::post('/export', 'exportWorkoutPlan');
        });
    });

Route::middleware(AuthMiddleware::class)
    ->controller(WorkoutSessionController::class)
    ->prefix('/sessions')
    ->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/active', 'getActiveWorkoutSession');

        Route::prefix('/{workoutSession}')->group(function () {
            Route::get('/', 'show');
            Route::patch('/', 'update');
            Route::delete('/', 'destroy');
            Route::post('/finish', 'finishWorkoutSession');

            Route::controller(WorkoutSetController::class)->prefix('/sets')->group(function () {
                Route::post('/', 'store');
                Route::prefix('/{workoutSet}')->group(function () {
                    Route::post('/', 'show');
                    Route::patch('/', 'update');
                    Route::delete('/', 'destroy');
                });
            });
        });
    });
