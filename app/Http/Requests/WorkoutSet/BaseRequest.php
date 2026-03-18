<?php

namespace App\Http\Requests\WorkoutSet;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
}
