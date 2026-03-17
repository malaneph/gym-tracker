<?php

namespace App\Http\Requests\WorkoutPlan;

use App\Models\WorkoutPlan;
use Illuminate\Validation\Rule;

class CreateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', Rule::unique(WorkoutPlan::class, 'name')],
            'category' => ['required', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
