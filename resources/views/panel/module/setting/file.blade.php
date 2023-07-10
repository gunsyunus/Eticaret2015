@extends('panel.template')

@section('content')

@include('panel.module.setting.menu',array('page'=>'Dosya Yöneticisi'))
<div class="page-body">

<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="card tab2-card">
        <div class="card-header">
            <h5>DOSYA YÜKLE</h5>
        </div>
        <div class="card-body">

    {!! Form::open(['url'=>'Pv3/setting/filesave/','role'=>'form','class'=>'form-horizontal','files'=>true]) !!}

        <div class="form-group row">
        <div class="col-md-2">     
        {!! Form::label('image', 'Dosya Seçiniz', array('class'=>'control-label')) !!}     
        {!! Tooltip::standard('Uzantı JPG,PNG,GIF,PDF,RAR olmalıdır.') !!}    
        </div>
        <div class="col-md-10">
        {!! Form::file('image'); !!}
        </div>
        </div>

        <div class="form-group">
          <div class="offset-md-2 col-md-10">
          <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> YÜKLE</button>
        </div>
        </div>
        
    {!! Form::close() !!}

    </div>
  </div>
</div>
</div>

@stop