<?php

namespace App\Services;

use App\Enums\TaskStatus;
use App\Models\TaskHall;
use Illuminate\Support\Facades\DB;

class TaskService
{

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
