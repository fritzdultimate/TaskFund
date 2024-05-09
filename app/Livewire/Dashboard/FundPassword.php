<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('livewire.layouts.dashboard')]
#[Title('Level for enterpreneurs')]
class FundPassword extends Component
{
    #[Validate(['required', 'size:6'], message:[
        'fund_password.required' => 'Please enter Fund password',
        'fund_password.size' => 'Fund Password must be exactly 6 characters',
    ])]
    public $fund_password;

    #[Validate(['required_with:fund_password', 'same:fund_password'], message:[
        'fund_password_confirmation.required_with' => 'Fund Password Confirmation cannot be empty!',
        'fund_password_confirmation.same' => 'Fund Passwords do not match',
    ])]
    public $fund_password_confirmation;
    
    public function updateFundPassword(){
        $this->validate();

        $record = User::active()->update(['fund_password' => $this->fund_password]);        

        return ['success' => true, 'message' => 'Fund Password updated successfully'];
    }

    public function render()
    {
        return view('livewire.dashboard.fund-password');
    }
}
