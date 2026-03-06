<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExerciseRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'uuid' => ['required'],
            'name' => ['required'],
            'description' => ['required'],
            'muscles' => ['required'],
            'tutorial_url' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
