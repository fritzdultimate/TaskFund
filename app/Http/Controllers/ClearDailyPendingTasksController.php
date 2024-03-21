<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClearDailyPendingTasksController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $pendingTasks = TaskHall::with('user')->where('status', 'pending');
    }
}
