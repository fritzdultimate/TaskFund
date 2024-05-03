<?php

namespace App\Livewire\Dashboard;

use App\Models\Level;
use App\Models\Task;
use App\Models\TaskType;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Computed;

#[Layout('livewire.layouts.dashboard')]
#[Title('Home for enterpreneurs')]
class Home extends Component
{

    


    public function boot()
    {
        // session()->forget(['completed-tasks-yep', $key]);

       

        // dd($this->completedTasks, $this->referrals);
    }

    #[Computed]
    public function taskTypes(){
        return TaskType::all(['name']);
    }
   

    #[Computed]
    public function levels(){
        return Level::all(['name', 'daily_tasks', 'referral_bonus', 'profit_per_task']);
    }

    private function generateData($length = 10, $isReferral = false)
    {

        $levels = $this->levels;

        $data = [];

        for ($i = 0; $i < $length; $i++) {

            $rand = rand(1000, 9000);

            $level = $levels[rand(0, count($levels) - 1)];

            $referralData = [
                'name' => $level->name,
                'referral_bonus' => $level->referral_bonus,
            ];

            $tasksData = [
                'tasks_completed' => $level->daily_tasks,
                'amount_earned' => $level->daily_tasks * $level->profit_per_task,
            ];

            if($isReferral){
                $data["****" . $rand] = $referralData;
            } else {
                $data["****" . $rand] = $tasksData;
            }

            // $data["****" . $rand] = $isReferral ? $referralData : $tasksData;

        }

        return $data;
    }


    private function getCompletedTasks()
    {
        $key = 'completed-tasks-' . auth()->id();

        if (session()->missing($key)) {

            $tasks = $this->generateData(20, isReferral:false);

            session([$key => $tasks]);

            return $tasks;
        }

        return session($key);
    }

    private function getReferrals()
    {
        $key = 'referrals-' . auth()->id();
        
        if (session()->missing($key)) {
            
            $referrals = $this->generateData(20, isReferral:true);
            
            session([$key => $referrals]);
            
            return $referrals;
        }
        
        return session($key);
    }

    public function render()
    {
        $completedTasks = [];
        $referrals = [];

        $completedTasks = $this->getCompletedTasks();
        $referrals = $this->getReferrals();

        // $this->authorize();
        return view('livewire.dashboard.home', [
            'completedTasks' => $completedTasks,
            'referrals' => $referrals,
        ]);
    }
}
