<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskHall extends Model
{
    public $fillable = [
        'task_id',
        'user_id',
        'status',
        'attachment',
        'created_at',
        'updated_at'
    ];
    use HasFactory, SoftDeletes;


    public function user() : BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }
}
