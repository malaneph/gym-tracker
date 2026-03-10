<?php

namespace App\Data;

use Carbon\CarbonImmutable;
use Spatie\LaravelData\Data;

class ExerciseData extends Data
{
    public function __construct(
        public string $name,
        public string $description,
        public string $muscles,
        public string $tutorial_url,
        public CarbonImmutable $created_at,
        public CarbonImmutable $updated_at,
    ) {
    }
}
