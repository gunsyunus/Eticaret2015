@extends('panel.template')

@section('content')

@include('panel.module.design.menu',array('page'=>'Ürün Reklam Banner'))

@section('meta')
{{ HTML::style('panelv3/css/editor.min.css') }}
@stop

@section('body')
{{ HTML::script('panelv3/js/jquery.editor.min.js') }}
{{ HTML::script('panelv3/js/jquery.editor.tr.min.js') }}
@stop

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title panel-modul">ÜRÜN SAĞ REKLAM ALANI</h3>
  </div>
  <div class="panel-body">
    <div class="row">
    <div class="col-md-12">
        
        {!! Form::open(['url'=>'Pv3/design/productsave/','role'=>'form','class'=>'form-horizontal']) !!}

        <div class="form-group">
        {!! Form::label('product_advert_title', 'Kutu Başlığı', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('product_advert_title',$designs->product_advert_title,['class'=>'form-control']) !!}       
        </div>
        </div>        

        <div class="form-group">
        {!! Form::label('product_advert_content', 'Kutu İçeriği', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">        
        {!! Form::textarea('product_advert_content',$designs->product_advert_content,['class'=>'editor']) !!}
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