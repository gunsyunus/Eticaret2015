@extends('panel.template')

@section('content')

@include('panel.module.bankRate.menu')
<div class="page-body">

<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="card tab2-card">
        <div class="card-header">
            <h5>POS ORANI DÜZENLE</h5>
        </div>
        {!! Form::open(['url'=>'Pv3/bank-rate/save/'.$rates->id_rate.'','role'=>'form','class'=>'form-horizontal']) !!}

        <div class="card-body">
        <div class="form-group row">
        {!! Form::label('installment', 'Taksit Sayısı', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('installment',$rates->installment,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('rate', 'Komisyon Oranı', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
         {!! Form::text('rate',$rates->rate,['class'=>'form-control moneyformat']) !!} 
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('group_id', 'Banka Seçiniz', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::select('group_id',$banks,$rates->group_id,['class'=>'form-control']) !!}
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