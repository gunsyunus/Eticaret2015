@extends('panel.template')

@section('content')

@include('panel.module.setting.menu',array('page'=>'Kargo'))
<div class="page-body">

<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="card tab2-card">
        <div class="card-header">
            <h5>KARGO ÜCRETLENDİRME</h5>
        </div>
        {!! Form::open(['url'=>'Pv3/setting/cargosave/','role'=>'form','class'=>'form-horizontal']) !!}

        <div class="card-body">
        <div class="form-group row">        
        <div class="col-md-2">     
        {!! Form::label('cargo_total', 'Sepet Toplamı', array('class'=>'control-label')); !!}           
        {!! Tooltip::standard('xxx TL\'den sonra kargo bedava') !!} 
        </div>
        <div class="col-md-10">     
        {!! Form::text('cargo_total',$settings->cargo_total,['class'=>'form-control moneyformat']) !!}       
        </div>
        </div>   

        <div class="form-group row">        
        {!! Form::label('cargo_price', 'Kargo Ücreti', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('cargo_price',$settings->cargo_price,['class'=>'form-control moneyformat']) !!}       
        </div>
        </div>

        <div class="form-group row">        
        {!! Form::label('cargo_text', 'Ücretsiz Kargo Metni', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('cargo_text',$settings->cargo_text,['class'=>'form-control']) !!}       
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