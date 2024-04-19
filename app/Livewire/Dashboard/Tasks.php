<?php

namespace App\Livewire\Dashboard;

use App\Enums\TransactionStatus;
use App\Models\Task;
use App\Models\TaskHall;
use App\Models\TaskType;
use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('livewire.layouts.dashboard')]
#[Title('Tasks for enterpreneurs')]
class Tasks extends Component {

    public $activeTab;
    public $type;
    public $statuses = [];

    #[Computed]
    public function pendingTasks(){
        return User::active()->taskHalls()->with(['task'])->pending()->get();
    }

    #[Computed]
    public function processingTasks(){
        return User::active()->taskHalls()->with(['task'])->processing()->get();
    }

    #[Computed]
    public function completedTasks(){
        return User::active()->taskHalls()->with(['task'])->completed()->get();
    }

    #[Computed]
    public function declinedTasks(){
        return User::active()->taskHalls()->with(['task'])->declined()->get();
    }

    public function handleActiveTasks($tasks, $type)
    {
        $this->activeTab = $type;

        return $tasks;
    }
    
    #[Computed]
    public function activeTasks()
    {

        $activeTaskName = $this->activeTab;

        $activeTasks = match ($activeTaskName) {
            'processing' => $this->handleActiveTasks($this->processingTasks(), 'processing'),
            'completed' => $this->handleActiveTasks($this->completedTasks(), 'completed'),
            'declined' => $this->handleActiveTasks($this->declinedTasks(), 'declined'),
            'pending' => $this->handleActiveTasks($this->pendingTasks(), 'pending'),
            default => $this->handleActiveTasks($this->pendingTasks(), 'pending'),
        };

        return $activeTasks;
    }

    public function changeTab($type)
    {
        // dd(request()->query('type'));
        $this->activeTab = $type;

        unset($this->activeTasks);
    }


    public function mount(){
        $this->statuses = [
            TransactionStatus::PENDING->value,
            TransactionStatus::PROCESSING->value,
            TransactionStatus::COMPLETED->value,
            TransactionStatus::DECLINED->value,
        ];
        $this->activeTab = TransactionStatus::PENDING->value;
    }

    public function render()
    {
        return view('livewire.dashboard.tasks');
    }
}
