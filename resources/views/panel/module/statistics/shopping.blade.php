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
        <h3 class="panel-title panel-modul"><i class="fa fa-credit-card"></i> EN ÇOK ALIŞVERİŞ YAPAN 100 ÜYE</h3>
      </div>
      <div class="panel-body">
        <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 ">

    <table class="table table-striped">
      <thead>
        <tr>
          <th>Kayıt</th>        
          <th>E-Posta</th>
          <th>Cinsiyet</th>
          <th>Sipariş Adet</th>
        </tr>
      </thead>
      <tbody>
      @foreach($customers as $customer)
        <tr>
          <td>{{ $customer->user->created_at->format('d.m.Y') }}</td>
          <td>{{ $customer->user->email }}</td>
          <td>
          @if ($customer->gender === 'F') Kadın
          @elseif ($customer->gender === 'M') Erkek
          @else - @endif
          </td>
          <td><span class="label label-warning">{{ $customer->stock_order }}</span></td>
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