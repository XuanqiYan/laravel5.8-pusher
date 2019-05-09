@extends('layouts.app')
@section('content')
    <script src="https://js.pusher.com/4.4/pusher.min.js"></script>
    <script>

        //开启Pusher 控制台调试
        Pusher.logToConsole = true;
        //new Pusher --> 相当于拥有一台电视机
        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
          cluster: 'mt1',
          forceTLS: true
        });
        // subscribe--> 订阅、监听频道 --> 有了电视机后去订阅指定的频道cctv-1
        var channel = pusher.subscribe('cctv-1');

        // bind --> 在频道去监听事件 --> 选择节目 
        channel.bind('三国演绎', function(data) {

          alert(JSON.stringify(data));//stringify-->从json格式中提取data选项对应的数据
        
        });
      </script>

@endsection