@extends('panel.template')

@section('content')

@include('panel.module.page.menu')

@section('meta')
{{ HTML::style('panelv3/css/editor.min.css') }}
@stop

@section('body')
{{ HTML::script('panelv3/js/jquery.editor.min.js') }}
{{ HTML::script('panelv3/js/jquery.editor.tr.min.js') }}
@stop
<div class="page-body">

<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="card tab2-card">
        <div class="card-header">
            <h5>Sayfa Güncelle</h5>
        </div>
        
        {!! Form::open(['url'=>'Pv3/page/save/'.$pages->id_page.'','role'=>'form','class'=>'form-horizontal','files'=>'true']) !!}
        <div class="card-body">

        <div class="form-group row">
        {!! Form::label('title', 'Sayfa Başlık', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('title',$pages->title,['class'=>'form-control']) !!}       
        </div>
        </div>        

        <div class="form-group row">
        <div class="col-md-2">     
        {!! Form::label('keyword', 'Anahtar Kelimeler', array('class'=>'control-label')) !!}     
        {!! Tooltip::standard('Maksimum 260 karakter olmalıdır.') !!}    
        </div>
        <div class="col-md-10">
        {!! Form::text('keyword',$pages->keyword,['class'=>'form-control']) !!}       
        </div>
        </div>        

        <div class="form-group row">
        <div class="col-md-2">     
        {!! Form::label('description', 'Description (Açıklama)', array('class'=>'control-label')) !!}     
        {!! Tooltip::standard('Maksimum 160 karakter olmalıdır.') !!}    
        </div>
        <div class="col-md-10">
        {!! Form::text('description',$pages->description,['class'=>'form-control']) !!}       
        </div>
        </div>        

        <div class="form-group row">
        {!! Form::label('status', 'Sayfa Durumu', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-10">
        {!! Form::checkbox('status',1, $pages->status, array('class'=>'checkboxes')); !!}
        </div>
        </div>           

        <div class="form-group row">
        {!! Form::label('section_id', 'Bölüm', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::select('section_id',$sections,$pages->section_id,['class'=>'form-control']) !!}
        </div>
        </div>    

        <div class="form-group row">
        {!! Form::label('sort', 'Bölüm Sıralama', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('sort',$pages->sort,['class'=>'form-control']) !!}       
        </div>
        </div>           

        <div class="form-group row">
        {!! Form::label('sef_url', 'Sayfa Linki', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        <span class="copy-area">{!! Sef::page($pages->sef_url) !!}</span>
        <span class="btn btn-default copy-url" role="button" data-clipboard-action="copy" 
        data-clipboard-target=".copy-area"><i class="fa fa-clipboard"></i> Kopyala</span>        
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('content', 'Sayfa İçeriği', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">    
        <div class="card">
        <div class="digital-add needs-validation">
            <div class="form-group mb-0">
                <div class="description-sm">
                    <textarea id="editor1" name="content" cols="10" rows="4">{{$pages->content}} </textarea>
                </div>
            </div>
        </div>
        </div>    
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