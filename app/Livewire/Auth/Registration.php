<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('livewire.layouts.auth')]
#[Title('Register to start investing')]
class Registration extends Component {

    public $errorMsg = '';
    #[Rule('required|email|unique:users,email')]
    public $email = '';
    public $password = '';
    #[Rule('required|unique:users,username|min:3|alpha_dash')]
    public $username = '';
    #[Rule('required|min:2|alpha_dash')]
    public $firstname = '';
    #[Rule('required|min:2|alpha_dash')]
    public $lastname = '';
    public $referral = '';
    #[Rule('required')]
    public $number = '';
    #[Rule('accepted', message: 'You must accept our terms and conditions to proceed')]
    public $terms = false;

    public function rules() {
        return [
            'password' => ['required', Password::min(8)->letters()->mixedCase()->numbers()->symbols()]
        ];
    }

    public function render() {
        return view('livewire.auth.registration');
    }

    public function register() {
        $this->validate();
        $createUser = User::create([
            'username' => $this->username,
            'email' => $this->email,
            'first_name' => $this->firstname,
            'last_name' => $this->lastname,
            'phone_number' => $this->number,
            'password' => Hash::make($this->password)
        ]);

        if($createUser) {
            echo 'User created';
            // verify otp
            if($this->referral) {}
        }
    }
}
