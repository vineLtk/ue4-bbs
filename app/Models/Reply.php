<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reply extends Model
{
    use HasFactory;
    
    protected $fillable = ['content', 'to_reply_user_id', 'topic_id'];

    public function topic(){
        return $this->belongsTo(Topic::class, 'topic_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * 回复的评论
     */
    public function torepliy(){
        return $this->hasOne(Relpy::class, 'id', 'reply_id');
    }

    /**
     * 评论的回复
     */
    public function replies(){
        return $this->hasMany(Relpy::class, 'reply_id', 'id');
    }

    public function scopeRecent($query){
        return $query->orderBy('created_at', 'desc');
    }
}
