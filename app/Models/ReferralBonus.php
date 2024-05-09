<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class ReferralBonus extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function earning(): MorphOne {
        return $this->morphOne(Earning::class, 'earnable');
    }

    public function transaction(): MorphOne {
        return $this->morphOne(Transaction::class, 'transactionable');
    }

    public function referred(): BelongsTo {
        return $this->belongsTo(User::class, 'referred_user_id');
    }
    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }
}
