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
        <h3 class="panel-title panel-modul"><i class="fa fa-tags"></i> EN ÇOK SATILAN 100 ÜRÜN</h3>
      </div>
      <div class="panel-body">
        <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 ">

    <table class="table table-striped">
      <thead>
        <tr>
          <th class="text-center">Satış Adeti</th>
          <th>Ürün</th>
          <th>Stok</th>          
          <th>Durumu</th>          
        </tr>
      </thead>      
      <tbody>
      @foreach($products as $product)
        <tr>
          <th class="text-center">{{ $product->stock_order }}</th>        
          <td>{{ $product->name }}</td>
          <td>{!! $product->stock > '0' ? '<span class="label label-success">'.$product->stock.'</span>' : '<span class="label label-danger">'.$product->stock.'</span>' !!}</td>
          <td>{!! $product->status=='1' ? '<span class="label label-success">AKTİF</span>' : '<span class="label label-danger">PASİF</span>' !!}</td>
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