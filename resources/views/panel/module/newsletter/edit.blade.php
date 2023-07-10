@extends('panel.template')

@section('content')

@include('panel.module.newsletter.menu')
<div class="page-body">

<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="card tab2-card">
        <div class="card-header">
            <h5>ABONELİK BİLGİSİNİ DÜZENLE</h5>
        </div>
        {!! Form::open(['url'=>'Pv3/newsletter/save/'.$newsletters->id_subscriber.'','role'=>'form','class'=>'form-horizontal']) !!}

        <div class="card-body">
        <div class="form-group row">
        {!! Form::label('email', 'E-Posta', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('email',$newsletters->email,['class'=>'form-control']) !!}       
        {!! Form::hidden('secret', Crypt::encrypt($newsletters->id_subscriber)) !!}        
        </div>
        </div>

        <div class="form-group row">
        <div class="col-md-2 ">
        {!! Form::label('status', 'Durum', array('class'=>'control-label')) !!}
        {!! Tooltip::standard('E-Bülten aboneliğini aktif/pasif yapar.') !!}
        </div>
        <div class="col-md-10">
        {!! Form::checkbox('status', '1', $newsletters->status, array('class'=>'checkboxes')); !!}
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('ip_register_subscriber', 'Kayıt IP Adresi', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {{ $newsletters->ip_register_subscriber }}
        </div>
        </div>        

        <div class="form-group row">
        {!! Form::label('created_at', 'Abonelik Kayıt Tarihi', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {{ $newsletters->created_at->format('d.m.Y H:i') }}
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('updated_at', 'Güncelleme Tarihi', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {{ $newsletters->updated_at->format('d.m.Y H:i') }}
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