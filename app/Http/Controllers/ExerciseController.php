<?php

namespace App\Http\Controllers;

use App\Actions\CreateExerciseAction;
use App\Actions\DeleteExerciseAction;
use App\Http\Requests\ExerciseRequest;
use App\Http\Requests\SearchExerciseRequest;
use App\Http\Resources\ExerciseResource;
use App\Models\Exercise;
use App\Queries\GetExerciseQuery;

class ExerciseController extends Controller
{
    public function index(GetExerciseQuery $query)
    {
        $exercises = $query->builder()->paginate(10);

        return ExerciseResource::collection($exercises);
    }

    public function search(SearchExerciseRequest $request, GetExerciseQuery $query)
    {
        $name = $request->validated('name');
        $exercises = $query->search($name)->paginate(10);

        return ExerciseResource::collection($exercises);
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

    public function destroy(Exercise $exercise, DeleteExerciseAction $action)
    {
        $action($exercise);

        return response()->json();
    }
}
