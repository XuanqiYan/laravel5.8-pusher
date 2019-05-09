<!-- Button trigger modal -->
<div class='col-3 my-2' >
  <div class="card " style='height:100%'>
    <div class="card-body d-flex align-items-center justify-content-center" >
        <button type="button" class="btn btn-success btn-trigger" data-toggle="modal" data-target="#exampleModalLong">
            <i class='fa fa-btn fa-plus'></i>
        </button>
    </div>
  </div>
</div>
  <!-- Modal -->
  <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          {!! Form::open(['route'=>'projects.store','method'=>'Post','files'=>true]) !!}
            <div class="modal-body">
                
                  <div class="form-group">
                    {!! Form::label('name', 'ProjectName:') !!}
                    {!! Form::text('name','',['class'=>'form-control']) !!}
                  </div> 
                  <div class="form-group">
                    {!! Form::label('thumbnail', 'ThumbnailPic:') !!}
                    {!! Form::file('thumbnail',['class'=>'form-control-file']) !!}
                  </div>
                  {{-- @include('errors._error') --}}
                  @if($errors->create->any())
                    <ul class='alert alert-danger'>
                      @foreach($errors->create->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  @endif
            </div>
            <div class="modal-footer">
                  
              {!! Form::button('Close',['class'=>'btn btn-secondary','data-dismiss'=>'modal']) !!}
              {!! Form::submit('Create New Project ',['class'=>'btn btn-info']) !!}
              
            </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>