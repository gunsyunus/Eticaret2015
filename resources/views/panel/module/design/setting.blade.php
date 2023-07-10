@extends('panel.template')

@section('content')

@include('panel.module.design.menu',array('page'=>'Tasarım Ayarları'))

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title panel-modul">TASARIM AYARLARI</h3>
  </div>
  <div class="panel-body">
    <div class="row">
    <div class="col-md-12">
        
        {!! Form::open(['url'=>'Pv3/design/settingsave/','role'=>'form','class'=>'form-horizontal','files'=>'true']) !!}

        <div class="form-group">        
        <div class="col-md-2 text-right">     
        {!! Form::label('banner_width', 'Banner Uzunluk', array('class'=>'control-label')); !!}           
        {!! Tooltip::standard('Standart 1920 kalmalıdır. Özel tasarımlar hariç.') !!} 
        </div>
        <div class="col-md-10">     
        {!! Form::text('banner_width',$designs->banner_width,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group">
        <div class="col-md-2 text-right">     
        {!! Form::label('banner_height', 'Banner Yükseklik', array('class'=>'control-label')); !!}
        {!! Tooltip::standard('Maksimum 600 olmalıdır. Önerilen aralık : 410 - 500') !!} 
        </div>
        <div class="col-md-10">
        {!! Form::text('banner_height',$designs->banner_height,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group">
        <div class="col-md-2 text-right">     
        {!! Form::label('banner_scene_width', 'Banner Sahne Uzunluk', array('class'=>'control-label')); !!}
        </div>
        <div class="col-md-10">
        {!! Form::text('banner_scene_width',$designs->banner_scene_width,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group">
        {!! Form::label('banner_effect_type', 'Banner Geçiş Efekt', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::select('banner_effect_type', array('basic'=>'Standart (Soldan Sağa)',
                                                     'fade'=>'Saydam',
                                                     'mask'=>'Maskeli',
                                                     'scale'=>'Saydam (Kalıcı Resimler)'
                                                    ),
                                                    $designs->banner_effect_type,['class'=>'form-control']) !!}
        </div>
        </div>

        <div class="form-group">
        {!! Form::label('banner_buttons', 'Banner Buton', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::select('banner_buttons', array('default'=>'Beyaz - Klasik',
                                                 'light-2'=>'Beyaz - Kutu (Efekt)',
                                                 'light-3'=>'Beyaz - Yuvarlak',
                                                 'light-6'=>'Beyaz - Kare (Çizgili)',
                                                 'black-2'=>'Siyah - Kare'
                                                 ),
                                                 $designs->banner_buttons,['class'=>'form-control']) !!}
        </div>
        </div>


        <div class="form-group">        
        <div class="col-md-2 text-right">     
        {!! Form::label('banner_arrows', 'Banner Buton Görünürlüğü', array('class'=>'control-label')); !!}           
        {!! Tooltip::standard('Pasif ise hep görünür, aktif de ise fare ile üzerine gelince gözükür.') !!} 
        </div>
        <div class="col-md-10">     
        {!! Form::checkbox('banner_arrows', '1', $designs->banner_arrows, array('class'=>'checkboxes')); !!}
        </div>
        </div>

        <div class="form-group">
        {!! Form::label('banner_timebar', 'Banner Yükleniyor Çizgisi', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-10">
        {!! Form::checkbox('banner_timebar', '1', $designs->banner_timebar, array('class'=>'checkboxes')); !!}
        </div>
        </div>

        <div class="form-group">        
        <div class="col-md-2 text-right">     
        {!! Form::label('multiple_product_image', 'Ürün Listeleme (Çoklu Resim)', array('class'=>'control-label')); !!}           
        {!! Tooltip::standard('Ürünün üzerine gelince ikinci resim gözükür.') !!} 
        </div>
        <div class="col-md-10">     
        {!! Form::checkbox('multiple_product_image', '1', $designs->multiple_product_image, array('class'=>'checkboxes')); !!}
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