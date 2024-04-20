<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('livewire.layouts.dashboard')]
#[Title('Home for enterpreneurs')]
class Deposit extends Component
{
    public $amount;
    public $minimumDepositAmount;

    public function boot(){
        if(request()->has('cancel') && session()->has('payment_init')){
            session()->remove('payment_init');
            session()->flash('cancelled', ['success' => false, 'message' => 'Deposit cancelled']);
            return to_route('deposit');
        }
    }

    public function mount()
    {
        $this->minimumDepositAmount = '3000';
        $this->amount = $this->minimumDepositAmount;

        if(session()->has('cancelled')){
            // dd(session());
        }

        if(session()->has('success')){
            session()->flash('deposit-success', ['success' => 'true', 'message' => 'Your deposit of ' . number_format(session('payment_init.amount_in_naira'), 2) . ' is successful']);
            auth()->setUser(User::active());
            session()->remove('payment_init');
            // $this->dispatch('post-success', ['message' => 'from mount']);
        }
        
    }

    public function deposit()
    {
        $amountInKobo = $this->amount * 100;
        try {
            $response = Http::paystack()->post('/transaction/initialize', [
                'amount' => $amountInKobo,
                'email' => auth()->user()->email,
                'ref' => Str::ulid(),
                'currency' => 'NGN',
                'channels' => ['card', 'bank', 'qr', 'bank_transfer'],
                'callback_url' => route('process-deposit'),
                'metadata' => ["cancel_action" => route('deposit', ['cancel' => true])]
            ]);

            if ($response->json('status')) {
                $data = $response->json('data');
                session(['payment_init' => [
                    'amount_in_kobo' => $amountInKobo,
                    'amount_in_naira' => $this->amount,
                    'access_code' => $data['access_code'],
                    'reference' => $data['reference'],
                ]]);
                redirect()->away($data['authorization_url']);
            }
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            return [
                'success' => false, 
                'message' => 'We\'re seeing a temporary connection issue. Give it another shot in a moment!'
            ];
        }
    }

    public function render()
    {
        return view('livewire.dashboard.deposit');
    }
}
