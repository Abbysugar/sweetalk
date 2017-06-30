@extends('layouts.app')

@section('content')

@include('includes.errors')

<section class="row new-post">

    <div class="col-md-6 col-md-offset-3">
    <header><h2> Say Something! </h2></header>
        <form action="/createpost" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <textarea class="form-control" name="body" id="new-post" rows="5" placeholder="Post Something">
                </textarea>   
            </div>
            <button type="submit" class="btn btn-primary"> Create Post </button>
        </form> 
           
    </div>

</section>

<section class="row posts">

    <div class="col-md-6 col-md-offset-3">
    <hr>

        <header><h3> Other Posts... </h3></header>

        @foreach($posts as $post)
        <article class="post">

            <p> {{ $post->body }}</p>

            <div class="info">
            Posted by {{ $post->user->name }} on {{ $post->created_at }}
            </div>

            <div class="interaction">
                <a href="{{ route('likepost', ['post_id' => $post->id]) }}"> {{ $post->likes->count() }} Like </a> |
                <!-- <a href="#"> Unlike </a> | -->
                <a> {{ $post->comments->count() }} Comment </a> |
                @if(Auth::user() == $post->user)
                    <a href="{{ route('editpost', ['post_id' => $post->id]) }}"> Edit </a> |
                    <a href="{{ route('deletepost', ['post_id' => $post->id]) }}"> Delete </a>
                @endif
            </div>
            @foreach($post->comments as $comment)
                <p>{{ $comment->body }}<p>
            @endforeach
            <form action="{{ route('postcomment', ['post_id' => $post->id]) }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <textarea class="form-control" name="comment" id="comment" rows="3" placeholder="Comment here">
                </textarea>   
            </div>
            <button type="submit" class="btn btn-primary"> Submit </button>
        </form>
        </article>
        @endforeach
        
    </div>

</section>

@endsection
