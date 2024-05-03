<?php

namespace App\Services;

use App\Enums\TaskStatus;
use App\Models\ReferralLevel;
use App\Models\TaskHall;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TaskService
{

    private function distributeReferralCommision($investment, $interest)
    {
        $referrer = User::where('username', $investment->user->referrer_username)->first();

        if (!$referrer) return;

        $depth = 1;

        do {

            $referrallevel = ReferralLevel::where('depth', $depth)->first();


            $commission = ($referrallevel->referral_commission / 100) * $interest;

            $referrer->increment('total_earning', $commission);

            $referrer->
          
            $referralTaskBonus = 


            $referrer = User::where('username', $referrer->referrer_username)->first();

            $depth++;

            if ($depth > User::REFERRAL_LEVEL_LIMIT) break;
        } while ($referrer);
    }

    function approveTask($taskHallId){
        DB::beginTransaction();  

        $taskHall = TaskHall::with(['user.level', 'task'])->find($taskHallId);

        if(!$taskHall) return [
            'success' => false,
            'message' => 'Task Not Found'
        ];

        $taskHall->update(['status' => TaskStatus::COMPLETED]);

        $taskHall->user->increment('total_earning', $taskHall->user->level->profit_per_task);


    }

    function declineTask($taskHallId){
        
    }

    function processTask($taskHallId){
        
    }

    function deleteTask($taskHallId){
        
    }

}
