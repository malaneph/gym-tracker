<?php

namespace App\Http\Controllers;

use App\Actions\CreateWorkoutSet;
use App\Http\Requests\WorkoutSet\BaseRequest;
use App\Http\Requests\WorkoutSet\CreateRequest;
use App\Http\Resources\WorkoutSetResource;
use App\Models\WorkoutSession;
use App\Models\WorkoutSet;

class WorkoutSetController extends Controller
{
    public function index()
    {
        return WorkoutSetResource::collection(WorkoutSet::all());
    }

    public function store(WorkoutSession $workoutSession, CreateRequest $request, CreateWorkoutSet $action)
    {
        $action($workoutSession, $request->validated());

        $workoutSet = WorkoutSet::latest('created_at')->first();

        return WorkoutSetResource::make($workoutSet);
    }

    public function show(WorkoutSet $workoutSet)
    {
        return new WorkoutSetResource($workoutSet);
    }

    public function update(BaseRequest $request, WorkoutSet $workoutSet)
    {
        $workoutSet->update($request->validated());

        return new WorkoutSetResource($workoutSet);
    }

    public function destroy(WorkoutSet $workoutSet)
    {
        $workoutSet->delete();

        return response()->json();
    }
}
