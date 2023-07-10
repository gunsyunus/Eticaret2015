<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Print</title>
    {{ HTML::style('panelv3/css/bootstrap.min.css') }}   
    {{ HTML::style('panelv3/css/order.min.css') }}    
</head>
<body onLoad="window.print();">

<div class="container">

<br />

<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12">

<!-- - -->

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title panel-modul">SİPARİŞ BİLGİLERİ</h3>
  </div>
  <div class="panel-body">
    <div class="row">
    <div class="col-md-12">
        
    <table class="table table-condensed">
      <tbody>
        <tr>
          <th>Sipariş Tarihi</th>
          <td><span class="label label-default">{{ $order->created_at->format('d.m.Y - H:i') }}</span></td>
        </tr>
        <tr>
          <th>Üyelik Tipi</th>
          <td>         
          @if ($order->customer_group=='0')
         <span class="label label-default">MİSAFİR</span>
         @elseif ($order->customer_group=='1')
         <span class="label label-primary">ÜYE</span>
         @endif
       </td>
        </tr>
        <tr>
          <th>Ödeme Tipi</th>
          <td>{{ $payment->name }}</td>
        </tr>
        <tr>
          <th>Adı Soyadı</th>
          <td>{{ $order->name }} {{ $order->surname }}</td>
        </tr>      
        <tr>
          <th>E-Posta / Telefon</th>
          <td>{{ $order->email }} / {{ $order->phone }}</td>
        </tr> 
        <tr>
          <th>Sipariş Mesajı</th>
          <td>{{ $order->message }} </td>
        </tr>                              
      </tbody>
    </table>

    </div>
  </div>
</div>
</div>

<!-- - -->

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title panel-modul">SİPARİŞ DETAYLARI : <b>{{ $order->ref_number }}</b></h3>
  </div>
  <div class="panel-body">
    <div class="row">
    <div class="col-md-12">
    <table class="table table-condensed">
      <thead>
        <tr>
          <th>Resim</th>
          <th>Ürün</th>
          <th>Fiyat</th>
          <th>Adet</th>
          <th>Tutar</th>
        </tr>
      </thead>
      <tbody>
      @foreach($carts as $cart)
        <tr>
          <td><img class="img-thumbnail img-responsive" src="{{ URL::to($cart->product->image_small_1) }} " style="width:50px"></td>
          <td>{{ $cart->name }} @if (!empty($cart->option_name)) - {{ $cart->option_name }} @endif</td>
          <td>{{ Price::format($cart->price) }} TL</td>
          <td>{{ $cart->stock }}</td>
          <td>{{ Price::format($cart->total) }} TL</td>
        </tr> 
      @endforeach     
        <tr>
          <td></td>          
          <td></td>
          <td></td>
          <td><b>Kargo Bedeli</b></td>
          <td><b>{{ Price::format($order->shipment_amount) }} TL</b></td>
        </tr>
        <tr>
          <td></td>          
          <td></td>
          <td></td>
          <td><b>İndirim Bedeli</b></td>
          <td><b>- {{ Price::format($order->discount_amount) }} TL</b></td>
        </tr>         
        <tr>
          <td></td> 
          <td></td>
          <td></td>
          <td><b>Genel Toplam</b></td>
          <td><b>{{ Price::format($order->total_amount) }} TL</b></td>
        </tr>
      </tbody>
    </table>
    </div>
    </div>
  </div>
</div>

<!-- - -->

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title panel-modul">ADRES BİLGİLERİ</h3>
  </div>
  <div class="panel-body">
    <div class="row">

    <div class="col-md-6">
      <div class="well">
        <b>TESLİMAT</b>
        {{ $shipping_address->phone }}<br />
        {{ $shipping_address->address_1 }}<br />
        {{ $shipping_address->city->name }} / {{ $shipping_address->county->name }}<br />
      </div>
    </div>

    <div class="col-md-6">
      <div class="well">
        <b>FATURA</b>
        {{ $billing_address->phone }}<br />
        {{ $billing_address->address_1 }}<br />
        {{ $billing_address->city->name }} / {{ $billing_address->county->name }}<br />
      </div>
    </div>

  </div>
</div>
</div>

  </div>
</div>  

</div>

</body>
</html>