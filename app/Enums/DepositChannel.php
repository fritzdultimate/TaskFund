<?php

namespace App\Enums;

use App\Traits\EnumOptions;
use App\Traits\EnumValues;

enum DepositChannel: string {
    use EnumValues, EnumOptions;

    case CARD = "card";
    case BANK = "bank";
    case USSD = "ussd";
    case BANK_TRANSFER = "bank transfer";
    case QR_CODE = "QR code";

}