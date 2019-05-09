@extends('layouts.app')
@section('content')
    <div class="container">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="undone-tab" data-toggle="tab" href="#undone" role="tab" aria-controls="undone" aria-selected="true">Undone</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="done-tab" data-toggle="tab" href="#done" role="tab" aria-controls="done" aria-selected="false">Done</a>
                    </li>
                    
                    </ul>
                    <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="undone" role="tabpanel" aria-labelledby="undone-tab">
                        
                        @if(count($undone))
                            <table class="table table-striped ">
                                    <tbody>
                                        @foreach ($undone as $task )
                                            <tr>
                                                <td scope="row" class='col-8'>{{ $task->name }}</td>
                                                <td >@include('tasks._checkForm')</td>
                                                <td >@include('tasks._editModal')</td>
                                            </tr>  
                                        @endforeach    
                                    </tbody>
                            </table>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="done" role="tabpanel" aria-labelledby="done-tab">
                        @if(count($done))
                            <table class="table table-striped table-bordered" >
                                    <tbody>
                                        @foreach ($done as $task )
                                            <tr>
                                                <td scope="row">{{ $task->name }}</td>
                                            </tr>  
                                        @endforeach    
                                    </tbody>
                            </table>
                        @endif
                    </div>
                            
                    </div>
    </div>
   
@endsection