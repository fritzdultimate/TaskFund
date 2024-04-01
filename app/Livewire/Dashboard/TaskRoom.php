<?php

namespace App\Livewire\Dashboard;

use App\Models\Level;
use App\Models\Task;
use App\Models\TaskHall;
use App\Models\TaskType;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Locked;

#[Layout('livewire.layouts.dashboard')]
#[Title('Task room for enterpreneurs')]
class TaskRoom extends Component {
    #[Locked]
    public $tasks = [];
    public $level = 1;

    
    public function render() {
        // $this->authorize();
        return view('livewire.dashboard.task-room');
    }

    public function takeTask($id) {
        $level = Level::where('id', 1)->first();
        $tasks = TaskHall::where('user_id', Auth::id())->get();

        if($tasks->count() < $level->daily_tasks) {
            $tasks_already_exists = TaskHall::where([
                'task_id' => $id,
                'user_id' => Auth::id(),
            ])->first();
            if(!$tasks_already_exists) {
                $task_hall = TaskHall::create([
                    'task_id' => $id,
                    'user_id' => Auth::id(),
                ]);

                $this->dispatch('success', 'Task added to queue of pending tasks');
            } else {
                $this->dispatch('error', 'Task has already been added to queue');
            }
        } else {
            $this->dispatch('error', 'Daily task limit reached');
        }
    }

    public function switchTask($task) {
        $task_type = TaskType::where('name', $task)->first();
        $this->tasks = Task::where('task_type_id', $task_type->id)->get();
    }

    public function mount() {
        $facebook_task_type = TaskType::where('name', 'facebook')->first();
        $this->tasks = Task::where('task_type_id', $facebook_task_type->id)->get();
    }
}
