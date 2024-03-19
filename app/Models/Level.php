<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'capital',
        'welcome_bonus',
        'daily_tasks',
        'profit_per_task',
        'is_automated',
    ];
}
