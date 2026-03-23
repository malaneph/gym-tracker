<?php

namespace App\Http\Controllers;

use App\Actions\CreateWorkoutSession;
use App\Actions\DeleteWorkoutSession;
use App\Actions\UpdateWorkoutSession;
use App\Enums\WorkoutStatus;
use App\Http\Requests\WorkoutSession\CreateRequest;
use App\Http\Requests\WorkoutSession\UpdateRequest;
use App\Http\Resources\WorkoutSessionResource;
use App\Models\WorkoutSession;
use App\Queries\GetWorkoutSessionQuery;

class WorkoutSessionController extends Controller
{
    public function index(GetWorkoutSessionQuery $query)
    {
        $workoutSessions = $query->builder()->paginate(10);

        return WorkoutSessionResource::collection($workoutSessions);
    }

    public function store(CreateRequest $request, GetWorkoutSessionQuery $query, CreateWorkoutSession $action)
    {
        $action($request->validated());
        $workoutSession = $query->builder()
            ->whereIn('status', [WorkoutStatus::ACTIVE->value, WorkoutStatus::DRAFT->value])
            ->orderByDesc('created_at')
            ->first();

        return new WorkoutSessionResource($workoutSession);
    }

    public function show(WorkoutSession $workoutSession)
    {
        return WorkoutSessionResource::make($workoutSession);
    }

    public function update(UpdateRequest $request, WorkoutSession $workoutSession, UpdateWorkoutSession $action)
    {
        $action($workoutSession, $request->validated());

        return new WorkoutSessionResource($workoutSession->refresh());
    }

    public function destroy(WorkoutSession $workoutSession, DeleteWorkoutSession $action)
    {
        $action($workoutSession);

        return response()->json();
    }

    public function getActiveWorkoutSession(GetWorkoutSessionQuery $query)
    {
        $workoutSession = $query->builder()
            ->where('status', '=', WorkoutStatus::DRAFT->value)
            ->first();

        if (! $workoutSession) {
            return response()->json([
                'message' => 'No active workout session found',
                'data' => [],
            ], 404);
        }

        return WorkoutSessionResource::make($workoutSession);
    }

    public function finishWorkoutSession(WorkoutSession $workoutSession, UpdateWorkoutSession $action)
    {
        $action($workoutSession, [
            'status' => WorkoutStatus::FINISHED->value,
        ]);

        return WorkoutSessionResource::make($workoutSession->refresh());
    }
}
