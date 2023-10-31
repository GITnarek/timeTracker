<?php

namespace App\Enums\Tasks;

use App\Enums\StringableEnum;

enum PrioritiesEnum: string implements StringableEnum
{
   case MINOR = 'MINOR';
   case MAJOR = 'MAJOR';
   case CRITICAL = 'CRITICAL';
   case BLOCKER = 'BLOCKER';

   public function toString(): string
   {
       return $this->value;
   }
}
