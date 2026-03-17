<?php

namespace App\Http\Requests\WorkoutPlan;

class ImportRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'token' => ['required', 'string'],
            'name' => ['required', 'string'],
        ];
    }
}
