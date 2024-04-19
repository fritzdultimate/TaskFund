<?php

namespace App\Livewire\Dashboard;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('livewire.layouts.dashboard')]
#[Title('Level for enterpreneurs')]
class PersonalInformation extends Component
{
    public function render()
    {
        return view('livewire.dashboard.personal-information');
    }
}
