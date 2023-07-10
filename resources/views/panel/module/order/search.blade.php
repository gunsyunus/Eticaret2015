@extends('panel.template')

@section('content')

@include('panel.module.order.menu')

<div class="row">
  <div class="col-xs-12 col-sm-2 col-md-2">

    @include('panel.module.order.leftmenu')

  </div>
  <div class="col-xs-12 col-sm-10 col-md-10">

<div class="panel panel-default">
  <div class="panel-heading">
    <span class="order-title"><i class="fa fa-search-plus"></i> "{{ $searchText }}" - Arama Sonuçları <span class="badge">{{ $orders->total() }} Adet Sipariş Bulundu</span></span>
  </div>
  <div class="panel-body">
    <div class="row">
    <div class="col-md-12">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Tarih</th>
          <th>Adı Soyadı</th>
          <th>E-Posta</th>
          <th>Telefon</th>
          <th>Durumu</th>
          <th>Referans</th>
          <th>Toplam</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      @foreach($orders as $order)
        <tr>
          <td>{{ $order->created_at->format('d.m.Y') }}</td>
          <td>{{ $order->name }} {{ $order->surname }}</td>
          <td>{{ $order->email }}</td>
          <td>{{ $order->phone }}</td>          
          <td><span class="label label-{{ $order->status->color }}">{{ $order->status->name }}</span></td>
          <td>{{ $order->ref_number }}</td>
          <th>{{ Price::format($order->total_amount) }} TL</th>
          <td class="text-right"><a href="{{ URL::to('Pv3/order/detail/'.$order->id_order.'') }}" class="btn btn-default"><i class="fa fa-pencil-square-o"></i></a></td>
        </tr> 
      @endforeach      
      </tbody>
    </table>
    <div class="pagination"> {{ $orders->appends(Request::only('q'))->links() }} </div>
    </div>
    </div>
  </div>
</div>

  </div>
</div>

@stop