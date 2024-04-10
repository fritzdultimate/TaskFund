<?php

namespace App\Livewire\Dashboard;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

#[Layout('livewire.layouts.dashboard')]
#[Title('Home for enterpreneurs')]
class Home extends Component {

    
    public function render()
    {
        // $this->authorize();
        return view('livewire.dashboard.home');
    }
}
