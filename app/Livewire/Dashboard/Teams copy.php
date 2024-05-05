<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Contracts\HasTable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('livewire.layouts.dashboard')]
#[Title('Task room for enterpreneurs')]


class Teams extends Component 
// implements HasForms, HasTable
{
    // use InteractsWithTable;
    // use InteractsWithForms;

   
    public function render()
    {
        return view('livewire.dashboard.teams');
    }
}
