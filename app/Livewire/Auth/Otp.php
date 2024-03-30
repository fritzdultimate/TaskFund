<?php

namespace App\Livewire\Auth;

use App\Events\LoginHistory;
use App\Models\User;
use App\Models\VerificationTokens;
use App\Modules\Users\Services\CreateUserService;
use App\Traits\API;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class Otp extends Component {

    public $verificationMethod;
    public $email;
    public $password;
    public $userId;
    public $otpErrMsg = ''; 
    public $otp = '';
    public $from = '';

    #[Locked]
    public $verifiedNewUser = false;

    
    public function verifyTwoFac() {
        if(!strlen($this->otp)) {
            $this->otpErrMsg = 'Missing otp';
            return;
        }
        $data = [
            'email' => $this->email,
            'token' => $this->otp,
            'id' => $this->userId 
        ];
        
        $result = $this->sendRequest(env("API_URL") . 'auth/twosteps/sign/in', 'POST', $data);

        if(!$result->status) {
            $this->otpErrMsg = $result->message;
        } else {
            $this->dispatch('user-logged-in', $result->token);

            // redirect user to next page.
        }
    }
 
    public function verify() {
        if(!strlen($this->otp)) {
            $this->otpErrMsg = 'Missing otp.';
            return;
        }
        try {
            $token = VerificationTokens::where([
                'email' => $this->email,
                'token' => $this->otp
            ])->first();

            if(!$token) {
                $this->otpErrMsg = 'Wrong or expired token';
            } else {
                VerificationTokens::where([
                    'email' => $this->email,
                    'token' => $this->otp
                ])->update([
                    'verified_at' => Carbon::now()
                ]);
                if($this->from == 'registration') {
                    User::where(['id' => $token->user_id])->update(['email_verified_at' => Carbon::now()]);
                    return redirect('/verified');
                }
                if($this->from == 'forgot-password') {
                    $data = [
                        'email' => $this->email
                    ];
                    $this->dispatch('next-screen', ['payload' => $data, 'screen' => 'auth.change-password'])->to(ForgotPassword::class);
                }
                VerificationTokens::where([
                    'email' => $this->email,
                    'token' => $this->otp
                ])->forceDelete();
            }

        } catch (\Throwable $th) {
            $this->otpErrMsg = "Something went wrong while verifying account. " . $th->getMessage();
        }
    }


    public function render() {
        return view('livewire.auth.otp');
    }

    public function mount($email = '', $userId = '', $from = '') {
        $this->email = $email;
        $this->userId = $userId;
        $this->from = $from;
    }
}
