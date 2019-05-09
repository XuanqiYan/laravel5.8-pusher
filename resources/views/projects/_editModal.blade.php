<div class="modal fade" id="editProjectModalId-{{ $project['id'] }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title">Edit Project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            {!! Form::model($project,['route'=>['projects.update',$project['id']],'method'=>'PATCH','files'=>true]) !!}
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="form-group">
                        {!! Form::label('name', 'ProjectName:') !!}
                        {!! Form::text('name',null,['class'=>'form-control']) !!}
                    </div>
                    <div class='form-group'>
                       
                        <img  width='40%' src="{{ asset('storage/thumbs/original/'.$project['thumbnail']) }}" alt="">
                    </div> 
                    <div class="form-group">
                        {!! Form::label('thumbnail', 'ThumbnailPic:') !!}
                        {!! Form::file('thumbnail',['class'=>'form-control-file']) !!}
                    </div>
                    {{-- @include('errors._error') --}}
                    @if($errors->getBag('update-'.$project['id'])->any())
                        <ul class='alert alert-danger'>
                        @foreach($errors->getBag('update-'.$project['id'])->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                     @endif
                </div>
            </div>
            <div class="modal-footer">
                    {!! Form::button('Close',['class'=>'btn btn-secondary','data-dismiss'=>'modal']) !!}
                    {!! Form::submit('Update ',['class'=>'btn btn-info']) !!}
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>