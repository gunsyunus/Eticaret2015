@extends('panel.template')

@section('content')

@include('panel.module.bannerCategory.menu')

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title panel-modul">BANNER DÜZENLE</h3>
  </div>
  <div class="panel-body">
    <div class="row">
    <div class="col-md-12">
        
        {!! Form::open(['url'=>'Pv3/banner-category/save/'.$banners->id_banner.'','role'=>'form','class'=>'form-horizontal','files'=>'true']) !!}

        <div class="form-group">
        <div class="col-md-2 text-right">     
        {!! Form::label('image', 'Resim Seçiniz', array('class'=>'control-label')) !!}     
        {!! Tooltip::standard('860 x 320 ölçülerinde ve JPG,PNG,GIF olmalıdır.') !!}    
        </div>
        <div class="col-md-10">     
        <img src="{{ URL::to($banners->image) }}" class="banner img-thumbnail img-responsive" />
        {!! Form::file('image'); !!}
        </div>
        </div>        

        <div class="form-group">
        {!! Form::label('title', 'Banner Üst Yazı', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('title',$banners->title,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group">
        {!! Form::label('text', 'Banner Alt Yazı', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('text',$banners->text,['class'=>'form-control']) !!}       
        </div>
        </div>              

        <div class="form-group">
        {!! Form::label('status', 'Banner Durumu', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::checkbox('status', '1', $banners->status, array('class'=>'checkboxes')); !!}
        </div>
        </div>            

        <div class="form-group">
        {!! Form::label('url', 'Banner Linki', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('url',$banners->url,['class'=>'form-control']) !!}       
        </div>
        </div> 

        <div class="form-group">
        {!! Form::label('sort', 'Sıralama', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('sort',$banners->sort,['class'=>'form-control']) !!}       
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