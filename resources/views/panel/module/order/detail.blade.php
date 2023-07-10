@extends('panel.template')

@section('content')

@include('panel.module.order.menu')

<div class="row">
  <div class="col-xs-12 col-sm-2 col-md-2">

    <div class="order-back text-center">  
        <a href="{{ URL::to('Pv3/order/list/1') }} "><i class="fa fa-chevron-circle-left fa-5x"></i><br />SİPARİŞLER</a>      
    </div>

    <br />

    <div class="order-back text-center">  
        <a href="{{ URL::to('print/'.$order->id_order.'') }} " target="_blank"><i class="fa fa-print"></i><br />YAZDIR</a>      
    </div>    
  
  </div>
  <div class="col-xs-12 col-sm-10 col-md-10">

<!-- - -->

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title panel-modul">SİPARİŞ BİLGİLERİ</h3>
  </div>
  <div class="panel-body">
    <div class="row">
    <div class="col-md-12">
        
        {!! Form::open(['url'=>'Pv3/order/save/'.$order->id_order.'','role'=>'form','class'=>'form-horizontal']) !!}

        <div class="form-group row">
        {!! Form::label('name', 'Sipariş Tarihi', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10"><span style="color:black;" class="label label-default">{{ $order->created_at->format('d.m.Y - H:i') }}</span></div>
        </div>

        <div class="form-group row">
        {!! Form::label('customer_group', 'Üyelik Tipi', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
         @if ($order->customer_group=='0')
         <span style="color:black;" class="label label-default">MİSAFİR</span>
         @elseif ($order->customer_group=='1')
         <a  style="color:black;" href="{{ URL::to('Pv3/customer/edit/'.$order->customer_id.'') }}" class="label label-primary">ÜYE</a>
         @endif
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('customer_group', 'Ödeme Tipi', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
          <span style="color:black;" class="label label-default">{{ $payment->name }}</span>
          @if ($order->installment >= 1)
          <span style="color:black;" class="label label-default">{{ $order->installment }} Taksit - % {{ $order->installment_rate }} Oran</span>
          @endif
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('name', 'Adı Soyadı', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-5">
        {!! Form::text('name',$order->name,['class'=>'form-control']) !!}       
        </div>
        <div class="col-md-5">
        {!! Form::text('surname',$order->surname,['class'=>'form-control']) !!}
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('email', 'E-Posta / Telefon', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-5">
        {!! Form::text('email',$order->email,['class'=>'form-control']) !!}       
        </div>
        <div class="col-md-5">
        {!! Form::text('phone',$order->phone,['class'=>'form-control phoneformat']) !!}
        </div>
        </div> 

        <div class="form-group row">
        {!! Form::label('gender', 'Cinsiyet', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::select('gender', array('-'=>'Lütfen Seçiniz','M'=>'Erkek','F'=>'Kadın'),$order->gender,['class'=>'form-control']) !!}
        </div>
        </div>          

        <div class="form-group row">
        {!! Form::label('message', 'Üye Mesajı', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('message',$order->message,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group row">
        <div class="col-md-2">     
        {!! Form::label('admin_message', 'Yönetici Mesajı', array('class'=>'control-label')) !!}
        {!! Tooltip::standard('Yöneticiler arasında gözükür. Üye bu notu göremez.') !!}    
        </div>
        <div class="col-md-10">
        {!! Form::text('admin_message',$order->admin_message,['class'=>'form-control']) !!}       
        </div>
        </div>     

        <div class="form-group row">
        {!! Form::label('shipment_id', 'Kargo', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-10">
        {!! Form::select('shipment_id',$shipments,$order->shipment_id,['class'=>'form-control']) !!}
        </div>
        </div>      

        <div class="form-group row">
        {!! Form::label('shipping_tracking_number', 'Kargo Takip No', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('shipping_tracking_number',$order->shipping_tracking_number,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group row">
        <div class="col-md-2">
        {!! Form::label('status_id', 'Sipariş Durumu', array('class'=>'control-label')) !!}
        {!! Tooltip::standard('KARGO durumu seçildiğinde müşteriye mail gönderilir.') !!}    
        </div>
        <div class="col-md-10">
        @if ($order->status_id==4)
        <span class="label label-success">Tamamlandı</span>
        @elseif  ($order->status_id==5)
        <span class="label label-danger">Iptal</span>
        @else 
        {!! Form::select('status_id',$statuses,$order->status_id,['class'=>'form-control']) !!}
        @endif
        </div>
        </div>
    
        <div class="form-group">
          <div class="col-md-offset-2 col-md-10">
          <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> KAYDET</button>
        </div>
        </div>
        
        {!! Form::close() !!}

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
          <td><img class="product img-thumbnail img-responsive" src="{{ URL::to($cart->product->image_small_1) }} "></td>
          <td><a href="{{ URL::to('Pv3/product/edit/'.$cart->product_id) }}">{{ $cart->name }}</a> @if (!empty($cart->option_name)) <span class="cart-grey">{{ $cart->option_name }} </span> @endif</td>
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
        <b>TESLİMAT</b><br />
        {{ $shipping_address->phone }}<br />
        {{ $shipping_address->address_1 }}<br />
        {{ $shipping_address->city->name }} / {{ $shipping_address->county->name }}<br />
      </div>
    </div>

    <div class="col-md-6">
      <div class="well">
        <b>FATURA</b><br />
        {{ $billing_address->phone }}<br />
        {{ $billing_address->address_1 }}<br />
        {{ $billing_address->city->name }} / {{ $billing_address->county->name }}<br />
      </div>
    </div>


  </div>
</div>
</div>

<!-- - -->

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title panel-modul">DİĞER BİLGİLER</h3>
  </div>
  <div class="panel-body">
    <div class="row">
    <div class="col-md-12">
        
    <table class="table table-condensed">
      <tbody>
        <tr>
          <th>Müşteri IP Adresi</th>
          <td>{{ $order->ip }}</td>
        </tr>
        <tr>
          <th>Tarayıcı Bilgisi</th>
          <td>{{ $order->user_agent }}</td>
        </tr>
        <tr>
          <th>Son Güncelleme Tarihi</th>
          <td>{{ $order->updated_at->format('d.m.Y - H:i') }}</td>
        </tr>
        <tr>
          <th>Son Güncelleyen Yönetici</th>
          <td>{{ $order->last_name_update }}</td>
        </tr>      
        <tr>
          <th>Sipariş Kayıt Aygıtı</th>
          <td>{{ $order->device }}</td>
        </tr>
        <tr>
          <th>Kupon Kodu</th>
          <td>{{ $order->coupon_code }}</td>
        </tr>        
      </tbody>
    </table>

    </div>
  </div>
</div>
</div>

<!-- - -->

  </div>
</div>    

@stop