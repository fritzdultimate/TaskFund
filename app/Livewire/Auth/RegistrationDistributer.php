<?php

namespace App\Livewire\Auth;

use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Request;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('livewire.layouts.auth')]
#[Title('Register to start investing')]
class RegistrationDistributer extends Component {

    #[Locked]
    public $current = 'auth.registration';

    #[Locked]
    public $canRegister = true;
        
    #[Locked]
    public $errorWhileRegistering = false;
    #[Locked]
    public $showOtp = false;

    public $payload = [];

    #[Locked]
    public $loading = true;


    #[On('next-screen')] 
    public function nextScreen($data){
        $this->current = $data['screen'];
        $this->payload = $data['payload'];
    }

    #[On('user-logged-in')] 
    public function userLogIn($data = ''){
    //    dd('loggedIn a muthafucka');
    }

    public function render() {
        return view('livewire.auth.registration-distributer');
    }

    public function mount() {
        $this->loading = false;
    }
       
}
