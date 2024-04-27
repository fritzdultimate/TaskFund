<?php

namespace App\Livewire\Dashboard;

use App\Enums\TaskStatus;
use App\Models\TaskHall;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('livewire.layouts.dashboard')]
#[Title('Level for enterpreneurs')]
class TaskDetail extends Component
{
    use WithFileUploads;

    #[Locked]
    public $taskId;

    #[Validate(['attachments.*' => 'image|max:1024'])]
    public $attachments = [];

    public function submitTask(){
        // dd($this->attachments);
        $attachments = [];

        foreach ($this->attachments as $attachment) {
            array_push($attachments, $attachment->store('tasks', 'public'));
        }

        $this->taskHall->update([
            'attachments' => $attachments,
            'status' => TaskStatus::PROCESSING,
        ]);

        unset($this->taskHall);

        return ['success' => true, 'message' => 'Task successfully submitted for audit'];
    }

    public function mount($id){
        $this->taskId = $id;
        if(!$this->taskHall) return to_route('tasks');
    }

    #[Computed]
    public function taskHall(){
        return TaskHall::with(['task', 'user'])->find($this->taskId);
    }

    public function render()
    {
        return view('livewire.dashboard.task-detail');
    }
}
