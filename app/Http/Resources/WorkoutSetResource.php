<?php

namespace App\Http\Resources;

use App\Models\WorkoutSet;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin WorkoutSet */
class WorkoutSetResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'set_index' => $this->set_index,
            'reps' => $this->reps,
            'weight' => $this->weight,
            'rpe' => $this->rpe,
            'notes' => $this->notes,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'workout_session' => $this->workout_session,
        ];
    }
}
