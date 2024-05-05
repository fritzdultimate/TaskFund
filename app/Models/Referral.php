<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Referral extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeActive(){
        return $this->where('user_id', auth()->id());
    }

    public function referred(): BelongsTo {
        return $this->belongsTo(User::class, 'referred_user_id');
    }
    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }
}
