@extends('panel.template')

@section('content')

@include('panel.module.statistics.menu')

<div class="row">
  <div class="col-xs-12 col-sm-4 col-md-4">
  @include('panel.module.statistics.list')
  </div>
  <div class="col-xs-12 col-sm-8 col-md-8">

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title panel-modul"><i class="fa fa-star"></i> KAMPANYA KUPON İSTATİSTİK</h3>
      </div>
      <div class="panel-body">
        <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 ">

    <table class="table table-striped">
      <thead>
        <tr>
          <th>Kupon Kodu</th>        
          <th>Toplam Adet</th>
        </tr>
      </thead>
      <tbody>
      @foreach($orders as $order)
        <tr>
          <td>{{ $order->coupon_code }}</td>
          <td><span class="label label-warning">{{ $order->coupon_total }}</span></td>
        </tr> 
      @endforeach      
      </tbody>
    </table>

        </div>        
        </div>
      </div>
    </div>  

  </div>
</div> 
@stop