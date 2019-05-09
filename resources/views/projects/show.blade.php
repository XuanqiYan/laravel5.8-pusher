@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>show sgingle project logic </h3>
        @include('tasks._createForm')
        @include('tasks._list')
    </div>
@endsection