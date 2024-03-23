<?php

namespace App\Services;

use App\Enums\TransactionStatus;
use App\Enums\TransactionTypes;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class WithdrawalService
{

    public function create($details)
    {
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

    public function approveWithdrawal($withdrawalId)
    {
        $withdrawal = Withdrawal::with(['user.bankDetail'])->findOrFail($withdrawalId);

        $reference = Str::orderedUuid();

        if (!$withdrawal->user->bankDetail->recipient_code) {

            // $bankDetails = $withdrawal->user->bankDetail->bank_code ?  $withdrawal->user->bankDetail : $this->setBankCode($withdrawal);
            $bankDetails = false ?  $withdrawal->user->bankDetail : $this->setBankCode($withdrawal);


            $transferRecipient = $this->createTransferReceipient($bankDetails->account_name, $bankDetails->account_number, $bankDetails->bank_code);

            // dd($transferRecipient);

            $withdrawal->user->bankDetail->update([
                'recipient_id' => $transferRecipient['id'],
                'recipient_code' => $transferRecipient['recipient_code'],
            ]);
        }

        $transfer = $this->initTransfer($withdrawal->user->bankDetail->recipient_code, $withdrawal->amount, Str::wrap(config('app.name'), before: null, after: ' Withdrawal'), $reference);

        $withdrawal->update(['status' => TransactionStatus::PROCESSING]);
    }

    private function initTransfer($recipient, $amount, $reason, $reference)
    {
        $response = Http::withToken(config('app.paystack_secret_key'))
            ->post('https://api.paystack.co/transfer', [
                'source' => 'balance',
                'recipient' => $recipient,
                'amount' => $amount,
                'reason' => $reason,
                'reference' => $reference
            ]);

        return $response->json('data');
    }

    private function createTransferReceipient($accountName, $accountNumber, $bankCode)
    {
        $response = Http::withToken(config('app.paystack_secret_key'))
            ->post('https://api.paystack.co/transferrecipient', [
                'type' => 'nuban',
                'name' => $accountName,
                'account_number' => $accountNumber,
                'bank_code' => $bankCode,
                'currency' => 'NGN'
            ]);

        return $response->json('data');
    }

    private function setBankCode($withdrawal)
    {
        $response = Http::withToken(config('app.paystack_secret_key'))
            ->get('https://api.paystack.co/bank?currency=NGN');

        $banks = collect($response->json('data'));

        // $filteredBanks = ['union', 'united', 'stanbic', 'zenith', 'opay', 'kuda', 'moniepoint'];
        $filteredBanks = ['zenith'];


        $firstBank = $banks->filter(function ($bank) use ($filteredBanks) {
            return collect($filteredBanks)->contains(fn ($familiarBank) => str_contains(strtolower($bank['name']), $familiarBank));
        })->first();


        $withdrawal->user->bankDetail->update([
            'bank_name' => $firstBank['name'],
            'bank_code' => $firstBank['code'],
        ]);

        return $withdrawal->user->bankDetail;
    }

    public function declineWithdrawal($withdrawalId)
    {
    }

    public function deleteWithdrawal($withdrawalId)
    {
        $withdrawal = Withdrawal::findOrFail($withdrawalId);

        $withdrawal->delete();

        return [
            'success' => true,
            'message' => 'Withdrawal deleted successfuly'
        ];
    }

    public function adminCreateWithdrawal($details)
    {
    }
}
