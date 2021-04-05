@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row" id="table-detail"></div>
    <div class="row justify-content-center py-5">
      <div class="col-md-5">
        <button class="btn btn-primary btn-block" id="show-tables">View All Table</button>
        <div id="selected-table"></div>
        <div id="order-detail"></div>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h3 class="total_amount"></h3>
        <h3 class="changeAmount"></h3>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">$</span>
            <input type="number" id="received-amount" class="form-control">
          </div>
        </div>
        <div class="form-group">
          <label for="payment">Payment Type</label>
          <select class="form-control" id="payment-type">
            <option value="cash">Cash</option>
            <option value="credit card">Credit Card</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-save-payment" disabled>Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    // 初期設定
    $("#table-detail").hide();

    // all tables show up
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

    // タブクリックでメニュー表示
    $(".nav-link").click(function() {
      $.get("/cashier/getMenuByCategory/" + $(this).data("id"), function(data) {
        $("#list-menu").html(data);
      })
    });

    // グローバル定数
    var SELECTED_TABLE_ID = '';
    var SELECTED_TABLE_NAME = '';
    var SALE_ID = '';
    // テーブルクリックでテーブル名表示
    $("#table-detail").on('click', '.btn-table', function(){
      SELECTED_TABLE_ID = $(this).data('id');
      SELECTED_TABLE_NAME = $(this).data('name');
      $('#selected-table').html('<br><h3>Table:'+SELECTED_TABLE_NAME+' </h3><hr>');
      $.get("/cashier/getSaleDetailsByTable/" + SELECTED_TABLE_ID, function(data){
        $('#order-detail').html(data);
      });
    });

    // 
    $("#list-menu").on('click', '.btn-menu', function(){
      if (SELECTED_TABLE_ID === "") {
        alert('Please select table first');
      }else{
        var menu_id = $(this).data('id');
        $.ajax({
          type : 'POST',
          data : {
            "_token" : $('meta[name= "csrf-token"]').attr('content'),
            "menu_id" : menu_id,
            "table_id" : SELECTED_TABLE_ID,
            "table_name" : SELECTED_TABLE_NAME,
            "quantity" : 1
          },
          url : '/cashier/orderFood',
          success : function(data){
            $('#order-detail').html(data);
          }
        });
      }
    });

    $('#order-detail').on('click', '.btn-confirm-order', function(){
      var SaleID = $(this).data('id');
      $.ajax({
          type : 'POST',
          data : {
            "_token" : $('meta[name= "csrf-token"]').attr('content'),
            "sale_id" : SaleID
          },
          url : '/cashier/confirmOrderStatus',
          success : function(data){
            $('#order-detail').html(data);
          }
      })
    });

    // delete saledetail
    $('#order-detail').on('click', '.btn-delete-saledetail', function(){
      var SaleDetailId = $(this).data('id');
      $.ajax({
          type : 'POST',
          data : {
            "_token" : $('meta[name= "csrf-token"]').attr('content'),
            "saleDetail_id" : SaleDetailId
          },
          url : '/cashier/deleteSaleDetail',
          success : function(data){
            $('#order-detail').html(data);
          }
      })
    });


    // payment button
    $('#order-detail').on('click','.btn-payment',function(){
      var totalAmount = $(this).attr('data-total_amount');
      $('.total_amount').html('Total Amount ' + totalAmount);
      $('#received-amount').val('');
      $('.changeAmount').html('');
      SALE_ID = $(this).data('id');
    });

    // calcuate
    $('#received-amount').keyup(function(){
      var totalAmount = $('.btn-payment').attr('data-total_amount');
      var receivedAmount = $(this).val();
      var changeAmount = receivedAmount - totalAmount;
      $('.changeAmount').html("Total Change: $" + changeAmount);

      // check if button
      if (changeAmount >= 0) {
        $('.btn-save-payment').prop('disabled', false);
      } else {
        $('.btn-save-payment').prop('disabled', true);
      }
    });

    // save payment
    $('.btn-save-payment').click(function() {
      var receivedAmount = $('#received-amount').val();
      var paymentType = $('#payment-type').val();
      var saleId = SALE_ID;
      $.ajax({
        type: "POST",
        data: {
          "_token" : $('meta[name="csrf-token"]').attr('content'),
          "saleID" : saleId,
          "receivedAmount" : receivedAmount,
          "paymentType" : paymentType
        },
        url: "/cashier/savePayment",
        success: function(data){
          window.location.href = data;
        }
      });
    })
  });
</script>

@endsection