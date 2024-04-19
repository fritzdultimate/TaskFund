<?php

namespace App\Livewire\Dashboard;

use App\Models\Task;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('livewire.layouts.dashboard')]
#[Title('Tasks for enterpreneurs')]
class Tasks extends Component {

    public function mount(){
      
    }

    

    
    public function render()
    {
        return view('livewire.dashboard.tasks');
    }
}
