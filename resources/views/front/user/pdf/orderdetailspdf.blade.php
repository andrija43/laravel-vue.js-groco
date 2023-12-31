<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>User Order Details-{{ $order->id }}</title>
    <style>
      .clearfix:after{content:"";display:table;clear:both}a{color:#5d6975;text-decoration:underline}body{position:relative;width:24cm;min-height:20cm;margin:0 auto;color:#001028;background:#fff;font-family:Arial,sans-serif;font-size:15px;font-family:Arial}header{padding:10px 0;margin-bottom:10px;line-height: 1.3;}#logo{text-align:center;margin-bottom:10px;background: {{ $shop_info->theme_color }} !important;}#logo img{/*width:90px*/}#project{float:left}#project span{color:#5d6975;text-align:right;width:64px;margin-right:10px;display:inline-block;font-size:.8em}#company{float:right;}#company div,#project div{white-space:nowrap}h1{border-top:1px solid #5d6975;border-bottom:1px solid #5d6975;color:#5d6975;font-size:1.8em;line-height:1.4em;font-weight:400;text-align:center;margin:0 0 20px 0;}table{width:100%;border-collapse:collapse;border-spacing:0;margin-bottom:20px}table tr:nth-child(2n-1) td{background:#f5f5f5;padding:4px 0px;}table td,table th{text-align:center; line-height: 2em;}table th{padding:5px 20px;color:#5d6975;border-bottom:1px solid #c1ced9;white-space:nowrap;font-size: 16px;}table td.total{font-size:1.2em; line-height: 1.4em;}table td.grand{border-top:1px solid #5d6975;}table td.unit{text-align: right;}footer{color:#5d6975;width:100%;height:30px;position:absolute;bottom:0;border-top:1px solid #c1ced9;padding:8px 0;text-align:center}
    </style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="{{asset('images/logo/'.$shop_info->logo_header)}}">
      </div>
      <h1>Invoice <strong>#{{ $order->id }}</strong></h1>
      <div id="company" class="clearfix">
      <!-- <div id="company" style="float: right;"> -->
        <div>{{ $shop_info->shop_name }}</div>
        <div>{{ $shop_info->address }}</div>
        <div>{{ $shop_info->phone }}</div>
        <div>{{ $shop_info->email }}</div>
      </div>
      <div id="project">
        <div><span>ORDER NO.</span> {{ $order->id }}</div>
        <div><span>CLIENT</span> {{ $order->customer_name }}</div>
        <div><span>ADDRESS</span> {{ $order->address }}</div>
        <div><span>EMAIL</span>{{ $order->user->email }}</div>
        <div><span>PHONE</span> {{ $order->phone }}</div>
        <div><span>DATE</span> {{ $order->order_date }}</div>
        <div><span>Paid By</span>
          @if($order->payment_method == 1)<span>Cash on Delivery</span>
          @elseif($order->payment_method == 2)<span>Paypal</span>
          @elseif($order->payment_method == 3)<span>Stripe</span>
          @elseif($order->payment_method == 4)<span>SSL Commerz</span>
          @elseif($order->payment_method == 5)<span>Razorpay</span>
          @else<span>Non Paid</span>
          @endif
        </div>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th>SL no</th>
            <th>Name</th>
            <th>Qty</th>
            <th>Unit Price</th>
            <th>Total Price</th>
          </tr>
        </thead>
        <tbody><?php $i = 1; ?>
        @foreach($orderdetails as $value)
          <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $value->product->product_name }}</td>
            <td>{{ $value->quantity }}</td>
            <td>{{ $value->selling_price }}
              @if($value->unit_discount > 0)<sub><del><small>{{ $value->selling_price + $value->unit_discount }}</small></del></sub>@endif
            </td>
            <td>{{ $value->total_selling_price }}</td>
          </tr>
        @endforeach
        <tr>
            <td colspan="4" class="unit">SUBTOTAL</td>
            <td class="total">{{ $order->total_amount }}</td>
          </tr>
          <tr>
            <td colspan="4" class="unit">VAT / TAX</td>
            <td class="total">{{ $order->vat_gst_amount }}</td>
          </tr>
          <tr>
            <td colspan="4" class="unit">SHIPPING</td>
            <td class="total">{{ $order->shipping_amount }}</td>
          </tr>
          @if($order->coupon_discount > 0 )
          <tr>
            <td colspan="4" class="unit">TOTAL</td>
            <td class="total"> {{ $order->total_amount + $order->shipping_amount + $order->vat_gst_amount}}</td>
          </tr>

          <tr>
            <td colspan="4" class="unit">(-) DISCOUNT ({{ $order->cupon }})</td>
            <td class="total"> {{ $order->coupon_discount }}</td>
          </tr>

          @endif

          <tr>
            <td colspan="4" class="grand total unit">GRAND TOTAL</td>
            <td class="grand total">{{ getCurrentCurrency()->code }} {{ $order->total_amount + $order->shipping_amount + $order->vat_gst_amount - $order->coupon_discount }}</td>
          </tr>
        </tbody>
      </table>
    </main>
    <!-- <footer>
      Thanks For Shopping
    </footer> -->
  </body>
</html>