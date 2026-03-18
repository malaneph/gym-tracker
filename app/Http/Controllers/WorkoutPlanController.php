<?php

namespace App\Http\Controllers;

use App\Actions\CreateWorkoutPlan;
use App\Actions\CreateWorkoutPlanExercise;
use App\Actions\DeleteWorkoutPlan;
use App\Actions\ExportWorkoutPlan;
use App\Actions\ImportWorkoutPlan;
use App\Actions\UpdateWorkoutPlan;
use App\Actions\UpdateWorkoutPlanExercise;
use App\Http\Requests\WorkoutPlan\AddExerciseRequest;
use App\Http\Requests\WorkoutPlan\CreateRequest;
use App\Http\Requests\WorkoutPlan\ImportRequest;
use App\Http\Requests\WorkoutPlan\UpdateExerciseRequest;
use App\Http\Requests\WorkoutPlan\UpdateRequest;
use App\Http\Resources\WorkoutPlanExerciseResource;
use App\Http\Resources\WorkoutPlanResource;
use App\Models\WorkoutPlan;
use App\Models\WorkoutPlanExercise;
use App\Queries\GetWorkoutPlanQuery;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class WorkoutPlanController extends Controller
{
    public function index(GetWorkoutPlanQuery $query): AnonymousResourceCollection
    {
        $workoutPlans = $query->builder()->paginate(10);

        return WorkoutPlanResource::collection($workoutPlans);
    }

    public function store(CreateRequest $request, CreateWorkoutPlan $action, GetWorkoutPlanQuery $query)
    {
        $data = $request->validated();
        $action($data);
        $result = $query->builder()->latest('created_at')->first();

        return new WorkoutPlanResource($result);
    }

    public function show(WorkoutPlan $workoutPlan)
    {
        return WorkoutPlanResource::make($workoutPlan);
    }

    public function update(UpdateRequest $request, WorkoutPlan $workoutPlan, UpdateWorkoutPlan $action)
    {
        $action($workoutPlan, $request->validated());

        return new WorkoutPlanResource($workoutPlan->refresh());
    }

    public function destroy(WorkoutPlan $workoutPlan, DeleteWorkoutPlan $action)
    {
        $workoutPlan->delete();

        return response()->json();
    }

    public function addExercise(
        AddExerciseRequest $request,
        WorkoutPlan $workoutPlan,
        CreateWorkoutPlanExercise $action
    ) {
        $data = $request->validated();
        $action($workoutPlan, $data);

        return new WorkoutPlanExerciseResource($workoutPlan->exercises()->latest('created_at')->first());
    }

    public function updateExercise(
        UpdateExerciseRequest $request,
        WorkoutPlan $workoutPlan,
        WorkoutPlanExercise $exercise,
        UpdateWorkoutPlanExercise $action
    ) {
        $action($exercise, $request->validated());

        return WorkoutPlanExerciseResource::make($exercise->refresh());
    }

    public function exportWorkoutPlan(WorkoutPlan $workoutPlan, ExportWorkoutPlan $action)
    {
        $action($workoutPlan);

        return response()->json($workoutPlan->getToken());
    }

    public function importWorkoutPlan(ImportRequest $request, ImportWorkoutPlan $action)
    {
        $data = $request->validated();
        $action($data);

        return WorkoutPlanResource::make(WorkoutPlan::where('name', $data['name'])->first());
    }
}
