<?php

namespace App\Enums;

use App\Traits\EnumOptions;
use App\Traits\EnumValues;

enum TransactionStatus: string {
    use EnumValues, EnumOptions;

    case PENDING = "pending";
    case PROCESSING = "processing";
    case COMPLETED = "completed";
    case APPROVED = "approved";
    case DECLINED = "declined";

    public static function getColor($value): string | array| null 
    {
        return match($value){
            self::APPROVED->value => 'success',
            self::DECLINED->value => 'danger',
            self::PROCESSING->value, self::PENDING->value => 'warning'
        };
    }
}