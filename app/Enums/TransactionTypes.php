<?php
    namespace App\Enums;
    use App\Traits\{EnumValues, EnumOptions};

    enum TransactionTypes : string {
        use EnumValues;
        use EnumOptions;

        case DEPOSIT = "deposit";
        case WITHDRAWAL = "withdrawal";
        case TASK_EARNING = "task_earning";
        case REFERRAL_BONUS = "referral_bonus";

        public function getLabel(self $value): string{ 
            return match($value){
                default => str_replace('_', ' ', $value->value)
            };
        }
    
        public function label(): string {
            return static::getLabel($this);
        }
    }