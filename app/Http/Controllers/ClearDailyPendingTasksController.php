<?php

namespace App\Http\Controllers;

use App\Enums\TaskStatus;
use App\Models\TaskHall;
use Illuminate\Http\Request;

class ClearDailyPendingTasksController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        TaskHall::with('user')
            ->where('status', TaskStatus::PENDING->value)
            ->where('created_at', '<=', now()->subDay())
            ->lazyById(200, $column = 'id')
            ->each
            ->delete();
    }
}
