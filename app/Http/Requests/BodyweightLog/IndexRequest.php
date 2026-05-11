<?php

namespace App\Http\Requests\BodyweightLog;

class IndexRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'date_period' => ['string'],
        ];
    }
}
