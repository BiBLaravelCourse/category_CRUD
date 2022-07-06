@extends('layouts.master')

@section('title')
Home
@endsection

@section('content')

<div class="container col-8 rounded bg-light mt-2 p-3">
  @include('common.alert')

  <div class="row">
    <!-- Create -->
    <div class="col-6">
      <a href="/categories/create" class="btn btn-danger">Create</a><br>

    </div>
    <!-- Search -->
    <div class="col-6">
      <form>
        <div class="input-group">
          <input type="search" class="form-control" name="search" placeholder="Search..." 
          value="{{request('search')}}">
          <button class="btn btn-danger" type="submit">Search</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Table -->
  <div class="col-12 mt-5">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Date</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse( $categories as $category )
        <tr>
          <td>{{$category->id}}</td>
          <td>{{$category->name}}</td>
          <td>{{$category->created_at->toFormattedDateString()}}</td>
          <td class="d-flex">
            <a href="/categories/edit/{{ $category->id }}" class="btn btn-sm btn-outline-danger ms-2">Edit</a>
            <form action="/categories/delete/{{$category->id}}" method="POST" onclick="return confirm('Deleting this category! Are you sure?')">
              @method('DELETE')
              @csrf
              <button type="submit" class="btn btn-sm btn-outline-secondary ms-3">Delete</button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="100%"> No Category. </td>
        </tr>
        @endforelse


      </tbody>
    </table>
  </div>
  {{ $categories->links()}}


</div>

@endsection