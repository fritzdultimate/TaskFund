<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('livewire.layouts.dashboard')]
#[Title('Level for enterpreneurs')]
class RealName extends Component
{

    
    public ?string $realname;

    public function mount(){
        $this->realname =  User::active()->legal_name;
    }

    public function setRealName(){
        $record = User::active()->update([
            'legal_name' => $this->realname
        ]);

        // if($record){
            //  to_route('personal-information');
             return ['success' => true, 'message' => 'updated successfully'];
        // }
    }

    public function render()
    {
        return view('livewire.dashboard.real-name');
    }
}
