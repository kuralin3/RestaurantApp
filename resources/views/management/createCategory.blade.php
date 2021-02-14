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
        Create Category
        <hr>
        <form action="" class="get">
          <div class="form-group">
            <label for="categoryName">category Name</label>
            <input type="text" name="name" class="form-control" placeholder="Category...">
          </div>
          <button class="btn btn-primary">save</button>
        </form>
      </div>
    </div>
  </div>
@endsection