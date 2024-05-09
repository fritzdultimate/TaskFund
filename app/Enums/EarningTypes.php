<?php
    namespace App\Enums;
    use App\Traits\{EnumValues, EnumOptions};

    enum EarningTypes : string {
        use EnumValues;
        use EnumOptions;
        
        case TASK_EARNING = "task_earning";
        case COMMISSION = "commission";
        case REFERRAL_BONUS = "referral_bonus";
        case REBATE = "rebate";
      
        public function getLabel(self $value): string{ 
            return match($value){
                default => str_replace('_', ' ', $value->value)
            };
        }
    
        public function label(): string {
            return static::getLabel($this);
        }
    }