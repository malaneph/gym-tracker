<?php

namespace App\Enums;

enum WorkoutStatus: int
{
    case DRAFT = 0;
    case ACTIVE = 1;
    case DELETED = 2;
    case FINISHED = 3;

    public function label(): string
    {
        return match ($this) {
            self::DRAFT => 'Draft',
            self::ACTIVE => 'Active',
            self::DELETED => 'Deleted',
            self::FINISHED => 'Finished',
        };
    }
}
