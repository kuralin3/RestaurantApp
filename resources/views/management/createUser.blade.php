@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      @include('management.inc.sidebar')
      <div class="col-md-8">
        Create a User
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
        <form action="/management/user" method="POST">
          @csrf
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Name...">
          </div>
          <div class="form-group">
            <label for="email">email</label>
            <input type="text" name="email" class="form-control" placeholder="email...">
          </div>
          <div class="form-group">
            <label for="password">password</label>
            <input type="text" name="password" class="form-control" placeholder="password...">
          </div>
          <div class="form-group">
            <label for="role">role</label>
            <select name="role" class="form-control">
              <option value="admin">Admin</option>
              <option value="cashier">Cashier</option>
            </select>
          </div>
          
          <button type="submit" class="btn btn-primary">save</button>
        </form>
      </div>
    </div>
  </div>
@endsection