@extends('layouts.auth')

@section('title')
Login
@endsection

@section('content')
<div class="container mt-3">
  <div class="col-md-8 bg-light rounded p-5 mx-auto">
    <h4 class="text-center display-6">Login</h4>

    <form action="{{route('login.store')}}" method="POST">
      @csrf
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control" name="email" value="{{ old('email')}}" placeholder="Enter Your Email">
        @error('email')
        <p style="color:red">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" value="" placeholder="Enter Your Password">
        @error('password')
        <p style="color:red">{{ $message }}</p>
        @enderror
      </div>

      <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-danger">Login</button>
        <a href="{{route('home')}}" class="btn btn-secondary">Cancle</a>
      </div>
    </form>
  </div>
</div>
@endsection