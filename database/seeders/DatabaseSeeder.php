<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\ReferralLevels;
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

        $referrer_username = 'kasandra.bergstrom';
       
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
            ->create([
                'referrer_username' => $referrer_username,
            ]);


            
            $referrer = User::where('username', $referrer_username)->first();
            
            $level = 1;
    
            do {
                $referrer->referrals()->create([
                    'referred_user_id' => $user->id,
                    'level' => ReferralLevels::from($level)
                ]);
                
                $referrer = User::where('username', $referrer->referrer_username)->first();
                
                $level++;
                
                if($level > User::REFERRAL_LEVEL_LIMIT) break;
    
            } while($referrer);
            
    


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
