@extends('layouts.master')

@section('title')
Show
@endsection

@section('content')

<div class="container col-6 rounded bg-light mt-2 p-3">
    <div class="container bg-grey rounded p-1 mb-3">
        <h3 class="text-center">Post Detail</h3>
    </div>

    <div class="card mb-4">
        <img src="{{ Storage::url($post->images[0]->path) }}" alt="Post Image">
        <h5 class="text-danger display-6">{{$post->title}}</h5>
        <p class="text-muted">
            {{ $post->created_at->toFormattedDateString() }}
            by
            <span class="text-danger">{{ $post->author->name}}</span>
          
          <!-- Post Category -->
          @foreach( $post->categories as $category)
          <span class="badge text-bg-info">{{$category->name}}</span>
          @endforeach

          </p>

        <p>{{$post->body}}</p>
    

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

</div>

@endsection