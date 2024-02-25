<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('livewire.layouts.auth')]
#[Title('Register to start investing')]
class AccountCreated extends Component {

    
    public function render()
    {
        return view('livewire.auth.account_created');
    }
}
