<?php

namespace App\Enums;

use App\Traits\EnumOptions;
use App\Traits\EnumValues;

enum ReferralLevels: string {
    use EnumValues, EnumOptions;

    case LEVEL_ONE = "1";
    case LEVEL_TWO = "2";
    case LEVEL_THREE = "3";
}