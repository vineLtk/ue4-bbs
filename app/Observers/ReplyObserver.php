<?php

namespace App\Observers;

use App\Models\Reply;
use App\Notifications\{TopicReplied, TopicRepliedMail};

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver
{
    public function creating(Reply $reply)
    {
        // 命令行运行迁移时不做这些操作！
        if ( ! app()->runningInConsole()) {
            $reply->content = clean($reply->content, 'user_topic_body');
            $reply->topic->increment('reply_count', 1);//话题自增评论数
    
            //通知帖子发布者
            if(true && $reply->reply_id == 0){//
                $reply->topic->user->notify(new TopicReplied($reply));
            }
    
            //订阅邮件推送
            if(true){
                $reply->topic->user->notify(new TopicRepliedMail($reply));
            }
        }
    }

    public function updating(Reply $reply)
    {
        //
    }

    public function deleted(Reply $reply){
        $reply->topic->decrement('reply_count', 1);
    }
}