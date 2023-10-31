<?php

namespace App\Enums\Tasks;

use App\Enums\StringableEnum;

enum StatusesEnum: string implements StringableEnum
{
    case TODO = 'TO DO';
    case IN_PROGRESS = 'IN PROGRESS';
    case READY_FOR_TEST = 'READY FOR TEST';
    case RESOLVED = 'RESOLVED';

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->value;
    }
}
