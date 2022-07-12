@extends('layouts.master')

@section('title')
  Edit Post
@endsection

@section('content')

<div class="container col-6 rounded bg-light mt-2 p-3">
  <div class="container bg-grey rounded p-1 mb-3">
    <h3 class="text-center">Editing A Post</h3>
  </div>

  <form action="{{route('posts.update', $post->id)}}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mt-3 mb-3">
      <label for="images[]" class="form-label">Image Upload</label>
      <input type="file" class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror" name="images[]" multiple>
      @error('images')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror

      @foreach( $errors->get('images.*') as $message)
      <div class="invalid-feedback">{{ $message[0] }}</div>
      @endforeach
      
    </div>

    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title',$post->title)}}" placeholder="Write title">
      @error('title')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    
    <div class="mb-3">
      <label for="body" class="form-label">Body</label>
      <textarea type="text" class="form-control @error('body') is-invalid @enderror" name="body" placeholder="Write the body">{{ old('body',$post->body)}}</textarea>
      @error('body')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="categories[]" class="form-label">Post Category</label>
      <select name="categories[]" class="form-select @error('categories') is-invalid @enderror" multiple>
        <option selected disabled>Open this select menu</option>
        @foreach( $categories as $category)
        <option value="{{$category->id}}"
          @if( in_array($category->id, old('categories', $oldCategories) ))
            selected
          @endif
          >{{$category->name}}</option>
        @endforeach
      </select>
      @error('categories')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="d-flex justify-content-between">
    <button type="submit" class="btn btn-danger">Update</button>
    <a href="{{route('posts.index')}}" class="btn btn-outline-secondary">Cancle</a>
    </div>
    
  </form>
</div>

@endsection