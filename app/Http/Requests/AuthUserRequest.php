<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'initData' => ['required', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function validated($key = null, $default = null)
    {
        $data = [];
        parse_str($this->input('initData'), $data);
        
        return array_merge(parent::validated(), $data);
    }
}
