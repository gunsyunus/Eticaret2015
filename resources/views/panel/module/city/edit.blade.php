@extends('panel.template')

@section('content')

@include('panel.module.city.menu')

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title panel-modul">ŞEHİR BİLGİLERİNİ DÜZENLE</h3>
  </div>
  <div class="panel-body">
    <div class="row">
    <div class="col-md-12">
        
        {!! Form::open(['url'=>'Pv3/city/save/'.$cities->id_city.'','role'=>'form','class'=>'form-horizontal']) !!}

        <div class="form-group">
        {!! Form::label('name', 'Şehir Adı', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('name',$cities->name,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group">
        <div class="col-md-2 text-right">     
        {!! Form::label('sort', 'Şehir Sıralama', array('class'=>'control-label')); !!}
        {!! Tooltip::standard('Özel sıralama içindir. Örneğin : İSTANBUL listenin ilk sırasına alınabilir. Üyelik ve misafirler için sıralar.') !!}   
        </div>
        <div class="col-md-10">
        {!! Form::text('sort',$cities->sort,['class'=>'form-control']) !!}       
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

@stop