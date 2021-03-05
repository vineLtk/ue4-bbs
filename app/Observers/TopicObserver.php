<?php

namespace App\Observers;

use App\Models\{Topic, Category};
use Str;
use DB;
// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{
    public function creating(Topic $topic)
    {
        //
        $category = Category::find($topic->category_id);
        $category->increment('post_count', 1);
    }

    public function updating(Topic $topic)
    {
        //
    }

    public function saving(Topic $topic)
    {
        $topic->body = clean($topic->body, 'user_topic_body');

        $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($topic->body)));

        $topic->excerpt = Str::limit($excerpt, 200);

    }

    public function deleted(Topic $topic){
        DB::table('replies')->where('topic_id', $topic->id)->delete();
        //
        $category = Category::find($topic->category_id);
        if($category->post_count >0){
            $category->decrement('post_count', 1);
        }
        
    }
}