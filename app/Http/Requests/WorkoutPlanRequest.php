<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Models\WorkoutPlan;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WorkoutPlanRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', Rule::unique(WorkoutPlan::class, 'name')],
            'user' => ['required', 'string', Rule::exists(User::class, 'id')],
            'category' => ['required', 'string'],
            'is_default' => ['required', 'boolean'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
