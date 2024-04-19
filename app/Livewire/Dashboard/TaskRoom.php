<?php

namespace App\Livewire\Dashboard;

use App\Models\Level;
use App\Models\Task;
use App\Models\TaskHall;
use App\Models\TaskType;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;

#[Layout('livewire.layouts.dashboard')]
#[Title('Task room for enterpreneurs')]
class TaskRoom extends Component
{
    #[Locked]
    public $tasks = [];
    #[Locked]
    public $taskTypes = [];
    public $current = '';
    public $level = 1;


    public $activeTab;
    public $type;

    #[Computed]
    public function addedTasks()
    {
        return TaskHall::where('user_id', auth()->id())->pluck('task_id')->toArray();
    }

    #[Computed]
    public function youtubeTasks()
    {
        return Task::youtube()->whereNotIn('id', $this->addedTasks)->get();
    }
    #[Computed]
    public function facebookTasks()
    {
        return Task::facebook()->whereNotIn('id', $this->addedTasks)->get();;
    }
    #[Computed]
    public function whatsappTasks()
    {
        return Task::whatsapp()->whereNotIn('id', $this->addedTasks)->get();;
    }
    #[Computed]
    public function tiktokTasks()
    {
        return Task::tiktok()->whereNotIn('id', $this->addedTasks)->get();;
    }

    #[Computed]
    public function instagramTasks()
    {
        return Task::instagram()->whereNotIn('id', $this->addedTasks)->get();;
    }

    public function handleActiveTasks($tasks, $type)
    {
        $this->activeTab = TaskType::{$type}(['id', 'name']);

        return $tasks;
    }

    public function handleDefaultTask()
    {
        $firstTask = TaskType::first(['id', 'name']);
        $this->activeTab = $firstTask;
        return Task::where('task_type_id', $firstTask->id)->get();
    }

    #[Computed]
    public function activeTasks()
    {

        $activeTaskName = $this->type;

        $activeTasks = match ($activeTaskName) {
            'youtube' => $this->handleActiveTasks($this->youtubeTasks(), 'youtube'),
            'facebook' => $this->handleActiveTasks($this->facebookTasks(), 'facebook'),
            'tiktok' => $this->handleActiveTasks($this->tiktokTasks(), 'tiktok'),
            'whatsapp' => $this->handleActiveTasks($this->whatsappTasks(), 'whatsapp'),
            default => $this->handleDefaultTask(),
        };

        return $activeTasks;
    }

    
    public function takeTask($id)
    {
        $user =  User::active();
        $level = $user->level;
        $tasks = $user->taskHalls();
        
        if ($tasks->count() < $level->daily_tasks) {
            $tasks_already_exists = TaskHall::where([
                'task_id' => $id,
                'user_id' => Auth::id(),
            ])->exists();
            if (!$tasks_already_exists) {
                $task_hall = TaskHall::create([
                    'task_id' => $id,
                    'user_id' => Auth::id(),
                ]);

                unset($this->activeTasks);
                
                $this->dispatch('success', 'Task added to queue of pending tasks');
            } else {
                $this->dispatch('error', 'Task has already been added to queue');
            }
        } else {
            $this->dispatch('error', 'Daily task limit reached');
        }
    }

    public function switchTask($task)
    {
        $task_type = TaskType::where('name', $task)->first();
        $this->tasks = Task::where('task_type_id', $task_type->id)->get();
    }

    public function changeTab($type)
    {
        // dd(request()->query('type'));
        $this->type = $type;

        unset($this->activeTasks);
    }
    
    public function mount(TaskType $type)
    {
        $facebook_task_type = TaskType::where('name', 'facebook')->first();
        $type = $type->id ? $type : $facebook_task_type;

        $this->changeTab(strtolower(request()->query('type')));
        
        $this->addedTasks;
        
        $this->activeTasks;
        
        $this->tasks = Task::where('task_type_id', $type->id)->get();

        
        $this->taskTypes = TaskType::all();

        $this->current = $type->name;
    }
    
    public function render()
    {
        return view('livewire.dashboard.task-room');
    }
}
