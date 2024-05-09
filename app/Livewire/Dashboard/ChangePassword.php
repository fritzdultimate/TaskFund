<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('livewire.layouts.dashboard')]
#[Title('Level for enterpreneurs')]
class ChangePassword extends Component
{
    #[Validate(['required', 'min:6'], message:[
        'password.required' => 'Please enter new password',
        'password.min' => 'Password is too short',
    ])]
    public $password;

    #[Validate(['required_with:password', 'same:password'], message:[
        'password_confirmation.required_with' => 'Password Confirmation cannot be empty!',
        'password_confirmation.same' => 'Passwords do not match',
    ])]
    public $password_confirmation;
    
    #[Validate(['required', 'current_password'], message:[
        'current_password.required' => 'Current password is required',
        'current_password.current_password' => 'Current password is incorrect',
    ])]
    public $current_password;

    public function changePassword(){
        $this->validate();
        User::active()->update(['password' => Hash::make($this->password)]);
        return ['success' => true, 'message' => 'Password updated successfully'];
    }

    public function render()
    {
        return view('livewire.dashboard.change-password');
    }
}
