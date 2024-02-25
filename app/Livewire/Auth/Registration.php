<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('livewire.layouts.auth')]
#[Title('Register to start investing')]
class Registration extends Component {

    public $errorMsg = '';
    #[Rule('required|email')] 
    public $email = '';

    public $username = '';
    public $firstname = '';
    public $lastname = '';
    public function render()
    {
        return view('livewire.auth.registration');
    }
}
