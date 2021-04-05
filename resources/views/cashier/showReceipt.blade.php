<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Receipt - saleID : {{$sale->id}}</title>
  <link rel="stylesheet" href="{{asset('/css/receipt.css')}}" media="all">
  <link rel="stylesheet" href="{{asset('/css/no-print.css')}}" media="print">
</head>
<body>
  <div id="wrapper">
    <div id="header">
      <h3 id="restaurant-name">Restaurant App </h3>
      <p>Address : Tokyo Narimasu</p>
      <p>street 234</p>
      <p>phone : 234-44554-134</p>
    </div>
    <div id="body">
      <table class="tb-sale-detail">
        <thead>
          <tr>
            <th>#</th>
            <th>Menu</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($saleDetails as $saleDetail)
              <tr>
                <td width="30">{{$saleDetail->menu_id}}</td>
                <td width="180">{{$saleDetail->menu_name}}</td>
                <td width="50">{{$saleDetail->quantity}}</td>
                <td width="50">$ {{$saleDetail->menu_price}}</td>
                <td width="50">$ {{$saleDetail->menu_price * $saleDetail->quantity}}</td>
              </tr>
          @endforeach
        </tbody>
      </table>
      <table class="tb-sale-total">
        <tbody>
          <tr>
            <td>Total Quantity</td>
            <td>{{$saleDetails->count()}}</td>
            <td>Total</td>
            <td>$ {{number_format($sale->total_price,2)}}</td>
          </tr>
          <tr>
            <td colspan="2">Payment Type</td>
            <td colspan="2">{{$sale->payment_type}}</td>
          </tr>
          <tr>
            <td colspan="2">Total </td>
            <td colspan="2">{{number_format($sale->total_received,2)}}</td>
          </tr>
          <tr>
            <td colspan="2">Change</td>
            <td colspan="2">{{number_format($sale->change,2)}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div id="footer">
      <p>Thanks!</p>
    </div>
    <div id="buttons">
      <a href="/cashier">
        <button class="btn btn-back">
          Back to Cashier
        </button>
      </a>
      <button class="btn btn-print" type="button" onclick="window.print(); return false;">
        Print
      </button>
    </div>
  </div>
</body>
</html>