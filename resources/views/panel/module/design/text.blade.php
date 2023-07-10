@extends('panel.template')

@section('content')

@include('panel.module.design.menu',array('page'=>'Metinler'))

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title panel-modul">METİNLER</h3>
  </div>
  <div class="panel-body">
    <div class="row">
    <div class="col-md-12">

    {!! Form::open(['url'=>'Pv3/design/textsave/','role'=>'form','class'=>'form-horizontal']) !!}

    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#header" aria-controls="header" role="tab" data-toggle="tab">Anasayfa Banner Altı</a></li>
        <li role="presentation"><a href="#footer" aria-controls="footer" role="tab" data-toggle="tab">Anasayfa Footer Üstü</a></li>
        <li role="presentation"><a href="#hometab" aria-controls="hometab" role="tab" data-toggle="tab">Anasayfa Tab</a></li>
        <li role="presentation"><a href="#other" aria-controls="other" role="tab" data-toggle="tab">Bülten</a></li>       
        <li role="presentation"><a href="#product" aria-controls="product" role="tab" data-toggle="tab">Ürünler</a></li>
    </ul>

    <br />

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="header">

        <!-- 1 -->

        <div class="form-group">
        {!! Form::label('home_text_1', 'Metin Kutusu - 1', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-4">
        {!! Form::text('home_text_1',$designs->home_text_1,['class'=>'form-control']) !!}       
        </div>
        <div class="col-md-6">
        {!! Form::text('home_text_2',$designs->home_text_2,['class'=>'form-control']) !!}       
        </div>        
        </div>

        <div class="form-group">
        {!! Form::label('home_text_3', 'Metin Kutusu - 2', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-4">
        {!! Form::text('home_text_3',$designs->home_text_3,['class'=>'form-control']) !!}       
        </div>
        <div class="col-md-6">
        {!! Form::text('home_text_4',$designs->home_text_4,['class'=>'form-control']) !!}       
        </div>        
        </div>

        <div class="form-group">
        {!! Form::label('home_text_5', 'Metin Kutusu - 3', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-4">
        {!! Form::text('home_text_5',$designs->home_text_5,['class'=>'form-control']) !!}       
        </div>
        <div class="col-md-6">
        {!! Form::text('home_text_6',$designs->home_text_6,['class'=>'form-control']) !!}       
        </div>        
        </div>

        <div class="form-group">
        {!! Form::label('home_text_8', 'Metin Kutusu - 4', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-4">
        {!! Form::text('home_text_7',$designs->home_text_7,['class'=>'form-control']) !!}       
        </div>
        <div class="col-md-6">
        {!! Form::text('home_text_8',$designs->home_text_8,['class'=>'form-control']) !!}       
        </div>        
        </div>                        

        <!-- 1 -->                

        </div>
        <div role="tabpanel" class="tab-pane" id="footer">
            
        <!-- 2 -->

        <div class="form-group">
        {!! Form::label('home_text_9', 'Metin Kutusu - 1', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-4">
        {!! Form::text('home_text_9',$designs->home_text_9,['class'=>'form-control']) !!}       
        </div>
        <div class="col-md-6">
        {!! Form::text('home_text_10',$designs->home_text_10,['class'=>'form-control']) !!}       
        </div>        
        </div>

        <div class="form-group">
        {!! Form::label('home_text_11', 'Metin Kutusu - 2', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-4">
        {!! Form::text('home_text_11',$designs->home_text_11,['class'=>'form-control']) !!}       
        </div>
        <div class="col-md-6">
        {!! Form::text('home_text_12',$designs->home_text_12,['class'=>'form-control']) !!}       
        </div>        
        </div>

        <div class="form-group">
        {!! Form::label('home_text_13', 'Metin Kutusu - 3', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-4">
        {!! Form::text('home_text_13',$designs->home_text_13,['class'=>'form-control']) !!}       
        </div>
        <div class="col-md-6">
        {!! Form::text('home_text_14',$designs->home_text_14,['class'=>'form-control']) !!}       
        </div>        
        </div>             

        <!-- 2 -->      

        </div>
        <div role="tabpanel" class="tab-pane" id="other">
            
        <!-- 3 -->

        <div class="form-group">
        {!! Form::label('newsletter_text', 'E-Bülten Mesajı', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('newsletter_text',$designs->newsletter_text,['class'=>'form-control']) !!}       
        </div>
        </div>

        <!-- 3 -->  

        </div>

        <div role="tabpanel" class="tab-pane" id="product">
            
        <!-- 4 -->    

        <div class="form-group">
        {!! Form::label('product_title_text', 'Ürünler Başlık', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('product_title_text',$designs->product_title_text,['class'=>'form-control']) !!}       
        </div>
        </div>       

        <div class="form-group">
        {!! Form::label('outlet_title_text', 'Fırsatlar Başlık', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('outlet_title_text',$designs->outlet_title_text,['class'=>'form-control']) !!}       
        </div>
        </div>       

        <div class="form-group">
        {!! Form::label('similar_product_title', 'Benzer Ürünler Başlığı', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('similar_product_title',$designs->similar_product_title,['class'=>'form-control']) !!}       
        </div>
        </div>  

        <!-- 4 -->      

        </div>        

        <div role="tabpanel" class="tab-pane" id="hometab">
            
        <!-- 5 -->

        <div class="form-group">
        {!! Form::label('home_tab_text_1', 'Anasayfa Tab', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-4">
        {!! Form::text('home_tab_text_1',$designs->home_tab_text_1,['class'=>'form-control']) !!}       
        </div>
        <div class="col-md-6">
        {!! Form::text('home_tab_text_2',$designs->home_tab_text_2,['class'=>'form-control']) !!}       
        </div>        
        </div>

        <div class="form-group">
        {!! Form::label('home_tab_text_3', 'Anasayfa Alt Tab', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-4">
        {!! Form::text('home_tab_text_3',$designs->home_tab_text_3,['class'=>'form-control']) !!}       
        </div>
        <div class="col-md-6">
        {!! Form::text('home_tab_text_4',$designs->home_tab_text_4,['class'=>'form-control']) !!}       
        </div>        
        </div>        

        <div class="form-group">
        {!! Form::label('home_tab_text_5', 'Anasayfa Geniş Bant Ürünler', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('home_tab_text_5',$designs->home_tab_text_5,['class'=>'form-control']) !!}       
        </div>
        </div>      

        <div class="form-group">
        {!! Form::label('home_tab_text_6', 'Anasayfa Alt Banner', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('home_tab_text_6',$designs->home_tab_text_6,['class'=>'form-control']) !!}       
        </div>
        </div>      

        <!-- 5 -->      

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