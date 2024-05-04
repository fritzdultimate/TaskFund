<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Earning extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function scopeTodayProfits($query)
    {
        return $query->whereDate('created_at', Carbon::today());
    }

    public function scopeYesterdayProfits($query)
    {
        return $query->whereDate('created_at', Carbon::yesterday());
    }

    public function scopeThisWeekProfits($query)
    {
        return $query->whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek(),
        ]);
    }

    public function scopeThisMonthProfits($query)
    {
        return $query->whereMonth('created_at', Carbon::now()->month);
    }
}
