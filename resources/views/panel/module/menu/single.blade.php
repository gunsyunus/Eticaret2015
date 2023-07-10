@extends('panel.template')

@section('content')

@include('panel.module.menu.menu')
<div class="page-body">

<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="card tab2-card">
        <div class="card-header">
            <h5>MENÜ DÜZENLE</h5>
        </div>
        {!! Form::open(['url'=>'Pv3/menu/save/'.$menus->id_menu.'','role'=>'form','class'=>'form-horizontal','files'=>'true']) !!}

        <div class="card-body">
        <div class="form-group row">
        {!! Form::label('name', 'Menü Adı', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-10">
        {!! Form::text('name',$menus->name,['class'=>'form-control']) !!}
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('status', 'Durumu', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-10">
        {!! Form::checkbox('status', '1', $menus->status, array('class'=>'checkboxes')); !!}
        </div>
        </div>            

        <div class="form-group row">
        {!! Form::label('url', 'Linki', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-10">
        {!! Form::text('url',$menus->url,['class'=>'form-control']) !!}       
        </div>
        </div>  

        <div class="form-group row">
        {!! Form::label('sort', 'Sıralama', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-10">
        {!! Form::text('sort',$menus->sort,['class'=>'form-control']) !!}       
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