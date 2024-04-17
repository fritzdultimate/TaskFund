<?php

namespace App\Http\Controllers;

use App\Enums\TransactionTypes;
use App\Models\Deposit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProcessDepositController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // dd(session('payment_init'));

        $success = false;

        DB::transaction(function() use($request, &$success) {

            $user = User::active();
            $amount = (float) session('payment_init.amount_in_naira');
    
            $deposit = $user->deposits()->create([
                'reference' => $request->query('reference'),
                'amount' => $amount
            ]);
    
    
            $deposit->transactions()->create([
                'user_id' => auth()->id(),
                'type' => TransactionTypes::DEPOSIT,
            ]);
    
            $user->increment('balance', $amount);

            session()->flash('success');
            $success = true;
    
        });
        if($success) return to_route('deposit');
    }
}
