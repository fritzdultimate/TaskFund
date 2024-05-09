<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Rebate extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function earning(): MorphOne {
        return $this->morphOne(Earning::class, 'earnable');
    }
}
