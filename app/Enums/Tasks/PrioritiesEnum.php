<?php

namespace App\Enums\Tasks;

enum PrioritiesEnum: int
{
   case MINOR = 0;
   case MAJOR = 1;
   case CRITICAL = 2;
   case BLOCKER = 3;
}
