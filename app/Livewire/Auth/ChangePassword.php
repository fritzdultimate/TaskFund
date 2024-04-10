<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('livewire.layouts.auth')]
#[Title('Change your password')]
class ChangePassword extends Component {
    #[Rule('required')] 
    public $password = '';
    public $repassword = '';
    public $errorMsg = '';
    public $email;
    public $payload;

    public function submit() {
        $this->validate();
        $user = User::where('email', $this->payload['email'])->first();
        if($user) {
            User::where('email', $this->payload['email'])->update([
                'password' => Hash::make($this->password)
            ]);
            $data = [
                'response' => "Password was changed successfully",
                'url' => '/login',
                'bg' => 'bg-blue-200',
                'text' => 'text-blue-600',
                'btn-color' => 'bg-blue-100',
                'btn-bg' => 'bg-blue-700',
                'icon' => 'uil-check',
                'icon-color' => 'text-green-600'
            ];
            $this->dispatch('next-screen', ['payload' => $data, 'screen' => 'misc.message-livewire'])->to(ForgotPassword::class);
        } else {
            $this->errorMsg = 'Invalid approach';
        }
    }

    public function render() {
        return view('livewire.auth.change-password');
    }

    public function mount($email = '') {
    }
}
