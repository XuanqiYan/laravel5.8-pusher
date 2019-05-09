{{ Form::open(['route'=>'chat.create','method'=>'post']) }}
    {{ Form::hidden('user_id',2) }}
    <button type='submit' class="dropdown-item" >
        <i class='fa fa-comments'></i>
    </button>
{{ Form::close() }}