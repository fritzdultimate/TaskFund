<?php

namespace Database\Seeders;

use App\Models\ReferralLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReferralLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $referralLevels = config('referral-levels');

        ReferralLevel::factory(count($referralLevels))
            ->state(function () use (&$referralLevels) {
                return array_shift($referralLevels) ?? [];
            })
            ->create();
    }
}
