@extends('panel.template')

@section('content')

@include('panel.module.newsletter.menu')
<div class="page-body">

<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="card tab2-card">
        <div class="card-header">
            <h5>YENİ ABONE KAYIT</h5>
        </div>
        {!! Form::open(['url'=>'Pv3/newsletter/add','role'=>'form','class'=>'form-horizontal']) !!}

        <div class="card-body">
        <div class="form-group row">
        {!! Form::label('email', 'E-Posta', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('email',null,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group row">
        <div class="col-md-2">
        {!! Form::label('status', 'Durum', array('class'=>'control-label')) !!}
        {!! Tooltip::standard('E-Bülten aboneliğini aktif/pasif yapar.') !!}
        </div>
        <div class="col-md-10">
        {!! Form::checkbox('status', '1', true, array('class'=>'checkboxes')); !!}
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