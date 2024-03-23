<?php

namespace App\Services;

use App\Enums\TransactionTypes;
use App\Models\Transaction;
use App\Models\Withdrawal;

class WithdrawalService
{

    public function create($details){
        $withdrawal = Withdrawal::create([
            'user_id' => $details['user_id'],
            'amount' => $details['amount'],
            'transaction' => [
                'user_id' => auth()->id(),
                'type' => TransactionTypes::WITHDRAWAL,
                'transactionable_type' => Withdrawal::class,
            ]
        ]);

    }

    public function approveWithdrawal($withdrawalId){
       
    }  
    
    public function declineWithdrawal($withdrawalId){
       
    }  
 
    public function deleteWithdrawal($withdrawalId){
        $withdrawal = Withdrawal::findOrFail($withdrawalId);

        $withdrawal->delete();

        return [
            'success' => true,
            'message' => 'Withdrawal deleted successfuly'
        ];
    }
    
    public function adminCreateWithdrawal($details){

       
    }
}
