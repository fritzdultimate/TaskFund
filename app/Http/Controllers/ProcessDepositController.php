<?php

namespace App\Http\Controllers;

use App\Enums\TransactionStatus;
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
            // $amount = (float) session('payment_init.amount_in_naira');

            $deposit = Deposit::find(session('payment_init.deposit_id'));
    
            $deposit->update(['status' => TransactionStatus::APPROVED]);

            // $deposit = $user->deposits()->create([
            //     'reference' => $request->query('reference'),
            //     'amount' => $amount
            // ]);
    
            $user->increment('balance', $deposit->amount);

            session()->flash('success');
            $success = true;
    
        });
        if($success) return to_route('deposit');
    }
}
