@extends('layouts.app')
@section('content')
    <script src="https://js.pusher.com/4.4/pusher.min.js"></script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;
    
        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
          cluster: 'mt1',
          forceTLS: true
        });
    
        var channel = pusher.subscribe('test-channel');
        channel.bind('test-event', function(data) {
          alert(JSON.stringify(data));//stringify 提取data数据
        });
      </script>

@endsection