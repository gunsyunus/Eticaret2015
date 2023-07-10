@extends('panel.template')

@section('content')

@include('panel.module.payment.menu')
<div class="page-body">

<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="card tab2-card">
        <div class="card-header">
            <h5>ÖDEME TİPİNİ DÜZENLE</h5>
        </div>
        {!! Form::open(['url'=>'Pv3/payment/save/'.$payments->id_payment.'','role'=>'form','class'=>'form-horizontal']) !!}

        <div class="card-body">
        <div class="form-group row">
        {!! Form::label('sort', 'Sıralama', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('sort',$payments->sort,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('status', 'Gösterim', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-10">
        {!! Form::checkbox('status', '1', $payments->status, array('class'=>'checkboxes')); !!}
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