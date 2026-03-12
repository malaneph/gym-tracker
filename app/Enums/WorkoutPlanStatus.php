<?php

namespace App\Enums;

enum WorkoutPlanStatus: int
{
    case DRAFT = 0;
    case ACTIVE = 1;
    case DELETED = 2;

    public function label(): string
    {
        return match ($this) {
            self::DRAFT => 'Draft',
            self::ACTIVE => 'Active',
            self::DELETED => 'Deleted',
        };
    }
}
