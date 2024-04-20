<?php

use App\Http\Controllers\ProcessDepositController;
use App\Livewire\Auth\AccountCreated;
use App\Livewire\Auth\AccountDetailsConfirmation;
use App\Livewire\Auth\AccountVerification;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Misc\MessageResponse;
use App\Livewire\Auth\RegistrationDistributer;
use App\Livewire\Dashboard\AccountingRecords;
use App\Livewire\Dashboard\BankCard;
use App\Livewire\Dashboard\ChangePassword;
use App\Livewire\Dashboard\DailyStatement;
use App\Livewire\Dashboard\Deposit;
use App\Livewire\Dashboard\Earning;
use App\Livewire\Dashboard\FundPassword;
use App\Livewire\Dashboard\Home;
use App\Livewire\Dashboard\InviteFriends;
use App\Livewire\Dashboard\Level;
use App\Livewire\Dashboard\PersonalInformation;
use App\Livewire\Dashboard\PiggyMoney;
use App\Livewire\Dashboard\Profile;
use App\Livewire\Dashboard\RealName;
use App\Livewire\Dashboard\TaskRecords;
use App\Livewire\Dashboard\TaskRoom;
use App\Livewire\Dashboard\Tasks;
use App\Livewire\Dashboard\TeamReports;
use App\Livewire\Dashboard\Wallet;
use App\Livewire\Dashboard\Withdrawal;
use Illuminate\Support\Facades\Route;

// use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', Login::class)->name('login');
Route::get('/register', RegistrationDistributer::class)->name('register');
Route::get('/otp', AccountVerification::class)->name('otp');
Route::get('/register/details/confirmation', AccountDetailsConfirmation::class)->name('details-confirmation');
Route::get('/register/details/confirmed', AccountCreated::class)->name('details-confirmed');

Route::get('/forgot-password', ForgotPassword::class)->name('forgot-password');
Route::get('/message/response', MessageResponse::class)->name('message');

Route::middleware(['auth'])->group(function(){
    Route::get('/app/dashboard', Home::class)->name('dashboard');
    Route::get('/app/deposit', Deposit::class)->name('deposit');
    Route::get('/app/wallet', Wallet::class)->name('wallet');
    Route::get('/app/withdrawal', Withdrawal::class)->name('withdrawal');
    Route::get('/app/tasks', Tasks::class)->name('tasks');
    Route::get('/app/task/room', TaskRoom::class)->name('tasks-room');
    // Route::get('/app/task/room/{type:name}', TaskRoom::class)->name('tasks-room');
    Route::get('/app/level', Level::class)->name('level');
    Route::get('/app/profile', Profile::class)->name('profile');
    Route::get('/app/earning', Earning::class)->name('earning');
    Route::get('/app/personal-information', PersonalInformation::class)->name('personal-information');
    Route::get('/app/task-records', TaskRecords::class)->name('task-records');
    Route::get('/app/daily-statement', DailyStatement::class)->name('daily-statement');
    Route::get('/app/team-reports', TeamReports::class)->name('team-reports');
    Route::get('/app/invite-friends', InviteFriends::class)->name('invite-friends');
    Route::get('/app/piggy-money', PiggyMoney::class)->name('piggy-money');
    Route::get('/app/accounting-records', AccountingRecords::class)->name('accounting-records');

    Route::get('/app/info/name', RealName::class)->name('real-name');

    Route::get('/app/info/bank-card', BankCard::class)->name('bank-card');

    Route::get('/app/info/change-password', ChangePassword::class)->name('change-password');

    Route::get('/app/info/fund-password', FundPassword::class)->name('fund-password');


});


Route::get('/hooks/deposit', ProcessDepositController::class)->name('process-deposit');

