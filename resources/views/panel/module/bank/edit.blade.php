@extends('panel.template')

@section('content')

@include('panel.module.bank.menu')
<div class="page-body">

<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="card tab2-card">
        <div class="card-header">
            <h5>BANKA / ÖDEME MERKEZİ DÜZENLE</h5>
        </div>
        {!! Form::open(['url'=>'Pv3/bank/save/'.$banks->id_bank.'','role'=>'form','class'=>'form-horizontal']) !!}

        <div class="card-body">
        <div class="form-group row">
        {!! Form::label('name', 'Banka / Ödeme Merkezi', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        <h4><span class="label label-default">{{ $banks->name }}</span></h4>
        </div>
        </div>

        @if(!empty($banks->customer_text))
        <div class="form-group row">
        {!! Form::label('customer_number', $banks->customer_text, array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('customer_number',$banks->customer_number,['class'=>'form-control']) !!}       
        </div>
        </div>
        @endif

        @if(!empty($banks->merchant_text))
        <div class="form-group row">
        {!! Form::label('merchant_number', $banks->merchant_text, array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('merchant_number',$banks->merchant_number,['class'=>'form-control']) !!}       
        </div>
        </div>
        @endif

        @if(!empty($banks->username_text))
        <div class="form-group row">
        {!! Form::label('username', $banks->username_text, array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('username',$banks->username,['class'=>'form-control']) !!}       
        </div>
        </div>
        @endif        

        @if(!empty($banks->password_text))
        <div class="form-group row">
        {!! Form::label('password', $banks->password_text, array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('password',$banks->password,['class'=>'form-control']) !!}       
        </div>
        </div>
        @endif      

        <div class="form-group row">
        {!! Form::label('secure_verify_status', '3D Secure', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        <h4>{!! $banks->secure_verify_status =='1' ? '<span style="color:black;" class="label label-default">3D Pos</span>' : '<span style="color:black;" class="label label-default">Sanal Pos</span>' !!}</h4>
        </div>
        </div>        

        <div class="form-group row">
        {!! Form::label('status', 'Pos Durumu', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-10">
        {!! Form::checkbox('status', '1', $banks->status, array('class'=>'checkboxes')); !!}
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