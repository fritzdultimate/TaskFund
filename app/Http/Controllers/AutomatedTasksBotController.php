<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AutomatedTasksBotController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        User::with(['level' => fn($query) => $query->is_automated])
        ->lazyById(200, $column = 'id')
        ->each(function($user){
            $user->increment('balance', $user->level->total_profits);
        });
    }
}
