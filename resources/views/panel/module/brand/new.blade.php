@extends('panel.template')

@section('content')

@include('panel.module.brand.menu')
<div class="page-body">

<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="card tab2-card">
        <div class="card-header">
            <h5>Yeni Marka Tanımla</h5>
        </div>
        {!! Form::open(['url'=>'Pv3/brand/add','role'=>'form','class'=>'form-horizontal']) !!}

        <div class="card-body">

        <div class="form-group row">
        {!! Form::label('bname', 'Marka Adı', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('bname',null,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group row">
        <div class="col-md-2">     
        {!! Form::label('title', 'Site Başlığı', array('class'=>'control-label')) !!}     
        {!! Tooltip::standard('Minimum 3 ve maksimum 70 karakter olmalıdır.') !!}    
        </div>
        <div class="col-md-10">
        {!! Form::text('title',null,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group row">
        <div class="col-md-2">         
        {!! Form::label('keyword', 'Anahtar Kelimeler', array('class'=>'control-label')) !!}     
        {!! Tooltip::standard('Maksimum 260 karakter olmalıdır.') !!}    
        </div>
        <div class="col-md-10">
        {!! Form::text('keyword',null,['class'=>'form-control']) !!}       
        </div>
        </div>        

        <div class="form-group row">
        <div class="col-md-2">        
        {!! Form::label('description', 'Description (Açıklama)', array('class'=>'control-label')) !!}     
        {!! Tooltip::standard('Maksimum 160 karakter olmalıdır.') !!}    
        </div>
        <div class="col-md-10">
        {!! Form::text('description',null,['class'=>'form-control']) !!}       
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