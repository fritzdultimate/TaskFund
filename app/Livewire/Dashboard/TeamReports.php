<?php

namespace App\Livewire\Dashboard;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('livewire.layouts.dashboard')]
#[Title('Task room for enterpreneurs')]
class TeamReports extends Component
{
    public function render()
    {
        return view('livewire.dashboard.team-reports');
    }
}
