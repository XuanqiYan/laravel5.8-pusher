<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = ['user_one','user_two'];

    //每一个回话有许多消息
    public function messages(){
        return $this->hasMany('App\Message');    
    }
}
