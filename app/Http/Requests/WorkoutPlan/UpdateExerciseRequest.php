<?php

namespace App\Http\Requests\WorkoutPlan;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExerciseRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'position' => ['integer'],
            'is_optional' => ['boolean'],
            'notes' => ['string'],
            'sets' => ['integer'],
            'reps' => ['integer'],
            'exercise_variation' => ['string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
