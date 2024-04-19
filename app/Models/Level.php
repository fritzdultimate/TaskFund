<?php

namespace App\Models;

use App\Builders\LevelBuilder;
use Illuminate\Contracts\Database\Eloquent\Builder;
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
    
    protected $casts = [
        'is_automated' => 'boolean',
    ];
    
    public function newEloquentBuilder($query): LevelBuilder
    {
        return new LevelBuilder($query);
    }

    public function getIsCurrentAttribute(){
        return $this->id == auth()->user()->level_id;
    }
}
