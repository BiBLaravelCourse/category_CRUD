@extends('layouts.master')

@section('title')
Show
@endsection

@section('content')

<div class="container col-6 rounded bg-light mt-2 p-3">
    <div class="container bg-grey rounded p-1 mb-3">
        <h3 class="text-center">Post Detail</h3>
    </div>

    <div>
        <h5 class="text-danger display-6">{{$post->title}}</h5>
        <p class="text-muted"><i>{{$post->updated_at->diffForHumans()}}</i><b> {{$post->author->name}}</b></p>

        <p>{{$post->body}}</p>
    </div>

    <div>
        @if($post->isOwnPost())
        <div class="d-flex justify-content-between">
            <a href="{{route('posts.edit',$post->id)}}" class="btn btn-danger">Edit</a>
            <form action="{{route('posts.delete',$post->id)}}" method="POST" onclick="return confirm('Deleting this post! Are you sure?')">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-secondary">Delete</button>
            </form>
        </div>
        @endif
    </div>

</div>

@endsection