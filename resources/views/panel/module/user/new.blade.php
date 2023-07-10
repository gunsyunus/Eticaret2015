@extends('panel.template')

@section('content')

@include('panel.module.user.menu')
<div class="page-body">

<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="card tab2-card">
        <div class="card-header">
            <h5>YENİ YÖNETİCİ TANIMLA</h5>
        </div>
        {!! Form::open(['url'=>'Pv3/user/add','role'=>'form','class'=>'form-horizontal']) !!}

        <div class="card-body">
        <div class="form-group row">
        {!! Form::label('name', 'Adı', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('name',null,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('surname', 'Soyad', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('surname',null,['class'=>'form-control']) !!}       
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
        <div class="col-md-2">
        {!! Form::label('email', 'E-Posta', array('class'=>'control-label')); !!}
        {!! Tooltip::standard('Sisteme giriş ve bilgilendirme mailleri için kullanılır.') !!}    
        </div>
        <div class="col-md-10">
        {!! Form::text('email',null,['class'=>'form-control']) !!}       
        </div>
        </div>        

        <div class="form-group row">
        <div class="col-md-2">
        {!! Form::label('password', 'Şifre', array('class'=>'control-label')); !!}
        {!! Tooltip::standard('Şifre minimum 8 karakter olmalı ve büyük, küçük harf içermesi önerilir.') !!}    
        </div>            
        <div class="col-md-10">
        {!! Form::password('password',array('class'=>'form-control')) !!}
        </div>
        </div>            


        <div class="form-group">
          <div class="offset-md-2 col-md-10">
          <button type="submit" class="btn btn-success"><i class="fa fa-plus-circle"></i> EKLE</button>
        </div>
        </div>
        
        {!! Form::close() !!}

    </div>
  </div>
</div>
</div>

@stop