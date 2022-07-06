@extends('layouts.master')

@section('title','My Posts')

@section('content')

<div class="container mt-4">
    <div class="col-6 bg-light">
        @foreach( $posts as $post)

        <li>{{$post->title}}</li>

        @endforeach
        {{ $posts->links() }}
    </div>
    
</div>

@endsection