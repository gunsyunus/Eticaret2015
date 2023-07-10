@extends('panel.template')

@section('content')

@include('panel.module.order.menu')

<div class="page-body">

<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="card tab2-card">
        <div class="card-header">
            <h5>Siparişler</h5>
        </div>

        <div class="card-body">
<div class="row">
  <div class="col-xs-12 col-sm-2 col-md-2">

    @include('panel.module.order.leftmenu')

  </div>
  <div class="col-xs-12 col-sm-10 col-md-10">

<div class="panel panel-{{ $statusType->color }}">
  <div class="panel-heading">
    <span class="order-title">{{ $statusType->name }} Siparişler <span class="badge">{{ $orders->total() }} Adet</span></span>
  </div>
  <div class="panel-body">
    <div class="row">
    <div class="col-md-12">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Tarih</th>
          <th>Saat</th>
          <th>Adı Soyadı</th>
          <th>Grup</th>
          <th>Referans</th>
          <th>Toplam</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      @foreach($orders as $order)
        <tr>
          <td>{{ $order->created_at->format('d.m.Y') }}</td>
          <td>{{ $order->created_at->format('H:i') }}</td>
          <td>{{ $order->name }} {{ $order->surname }}</td>
          <td>{{ $order->customer_group=='0' ? 'MİSAFİR' : 'ÜYE' }}</td>
          <td>{{ $order->ref_number }}</td>
          <th>{{ Price::format($order->total_amount) }} TL</th>
          <td class="text-right"><a href="{{ URL::to('Pv3/order/detail/'.$order->id_order.'') }}" class="btn btn-default"><i class="fa fa-pencil-square-o"></i></a></td>
        </tr> 
      @endforeach      
      </tbody>
    </table>
    <div class="pagination"> {{ $orders->links() }} </div>
    </div>
    </div>
    
    @if ($statusType->id_status == 3)
      <p class="text-right"><a class="btn btn-success" href="{{ URL::to('Pv3/order/export') }}"><i class="fa fa-download"></i> KARGO LİSTESİNİ İNDİR</a></p>
    @endif

  </div>
</div>

  </div>
</div>

@stop