<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('livewire.layouts.auth')]
#[Title('Login to start investing')]
class Login extends Component {
    #[Rule('required|email')] 
    public $login = '';
    public $password = '';
    public $errorMsg = '';

    public function submit() {
        $user = User::where('email', $this->login)->orWhere('username', $this->login)->first();
        if($user) {
            if(!password_verify($this->password, $user->password)) {
                $this->errorMsg = 'Wrong details entered.';
            } else {
                Auth::login($user);
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
