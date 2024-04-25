<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('livewire.layouts.dashboard')]
#[Title('Level for enterpreneurs')]
class Wallet extends Component
{
    public function mount(){
        // dd($this->deposits()[0]->date);
    }

    #[Computed]
    public function deposits(){
        return User::active()->deposits()->get();
    }

    #[Computed]
    public function withdrawals(){
        return User::active()->withdrawals()->get();
    }

    public function render()
    {
        return view('livewire.dashboard.wallet');
    }
}
