<?php

namespace App\Http\Controllers;

use App\Actions\CreateExerciseAction;
use App\Http\Requests\ExerciseRequest;
use App\Http\Resources\ExerciseResource;
use App\Models\Exercise;

class ExerciseController extends Controller
{
    public function index()
    {
        return ExerciseResource::collection(Exercise::all());
    }

    public function store(ExerciseRequest $request, CreateExerciseAction $action)
    {
        return ExerciseResource::make($action($request->validated()));
    }

    public function show(Exercise $exercise)
    {
        return new ExerciseResource($exercise);
    }

    public function update(ExerciseRequest $request, Exercise $exercise)
    {
        $exercise->update($request->validated());

        return new ExerciseResource($exercise);
    }

    public function destroy(Exercise $exercise)
    {
        $exercise->delete();

        return response()->json();
    }
}
