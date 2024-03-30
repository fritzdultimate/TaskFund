<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends User implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
       'name',
       'email',
       'password',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }
}
