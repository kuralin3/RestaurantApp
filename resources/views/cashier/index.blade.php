@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row" id="table-detail"></div>
    <div class="row justify-content-center py-5">
      <div class="col-md-5">
        <button class="btn btn-primary btn-block" id="show-tables">View All Table</button>
      </div>
      <div class="col-md-7"></div>
    </div>
</div>
<script>
  $(document).ready(function() {
    $("#show-tables").click(function() {
      $.get("/cashier/getTables", function(data) {
        $("#table-detail").html(data);
      })
    });
  });
</script>

@endsection