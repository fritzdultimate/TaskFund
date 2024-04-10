<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('livewire.layouts.auth')]
class AccountVerification extends Component {
    public $otp;
    public $otpErrMsg = '';
    public $email;
    public $from;
    public string $userId;

    public $payload;

    public function mount($payload = []){
        if(isset($payload['email'])){
            $user = User::where('email', $payload['email'])->first();
            $this->userId = $user->id;
        }
    }

    #[On('account-success')] 
    public function accountSuccess($userData){
    }


   
    public function rendered(){
        $this->dispatch('js-otp-event');
    }
    public function render()
    {
        return view('livewire.auth.account-verification');
    }
}
