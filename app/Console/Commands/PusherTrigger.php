<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PusherTrigger extends Command
{

    //设置命令后面的选项 option （选项可不不填）  // art pusher:trigger --channel=test --event=test --data='message:tellme ,user:xuanqiyan'
    protected $signature = 'pusher:trigger
                            {--channel= : your channel name}
                            {--event= : your event name}
                            {--data= : your pusher data}'; 

    /*
    //设置命令后面的参数 argument (参数 必填)
    protected $signature = 'pusher:trigger
                            {channel : your channel name}
                            {event : your event name}
                            {data : your pusher data}';
                            
    $channel = $this->argument('channel');//不填直接报错 所以后面不需要询问                        
    */                        
    protected $description = 'push message to pusher ';//描述

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        //执行命令的具体动作
        // $this->info('message pushed');//--> 输出信息
        $channel = $this->option('channel') ? : $this->ask('tell me  your pusher Channel Name ?');
        $event = $this->option('event') ? : $this->ask('tell me  your pusher Event Name ?');
        $data = $this->option('data') ? : $this->ask('tell me  your pusher Data ?');

        if($this->confirm('correct or not ? [y/n]')){
            $pusher = app()->make('pusher');
            $pusher->trigger($channel,$event,$this->toArray($data)); 
        }
        // $this->line('your enter channel Name is :'.$channel);
        //命令执行完毕以表格的形式输出信息
        $header = ['channel','event','data'];
        $row = [
            [$channel,$event,$data]
        ];
        $this->table($header,$row);

    }

    private function toArray($data){ // data--> 'message: tell me  , user: xuanqiyan' -->['message'=>'tell me','user'=>'xiuanqi yan']
        $tmp = [];
        foreach (explode(',',$data) as $item) {
            list($key,$value) = explode(':',$item);
            $tmp[$key] = $value;
        }
        return $tmp;
    }
}
