<?php

namespace App\Livewire\Dashboard;

use App\Enums\ReferralLevels;
use App\Models\Deposit;
use App\Models\Referral;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('livewire.layouts.dashboard')]
#[Title('Task room for enterpreneurs')]
class TeamReports extends Component
{
    public function render()
    {

        $level1AmountRecharged = format_currency(
            $this->getTotalRecharged(ReferralLevels::LEVEL_ONE)
        );
        $level1RechargeCount = $this->getRechargeCount(ReferralLevels::LEVEL_ONE);
    

        $level2AmountRecharged = format_currency(
            $this->getTotalRecharged(ReferralLevels::LEVEL_TWO)
        );
        $level2RechargeCount = $this->getRechargeCount(ReferralLevels::LEVEL_TWO);


        $level3AmountRecharged = format_currency(
            $this->getTotalRecharged(ReferralLevels::LEVEL_THREE)
        );
        $level3RechargeCount = $this->getRechargeCount(ReferralLevels::LEVEL_THREE);


        return view('livewire.dashboard.team-reports', [
            'level1AmountRecharged' => $level1AmountRecharged,
            'level1RechargeCount' => $level1RechargeCount,

            'level2AmountRecharged' => $level2AmountRecharged,
            'level2RechargeCount' => $level2RechargeCount,

            'level3AmountRecharged' => $level3AmountRecharged,
            'level3RechargeCount' => $level3RechargeCount,

            'teamBenefits' => format_currency(auth()->user()->task_referral_commission + auth()->user()->referral_bonus),
        ]);
    }

    #[Computed]
    public function referrals(){
        return User::active()->referrals();
    }

    private function getTotalRecharged($level){
        unset($this->referrals);
        $referrals = $this->referrals;
        return User::whereIn(
            'id', 
            $referrals->where('level', $level)->pluck('referred_user_id')
        )
        ->sum('total_deposited');
    }

    private function getRechargeCount($level){
        unset($this->referrals);
        $referrals = $this->referrals;
        return Deposit::whereIn(
            'user_id', 
            $referrals->where('level', $level)->pluck('referred_user_id')
        )
        ->count();
    }
}
