@extends('panel.template')

@section('content')

@include('panel.module.user.menu')
<div class="page-body">

<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="card tab2-card">
        <div class="card-header">
            <h5>YÖNETİCİYİ DÜZENLE</h5>
        </div>
        {!! Form::open(['url'=>'Pv3/user/save/'.$users->id_user.'','role'=>'form','class'=>'form-horizontal']) !!}

        <div class="card-body">
        <div class="form-group row">
        {!! Form::label('name', 'Adı', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('name',$users->name,['class'=>'form-control']) !!}       
        {!! Form::hidden('secret', Crypt::encrypt($users->id_user)) !!}
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('surname', 'Soyad', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('surname',$users->surname,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('created_at', 'Kayıt Tarihi', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! $users->created_at->format('d.m.Y H:i') !!}
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('updated_at', 'Güncelleme Tarihi', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! $users->updated_at->format('d.m.Y H:i') !!}
        </div>
        </div>                

        <div class="form-group row">
        <div class="col-md-2">
        {!! Form::label('email', 'E-Posta', array('class'=>'control-label')); !!}
        {!! Tooltip::standard('Sisteme giriş ve bilgilendirme mailleri için kullanılır.') !!}    
        </div>
        <div class="col-md-10">
        {!! Form::text('email',$users->email,['class'=>'form-control']) !!}       
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