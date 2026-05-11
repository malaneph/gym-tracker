<?php

namespace App\Http\Requests\BodyweightLog;

class CreateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'weight' => ['required', 'numeric'],
            'date' => ['required', 'date'],
        ];
    }
}
