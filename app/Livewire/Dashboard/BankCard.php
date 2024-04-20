<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('livewire.layouts.dashboard')]
#[Title('Level for enterpreneurs')]
class BankCard extends Component
{
    public ?string $realname = null;
    public ?string $bankId = null;
    public ?string $bankIdx = null;
    public ?string $accountNumber = null;
    public bool $fetchBanksError = false;


    public function mount()
    {
        $this->realname =  User::active()->bankDetail->account_name;

        $this->fetchBanksError = count($this->banks) == 0;
    }

    public function saveDetails()
    {
        $clientResponse = [];

        try {
            DB::transaction(function () use (&$clientResponse) {
                $bank = $this->banks[$this->bankIdx];

                $response = Http::paystack()->post('/transferrecipient', [
                    "type" => "nuban",
                    "name" => $this->realname,
                    "account_number" => $this->accountNumber,
                    "bank_code" => $bank['code'],
                    "currency" => $bank['currency']
                ])->json();

                if (!$response['status']) {
                    throw new \Exception($response['message']);
                }

                User::active()->bankDetail()->updateOrCreate(
                    [
                        'user_id' => auth()->id(),
                    ],
                    [
                        'bank_name' => $bank['name'],
                        'account_number' => $this->accountNumber,
                        'currency' => $bank['currency'],
                        'recipient_code' => $response['data']['recipient_code'],
                        'recipient_id' => $response['data']['id'],
                    ]
                );

                $clientResponse = ['success' => true, 'message' => 'Account Number Linked successfully'];
            });
        } catch (\Exception $e) {
            $clientResponse = ['success' => false, 'message' => $e->getMessage()];
            Log::error('Error saving bank details: ' . $e->getMessage());
        }

        return $clientResponse;
    }


    #[Computed]
    public function banks()
    {

        if (cache()->has('banks') && !count(cache('banks'))) {
            cache()->forget('banks');
        }

        $banks = cache()->remember('banks', now()->addMinutes(30), function () {
            try {
                $response = Http::paystack()->get('/bank')->json('data');
                return $response;
            } catch (\Illuminate\Http\Client\ConnectionException $e) {
                return [];
            }
        });

        return $banks;
    }

    public function render()
    {
        return view('livewire.dashboard.bank-card');
    }
}
