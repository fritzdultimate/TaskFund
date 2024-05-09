<?php

namespace App\Livewire\Dashboard;

use App\Models\Level as ModelsLevel;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('livewire.layouts.dashboard')]
#[Title('Level for enterpreneurs')]
class Level extends Component {

    #[Computed]
    public function levels(){
        return ModelsLevel::all();
    }
    
    public function render()
    {
        return view('livewire.dashboard.level');
    }
}
