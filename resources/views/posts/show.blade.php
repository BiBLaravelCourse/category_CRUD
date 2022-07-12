@extends('layouts.master')

@section('title')
Post
@endsection

@section('content')


<div class="container col-md-8 mt-3">

    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                @foreach( $post->images as $image)
                <img src="{{ Storage::url($image->path) }}" class="img-fluid rounded m-2" alt="Post Image">
                @endforeach
            </div>
            <div class="col-md-8 p-3">
                <div class="card-body">
                    <h4 class="card-title">{{ $post->title}}</h4>
                    <p class="text-muted">{{ $post->created_at->toFormattedDateString() }}
                        by
                        <span class="text-danger">{{ $post->author->name}}</span>

                        <!-- Post Category -->
                        @foreach( $post->categories as $category)
                        <span class="badge text-bg-info">{{$category->name}}</span>
                        @endforeach

                    </p>

                    <p class="card-text text-muted">{{ $post->body }}</p>

                    <!-- Buttons -->
                    @if($post->isOwnPost())
                    <div class="d-flex justify-content-between">
                        <a href="{{route('posts.edit',$post->id)}}" class="btn btn-sm btn-outline-danger">Edit</a>
                        <form action="{{route('posts.delete',$post->id)}}" method="POST" onclick="return confirm('Deleting this post! Are you sure?')">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-secondary ms-2">Delete</button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>

@endsection


