<?php

namespace App\Http\Requests\WorkoutSession;

class UpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'notes' => ['string'],
            'status' => ['string'],
        ];
    }
}
