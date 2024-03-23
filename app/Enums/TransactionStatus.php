<?php

namespace App\Enums;

use App\Traits\EnumOptions;
use App\Traits\EnumValues;

enum TransactionStatus: string {
    use EnumValues, EnumOptions;

    case PENDING = "pending";
    case PROCESSING = "processing";
    case APPROVED = "approved";
    case DECLINED = "declined";
}