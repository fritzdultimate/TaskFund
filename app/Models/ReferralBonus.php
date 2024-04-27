<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class ReferralBonus extends Model
{
    use HasFactory;

    public function earnings(): MorphMany {
        return $this->morphMany(Earning::class, 'earnable');
    }
}
