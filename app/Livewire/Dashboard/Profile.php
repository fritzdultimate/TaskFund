<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('livewire.layouts.dashboard')]
#[Title('Level for enterpreneurs')]
class Profile extends Component
{
    public function render()
    {
        $user = User::active();
        
        $todayProfits = $user->earnings()->todayProfits()->sum('amount');
        $yesterdayProfits = $user->earnings()->yesterdayProfits()->sum('amount');
        $thisWeekProfits = $user->earnings()->ThisWeekProfits()->sum('amount');
        $thisMonthProfits = $user->earnings()->ThisMonthProfits()->sum('amount');
     
        // $thisWeekProfits = $user->earnings()->ThisWeekProfits();

        return view('livewire.dashboard.profile', [
            'todayProfits' => format_currency($todayProfits),
            'yesterdayProfits' => format_currency($yesterdayProfits),
            'thisWeekProfits' => format_currency($thisWeekProfits),
            'thisMonthProfits' => format_currency($thisMonthProfits),
            'totalRevenue' => format_currency(auth()->user()->total_earning),
            'referralBonus' => format_currency(auth()->user()->referral_bonus)
        ]);
    }
}
