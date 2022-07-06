@extends('layouts.auth')

@section('title')
  Register
@endsection

@section('content')
<div class="container w-50 bg-light rounded mt-3 justigy-content-center">
    <h4 class="text-center p-3">Register</h4>
    
    <form action="{{route('register.store')}}" method="POST">
        @csrf
        <div class="mb-3 mt-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="{{ old('name')}}" placeholder="Enter Your Name">
            @error('name')
            <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3 mt-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" name="email" value="{{ old('email')}}" placeholder="Enter Your Email">
            @error('email')
            <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3 mt-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" value="" placeholder="Enter Your Password">
            @error('password')
            <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <a href="{{route('home')}}" class="btn btn-secondary">Cancle</a>
      <button type="submit" class="btn btn-danger">Register</button>
    </form>
</div>
@endsection