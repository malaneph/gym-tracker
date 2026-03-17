<?php

namespace App\Http\Requests\WorkoutPlan;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        if ($this->user()) {
            return true;
        }
    }
}
