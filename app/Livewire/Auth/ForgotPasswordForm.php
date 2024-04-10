<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Models\VerificationTokens;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('livewire.layouts.auth')]
#[Title('Register to start investing')]
class ForgotPasswordForm extends Component {

    public $errorMsg = '';
    #[Rule('required|email')]
    public $email = 'fritzdultimate@gmail.com';

    public function render() {
        return view('livewire.auth.forgot-password-form');
    }

    public function submit() {
        $this->validate();
        $data = [
            'email' => $this->email,
            'from' => 'forgot-password'
        ];
        $user = User::where('email', $this->email)->first();
        if($user) {
            VerificationTokens::create([
                'user_id' => $user->id,
                'email' => $this->email,
                'token' => rand(100000, 999999),
                'expired_at' => Carbon::parse()->addHour()
            ]);
            $this->dispatch('next-screen', ['payload' => $data, 'screen' => 'auth.account-verification'])->to(ForgotPassword::class);
        } else {
            $this->errorMsg = 'An error has occured.';
        }
    }
}
