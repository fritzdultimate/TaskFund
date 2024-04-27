<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use App\Services\WithdrawalService;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('livewire.layouts.dashboard')]
#[Title('Level for enterpreneurs')]
class Withdrawal extends Component
{
    public array $availableAmounts = [];
    public $userHasLinkedBankAccount;

    #[Validate('required', message:[
        'withdrawalAmount.required' => 'Please choose a withdrawal amount'
    ])]
    public $withdrawalAmount;

    #[Validate(['required', 'exists:bank_details,id'], message:[
        'withdrawalMethodId.required' => 'Please select a withdrawal method',
        'withdrawalMethodId.exists' => 'Invalid Withdrawal Method',
    ])]
    public $withdrawalMethodId;

    #[Validate('required', message:[
        'fundPassword.required' => 'Please enter your fund password'
    ])]
    public $fundPassword;

    public function mount(){
        $this->availableAmounts = [1500, 3000, 6000,18000, 60000, 150000, 400000, 1000000, 2500000, 5000000];        
        $this->userHasLinkedBankAccount = $this->banks->isNotEmpty();
    }

    public function requestWithdrawal(){
        $this->validate();

        if(!in_array($this->withdrawalAmount, $this->availableAmounts)) return $this->addError('withdrawalAmount', 'Invalid withdrawal amount');
        if($this->fundPassword !== auth()->user()->fund_password) return $this->addError('fundPassword', 'Fund password is incorrect');
        
        $withdrawalService = new WithdrawalService;

        $withdrawalService->create([
            'bank_detail_id' => $this->withdrawalMethodId,
            'user_id' => auth()->id(),
            'amount' => $this->withdrawalAmount
        ]);

        return ['success' => true, 'message' => 'Withdrawal request created successfully, You will be credited once your request has been processed'];

    }

    #[Computed]
    public function banks(){
        // return collect([]);
        return User::active()->bankDetails;
    }

    public function render()
    {
        return view('livewire.dashboard.withdrawal');
    }
}
