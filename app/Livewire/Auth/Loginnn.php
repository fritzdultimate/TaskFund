<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('livewire.layouts.auth')]
#[Title('Login to start investing')]
class Login extends Component {
    #[Rule('required')] 
    public $login = '';
    public $password = '';
    public $errorMsg = '';

    public $accountVerified = true;
    public $showOtp = false;

    public function submit() {
        $this->validate();
        $user = User::where('email', $this->login)->orWhere('username', $this->login)->first();
        if($user) {
            if(!password_verify($this->password, $user->password)) {
                $this->errorMsg = 'Wrong details entered.';
            } else {
                if(!$user->email_verified_at) {
                    $this->accountVerified = false;
                    return $this->showOtp = true;
                }
                Auth::login($user);
                return redirect('/app/dashboard');
                $this->dispatch('login-s', 'Login was successful');
            }
        } else {
            $this->errorMsg = 'Wrong details entered.';
        }
    }

    public function render() {
        return view('livewire.auth.login');
    }
}
