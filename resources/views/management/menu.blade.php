@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      @include('management.inc.sidebar')
      <div class="col-md-8">
        Menu
        <a href="/management/menu/create" class="btn btn-success btn-sm float-right"><i class="fa fa-plus"></i> Create Menu</a>
        <hr>

        @if (Session()->has('status'))
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">X</button>
            {{Session()->get('status')}}
          </div> 
        @endif

        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Name</th>
              <th scope="col">Price</th>
              <th scope="col">image</th>
              <th scope="col">description</th>
              <th scope="col">category</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($menus as $menu)
              <tr>
                <td scope="row">{{$menu->id}}</td>
                <td>{{$menu->name}}</td>
                <td>{{$menu->price}}</td>
                <td>
                  <img src="{{asset('menu_images')}}/{{$menu->image}}" alt="{{$menu->name}}" width="120" height="120" class="img-thumbnail">
                </td>
                <td>{{$menu->description}}</td>
                <td>{{$menu->category->name}}</td>
                <td>
                  <a href="/management/menu/{{$menu->id}}/edit" class="btn btn-warning">Edit</a>
                </td>
                <td>
                  <form action="/management/menu/{{$menu->id}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete" class="btn btn-danger">
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

      </div>
    </div>
  </div>
@endsection