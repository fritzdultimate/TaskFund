<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function task(): BelongsTo {
        return $this->belongsTo(Task::class, 'task_id');
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopePending($query){
        return $query->where('status', 'pending');
    }

    public function scopeToday($query){
        return $query->whereDate('created_at', Carbon::today());
    }

    public function scopeApproved($query){
        return $query->where('status', 'approved');
    }

    public function scopeProcessing($query){
        return $query->where('status', 'processing');
    }

    public function scopeCompleted($query){
        return $query->where('status', 'completed');
    }
    public function scopeDeclined($query){
        return $query->where('status', 'declined');
    }
}
