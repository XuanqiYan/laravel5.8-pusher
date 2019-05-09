@extends('layouts.app')
@section('content')
    <div class="container">
        <chat route='{{ route('chat.show',$chat->id) }}' channel={{ $channel }}></chat>
    </div>
@endsection