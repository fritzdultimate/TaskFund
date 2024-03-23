<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\BankDetail;
use App\Models\Level;
use App\Models\User;
use Database\Factories\LevelFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $user = User::factory()
            ->level1()
            ->has(
                BankDetail::factory()
                ->state(function (array $attributes, User $user) {
                    return [
                        'account_name' => $user->firstname . ' ' . $user->lastname,
                    ];
                })
            )
            ->create();


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
