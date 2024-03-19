<?php

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class LevelBuilder extends Builder {
    public function totalProfits(){
        return $this->daily_tasks * $this->profit_per_task;
    }
}