@extends('panel.template')

@section('content')

@include('panel.module.design.menu',array('page'=>'Anasayfa Reklam Banner'))

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title panel-modul">ANASAYFAYI REKLAMI DEĞİŞTİR</h3>
  </div>
  <div class="panel-body">
    <div class="row">
    <div class="col-md-12">
        
        {!! Form::open(['url'=>'Pv3/design/advertsave/','role'=>'form','class'=>'form-horizontal','files'=>'true']) !!}

        <div class="form-group">
        <div class="col-md-2 text-right">
        {!! Form::label('logo', 'Resim Seçiniz', array('class'=>'control-label')) !!}     
        {!! Tooltip::standard('1170 x 149 ölçülerinde ve JPG,PNG,GIF olmalıdır.') !!}    
        </div>
        <div class="col-md-10">
        <img src="{{ URL::to($designs->advert_image) }}" class="banner img-thumbnail img-responsive" />
        {!! Form::file('advert_image') !!}
        </div>
        </div>  

        <div class="form-group">
        {!! Form::label('advert_link', 'Banner Linki', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('advert_link',$designs->advert_link,['class'=>'form-control']) !!}       
        </div>
        </div>        

        <div class="form-group">
          <div class="col-md-offset-2 col-md-10">
          <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> KAYDET</button>
        </div>
        </div>
        
        {!! Form::close() !!}

    </div>
  </div>
</div>
</div>

@stop