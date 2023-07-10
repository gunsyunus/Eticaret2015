@extends('panel.template')

@section('content')

@include('panel.module.brand.menu')

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title panel-modul">MARKAYI DÜZENLE</h3>
  </div>
  <div class="panel-body">
    <div class="row">
    <div class="col-md-12">
        
        {!! Form::open(['url'=>'Pv3/brand/save/'.$brands->id_brand.'','role'=>'form','class'=>'form-horizontal']) !!}

        <div class="form-group row">
        {!! Form::label('bname', 'Marka Adı', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('bname',$brands->bname,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group row">
        <div class="col-md-2">     
        {!! Form::label('title', 'Site Başlığı', array('class'=>'control-label')) !!}     
        {!! Tooltip::standard('Minimum 3 ve maksimum 70 karakter olmalıdır.') !!}            
        </div>
        <div class="col-md-10">
        {!! Form::text('title',$brands->title,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group row">
        <div class="col-md-2">     
        {!! Form::label('keyword', 'Anahtar Kelimeler', array('class'=>'control-label')) !!}     
        {!! Tooltip::standard('Maksimum 260 karakter olmalıdır.') !!}            
        </div>
        <div class="col-md-10">
        {!! Form::text('keyword',$brands->keyword,['class'=>'form-control']) !!}       
        </div>
        </div>        

        <div class="form-group row">
        <div class="col-md-2">    
        {!! Form::label('description', 'Description (Açıklama)', array('class'=>'control-label')) !!}     
        {!! Tooltip::standard('Maksimum 160 karakter olmalıdır.') !!}            
        </div>
        <div class="col-md-10">
        {!! Form::text('description',$brands->description,['class'=>'form-control']) !!}       
        </div>
        </div>      

        <div class="form-group row">
        {!! Form::label('sef_url', 'Marka Linki', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">     
        <span class="copy-area">{!! Sef::brand($brands->sef_url,$brands->id_brand) !!}</span>
        <span class="btn btn-default copy-url" role="button" data-clipboard-action="copy" 
        data-clipboard-target=".copy-area"><i class="fa fa-clipboard"></i> Kopyala</span>
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