@extends('panel.template')

@section('content')

@include('panel.module.shipment.menu')
<div class="page-body">

<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="card tab2-card">
        <div class="card-header">
            <h5>YENİ KARGO</h5>
        </div>
        {!! Form::open(['url'=>'Pv3/shipment/add','role'=>'form','class'=>'form-horizontal','files'=>true]) !!}

        <div class="card-body">
        <div class="form-group row">        
        <div class="col-md-2">     
        {!! Form::label('image', 'Resim Seçiniz', array('class'=>'control-label')) !!}     
        {!! Tooltip::standard('100 x 75 ölçülerinde ve JPG,PNG,GIF olmalıdır.') !!}    
        </div>
        <div class="col-md-10">     
        {!! Form::file('image'); !!}        
        </div>
        </div>            

        <div class="form-group row">        
        {!! Form::label('provider_name', 'Kargo Servis Sağlayıcı', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-10">
        <span class="label label-default">Tanımsız</span>
        </div>
        </div>

        <div class="form-group row">        
        {!! Form::label('name', 'Kargo Adı', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-10">
        {!! Form::text('name',null,['class'=>'form-control']) !!}
        </div>
        </div>     

        <div class="form-group row">        
        {!! Form::label('status', 'Kargo Durumu', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-10">
        {!! Form::checkbox('status', '1', true, array('class'=>'checkboxes')); !!}
        </div>
        
        </div>            
        <div class="form-group row">        
        {!! Form::label('sort', 'Sıralama', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-10">
        {!! Form::text('sort',null,['class'=>'form-control']) !!}       
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