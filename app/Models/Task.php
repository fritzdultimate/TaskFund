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

    public function getImageAttribute(){
        return match(strtolower(trim($this->type->name))){
            'youtube' => asset('img/icons/youtube.png'),
            'whatsapp' => asset('img/icons/whatsapp.png'),
            'facebook' => asset('img/icons/facebook.png'),
            'instagram' => asset('img/icons/instagram.png'),
            'tiktok' => asset('img/icons/tiktok.png'),
        };
    }

    public function type() : BelongsTo {
        return $this->belongsTo(TaskType::class, 'task_type_id');
    }

    public function getTitleLabelAttribute(){
        return match(strtolower(trim($this->type->name))){
            'youtube' => 'Generate revenue through engagement on Youtube (likes & subscriptions).',
            'whatsapp' => 'Generate revenue through sharing on Whatsapp (status & groups).',
            'facebook' => 'Generate revenue through engagement on Facebook (likes & follows).',
            'instagram' => 'Generate revenue through engagement on Instagram (likes & follows).',
            'tiktok' => 'Generate revenue through engagement on Instagram (likes & follows).',
        };
    }

    public function getSubTitleLabelAttribute(){
        return match(strtolower(trim($this->type->name))){
            'youtube' => 'Sign up and log in to your Youtube account. Then upload pictures as needed',
            'whatsapp' => 'Open your Whatsapp app and share Then upload pictures as needed',
            'facebook' => 'Sign up and log in to your Facebook account. Then upload pictures as needed',
            'instagram' => 'Sign up and log in to your Instagram account. Then upload pictures as needed',
            'tiktok' => 'Sign up and log in to your Tiktok account. Then upload pictures as needed',
        };
    }

    public function scopeYoutube($query) {
        return $query->where('task_type_id', TaskType::where('name', 'like', '%youtube%')->first('id')->id);
    }

    public function scopeFacebook($query) {
        return $query->where('task_type_id', TaskType::where('name', 'like', '%facebook%')->first('id')->id);
    }

    public function scopeInstagram($query) {
        return $query->where('task_type_id', TaskType::where('name', 'like', '%instagram%')->first('id')->id);
    }

    public function scopeTiktok($query) {
        return $query->where('task_type_id', TaskType::where('name', 'like', '%tiktok%')->first('id')->id);
    }

    public function scopeWhatsapp($query) {
        return $query->where('task_type_id', TaskType::where('name', 'like', '%whatsapp%')->first('id')->id);
    }
    
}
