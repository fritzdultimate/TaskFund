<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Withdrawal extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function transactions(): MorphMany {
        return $this->morphMany(Transaction::class, 'transactionable');
    }

    public function getDateAttribute(){
        return $this->created_at->format('YmdHisv');
    }

    public function getAmountFormattedAttribute(){
        
        return "₦" . number_format($this->amount);
    }

    public function getStatusColorAttribute(){
        return match($this->status){
            'pending' => 'badge-pending',
            'approved' => 'badge-approved',
            'processing' => 'badge-processing',
            'declined' => 'badge-declined',
        };
    }
}
