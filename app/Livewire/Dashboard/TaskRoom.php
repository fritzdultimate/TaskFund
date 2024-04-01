<?php

namespace App\Livewire\Dashboard;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

#[Layout('livewire.layouts.dashboard')]
#[Title('Task room for enterpreneurs')]
class TaskRoom extends Component {

    
    public function render()
    {
        // $this->authorize();
        return view('livewire.dashboard.task-room');
    }
}
