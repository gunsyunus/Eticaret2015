@extends('panel.template')

@section('content')

@include('panel.module.menu.menu')
<div class="page-body">

<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="card tab2-card">
        <div class="card-header">
            <h5>YENİ MENÜ</h5>
        </div>
        {!! Form::open(['url'=>'Pv3/menu/add','role'=>'form','class'=>'form-horizontal','files'=>true]) !!}

        <div class="card-body">
         <div class="form-group row">
        {!! Form::label('name', 'Menü Adı', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-10">
        {!! Form::text('name',null,['class'=>'form-control']) !!}
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('status', 'Durumu', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-10">
        {!! Form::checkbox('status', '1', true, array('class'=>'checkboxes')); !!}
        </div>
        </div>            

        <div class="form-group row">
        {!! Form::label('url', 'Linki', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-10">
        {!! Form::text('url',null,['class'=>'form-control']) !!}       
        </div>
        </div>  

        <div class="form-group row">
        {!! Form::label('sort', 'Sıralama', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-10">
        {!! Form::text('sort',null,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('type', 'Menü Tipi', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::select('type', array('single'=>'Tekli Menü',
                                      'five'=>'5\'li Menü',
                                      'four'=>'4\'lü Menü',
                                      'three'=>'3\'lü Menü',
                                      'image'=>'Resimli Menü',
                                      'dropdown'=>'Açılır Menü'
                                      ),
                                      'single',['class'=>'form-control']) !!}
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