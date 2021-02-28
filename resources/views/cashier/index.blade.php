@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row" id="table-detail"></div>
    <div class="row justify-content-center py-5">
      <div class="col-md-5">
        <button class="btn btn-primary btn-block" id="show-tables">View All Table</button>
        <div id="selected-table"></div>
      </div>
      <div class="col-md-7">
        <nav>
          <div  class="nav nav-tabs" id="nav-tab" role="tablist">
            @foreach ($categories as $category)
                <a data-id="{{$category->id}}" class="nav-item nav-link" data-toggle="tab">
                  {{$category->name}}
                </a>
            @endforeach
          </div>
        </nav>
        <div id="list-menu" class="row mt-2"></div>
      </div>
    </div>
</div>
<script>
  $(document).ready(function() {
    // 初期設定
    $("#table-detail").hide();

    $("#show-tables").click(function() {
      if ($("#table-detail").is(":hidden")) {
        $.get("/cashier/getTables", function(data) {
          $("#table-detail").html(data);
          $("#show-tables").html('Hide Tables');
          $("#table-detail").slideDown();
        })
      } else {
        $("#table-detail").slideUp('fast');
        $("#show-tables").html('View All Tables');
      }
    });

    $(".nav-link").click(function() {
      $.get("/cashier/getMenuByCategory/" + $(this).data("id"), function(data) {
        $("#list-menu").html(data);
      })
    });

    $("#table-detail").on('click', '.btn-table', function(){
      var SELECTED_TABLE_ID = $(this).data('id');
      var SELECTED_TABLE_NAME = $(this).data('name');
      $('#selected-table').html('<br><h3>Table:'+SELECTED_TABLE_NAME+' </h3><hr>');
    });
  });
</script>

@endsection