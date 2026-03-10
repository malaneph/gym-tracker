<?php

namespace App\Enums;

enum WorkoutPlanStatusEnum: int
{
    case DRAFT = 0;
    case ACTIVE = 1;
    case DELETED = 2;
}
