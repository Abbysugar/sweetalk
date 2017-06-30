@extends ('layouts.app')


@section('content')
@include('includes.errors')

<div class="col-md-6 col-md-offset-3">
    
    <form action="{{ url('/updatepost/'.$post->id) }}" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
            <textarea class="form-control" name="body" id="new-post" rows="5"> {{ $post->body }}
            </textarea>   
        </div>

        <button type="submit" class="btn btn-primary"> Update Post</button>
    </form>    
</div>
@endsection 