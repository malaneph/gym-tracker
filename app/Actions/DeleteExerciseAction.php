<?php

namespace App\Actions;

use App\Models\Exercise;
use DB;

class DeleteExerciseAction
{
    public function __construct() {}

    public function __invoke(Exercise $exercise): void
    {
        DB::transaction(function () use ($exercise) {
            $exercise->delete();
        });
    }
}
