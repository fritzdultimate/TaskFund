<?php

namespace App\Livewire\Dashboard;

use App\Models\Level;
use App\Models\Task;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

#[Layout('livewire.layouts.dashboard')]
#[Title('Home for enterpreneurs')]
class Home extends Component {

    public $completedTasks = [];

    public function mount(){
        $this->completedTasks = $this->getCompletedTasks();
    }

    public function generateCompletedTasks($length = 10){
        $levels = Level::all(['name', 'daily_tasks', 'profit_per_task']);


        dd($levels);

        $tasks = [];

        for($i = 0; $i < $length; $i++){

            $rand = rand(1000,9000);

            $level = $levels[rand(0, count($levels) - 1)];

            $tasks["****" . $rand] = [
                'tasks_completed' => $level->daily_tasks,
                'amount_earned' => $level->daily_tasks * $level->profit_per_task,
            ];
        }

        return $tasks;
    }

    public function getCompletedTasks(){
        if(session()->missing('completed-tasks')){
           
            $tasks = $this->generateCompletedTasks(20);

            session(['completed-tasks' => $tasks]);

            return $tasks;
        }

        return session('completed-tasks');
    }
    
    public function render()
    {
        // $this->authorize();
        return view('livewire.dashboard.home');
    }
}
