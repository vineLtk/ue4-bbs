<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Topic extends Model
{
    use HasFactory;
    
    protected $fillable = ['title', 'body', 'category_id', 'excerpt', 'slug'];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function replies(){
        return $this->hasMany(Reply::class, 'topic_id', 'id')->where('reply_id', 0);
    }

    public function scopeOfOrder($query, $order){
        switch ($order) {
            case 'recent':
                $query->recent();
                break;

            default:
                $query->recentReplied();
                break;
        }
    }

    public function scopeRecent($query){
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeRecentReplied($query){
        return $query->orderBy('updated_at', 'desc');
    }
}
