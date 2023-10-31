<?php

namespace App\Enums\Tasks;

enum TypesEnum: int
{
    case TASK = 0;
    case SUB_TASK = 1;
    case IMPROVEMENT = 2;
    case BUG = 3;
    case EPIC = 4;
}
