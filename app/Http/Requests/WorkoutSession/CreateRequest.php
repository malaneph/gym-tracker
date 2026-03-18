<?php

namespace App\Http\Requests\WorkoutSession;

use App\Models\WorkoutPlan;
use Illuminate\Validation\Rule;

class CreateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'workout_plan' => ['required', Rule::exists(WorkoutPlan::class, 'id')],
            'finished_at' => ['nullable', 'date'],
            'notes' => ['nullable'],
        ];
    }
}
