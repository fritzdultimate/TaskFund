<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('livewire.layouts.auth')]
#[Title('Reset your password')]
class ForgotPassword extends Component {
    #[Rule('required')] 
    public $current = 'auth.forgot-password-form';
    public $password = '';
    public $errorMsg = '';
    public $payload = [];

    public $accountVerified = true;
    public $showOtp = false;

    #[On('next-screen')] 
    public function nextScreen($data){
        $this->current = $data['screen'];
        $this->payload = $data['payload'];
    }

    public function render() {
        return view('livewire.auth.forgot-password');
    }
}
