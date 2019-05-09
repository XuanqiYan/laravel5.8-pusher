<div class="col-3 my-2">
    <div class="card project-card">
        <ul class='icon-bar'>
            @include('projects._delete')
            <li>
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#editProjectModalId-{{ $project['id'] }}">
                    <i class="fa fa-cog"></i>
                </button>
            </li>
        </ul>
        <a href={{ route('projects.show',$project['id']) }}>
            <img class="card-img-top" src="{{ asset('storage/thumbs/original/'.$project['thumbnail']) }}" alt="">
        </a>
        <div class="card-body py-2">
            <h5 class="card-title text-center"> {{ $project['name'] }}</h5>
        </div>
    </div> 
    
    @include('projects._editModal')
    
</div>

@section('customJs')
    <script >
        $('document').ready(function(){
            $('.icon-bar').hide();
            $('.project-card').hover(function(){
                $(this).find('.icon-bar').toggle();
            })
        })
    </script>
@endsection