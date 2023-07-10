@extends('site.template')

@section('title', 'Kargo Takip - '.$settings->title.'')
@section('keyword', ''.$settings->keyword.'')
@section('description', ''.$settings->description.'')

@section('meta')
@stop

@section('body')
@stop

@section('content')

<!-- Main Container -->
<section class="main-container col1-layout">
  <div class="main container">
    <div class="account-login">
      <div class="page-title">
        <h2>KARGO TAKİP</h2>
      </div>
      <fieldset class="col2-set">
      
        <div class="col-2 registered-users" style="width:100%;">     
          <div class="content">
            
            <div class="text-center">
            <b>Sayın,</b> {{ str_limit($order->name,2,'***') }} ***** <br /> 
            "{{ $order->ref_number }}" nolu siparişinizin aşamaları aşağıdaki gibidir ; <br />
            </div>       

            <div class="row checkout-bar" style="border-bottom:0;">
                
                <div class="col-xs-3 checkout-bar-step @if($order->status_id >= '1') complete @else disabled @endif">
                  <div class="text-center checkout-bar-stepnum">Yeni</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="checkout-bar-dot"></a>
                </div>
                
                <div class="col-xs-3 checkout-bar-step @if($order->status_id >= '2') complete @else disabled @endif">
                  <div class="text-center checkout-bar-stepnum">Hazırlanıyor</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="checkout-bar-dot"></a>
                </div>
                
                <div class="col-xs-3 checkout-bar-step @if($order->status_id >= '3') complete @else disabled @endif">
                  <div class="text-center checkout-bar-stepnum">Kargo</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="checkout-bar-dot"></a>
                  @if($order->status_id >= '3')                  
                      @if($order->provider_service_url=='')
                      <div class="bs-wizard-info text-center">
                        {{ $order->shipmentName }}<br />
                        ( Gönderi No : {{ $order->shipping_tracking_number }} )
                      </div>
                      @else
                        <div class="bs-wizard-info text-center"><a href="{{ $order->provider_service_url.$order->shipping_tracking_number }}" target="_blank">( Kargom Nerede ? )</a></div>
                      @endif
                  @endif
                </div>
                
                <div class="col-xs-3 checkout-bar-step @if($order->status_id >= '4') complete @else disabled @endif">
                  <div class="text-center checkout-bar-stepnum">Tamamlandı</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="checkout-bar-dot"></a>
                </div>

            </div>

        </div>
      </fieldset>
    </div>
    <br>
    <br>
  </div>
</section>
<!-- Main Container End -->

@stop