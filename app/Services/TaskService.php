<?php

namespace App\Services;

use App\Enums\EarningTypes;
use App\Enums\TaskStatus;
use App\Models\ReferralLevel;
use App\Models\TaskHall;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TaskService
{

    private function distributeReferralCommision($taskHall, $amount)
    {
        $referrer = User::where('username', $taskHall->user->referrer_username)->first();

        if (!$referrer) return;

        $depth = 1;

        do {

            $referrallevel = ReferralLevel::where('depth', $depth)->first();


            $commission = ($referrallevel->referral_commission / 100) * $amount;

            $referrer->increment('total_earning', $commission);
            $referrer->increment('task_referral_commission', $commission);

            $taskCommision = $referrer->taskReferralCommissions()->create([
                'task_hall_id' => $taskHall->id,
                'referral_level_id' => $referrallevel->id,
                'amount' => $commission
            ]);
          
            $taskCommision->earning()->create([
                'user_id' => $referrer->id,
                'amount' => $commission,
                'type' => EarningTypes::COMMISSION
            ]);


            $referrer = User::where('username', $referrer->referrer_username)->first();

            $depth++;

            if ($depth > User::REFERRAL_LEVEL_LIMIT) break;
        } while ($referrer);
    }

    function approveTask($taskHallId){
        // DB::beginTransaction();  

        $taskHall = TaskHall::with(['user.level', 'task'])->find($taskHallId);

        if(!$taskHall) return [
            'success' => false,
            'message' => 'Task Not Found'
        ];
        
        $profit_per_task = $taskHall->user->level->profit_per_task;

        
        $taskHall->user->increment('total_earning', $profit_per_task);

        $taskEarning = $taskHall->user->taskEarnings()->create([
            'user_id' => $taskHall->user->id,
            'task_hall_id' => $taskHall->id,
            'amount' => $profit_per_task
        ]);

        $taskEarning->earning()->create([
            'user_id' => $taskHall->user->id,
            'amount' => $profit_per_task,
            'type' => EarningTypes::TASK_EARNING
        ]);
        
        $this->distributeReferralCommision($taskHall, $profit_per_task);
        
        $taskHall->update(['status' => TaskStatus::COMPLETED]);

        return [
            'success' => true,
            'message' => 'Task Approved successfully'
        ];
    }

    function declineTask($taskHallId){
        
    }

    function processTask($taskHallId){
        
    }

    function deleteTask($taskHallId){
        
    }

}
