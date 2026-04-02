<?php

use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkoutPlanController;
use App\Http\Controllers\WorkoutSessionController;
use App\Http\Controllers\WorkoutSetController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;
use Nutgram\Laravel\Middleware\ValidateWebAppData;
use SergiX44\Nutgram\Nutgram;

Route::controller(UserController::class)->prefix('/auth')->group(function () {
    Route::post('/login', 'login');
    Route::post('/init', 'authUser')->middleware([ValidateWebAppData::class, AuthMiddleware::class]);
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
        Route::get('/', 'index')->name('sessions.index');
        Route::post('/', 'store')->name('sessions.store');
        Route::get('/active', 'getActiveWorkoutSession')->name('sessions.active');

        Route::prefix('/{workoutSession}')->group(function () {
            Route::get('/', 'show')->name('sessions.show');
            Route::patch('/', 'update')->name('sessions.update');
            Route::delete('/', 'destroy')->name('sessions.delete');
            Route::post('/finish', 'finishWorkoutSession')->name('sessions.finish');

            Route::controller(WorkoutSetController::class)->prefix('/sets')->group(function () {
                Route::post('/', 'store');
                Route::prefix('/{workoutSet}')->group(function () {
                    Route::post('/', 'show')->name('sets.show');
                    Route::patch('/', 'update')->name('sets.update');
                    Route::delete('/', 'destroy')->name('sets.delete');
                });
            });
        });
    });
