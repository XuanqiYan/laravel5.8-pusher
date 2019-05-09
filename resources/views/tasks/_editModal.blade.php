<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editTask-{{ $task->id }}">
  <i class='fa fa-cog'></i> 
</button>

<!-- Modal -->
<div class="modal fade" id="editTask-{{ $task->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            {{ Form::model($task,['route'=>['tasks.update',$task->id],'method'=>'PATCH']) }}
            <div class="modal-body">
                <div class="form-group">
                    {{ Form::label('name','Task Name:') }}
                    {{ Form::text('name',null,['class'=>'form-control']) }}
                </div>
                <div class="form-group">
                        {{ Form::label('project_id','Change Projct:') }}
                        {{ Form::select('project_id',$projects,null,['class'=>'form-control']) }}
                </div>
            </div>
            <div class="modal-footer">
                {{ Form::submit('eidt',['class'=>'btn btn-info']) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>