@extends('panel.template')

@section('content')

@include('panel.module.design.menu',array('page'=>'Renkler'))

@section('meta')
{{ HTML::style('panelv3/css/colorpicker.min.css') }}
@stop

@section('body')
<script type="text/javascript"> jQuery(document).ready(function() { jQuery(".colorformat").colorpicker(); }); </script>
{{ HTML::script('panelv3/js/jquery.colorpicker.min.js') }}
@stop

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title panel-modul">TASARIM RENKLERİNİ DEĞİŞTİR</h3>
  </div>
  <div class="panel-body">
    <div class="row">
    <div class="col-md-12">
        
        {!! Form::open(['url'=>'Pv3/design/colorsave/','role'=>'form','class'=>'form-horizontal','files'=>'true']) !!}

        <div class="form-group">

        <div class="form-group row">
        <div class="col-md-2">
        {!! Form::label('main', 'Temel Renk', array('class'=>'control-label')) !!}     
        {!! Tooltip::standard('Sitenin ana rengini belirler. Buton renkleri, barlar ve diğer alanlarda geçerlidir.') !!}    
        </div>
        <div class="col-md-10">
        {!! Form::text('main',$color->main,['class'=>'form-control colorformat']) !!}       
        </div>
        </div>     

        <div class="form-group row">
        <div class="col-md-2">
        {!! Form::label('menu', 'Menü Renk', array('class'=>'control-label')) !!}     
        {!! Tooltip::standard('Ana menü için arka plan rengi') !!}    
        </div>
        <div class="col-md-10">
        {!! Form::text('menu',$color->menu,['class'=>'form-control colorformat']) !!}       
        </div>
        </div>  

        <div class="form-group row">
        <div class="col-md-2">
        {!! Form::label('menufont', 'Menü Yazı Renk', array('class'=>'control-label')) !!}     
        {!! Tooltip::standard('Ana menü için yazı rengi') !!}    
        </div>
        <div class="col-md-10">
        {!! Form::text('menufont',$color->menufont,['class'=>'form-control colorformat']) !!}       
        </div>
        </div>     

        <div class="form-group row">
        <div class="col-md-2">
        {!! Form::label('newsletter', 'Footer E-Bülten', array('class'=>'control-label')) !!}     
        {!! Tooltip::standard('E-Bülten alanı için arka plan rengi') !!}    
        </div>
        <div class="col-md-10">
        {!! Form::text('newsletter',$color->newsletter,['class'=>'form-control colorformat']) !!}       
        </div>
        </div>    

        <div class="form-group row">
        <div class="col-md-2">
        {!! Form::label('footer', 'Footer Renk', array('class'=>'control-label')) !!}     
        {!! Tooltip::standard('Sitenin en altındaki tablo için arka plan rengi') !!}    
        </div>
        <div class="col-md-10">
        {!! Form::text('footer',$color->footer,['class'=>'form-control colorformat']) !!}       
        </div>
        </div>    

        <div class="form-group row">
        <div class="col-md-2">
        {!! Form::label('socialfooter', 'Footer Sosyal Medya', array('class'=>'control-label')) !!}     
        {!! Tooltip::standard('Footerda bulunan sosyal medya + banka barının arka plan rengi') !!}    
        </div>
        <div class="col-md-10">
        {!! Form::text('socialfooter',$color->socialfooter,['class'=>'form-control colorformat']) !!}       
        </div>
        </div>        

        <div class="form-group row">
        <div class="col-md-2">
        {!! Form::label('subfooter', 'Footer Alt Bar Renk', array('class'=>'control-label')) !!}     
        {!! Tooltip::standard('Alttaki bar için arka plan rengi') !!}    
        </div>
        <div class="col-md-10">
        {!! Form::text('subfooter',$color->subfooter,['class'=>'form-control colorformat']) !!}       
        </div>
        </div>

        <div class="form-group row">
        <div class="col-md-2">
        {!! Form::label('footerfont', 'Footer Yazı Renk', array('class'=>'control-label')) !!}     
        {!! Tooltip::standard('Footer için yazı rengi') !!}    
        </div>
        <div class="col-md-10">
        {!! Form::text('footerfont',$color->footerfont,['class'=>'form-control colorformat']) !!}       
        </div>
        </div>       

        <div class="form-group row">
        <div class="col-md-2">
        {!! Form::label('productborder', 'Ürün Çerçeve Renk', array('class'=>'control-label')) !!}     
        {!! Tooltip::standard('Renk seçilirse ürüne çerçeve ekler. BOŞ bırakılırsa çerçeve eklemez.') !!}    
        </div>
        <div class="col-md-10">
        {!! Form::text('productborder',$color->productborder,['class'=>'form-control colorformat']) !!}       
        </div>
        </div>               

        <div class="form-group">
          <div class="col-md-offset-2 col-md-10">Lütfen değişiklikten sonra, "TARAYICI GEÇMİŞİNİ" silerek siteyi kontrol ediniz.</div>
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