<?php

use App\Enums\ReferralLevels;

return [
    [
        'depth' => ReferralLevels::LEVEL_ONE,
        'referral_commission' => 5,
    ],
    [
        'depth' => ReferralLevels::LEVEL_TWO,
        'referral_commission' => 2,
    ],
    [
        'depth' => ReferralLevels::LEVEL_THREE,
        'referral_commission' => 1,
    ],
];