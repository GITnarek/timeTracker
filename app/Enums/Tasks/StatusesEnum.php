<?php

namespace App\Enums\Tasks;

enum StatusesEnum: int
{
    case TODO = 0;
    case IN_PROGRESS = 1;
    case READY_FOR_TEST = 2;
    case RESOLVED = 3;
}
