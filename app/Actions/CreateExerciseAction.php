<?php

namespace App\Actions;

use App\Models\Exercise;
use Illuminate\Support\Facades\DB;

class CreateExerciseAction
{
    public function __construct() {}

    public function __invoke(array $attributes): void
    {
        DB::transaction(function () use ($attributes) {
            $exercise = new Exercise($attributes);
            $exercise->save();
        });
    }
}
