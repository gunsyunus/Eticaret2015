@extends('panel.template')

@section('content')

@include('panel.module.city.menu')

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title panel-modul">YENİ ŞEHİR EKLE</h3>
  </div>
  <div class="panel-body">
    <div class="row">
    <div class="col-md-12">
        
        {!! Form::open(['url'=>'Pv3/city/add','role'=>'form','class'=>'form-horizontal']) !!}

        <div class="form-group">
        {!! Form::label('name', 'Şehir Adı', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('name',null,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group">
        <div class="col-md-2 text-right">     
        {!! Form::label('sort', 'Şehir Sıralama', array('class'=>'control-label')); !!}
        {!! Tooltip::standard('Özel sıralama içindir. Örneğin : İSTANBUL listenin ilk sırasına alınabilir. Üyelik ve misafirler için sıralar.') !!}
        </div>
        <div class="col-md-10">
        {!! Form::text('sort',null,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group">
          <div class="col-md-offset-2 col-md-10">
          <button type="submit" class="btn btn-success"><i class="fa fa-plus-circle"></i> EKLE</button>
        </div>
        </div>
        
        {!! Form::close() !!}

    </div>
  </div>
</div>
</div>

@stop