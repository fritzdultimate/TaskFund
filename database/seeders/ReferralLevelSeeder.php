<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReferralLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = config('referral_levels');

        Task::factory(count($tasks))
            ->youtube()
            ->state(function () use (&$tasks) {
                return array_shift($tasks) ?? [];
            })
            ->create();
    }
}
