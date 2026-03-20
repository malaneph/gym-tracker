<?php

namespace App\Http\Requests\WorkoutPlan;

use App\Models\Exercise;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddExerciseRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'exercise_name' => ['string'],
            'exercise' => [Rule::exists(Exercise::class, 'id')],
            'sets' => ['integer'],
            'reps' => ['integer'],
            'rest_seconds' => ['integer'],
            'rpe' => ['integer'],
            'notes' => ['string'],
            'position' => ['integer'],
            'is_optional' => ['boolean'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
