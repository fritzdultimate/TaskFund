<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function boot(){
        parent::boot();

        static::creating(function(Transaction $record){
            $transaction_id = Str::random(12);
            $record->transaction_id = $transaction_id;
        });
    }
}
