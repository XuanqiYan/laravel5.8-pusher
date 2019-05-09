<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chat;
use App\Message;

class ChatController extends Controller
{   
    protected $pusher; 
    /*
        Pusher看到频道之前有private前缀 就会将频道设置为私密频道，需要并且发送一个ajax请求去验证
        请求的地址：http://lar8.test/pusher/auth
        请求参数：
            socket_id: 261388.6404694
            channel_name: private-chat-1
        期望返回：auth_token 
            如果auth_token 通过pusher验证及视为通过，就可以监听频道   
    */
    const channel = 'private-chat-';//私密频道 
    //const channel = 'chat-'; //别的用户访问/chat/1 可以看到别人的聊天记录并且还能回复消息。
    public function __construct(){
        $this->pusher = app()->make('pusher');

    }    
    public function create(Request $request){
        // 查询 登录用户和通话用户的chat 如果没有则创建这个chat
        $chat = Chat::firstOrCreate([
            'user_one'=>auth()->user()->id,
            'user_two'=>$request->user_id
        ]);

        return redirect()->route('chat.show',$chat->id);

    }

    public function show(Request $request, Chat $chat){
        $channel = self::channel.$chat->id;//坑啊啊  ～～～～～～～
        return view('pusher.message',compact('chat','channel'));
    }

    public function messages(Request $request, Chat $chat){
        $messages = $chat->messages()->with('user')->get();
        return  response()->json([
            'messages'=>$messages
        ],200);
    }

    public function store(Request $request,$chat){
        $mes = Message::create([
            'message'=>$request->message,
            'user_id'=>auth()->user()->id,
            'chat_id'=>$chat
        ]);
        $mes = $mes->load('user');
        //在一对一私密频道中发送事件
        $this->pusher->trigger(self::channel.$chat, 'new-message', $mes, $request->socket_id);
        /**
         * 第四个参数是发送者的socketid 那么在自身的socket连接就不会接受监听这个事件
         *  */

        $theOtherUser = $this->theOtherUser($chat);   
        //在全局私密频道中发送事件     
        $this->pusher->trigger('private-notification-'.$theOtherUser,'notification',$mes); 
        return response()->json([
           'mes'=>$mes 
        ],200);
    }

    //私密验证颁发token
    public function auth(Request $request){
        if($this->UserInChat($request)){
            //如果在就颁发token
            return $this->pusher->socket_auth($request->channel_name,$request->socket_id);
        } 
    }
    //登录用户是否在聊天chat中
    private function UserInChat($request){
        //获取chatId    
        $chat_id =explode('-',$request->channel_name)[2];
        
        $chat_users = Chat::select('user_one','user_two')->findOrFail($chat_id)->toArray(); 
        
        //判断 当前的登录用户在不在chat中   
        return in_array(auth()->user()->id,$chat_users);
    }

    //获取聊天chat中另一个用户
    private function theOtherUser($chat){
        $chat_users = Chat::select('user_one','user_two')->findOrFail($chat)->toArray();
        $current_user = auth()->user()->id;
        $arr = array_filter($chat_users,function($user) use($current_user){
            return $user !== $current_user;
        });
        return array_shift($arr);
    }

    public function notificationAuth(Request $request){
       return  $this->pusher->socket_auth($request->channel_name,$request->socket_id);
    }
}
