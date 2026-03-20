<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserSettingsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'language' => $this->language,
            'timezone' => $this->timezone,
            'units_system' => $this->units_system,
        ];
    }
}
