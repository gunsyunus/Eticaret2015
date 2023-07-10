@extends('panel.template')

@section('content')

@include('panel.module.customer.menu')
<div class="page-body">

<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="card tab2-card">
        <div class="card-header">
            <h5>Üyelik Ekleme</h5>
        </div>
    {!! Form::open(['url'=>'Pv3/customer/add/','role'=>'form','class'=>'form-horizontal']) !!}
    <div class="card-body">
            <ul class="nav nav-tabs tab-coupon" id="myTab" role="tablist">
            <li class="nav-item"><a class="nav-link active show" id="general-tab" data-toggle="tab" href="#login" role="tab" aria-controls="general" aria-selected="true" data-original-title="" title="">Giriş Bilgileri</a></li>
            <li class="nav-item"><a class="nav-link" id="seo-tabs" data-toggle="tab" href="#other" role="tab" aria-controls="seo" aria-selected="false" data-original-title="" title="">Diğer Bilgiler</a></li>
            <li class="nav-item"><a class="nav-link" id="" data-toggle="tab" href="#address" role="tab" aria-controls="seo" aria-selected="false" data-original-title="" title="">Adres Bilgileri</a></li>
            </ul>
            <div class="tab-content" id="myTabContent">
    <br />

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="login">

        <!-- 1 -->

        <div class="form-group row">
        {!! Form::label('name', 'Adı', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('name',null,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('surname', 'Soyadı', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('surname',null,['class'=>'form-control']) !!}       
        </div>
        </div>        

        <div class="form-group row">
        {!! Form::label('email', 'E-Posta (Kullanıcı Adı)', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('email',null,['class'=>'form-control']) !!}       
        </div>
        </div>     

        <div class="form-group row">
        {!! Form::label('password', 'Şifre', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('password',null,['class'=>'form-control']) !!}       
        </div>
        </div>           

        <!-- 1 -->                

        </div>
        <div role="tabpanel" class="tab-pane" id="other">
            
        <!-- 2 -->

        <div class="form-group row">
        {!! Form::label('phone', 'Telefon', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('phone',null,['class'=>'form-control phoneformat']) !!}       
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('phone_other', 'Diğer Telefon', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('phone_other',null,['class'=>'form-control phoneformat']) !!}       
        </div>
        </div>        

        <div class="form-group row">
        {!! Form::label('gender', 'Cinsiyet', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::select('gender', array('-'=>'Lütfen Seçiniz','M'=>'Erkek','F'=>'Kadın'),'-',['class'=>'form-control']) !!}
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('city_id', 'Şehir', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::select('city_id',$cities,'-',['class'=>'form-control']) !!}
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('newsletter_status', 'E-Bülten Aboneliği', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-10">
        {!! Form::checkbox('newsletter_status', '1', true, array('class'=>'checkboxes')); !!}
        </div>
        </div>        

        <div class="form-group row">
        {!! Form::label('register_device', 'Üyelik Kayıt Aygıtı', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::select('register_device', array('-'=>'Lütfen Seçiniz','W'=>'Web Site','M'=>'Mobil Site','A'=>'Mobil Uygulama'),'-',['class'=>'form-control']) !!}       
        </div>
        </div>                

        <div class="form-group row">
        {!! Form::label('stock_order', 'Toplam Sipariş Adeti', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('stock_order',null,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('birth_at', 'Doğum Tarihi', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('birth_at',null,['class'=>'form-control dateformat']) !!}       
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('date', 'Kayıt Tarihi', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        -
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('date', 'Güncelleme Tarihi', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        -
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('login_at', 'Sisteme Giriş Tarihi', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        -
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('order_at', 'Son Sipariş Tarihi', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        -     
        </div>
        </div>

        <!-- 2 -->  

        </div>
        <div role="tabpanel" class="tab-pane" id="address">
            
        <!-- 3 -->     

        <div class="alert alert-info" role="alert"><i class="fa fa-info-circle fa-fw"></i> Üyeliği tamamladıktan sonra, adres eklenebilir.</div>

        <!-- 3 -->      

        </div>        
    </div>
          
        <div class="form-group">
          <div class="offset-md-2 col-md-10">
          <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> KAYDET</button>
        </div>
        </div>
        
        {!! Form::close() !!}

    </div>
  </div>
</div>
</div>

@stop