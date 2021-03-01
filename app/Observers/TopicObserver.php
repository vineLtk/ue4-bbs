<?php

namespace App\Observers;

use App\Models\Topic;
use Str;
use DB;
// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{
    public function creating(Topic $topic)
    {
        //
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

    public function deleted(){
        DB::table('replies')->where('topic_id', $topic->id)->delete();
    }
}