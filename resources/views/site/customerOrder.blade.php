@extends('site.template')

@section('title', 'Hesabım - '.$settings->title.'')
@section('keyword', ''.$settings->keyword.'')
@section('description', ''.$settings->description.'')

@section('meta')
@stop

@section('body')
@stop

@section('content')

<!-- Container -->

<section class="main-container col2-right-layout">
  <div class="main container">
    <div class="row">
      <div class="col-main col-sm-9">
        <div class="page-title">
          <h2>SİPARİŞLERİM <span style="font-size:14px;">(Toplam {{ count($orders) }} siparişiniz var)</span></h2>
        </div>

      @foreach($orders as $order)
      <div class="well">
        <b style="font-size:20px">{{ $order->ref_number }}</b><br />
        <b><a href="{{ URL::to('kargo-sorgula?n=').$order->ref_number }}" style="color:orange; text-transform: uppercase; font-size:14px"> > KARGO TAKİP</a></b><br>
        {{ date('d.m.Y - H:i', strtotime($order->created_at)) }}<br />
        Toplam Tutar : {{ Price::format($order->total_amount) }} TL <br>
      </div>
      @endforeach

      </div>

      @include('site.customerMenu')

    </div>
  </div>
</section>

<!-- End Container -->

@stop