<?php

namespace App\Http\Requests\Exercise;

use App\Models\Exercise;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BaseRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', Rule::unique(Exercise::class)],
            'description' => ['string'],
            'muscles' => ['string'],
            'tutorial_url' => ['string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
