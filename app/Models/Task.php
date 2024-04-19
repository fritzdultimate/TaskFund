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

    public function scopeYoutube() {
        return $this->where('task_type_id', TaskType::where('name', 'like', '%youtube%')->first('id')->id)->get();
    }

    public function scopeFacebook() {
        return $this->where('task_type_id', TaskType::where('name', 'like', '%facebook%')->first('id')->id)->get();
    }

    public function scopeInstagram() {
        return $this->where('task_type_id', TaskType::where('name', 'like', '%instagram%')->first('id')->id)->get();
    }

    public function scopeTiktok() {
        return $this->where('task_type_id', TaskType::where('name', 'like', '%tiktok%')->first('id')->id)->get();
    }

    public function scopeWhatsapp() {
        return $this->where('task_type_id', TaskType::where('name', 'like', '%whatsapp%')->first('id')->id)->get();
    }
    
}
