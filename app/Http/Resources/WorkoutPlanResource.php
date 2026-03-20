<?php

namespace App\Http\Resources;

use App\Enums\WorkoutStatus;
use App\Models\WorkoutPlan;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin WorkoutPlan */
class WorkoutPlanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'category' => $this->category,
            'is_default' => $this->is_default,
            'status' => WorkoutStatus::from($this->status)->label(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'exercises' => WorkoutPlanExerciseResource::collection($this->exercises()->get()),
        ];
    }
}
