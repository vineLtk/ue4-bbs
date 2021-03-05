<?php 

namespace App\Models\Traits;

use Carbon\Carbon;
use Cache;
use Arr;
use DB;
use App\Models\{Topic, Reply};

trait ActiveUserHelper
{
    
    protected $days = 7;
    protected $topic_score = '5';
    protected $reply_score = '1';

    protected $key = "active_user";//缓存KEY
    protected $cache_seconds = 60*60;//缓存时间

    public $active_users = [];

    public function getActiveUser(){

        // return $this->calculateActiveUsers();

        return Cache::remember($this->key, $this->cache_seconds, function(){
            return $this->calculateActiveUsers();
        });
    }

    public function cacheActiveUsers(){
        $active_users = $this->calculateActiveUsers();
        Cache::put($this->key, $active_users, $this->cache_seconds);
    }

    public function calculateActiveUsers(){

        $this->calculateTopicUsers();
        $this->calculateReplyUsers();

        //对user排序，活跃最高的排在前面,默认排正序
        $active_users = Arr::sort($this->active_users, function ($user){
            return $user['score'];
        });
        
        $active_users = array_reverse($active_users, true);//倒序
        
        $active_users = array_slice($active_users, 0, 9, true);//获取活跃前10

        foreach($active_users as $user_id => $user){
            $user = $this->find($user_id);
            if($user){
                $active_users[$user_id] = $user;
            }else{
                unset($active_users[$user_id]);
            }
        }

        return collect($active_users);
    }

    public function calculateTopicUsers(){
        //查询最近发布帖子的用户，以及发布帖子数量
        $topic_users = Topic::select(DB::raw("user_id, count(*) as topic_count"))
                            ->where('created_at', '>=', Carbon::now()->subDays($this->days))
                            ->groupBy('user_id')->get();
        
        foreach($topic_users as $user){
            if(isset($this->active_users[$user->user_id])){
                $this->active_users[$user->user_id]['score'] += $user->topic_count * $this->topic_score;
            }else{
                $this->active_users[$user->user_id]['score'] = $user->topic_count * $this->topic_score;
            }
        }
    }

    public function calculateReplyUsers(){
        //查询最近发布帖子的用户，以及发布帖子数量
        $reply_users = Reply::select(DB::raw("user_id, count(*) as reply_count"))
                            ->where('created_at', '>=', Carbon::now()->subDays($this->days))
                            ->groupBy('user_id')->get();

        foreach($reply_users as $user){
            if(isset($this->active_users[$user->user_id])){
                $this->active_users[$user->user_id]['score'] += $user->reply_count * $this->reply_score;
            }else{
                $this->active_users[$user->user_id]['score'] = $user->reply_count * $this->reply_score;
            }
        }
    }
}