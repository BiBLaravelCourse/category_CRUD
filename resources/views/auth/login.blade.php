@extends('layouts.auth')

@section('title')
  Login
@endsection

@section('content')
<div class="container w-50 bg-light rounded mt-3 justigy-content-center">
    <h4 class="text-center p-3">Login</h4>
    
    <form action="/login" method="POST">
        @csrf
        <div class="mb-3 mt-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" name="email" value="{{ old('email')}}" placeholder="Enter Your Email">
            @error('email')
            <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3 mt-3">
            <label for="password" class="form-label">Password</label>
            <input type="text" class="form-control" name="password" value="" placeholder="Enter Your Password">
            @error('password')
            <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <a href="/" class="btn btn-secondary">Cancle</a>
      <button type="submit" class="btn btn-danger">Login</button>
    </form>
</div>
@endsection