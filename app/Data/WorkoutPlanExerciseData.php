<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class WorkoutPlanExerciseData extends Data
{
    public function __construct(
        public UserData $user,
        public WorkoutPlanData $workout_plan,
        public ExerciseData $exercise,
        public int $position,
        public int $is_optional,
        public string $notes,
        public int $rest_seconds,
        public ?ExerciseData $exercise_variation
    ) {}
}
