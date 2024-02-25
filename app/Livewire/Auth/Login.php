<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Request;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('livewire.layouts.auth')]
#[Title('Login to start investing')]
class Login extends Component {
    #[Rule('required|email')] 
    public $email = '';

    public $password = '';
    public $showPasswordField = false;
    public $errorMsg = '';

    public $otpErrMsg = '';
    
    public $twoFac = false;
    public $accountVerified = true;
    public $newDevice = false;
    public $otp = '';

    public function sendRequest($url, $method, $data) {
        $request = Request::create($url, $method, $data);
        $response = app()->handle($request);
        return json_decode($response->getContent());
    }

    public function viewEmailField() {
        $this->showPasswordField = false;
    }

    public function render() {
        return view('livewire.auth.login');
    }
}
