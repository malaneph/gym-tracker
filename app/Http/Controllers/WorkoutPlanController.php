<?php

namespace App\Http\Controllers;

use App\Actions\CreateWorkoutPlan;
use App\Actions\CreateWorkoutPlanExercise;
use App\Actions\DeleteWorkoutPlan;
use App\Actions\UpdateWorkoutPlan;
use App\Http\Requests\WorkoutPlanRequest;
use App\Http\Resources\WorkoutPlanResource;
use App\Models\WorkoutPlan;
use App\Queries\GetWorkoutPlanQuery;

class WorkoutPlanController extends Controller
{
    public function index(GetWorkoutPlanQuery $query)
    {
        $workoutPlans = $query->builder()->paginate(10);

        return WorkoutPlanResource::collection($workoutPlans);
    }

    public function store(WorkoutPlanRequest $request, CreateWorkoutPlan $action, GetWorkoutPlanQuery $query)
    {
        $data = $request->validated();
        $action($data);
        $result = $query->builder()->latest('created_at')->first();

        return new WorkoutPlanResource($result);
    }

    public function show(WorkoutPlan $workoutPlan)
    {
        return new WorkoutPlanResource($workoutPlan);
    }

    public function update(WorkoutPlanRequest $request, WorkoutPlan $workoutPlan, UpdateWorkoutPlan $action)
    {
        $action($workoutPlan, $request->validated());

        return new WorkoutPlanResource($workoutPlan->refresh());
    }

    public function destroy(WorkoutPlan $workoutPlan, DeleteWorkoutPlan $action)
    {
        $workoutPlan->delete();

        return response()->json();
    }

    public function addExercise(WorkoutPlan $workoutPlan, CreateWorkoutPlanExercise $action)
    {
        return new WorkoutPlanResource($workoutPlan);
    }
}
