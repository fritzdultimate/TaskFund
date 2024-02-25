<?php

use App\Livewire\Auth\AccountCreated;
use App\Livewire\Auth\AccountDetailsConfirmation;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Registration;
use App\Livewire\Dashboard\Home;
use Illuminate\Support\Facades\Route;

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
Route::get('/register', Registration::class)->name('register');
Route::get('/register/details/confirmation', AccountDetailsConfirmation::class)->name('details-confirmation');
Route::get('/register/details/confirmed', AccountCreated::class)->name('details-confirmed');

Route::get('/app/dashboard', Home::class)->name('dashboard');

