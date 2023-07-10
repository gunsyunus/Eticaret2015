@extends('panel.template')

@section('content')

@include('panel.module.banner.menu')
<div class="page-body">

<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="card tab2-card">
        <div class="card-header">
            <h5>YENİ BANNER</h5>
        </div>
        {!! Form::open(['url'=>'Pv3/banner/add','role'=>'form','class'=>'form-horizontal','files'=>true]) !!}

        <div class="card-body">
        <div class="form-group row">        
        <div class="col-md-2">     
        {!! Form::label('image', 'Resim Seçiniz', array('class'=>'control-label')) !!}     
        {!! Tooltip::standard($designs->banner_width.' x '.$designs->banner_height.' ölçülerinde ve JPG,PNG,GIF olmalıdır.') !!}    
        </div>
        <div class="col-md-10">     
        {!! Form::file('image'); !!}        
        </div>
        </div>        

        <div class="form-group row">        
        {!! Form::label('title', 'Banner Adı', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-10">
        {!! Form::text('title',null,['class'=>'form-control']) !!}
        </div>
        </div>

        <div class="form-group row">        
        {!! Form::label('status', 'Banner Durumu', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-10">
        {!! Form::checkbox('status', '1', true, array('class'=>'checkboxes')); !!}
        </div>
        </div>            

        <div class="form-group row">        
        {!! Form::label('url', 'Banner Linki', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-10">
        {!! Form::text('url',null,['class'=>'form-control']) !!}       
        </div>
        </div>  

        <div class="form-group row">        
        <div class="col-md-2">     
        {!! Form::label('delay', 'Banner Süresi', array('class'=>'control-label')) !!}
        {!! Tooltip::standard('Banner geçiş süresi (5 saniye, 3 saniye)') !!}
        </div>
        <div class="col-md-10">     
        {!! Form::text('delay','5',['class'=>'form-control']) !!}
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