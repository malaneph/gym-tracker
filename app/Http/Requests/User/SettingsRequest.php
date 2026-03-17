<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
