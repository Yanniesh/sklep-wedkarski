@extends('layouts.app')

@section('content')
    <div class="">
        <div class="card-header">Comments:</div>
        <ul class="CommentsList">
            <ul>
                @foreach($comments as $comment)
                    <div class="comment-div">
                        <div class="author">
                            Użytkownik: {{ $comment->author->nickname }}
                            <form class="CategoryDeleteForm" method="POST" action="{{route('commentsAccept.update', $comment->id)}}">
                                {{csrf_field()}}
                                {{method_field('PUT')}}
                                <button class="CategoryDeleteButton">Acc</button>
                            </form>
                        </div>
                        <p>{{ $comment->text }}</p>
                    </div>
                @endforeach
            </ul>
        </ul>
    </div>

@endsection
