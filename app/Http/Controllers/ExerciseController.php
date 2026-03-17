<?php

namespace App\Http\Controllers;

use App\Actions\CreateExercise;
use App\Actions\DeleteExercise;
use App\Data\ExerciseData;
use App\Http\Requests\Exercise\BaseRequest;
use App\Http\Requests\Exercise\SearchRequest;
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

    public function search(SearchRequest $request, GetExerciseQuery $query)
    {
        $name = $request->validated('name');
        $exercises = $query->search($name)->paginate(10);

        return ExerciseResource::collection($exercises);
    }

    public function store(BaseRequest $request, CreateExercise $action)
    {
        $data = ExerciseData::from($request->validated());
        $action($data);

        return ExerciseResource::make(
            Exercise::where('name', $data->name)->first()
        );
    }

    public function show(Exercise $exercise)
    {
        return new ExerciseResource($exercise);
    }

    public function update(BaseRequest $request, Exercise $exercise)
    {
        $exercise->update($request->validated());

        return new ExerciseResource($exercise);
    }

    public function destroy(Exercise $exercise, DeleteExercise $action)
    {
        $action($exercise);

        return response()->json();
    }
}
