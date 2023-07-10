@extends('panel.template')

@section('content')

@include('panel.module.bankRate.menu')
<div class="page-body">

<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="card tab2-card">
        <div class="card-header">
            <h5>YENİ ORAN EKLE</h5>
        </div>
        {!! Form::open(['url'=>'Pv3/bank-rate/add','role'=>'form','class'=>'form-horizontal']) !!}

        <div class="card-body">
        <div class="form-group row">
        {!! Form::label('installment', 'Taksit Sayısı', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('installment',null,['class'=>'form-control']) !!}       
        </div>
        </div>        

        <div class="form-group row">
        {!! Form::label('rate', 'Komisyon Oranı', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
         {!! Form::text('rate',null,['class'=>'form-control moneyformat']) !!} 
        </div>
        </div>        

        <div class="form-group row">
        {!! Form::label('group_id', 'Banka Seçiniz', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::select('group_id',$banks,'-',['class'=>'form-control']) !!}
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