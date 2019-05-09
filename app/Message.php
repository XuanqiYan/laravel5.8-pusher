<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Message extends Model
{
    protected $fillable = ['user_id','chat_id','message'];
    protected $appends = ['created_time'];
    //消息属于哪个用户发送的
    public function user(){
        return $this->belongsTo('App\User');
    }
    //消息属于哪一个回话
    public function chat(){
        return $this->belongsTo('App\Chat');
    }

    public function getCreatedTimeAttribute()
    {   
        return $this->created_at->diffForHumans();
        //return 'aaa';
    }
}
