@extends('layouts.master')

@section('title')
Post
@endsection

@section('content')

<div class="container w-50 rounded bg-light mt-2 p-3">

  @if (session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

  <div class="container bg-grey rounded p-1 mb-2">
    <h3 class="text-center">posts</h3>

  </div>
  <div class="container bg-grey rounded p-4">
    <a href="/posts/create" class="btn btn-primary mb-5">Create</a><br>
    @foreach($posts as $post)
    <div class="d-flex justify-content-between">
      <h5><a href="/posts/show/{{$post->id}}">{{ $post->title }}</a></h5>

      @auth
      <div class="d-flex">
        <a href="/posts/edit/{{ $post->id }}" class="btn btn-sm btn-outline-primary ms-2">Edit</a>
        <form action="/posts/delete/{{$post->id}}" method="POST" onclick="return confirm('Deleting this post! Are you sure?')">
          @method('DELETE')
          @csrf
          <button type="submit" class="btn btn-sm btn-outline-secondary ms-3">Delete</button>
        </form>
      </div>
      @endauth
    </div>
    <p class="text-muted"><i>{{$post->updated_at->diffForHumans()}}</i><b> {{$post->name}}</b></p>
    <p>{{$post->body}}</p>
    <hr>
    @endforeach

    {{$posts->links()}}
  </div>

</div>

@endsection