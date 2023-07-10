@extends('panel.template')

@section('content')

@include('panel.module.banner.menu')

@section('meta')
{{ HTML::style('panelv3/css/colorpicker.min.css') }}
@stop

@section('body')
<script type="text/javascript"> jQuery(document).ready(function() { jQuery(".colorformat").colorpicker(); }); </script>
{{ HTML::script('panelv3/js/jquery.colorpicker.min.js') }}
@stop
<div class="page-body">

<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="card tab2-card">
        <div class="card-header">
            <h5>BANNER DÜZENLE</h5>
        </div>
        {!! Form::open(['url'=>'Pv3/banner/save/'.$banners->id_banner.'','role'=>'form','class'=>'form-horizontal','files'=>'true']) !!}

        <div class="card-body">
        <div class="form-group row">        
        <div class="col-md-2">     
        {!! Form::label('image', 'Resim Seçiniz', array('class'=>'control-label')) !!}     
        {!! Tooltip::standard($designs->banner_width.' x '.$designs->banner_height.' ölçülerinde ve JPG,PNG,GIF olmalıdır.') !!}    
        </div>
        <div class="col-md-10">     
        <img src="{{ URL::to($banners->image) }}" class="banner img-thumbnail img-responsive" />
        {!! Form::file('image'); !!}
        </div>
        </div>        

        <div class="form-group row">        
        {!! Form::label('title', 'Banner Adı', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('title',$banners->title,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group row">        
        {!! Form::label('status', 'Banner Durumu', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::checkbox('status', '1', $banners->status, array('class'=>'checkboxes')); !!}
        </div>
        </div>            

        <div class="form-group row">        
        {!! Form::label('url', 'Banner Linki', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('url',$banners->url,['class'=>'form-control']) !!}       
        </div>
        </div>  

        <div class="form-group row">        
        <div class="col-md-2">     
        {!! Form::label('delay', 'Banner Süresi', array('class'=>'control-label')) !!}
        {!! Tooltip::standard('Banner geçiş süresi (5 saniye, 3 saniye)') !!}
        </div>
        <div class="col-md-10">     
        {!! Form::text('delay',$banners->delay,['class'=>'form-control']) !!}
        </div>
        </div>

        <div class="form-group row">        
        {!! Form::label('sort', 'Sıralama', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('sort',$banners->sort,['class'=>'form-control']) !!}       
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

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title panel-modul">BANNER ELEMENTLERİ {!! Tooltip::standard('Banner üzerine efektli olarak video,resim ve yazı eklenebilir') !!} </h3>
  </div>
  <div class="panel-body">
    <div class="row">
    <div class="col-md-12">
    <table class="table private-table">
      <thead>
        <tr>
          <th>Tip</th>
          <th>Açıklama</th>
          <th>Detaylar</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
          {!! Form::open(['url'=>'Pv3/banner-element/add','role'=>'form','class'=>'form-horizontal','files'=>true]) !!}
          {!! Form::select('type', array('text'=>'Yazı',
                                      'image'=>'Resim',
                                      'video'=>'Video'
                                      ),
                                      'text',['class'=>'form-control']) !!}
          {!! Form::hidden('banner_id', $banners->id_banner ) !!}
          </td>
          <td>{!! Form::text('name',null,['class'=>'form-control']) !!}</td>
          <td>-</td>         
          <td><button type="submit" class="btn btn-success"><i class="fa fa-plus-circle"></i></button> {!! Form::close() !!}</td>
          </td>
        </tr>         
        @foreach($elements as $element)
        <tr>
          <td>
          {!! Form::open(['url'=>'Pv3/banner-element/save/'.$element->id_element.'','role'=>'form','class'=>'form-horizontal','files'=>'true']) !!}
          <input class="form-control" type="text" placeholder="{{ array_search($element->type,$types,true) }}" disabled>          
          </td>
          <td>{!! Form::text('name',$element->name,['class'=>'form-control']) !!}</td>
          <td>

              @if ($element->type=='text') 

            <div class="row">
            <div class="col-md-12">

                <div class="form-horizontal">

                <div class="form-group row">        
                <div class="col-md-4">     
                {!! Form::label('text', 'Metin', array('class'=>'control-label')) !!} 
                {!! Tooltip::standard('Metin bannerın üzerinde gözükür.') !!}    
                </div>
                <div class="col-md-8">
                {!! Form::text('text',$element->text,['class'=>'form-control']) !!}
                </div>
                </div>            

                <div class="form-group row">        
                <div class="col-md-4">     
                {!! Form::label('xleft', 'Sol Boşluk', array('class'=>'control-label')) !!}     
                {!! Tooltip::standard('PX olarak soldan boşluk verir (px) Örnek : 10, 20, 500') !!}
                </div>
                <div class="col-md-8">
                {!! Form::text('xleft',$element->xleft,['class'=>'form-control']) !!}
                </div>
                </div>

                <div class="form-group row">        
                <div class="col-md-4">  
                {!! Form::label('xtop', 'Üst Boşluk', array('class'=>'control-label')) !!}     
                {!! Tooltip::standard('PX olarak üstten boşluk verir (px) Örnek : 10, 20, 500') !!}
                </div>
                <div class="col-md-8">
                {!! Form::text('xtop',$element->xtop,['class'=>'form-control']) !!}
                </div>
                </div>           

                <div class="form-group row">        
                <div class="col-md-4">    
                {!! Form::label('delay', 'Sahne Saniyesi', array('class'=>'control-label')) !!}     
                {!! Tooltip::standard('xxx saniye sonra ekranda göster. 1000 değeri 1 saniyedir') !!}
                </div>
                <div class="col-md-8">
                {!! Form::text('delay',$element->delay,['class'=>'form-control']) !!}
                </div>
                </div>         

                <div class="form-group row">        
                <div class="col-md-4">    
                {!! Form::label('bg_color', 'Arkaplan Renk', array('class'=>'control-label')) !!}     
                {!! Tooltip::standard('Yazıya arkaplan rengi verir. Boş bırakılabilir.') !!}
                </div>
                <div class="col-md-8">
                {!! Form::text('bg_color',$element->bg_color,['class'=>'form-control colorformat']) !!}
                </div>
                </div>             

                <div class="form-group row">        
                <div class="col-md-4">       
                {!! Form::label('text_color', 'Yazı Renk', array('class'=>'control-label')) !!}     
                {!! Tooltip::standard('Yazıya renk verir.') !!}
                </div>
                <div class="col-md-8">
                {!! Form::text('text_color',$element->text_color,['class'=>'form-control colorformat']) !!}
                </div>
                </div>        

                <div class="form-group row">        
                <div class="col-md-4">       
                {!! Form::label('text_size', 'Yazı Boyutu', array('class'=>'control-label')) !!}     
                {!! Tooltip::standard('PX olarak yazı boyutu verilir. Örnek : 10,20,40') !!}
                </div>
                <div class="col-md-8">
                {!! Form::text('text_size',$element->text_size,['class'=>'form-control']) !!}
                </div>
                </div>                  

                <div class="form-group row">        
                <div class="col-md-4">     
                {!! Form::label('effect', 'Efekt Girişi', array('class'=>'control-label')) !!}     
                {!! Tooltip::standard('Sahneye hangi alandan giriş yapsın ?') !!}
                </div>
                <div class="col-md-8">
                {!! Form::select('effect', array('top'=>'Yukarıdan',
                                      'bottom'=>'Aşağıdan',
                                      'left'=>'Soldan',
                                      'right'=>'Sağdan',
                                      ),
                                      $element->effect,['class'=>'form-control']) !!}
                </div>
                </div>                 

                <div class="form-group row">        
                <div class="col-md-4">     
                {!! Form::label('effect_delay', 'Efekt Saniyesi', array('class'=>'control-label')) !!}     
                {!! Tooltip::standard('Efektin geliş saniyesi. Örnek :100,200,3000') !!}
                </div>
                <div class="col-md-8">
                {!! Form::text('effect_delay',$element->effect_delay,['class'=>'form-control']) !!}
                </div>
                </div>         

                </div>                                 

            </div>
            </div>


              @elseif ($element->type=='image') 


            <div class="row">
            <div class="col-md-12">


                <div class="form-horizontal">

                <div class="form-group row">        
                <div class="col-md-4">      
                {!! Form::label('image', 'Resim', array('class'=>'control-label')) !!}     
                {!! Tooltip::standard('Sahne ölçüsüne göre ve JPG,PNG,GIF olmalıdır.') !!}
                </div>
                <div class="col-md-8">
                <img src="{!! empty($element->image) ? URL::to('media/default/no-image.jpg') : URL::to($element->image) !!}" class="banner img-thumbnail img-responsive" />
                <br /><br />{!! Form::file('image') !!}
                </div>
                </div>

        
                <div class="form-group row">        
                <div class="col-md-4">      
                {!! Form::label('xleft', 'Sol Boşluk', array('class'=>'control-label')) !!}     
                {!! Tooltip::standard('PX olarak soldan boşluk verir (px) Örnek : 10, 20, 500') !!}
                </div>
                <div class="col-md-8">
                {!! Form::text('xleft',$element->xleft,['class'=>'form-control']) !!}
                </div>
                </div>

                <div class="form-group row">        
                <div class="col-md-4">    
                {!! Form::label('xtop', 'Üst Boşluk', array('class'=>'control-label')) !!}     
                {!! Tooltip::standard('PX olarak üstten boşluk verir (px) Örnek : 10, 20, 500') !!}
                </div>
                <div class="col-md-8">
                {!! Form::text('xtop',$element->xtop,['class'=>'form-control']) !!}
                </div>
                </div>           

                <div class="form-group row">        
                <div class="col-md-4">      
                {!! Form::label('delay', 'Sahne Saniyesi', array('class'=>'control-label')) !!}     
                {!! Tooltip::standard('xxx saniye sonra ekranda göster. 1000 değeri 1 saniyedir') !!}
                </div>
                <div class="col-md-8">
                {!! Form::text('delay',$element->delay,['class'=>'form-control']) !!}
                </div>
                </div>           
                <div class="form-group row">        
                <div class="col-md-4">     
                {!! Form::label('effect', 'Resim Efekt Girişi', array('class'=>'control-label')) !!}     
                {!! Tooltip::standard('Sahneye hangi alandan giriş yapsın ?') !!}
                </div>
                <div class="col-md-8">
                {!! Form::select('effect', array('top'=>'Yukarıdan',
                                      'bottom'=>'Aşağıdan',
                                      'left'=>'Soldan',
                                      'right'=>'Sağdan',
                                      ),
                                      $element->effect,['class'=>'form-control']) !!}
                </div>
                </div>                 

                <div class="form-group row">        
                <div class="col-md-4">      
                {!! Form::label('effect_delay', 'Resim Efekt Saniyesi', array('class'=>'control-label')) !!}     
                {!! Tooltip::standard('Efektin geliş saniyesi. Örnek :100,200,3000') !!}
                </div>
                <div class="col-md-8">
                {!! Form::text('effect_delay',$element->effect_delay,['class'=>'form-control']) !!}
                </div>
                </div>          

                </div>                                

            </div>
            </div>           


              @elseif ($element->type=='video')


            <div class="row">
            <div class="col-md-12">

            <div class="form-group row">        
                <div class="col-md-4">    
                {!! Form::label('video_url', 'Video Linki', array('class'=>'control-label')) !!}     
                {!! Tooltip::standard('Embed kodu alınmalıdır. Örnek : https://www.youtube.com/embed/xxxxxx') !!}
                </div>
                <div class="col-md-8">
                {!! Form::text('video_url',$element->video_url,['class'=>'form-control']) !!}
                </div>
                </div>

            </div>
            </div>

              @endif           

          </td>
          <td><button type="submit" class="btn btn-success"><i class="fa fa fa-floppy-o"></i></button> {!! Form::close() !!}
          <a href="{!! URL::to('Pv3/banner-element/delete/'.$element->id_element.'') !!}" class="btn btn-danger btn-left"><i class="fa fa-times"></i></a>
          </td>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    </div>
    </div>
  </div>
</div>

@stop