<?php

namespace App\Http\Requests\WorkoutSet;

use App\Models\WorkoutPlanExercise;
use Illuminate\Validation\Rule;

class CreateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'workout_plan_exercise' => ['required', Rule::exists(WorkoutPlanExercise::class, 'id')],
            'set_index' => ['required', 'integer'],
            'reps' => ['required', 'integer'],
            'weight' => ['required', 'numeric'],
            'rpe' => ['integer'],
            'notes' => ['string'],
        ];
    }
}
