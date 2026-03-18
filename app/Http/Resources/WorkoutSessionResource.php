<?php

namespace App\Http\Resources;

use App\Enums\WorkoutStatus;
use App\Models\WorkoutSession;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin WorkoutSession */
class WorkoutSessionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'started_at' => $this->started_at,
            'finished_at' => $this->finished_at,
            'notes' => $this->notes,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => WorkoutStatus::tryFrom($this->status)->label(),
            'workout_plan' => WorkoutPlanResource::make($this->workoutPlan),
            'sets' => WorkoutSetResource::collection($this->sets),
        ];
    }
}
