<?php

namespace App\Actions;

use App\Data\ExerciseData;
use App\Models\Exercise;
use Illuminate\Support\Facades\DB;

class CreateExercise
{
    public function __construct()
    {
    }

    public function __invoke(ExerciseData $data): void
    {
        DB::transaction(function () use ($data) {
            Exercise::create($data->toArray());
        });
    }
}
