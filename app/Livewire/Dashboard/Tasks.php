<?php

namespace App\Livewire\Dashboard;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('livewire.layouts.dashboard')]
#[Title('Tasks for enterpreneurs')]
class Tasks extends Component {

    
    public function render()
    {
        return view('livewire.dashboard.tasks');
    }
}
