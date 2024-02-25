<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('livewire.layouts.auth')]
#[Title('Register to start investing')]
class AccountDetailsConfirmation extends Component {

    public $errorMsg = '';

    public $accountName = '';
    public $bankName = '';
    public $accountNumber = '';
    public function render()
    {
        return view('livewire.auth.account_details_confirmation');
    }
}
