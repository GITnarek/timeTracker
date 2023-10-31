<?php

namespace App\Enums\Tasks;

use App\Enums\StringableEnum;

enum TypesEnum: string implements StringableEnum
{
    case TASK = 'TASK';
    case SUB_TASK = 'SUB TASK';
    case IMPROVEMENT = 'IMPROVEMENT';
    case BUG = 'BUG';
    case EPIC = 'EPIC';

    public function toString(): string
    {
        return $this->value;
    }
}
