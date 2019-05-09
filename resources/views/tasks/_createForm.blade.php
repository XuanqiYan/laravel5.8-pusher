{{ Form::open(['route'=>'tasks.store','method'=>'post']) }}
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">
                <i class='fa fa-plus'></i>
            </span>
        </div>
        {{ Form::text('name',null,['class'=>'form-control','placeholder'=>'Are there any specific tasks?']) }}
        {{ Form::hidden('projectId',$project->id) }}
    </div>
{{ Form::close() }}