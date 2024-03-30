<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = config('levels');

        Level::factory(count($levels))
            ->state(function () use (&$levels) {
                return array_shift($levels) ?? [];
            })
            ->create();
    }
}
