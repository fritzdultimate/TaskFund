<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Models\VerificationTokens;
use Carbon\Carbon;
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
    public $email = 'fritz@gmail.com';
    public $password = 'Justmefritz@656';
    #[Rule('required|unique:users,username|min:3|alpha_dash')]
    public $username = 'emmy';
    #[Rule('required|min:2|alpha_dash')]
    public $firstname = 'Emeka';
    #[Rule('required|min:2|alpha_dash')]
    public $lastname = 'Nwosu';
    public $referral = '';
    #[Rule('required')]
    public $number = '08138222565';
    #[Rule('accepted', message: 'You must accept our terms and conditions to proceed')]
    public $terms = true;

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
        $data = [
            'email' => $this->email,
            'password' => $this->password,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'username' => $this->username,
            'from' => 'registration'
        ];
        $createUser = User::create([
            'username' => $this->username,
            'email' => $this->email,
            'first_name' => $this->firstname,
            'last_name' => $this->lastname,
            'phone_number' => $this->number,
            'password' => Hash::make($this->password)
        ]);

        if($createUser) {
            VerificationTokens::create([
                'user_id' => $createUser->id,
                'email' => $this->email,
                'token' => rand(100000, 999999),
                'expired_at' => Carbon::parse()->addHour()
            ]);
            if($this->referral) {}
            $this->dispatch('next-screen', ['payload' => $data, 'screen' => 'auth.account-verification'])->to(RegistrationDistributer::class);
        }
    }
}
