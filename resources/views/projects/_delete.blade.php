<li>
    {{ Form::open(['route'=>['projects.destroy',$project['id']],'method'=>'DELETE']) }}
        <button class='btn'><i class="fa fa-btn fa-minus-circle" ></i></button>
    {{ Form::close() }}   
</li>
