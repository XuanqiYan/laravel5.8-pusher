@extends('layouts.app')

@section('content')
<div class="container">
        
    <div class="card-deck">

        @each('projects._card',$projects->toArray(),'project','projects._hasNoProject')

        @include('projects._createModal')  
       
    </div> 
       
</div>
@endsection

