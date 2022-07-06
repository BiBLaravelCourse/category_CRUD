@extends('layouts.master')

@section('title')
  Edit
@endsection

@section('content')

  <div class="container col-6 rounded bg-light mt-5 p-3">
    <div class="container bg-grey rounded p-1 mb-3">
      <h3 class="text-center">Editing Category</h3>
    </div>

    <form action="/categories/update/{{$category->id}}" method="POST">
      @csrf
      <div class="mb-3 mt-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" name="name" value="{{ old('name',$category->name)}}">
        @error('name')
        <p style="color:red">{{ $message }}</p>
        @enderror
      </div>
       <a href="/" class="btn btn-secondary">Cancle</a>
      <button type="submit" class="btn btn-primary">Edit</button>
    </form>
  </div>

  @endsection  