<?php

namespace App\Observers;

use App\Models\Topic;
use Str;
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
        $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($topic->body)));

        $topic->excerpt = Str::limit($excerpt, 200);

    }
}