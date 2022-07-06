@extends('layouts.master')

@section('title')
Post
@endsection

@section('content')


<div class="container col-md-8 mt-3">

  @include('common.alert')

  <div class="row">
    <!-- Post Lists-->
    <div class="col-md-8">
      @if($posts->count()) @php( $c=$posts->count())
      @for( $i = 0 ; $i < $c ; $i++ ) @php( $post=$posts[$i] ) <div class="card mb-4">
        <img src="https://colorlibhub.com/sparkling/wp-content/uploads/sites/52/2014/03/slider-image-blurry-750x410.jpg" alt="Post Image">
        <div class="card-body">
          <h4 class="card-title">{{ $post->title}}</h4>
          <p class="text-muted m-0">{{ $post->created_at->toFormattedDateString() }}
            by
            <span class="text-danger">{{ $post->author->name}}</span>
          </p>

          <!-- Post Category -->
          <p class="text-danger"><span class="text-secondary">Categories: </span><i>{{$post->category}}</i>
            <?php
            for ($x = $i + 1; $x < $c; $x++) {
              if ($post->id == $posts[$x]->id) {
                echo '<i>, ' . $posts[$x]->category . '</i>';
              } else {
                $i = $x - 1;
                $x = $c;
              }
            }
            ?>
          </p>

          <p class="card-text text-muted">{{ $post->body }}</p>

          <!-- Buttons -->
          <div class="d-flex justify-content-between">
            <div>
              @if($post->isOwnPost())
              <div class="d-flex">
                <a href="{{route('posts.edit',$post->id)}}" class="btn btn-sm btn-outline-danger">Edit</a>
                <form action="{{route('posts.delete',$post->id)}}" method="POST" onclick="return confirm('Deleting this post! Are you sure?')">
                  @method('DELETE')
                  @csrf
                  <button type="submit" class="btn btn-sm btn-outline-secondary ms-2">Delete</button>
                </form>
              </div>
              @endif
            </div>
            <a href="{{route('posts.show',$post->id)}}" class="btn btn-danger text-uppercase float-end">View More</a>
          </div>
        </div>
    </div>
    @endfor
    @else
    <div class="display-1"> No Post!!</div>
    @endif

    <!-- pagination -->
    <div class="row">
       {{ $posts->links()}}
    </div>
  </div>

  <!-- Side Bar -->
  <div class="col-md-4">

    <!-- Search -->
    <form>
      <div class="input-group">
        <input type="search" class="form-control" name="search" placeholder="Search..." value="{{request('search')}}">
        <button class="btn btn-danger" type="submit">Search</button>
      </div>
    </form>

    <!-- Recent Post -->
    <div class="card card-body mt-2  mb-2">
      <h5>Recent Posts</h5>
      @foreach( range(1,5) as $category)
      <div class="row mt-2">
        <div class="col-3 text-center p-1">
          <img src="https://colorlibhub.com/sparkling/wp-content/uploads/sites/52/2014/03/slider-image-blurry-750x410.jpg" class="img-fluid" alt="Recent Post Image">
        </div>
        <div class="col-9">
          <a href="#" class="text-danger text-decoration-none">Posts Title Posts Title Posts Title</a>
          <p class="text-muted m-0">7 Jun 2020</p>
        </div>
      </div>
      @endforeach
    </div>

    <!-- Category List -->
    <div class="card card-body">
      <h5>CATEGORIES</h5>
      <ul class="mt-2 list-group list-group-flush">
        @foreach( range(1,5) as $category)
        <li class="list-group-item d-flex">
          <div class="flex-grow-1">Cat Name</div>
          <div>(10)</div>
        </li>
        @endforeach
      </ul>
    </div>
  </div>

</div>


@endsection