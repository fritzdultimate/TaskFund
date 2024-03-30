<?php

namespace App\Enums;

use App\Traits\EnumOptions;
use App\Traits\EnumValues;

enum TaskStatus: string {
    use EnumValues, EnumOptions;

    case PENDING = "pending";
    case PROCESSING = "processing";
    case COMPLETED = "completed";
    case DECLINED = "declined";
}