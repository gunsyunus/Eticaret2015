<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="utf-8">
</head>
<body>

  <table>
    <thead>
      <tr>
        <th>Adı Soyadı</th>
        <th>Telefon</th>
        <th>Telefon - 2</th>
        <th>E-Posta</th>
        <th>Teslimat Adres</th>
        <th>İlçe</th>
        <th>Şehir</th>
        <th>Ödeme Tipi</th>
        <th align="right">Toplam (TL)</th>
      </tr>
    </thead>
    <tbody>
      @foreach($orders as $order)
      <tr>
        <td>{{ $order->name }} {{ $order->surname }}</td>
        <td>{{ $order->phone }}</td>
        <td>{{ $order->address->phone }}</td>        
        <td>{{ $order->email }}</td>
        <td>{{ $order->address->address_1 }}</td>
        <td>{{ $order->address->city->name }}</td>
        <td>{{ $order->address->county->name }}</td>  
        <td>{{ $order->payment->name }}</td>  
        <td align="right">{{ Price::format($order->total_amount) }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>

</body>
</html>
