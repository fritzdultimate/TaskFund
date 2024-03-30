<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = config('youtube-tasks');

        Task::factory(count($tasks))
            ->youtube()
            ->state(function () use (&$tasks) {
                return array_shift($tasks) ?? [];
            })
            ->create();
    }
}
