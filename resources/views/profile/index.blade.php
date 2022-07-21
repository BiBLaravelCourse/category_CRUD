@extends('layouts.master')

@section('title')
Post
@endsection

@section('content')


<div class="container col-md-8 mt-3">

<div class="card p-5">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="{{ auth()->user()->photo }}" class="img-fluid rounded-circle" style="width:200px; height:200px; object-fit:cover;" alt="Profile Avater">
    </div>
    <div class="col-md-4">
        <h5 class="display-4">{{ auth()->user()->name }}</h5>
        <p >email : {{ auth()->user()->email }}</p>
    </div>
    <div class="col-md-4">
        <a href="{{ route('profile.edit') }}" class="btn btn-danger float-button float-end">Edit</a>
    </div>
  </div>
</div>

</div>

@endsection


