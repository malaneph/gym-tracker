<?php

namespace App\Http\Resources;

use App\Models\WorkoutPlanExercise;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin WorkoutPlanExercise */
class WorkoutPlanExerciseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'position' => $this->position,
            'is_optional' => $this->is_optional,
            'notes' => $this->notes,
            'rest_seconds' => $this->rest_seconds,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'variation' => ExerciseResource::make($this->exerciseVariation),
        ];
    }
}
