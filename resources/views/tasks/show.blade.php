@extends('layouts.app')
@section('content')
    <div class="container" >
        <h3>{{ $task->name }}</h3>
        
        <steps route='{{ route('tasks.show',$task->id) }}'></steps>
    </div>
@endsection