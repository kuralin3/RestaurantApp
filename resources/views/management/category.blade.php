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
        Category
        <a href="/management/category/create" class="btn btn-success btn-sm float-right"><i class="fa fa-plus"></i> Create Category</a>
        <hr>

        @if (Session()->has('status'))
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">X</button>
            {{Session()->get('status')}}
          </div> 
        @endif
      </div>
    </div>
  </div>
@endsection