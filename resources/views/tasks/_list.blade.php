<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="undone-tab" data-toggle="tab" href="#undone" role="tab" aria-controls="undone" aria-selected="true">
            Undone
            <span class='badge badge-danger badge-pill'>{{ count($undones) }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="done-tab" data-toggle="tab" href="#done" role="tab" aria-controls="done" aria-selected="false">
            Done
            <span class='badge badge-info badge-pill'>{{ count($dones) }}</span>

            {{-- foreign 外部  references 引用  cascade 联动  badge 徽章 pill 丸/球 --}}
        </a>
    </li>
    
    </ul>
    <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="undone" role="tabpanel" aria-labelledby="undone-tab">
        
        @if(count($undones))
            <table class="table table-striped ">
                    <tbody>
                        @foreach ($undones as $task )
                            <tr>
                                <td>
                                    <span class="badge badge-primary" >{{ $task->updated_at->diffForHumans() }}</span>
                                </td>    
                                <td scope="row" class='col-8 '>
                                    <a href="{{ route('tasks.show',$task->id) }}">
                                    
                                        {{ $task->name }}
                                    </a>
                                </td>
                                <td >@include('tasks._checkForm')</td>
                                <td >@include('tasks._editModal')</td>
                            </tr>  
                        @endforeach    
                    </tbody>
            </table>
        @endif
    </div>
    <div class="tab-pane fade" id="done" role="tabpanel" aria-labelledby="done-tab">
        @if(count($dones))
            <table class="table table-striped table-bordered" >
                    <tbody>
                        @foreach ($dones as $task )
                            <tr>
                                <td scope="row">{{ $task->name }}</td>
                            </tr>  
                        @endforeach    
                    </tbody>
            </table>
        @endif
    </div>
            
    </div>