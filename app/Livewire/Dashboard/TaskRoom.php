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
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;

#[Layout('livewire.layouts.dashboard')]
#[Title('Task room for enterpreneurs')]
class TaskRoom extends Component {
    #[Locked]
    public $tasks = [];
    #[Locked]
    public $taskTypes = [];
    public $current = '';
    public $level = 1;


    public $activeTab;
    public $type;

    
    #[Computed]
    public function youtubeTasks(){
        return Task::youtube();
    }
    #[Computed]
    public function facebookTasks(){
        return Task::facebook();
    }
    #[Computed]
    public function whatsappTasks(){
        return Task::whatsapp();
    }
    #[Computed]
    public function tiktokTasks(){
        return Task::tiktok();
    }

    #[Computed]
    public function instagramTasks(){
        return Task::instagram();
    }

    public function handleActiveTasks($tasks, $type){
        $this->activeTab = TaskType::{$type}(['id', 'name']);

        return $tasks;
    }

    public function handleDefaultTask(){
        $firstTask = TaskType::first(['id', 'name']);
        $this->activeTab = $firstTask;
        return Task::where('task_type_id', $firstTask->id)->get();
    }

    #[Computed]
    public function activeTasks(){
        
        $activeTaskName = $this->type;
        
        $activeTasks = match($activeTaskName){
            'youtube' => $this->handleActiveTasks($this->youtubeTasks(), 'youtube'), 
            'facebook' => $this->handleActiveTasks($this->facebookTasks(), 'facebook'),
            'tiktok' => $this->handleActiveTasks($this->tiktokTasks(), 'tiktok'),
            'whatsapp' => $this->handleActiveTasks($this->whatsappTasks(), 'whatsapp'),
            default => $this->handleDefaultTask(),
        };

        // dd($this->activeTab);

        return $activeTasks;
    }

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

    public function changeTab($type){
        // dd(request()->query('type'));
        $this->type = $type;

        unset($this->activeTasks);
    }

    public function mount(TaskType $type) {
        $facebook_task_type = TaskType::where('name', 'facebook')->first();
        $type = $type->id ? $type : $facebook_task_type;

        $this->changeTab(strtolower(request()->query('type')));

        $this->activeTasks;
        
        $this->tasks = Task::where('task_type_id', $type->id)->get();

        
        $this->taskTypes = TaskType::all();

        $this->current = $type->name;
    }
}
