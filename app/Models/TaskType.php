<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'is_active',
    ];


    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeYoutube($query, $columns = []) {
        return $query->where('name', 'like', '%youtube%')->first($columns);
    }

    public function scopeFacebook($query, $columns = []) {
        return $query->where('name', 'like', '%facebook%')->first($columns);
    }

    public function scopeInstagram($query, $columns = []) {
        return $query->where('name', 'like', '%instagram%')->first($columns);
    }

    public function scopeTiktok($query, $columns = []) {
        return $query->where('name', 'like', '%tiktok%')->first($columns);
    }

    public function scopeWhatsapp($query, $columns = []) {
        return $query->where('name', 'like', '%whatsapp%')->first($columns);
    }
}
