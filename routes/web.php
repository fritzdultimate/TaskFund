<?php

use App\Http\Controllers\ProcessDepositController;
use App\Livewire\Auth\AccountCreated;
use App\Livewire\Auth\AccountDetailsConfirmation;
use App\Livewire\Auth\AccountVerification;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Misc\MessageResponse;
use App\Livewire\Auth\RegistrationDistributer;
use App\Livewire\Dashboard\Deposit;
use App\Livewire\Dashboard\Home;
use App\Livewire\Dashboard\Level;
use App\Livewire\Dashboard\TaskRoom;
use App\Livewire\Dashboard\Tasks;
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
    Route::get('/app/tasks', Tasks::class)->name('tasks');
    Route::get('/app/task/room', TaskRoom::class)->name('tasks-room');
    Route::get('/app/task/room/{type:name}', TaskRoom::class)->name('tasks-room');
    Route::get('/app/level', Level::class)->name('level');
    
});


Route::get('/hooks/deposit', ProcessDepositController::class)->name('process-deposit');

