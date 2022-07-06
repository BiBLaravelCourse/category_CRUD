@extends('layouts.master')

@section('title')
Post
@endsection

@section('content')

<div class="container w-50 rounded bg-light mt-2 p-3">

  <section>
    <div>
      <form>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="search" placeholder="Search..." value="{{request('search')}}">
          <button class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
      </form>
    </div>
  </section>

  <section>
  @include('commom.aler')

    <div class="container bg-grey rounded p-1 mb-2">
      <h3 class="text-center">posts</h3>

    </div>
    <div class="container bg-grey rounded p-4">
      <a href="/posts/create" class="btn btn-primary mb-5">Create</a><br>
      @if($posts->count())
      @php( $c = $posts->count())

      @for( $i = 0 ; $i < $c ; $i++ ) @php( $post=$posts[$i] ) <div class="d-flex justify-content-between">
        <h5><a href="/posts/show/{{$post->id}}">{{ $post->title }}</a></h5>

        @if($post->isOwnPost())
        <div class="d-flex">
          <a href="/posts/edit/{{ $post->id }}" class="btn btn-sm btn-outline-primary ms-2">Edit</a>
          <form action="/posts/delete/{{$post->id}}" method="POST" onclick="return confirm('Deleting this post! Are you sure?')">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-secondary ms-3">Delete</button>
          </form>
        </div>
        @endif

    </div>
    <p class="text-muted"><i>{{$post->updated_at->diffForHumans()}}</i>
      <!-- <b> {{$post->name}}</b> -->
      <b> {{$post->author->name}}</b>
    </p>

    <p class="text-success"><span class="text-secondary">Categories: </span><i>{{$post->category}}</i>

    <?php
    for( $x=$i+1 ; $x < $c ; $x++){
      if($post->id == $posts[$x]->id){
        echo '<i>, '.$posts[ $x ] ->category.'</i>';
      }
      else{
        $i = $x-1;
        $x = $c;
      }
    }
    ?>
   
    </p>
    <p>{{$post->body}}</p>
    <hr>
    @endfor
    @else
    <p><i>There is no post.</i>
      @endif

</div>
</section>

</div>

@endsection