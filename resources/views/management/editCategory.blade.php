@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="list-group">
          <a href="/management/category" class="list-group-item">Category</a>
          <a href="" class="list-group-item">Menu</a>
          <a href="" class="list-group-item">Table</a>
          <a href="" class="list-group-item">User</a>
        </div>
      </div>
      <div class="col-md-8">
        Edit Category
        <hr>
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>
                  {{$error}}
                </li>
              @endforeach
            </ul>
          </div>
            
        @endif
        <form action="/management/category/{{$category->id}}" method="POST">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="categoryName">category Name</label>
            <input type="text" name="name" class="form-control" value="{{$category->name}}" placeholder="Category...">
          </div>
          <button type="submit" class="btn btn-primary">UPDATE</button>
        </form>
      </div>
    </div>
  </div>
@endsection