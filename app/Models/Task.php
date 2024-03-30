<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_type_id',
        'link',
        'instructions',
    ];

    public function type() : BelongsTo {
        return $this->belongsTo(TaskType::class, 'task_type_id');
    }
    
}
