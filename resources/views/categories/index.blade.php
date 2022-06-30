@extends('layouts.master')

@section('title')
  Home
@endsection

@section('content')

  <div class="container col-6 rounded bg-light mt-5 p-3">

    <div class="container bg-grey rounded p-1 mb-3">
      <h3 class="text-center">Categories</h3>
    </div>    

    <div class="container bg-grey rounded p-3">

      <a href="/categories/create" class="btn btn-primary">Create</a>

      @foreach($categories as $category)
      <div class="d-flex mt-4 justify-content-between">
        <h6>{{ $category->name }}</h6>

        <div class="d-flex">
        <a href="/categories/edit/{{ $category->id }}" class="btn btn-sm btn-secondary ms-2">Edit</a>
        <form action="/categories/delete/{{$category->id}}" method="POST" onclick="return confirm('Deleting this post! Are you sure?')">
          @method('DELETE')
          @csrf
          <button type="submit" class="btn btn-sm btn-danger ms-3">Delete</button>
        </form>
        </div>
      </div>
      <hr>
      @endforeach
    </div>    
   
  </div>

  @endsection