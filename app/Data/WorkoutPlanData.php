<?php

namespace App\Data;

use App\Enums\WorkoutPlanStatus;
use Ramsey\Uuid\Uuid;
use Spatie\LaravelData\Data;

class WorkoutPlanData extends Data
{
    public function __construct(
        public ?Uuid $user,
        public string $name,
        public string $category,
        public int $is_default,
        public ?WorkoutPlanStatus $status = WorkoutPlanStatus::DRAFT,
    ) {}
}
