<?php

namespace App\Http\Requests\WorkoutPlan;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user' => ['string'],
            'name' => ['string'],
            'category' => ['string'],
            'is_default' => ['boolean'],
            'status' => ['string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
