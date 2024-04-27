<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BankDetail extends Model
{
    protected $guarded = [];
    
    use HasFactory;

    public function user(): BelongsTo{
        return $this->belongsTo(User::class, "user_id");
    }

    public function getAccountNumberMaskedAttribute(){
        return $this->maskNumber($this->account_number);
    }

    public function maskNumber($number){
        $numberLen = strlen($number);
        $codeArr = str_split($number);

        return join("", array_map(function($e, $idx) use($numberLen) {
            if($idx < 4) return $e;
            if($numberLen - $idx > 4) return '*'; 
            return $e;            
        }, $codeArr, array_keys($codeArr)));
        
    }
}
