<?php

namespace App\Http\Resources;

use App\Models\WorkoutPlan;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin WorkoutPlan */
class WorkoutPlanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'name' => $this->name,
            'category' => $this->category,
            'is_default' => $this->is_default,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'exercises' => WorkoutPlanExercisesResource::collection($this->whenLoaded('exercises')),
        ];
    }
}
