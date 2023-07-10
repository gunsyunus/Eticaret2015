@extends('panel.template')

@section('content')

@include('panel.module.setting.menu',array('page'=>'Tanımlamalar'))

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
            <h5>Üyelik Ekleme</h5>
        </div>
        {!! Form::open(['url'=>'Pv3/setting/generalsave/','role'=>'form','class'=>'form-horizontal']) !!}
    <div class="card-body">
            <ul class="nav nav-tabs tab-coupon" id="myTab" role="tablist">
            <li class="nav-item"><a class="nav-link active show" id="general-tab" data-toggle="tab" href="#seo" role="tab" aria-controls="general" aria-selected="true" data-original-title="" title="">SEO</a></li>
            <li class="nav-item"><a class="nav-link" id="seo-tabs" data-toggle="tab" href="#social" role="tab" aria-controls="seo" aria-selected="false" data-original-title="" title="">Sosyal Medya</a></li>
            <li class="nav-item"><a class="nav-link" id="" data-toggle="tab" href="#copyright" role="tab" aria-controls="seo" aria-selected="false" data-original-title="" title="">Telif Hakkı</a></li>
            <li class="nav-item"><a class="nav-link" id="" data-toggle="tab" href="#text" role="tab" aria-controls="seo" aria-selected="false" data-original-title="" title="">Slogan</a></li>
            <li class="nav-item"><a class="nav-link" id="" data-toggle="tab" href="#code" role="tab" aria-controls="seo" aria-selected="false" data-original-title="" title="">Takip Kodları</a></li>
            <li class="nav-item"><a class="nav-link" id="" data-toggle="tab" href="#agreement" role="tab" aria-controls="seo" aria-selected="false" data-original-title="" title="">Sözleşmeler</a></li>
            <li class="nav-item"><a class="nav-link" id="" data-toggle="tab" href="#email" role="tab" aria-controls="seo" aria-selected="false" data-original-title="" title="">E-Posta Ayarları</a></li>
            <li class="nav-item"><a class="nav-link" id="" data-toggle="tab" href="#config" role="tab" aria-controls="seo" aria-selected="false" data-original-title="" title="">Ayarlar</a></li>

            </ul>
            <div class="tab-content" id="myTabContent">
    <br />

    <div class="tab-content">

        <div role="tabpanel" class="tab-pane active" id="seo">

        <!-- 1 -->

        <div class="form-group row">
        <div class="col-md-2">     
        {!! Form::label('title', 'Site Başlık', array('class'=>'control-label')) !!}     
        {!! Tooltip::standard('Minimum 3 ve maksimum 70 karakter olmalıdır.') !!}    
        </div>
        <div class="col-md-10">
        {!! Form::text('title',$settings->title,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group row">
        <div class="col-md-2">      
        {!! Form::label('keyword', 'Anahtar Kelimeler', array('class'=>'control-label')) !!}     
        {!! Tooltip::standard('Maksimum 260 karakter olmalıdır.') !!}    
        </div>
        <div class="col-md-10">
        {!! Form::text('keyword',$settings->keyword,['class'=>'form-control']) !!}       
        </div>
        </div>        

        <div class="form-group row">
        <div class="col-md-2">     
        {!! Form::label('description', 'Description (Açıklama)', array('class'=>'control-label')) !!}     
        {!! Tooltip::standard('Maksimum 160 karakter olmalıdır.') !!}    
        </div>
        <div class="col-md-10">
        {!! Form::text('description',$settings->description,['class'=>'form-control']) !!}       
        </div>
        </div>     

        <!-- 1 -->                

        </div>
        <div role="tabpanel" class="tab-pane" id="social">
            
        <!-- 2 -->

        <div class="form-group row">
        {!! Form::label('social_facebook_url', 'Facebook Linki', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('social_facebook_url',$settings->social_facebook_url,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('social_twitter_url', 'Twitter Linki', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('social_twitter_url',$settings->social_twitter_url,['class'=>'form-control']) !!}       
        </div>
        </div>        

        <div class="form-group row">
        {!! Form::label('social_instagram_url', 'Instagram Linki', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('social_instagram_url',$settings->social_instagram_url,['class'=>'form-control']) !!}       
        </div>
        </div>     

        <div class="form-group row">
        {!! Form::label('social_pinterest_url', 'Pinterest Linki', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('social_pinterest_url',$settings->social_pinterest_url,['class'=>'form-control']) !!}       
        </div>
        </div>     

        <div class="form-group row">
        {!! Form::label('social_google_url', 'Google Linki', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('social_google_url',$settings->social_google_url,['class'=>'form-control']) !!}       
        </div>
        </div>        

        <div class="form-group row">
        {!! Form::label('social_linkedin_url', 'Linkedin Linki', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('social_linkedin_url',$settings->social_linkedin_url,['class'=>'form-control']) !!}       
        </div>
        </div>        

        <div class="form-group row">
        {!! Form::label('social_youtube_url', 'Youtube Linki', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('social_youtube_url',$settings->social_youtube_url,['class'=>'form-control']) !!}       
        </div>
        </div>                 

        <!-- 2 -->      

        </div>
        <div role="tabpanel" class="tab-pane" id="copyright">
            
        <!-- 3 -->

        <div class="form-group row">
        {!! Form::label('copyright', 'Telif Hakkı Metin', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('copyright',$settings->copyright,['class'=>'form-control']) !!}       
        </div>
        </div>

        <!-- 3 -->  

        </div>
        <div role="tabpanel" class="tab-pane" id="text">

        <!-- 4 -->

        <div class="form-group row">
        {!! Form::label('welcome_msg', 'Site Slogan', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('welcome_msg',$settings->welcome_msg,['class'=>'form-control']) !!}       
        </div>
        </div>

        <!-- 4 -->  

        </div>
        <div role="tabpanel" class="tab-pane" id="code">

        <!-- 5 -->

        <div class="form-group row">
        {!! Form::label('tracing_body_after_code', 'HTML <body> Tag Sonrasına Ekle', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::textarea('tracing_body_after_code',$settings->tracing_body_after_code,['class'=>'form-control','rows'=>'4']) !!}
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('tracing_body_before_code', 'HTML </body> Tag Öncesine Ekle', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::textarea('tracing_body_before_code',$settings->tracing_body_before_code,['class'=>'form-control','rows'=>'4']) !!}
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('tracing_head_code', 'HTML </head> Tag Öncesine Ekle', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::textarea('tracing_head_code',$settings->tracing_head_code,['class'=>'form-control','rows'=>'4']) !!}      
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('tracing_customer_code', 'Üyelik Başarılı ise Takip Kodu', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::textarea('tracing_customer_code',$settings->tracing_customer_code,['class'=>'form-control','rows'=>'4']) !!}
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('tracing_order_code', 'Sipariş Başarılı ise Takip Kodu', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::textarea('tracing_order_code',$settings->tracing_order_code,['class'=>'form-control','rows'=>'4']) !!}
        </div>
        </div>                        

        <!-- 5 -->  

        </div>      
        <div role="tabpanel" class="tab-pane" id="agreement">

        <!-- 6 -->

        <div class="form-group row">
        {!! Form::label('agreement_user_url', 'Üyelik Sözleşmesi Link', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('agreement_user_url',$settings->agreement_user_url,['class'=>'form-control']) !!}       
        </div>
        </div>
        
        <div class="form-group row">
        {!! Form::label('agreement_cancel_url', 'İptal ve İade Sözleşmesi Link', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('agreement_cancel_url',$settings->agreement_cancel_url,['class'=>'form-control']) !!}       
        </div>
        </div>  

        <div class="form-group row">
        {!! Form::label('agreement_order_url', 'Mesafeli Satış Sözleşmesi Link', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        <span class="copy-area">{{ URL::to($settings->agreement_order_url) }}</span>
        <span class="btn btn-default copy-url" role="button" data-clipboard-action="copy" 
        data-clipboard-target=".copy-area"><i class="fa fa-clipboard"></i> Kopyala</span>
        </div>
        </div>       
       
        <div class="form-group row">
        {!! Form::label('agreement_order_title', 'Mesafeli Satış Söz. Başlık', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('agreement_order_title',$settings->agreement_order_title,['class'=>'form-control']) !!}       
        </div>
        </div>          

        <div class="form-group row">
        {!! Form::label('agreement_order_content', 'Mesafeli Satış Söz. İçerik', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">        
        {!! Form::textarea('agreement_order_content',$settings->agreement_order_content,['class'=>'editor']) !!}        
        Kullanılabilir Parametreler : [[ad]] [[soyad]] [[eposta]] [[telefon]] [[teslimatadres]] [[faturaadres]]
        <br />
        </div>
        </div>
        
        <!-- 6 -->  

        </div>      
        <div role="tabpanel" class="tab-pane" id="email">

        <!-- 7 -->

        <div class="form-group row">
        <div class="col-md-2">     
        {!! Form::label('email_admin', 'Yönetici E-Posta', array('class'=>'control-label')) !!}     
        {!! Tooltip::standard('Sipariş verildiğinde, sistemde bir hata olduğunda YÖNETİCİYE mail gönderilir.') !!}    
        </div>
        <div class="col-md-10">
        {!! Form::text('email_admin',$settings->email_admin,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('email_admin_name', 'Yönetici Mail Görünür Adı', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('email_admin_name',$settings->email_admin_name,['class'=>'form-control']) !!}       
        </div>
        </div>        

        <div class="form-group row">
        <div class="col-md-2">     
        {!! Form::label('email_info', 'Müşteri Hizmetleri E-Posta', array('class'=>'control-label')) !!}     
        {!! Tooltip::standard('Kullanıcılara kargo, yeni üyelik vb. durumlarda bu mail üzerinden gönderilir.') !!}    
        </div>
        <div class="col-md-10">
        {!! Form::text('email_info',$settings->email_info,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('email_info_name', 'Müşteri Hizmetleri Mail Görünür Adı', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('email_info_name',$settings->email_info_name,['class'=>'form-control']) !!}       
        </div>
        </div>          

        <!-- 7 -->  

        </div>
        <div role="tabpanel" class="tab-pane" id="config">

        <!-- 8 -->

        <div class="form-group row">
        <div class="col-md-2">     
        {!! Form::label('ssl_status', 'SSL (https) Bağlantısı', array('class'=>'control-label')) !!}     
        {!! Tooltip::standard('Ödeme sayfasında güvenliği sağlar. Sertifika kurulu ise aktif edilmelidir.') !!}    
        </div>
        <div class="col-md-10">
        {!! Form::checkbox('ssl_status', '1', $settings->ssl_status, array('class'=>'checkboxes')); !!}
        </div>
        </div>     

        <div class="form-group row">
        {!! Form::label('sef_url', 'Kargo Takip Linki', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        <span class="copy-area">{{ URL::to('kargo-takip') }}</span>
        <span class="btn btn-default copy-url" role="button" data-clipboard-action="copy" 
        data-clipboard-target=".copy-area"><i class="fa fa-clipboard"></i> Kopyala</span>        
        </div>
        </div>        

        <div class="form-group row">
        <div class="col-md-2">     
        {!! Form::label('product_small_width', 'Ürün Resim Boyut (Önizleme)', array('class'=>'control-label')) !!}     
        {!! Tooltip::standard('Önerilen minimum 265px ve maksimum 400px olabilir.') !!}    
        </div>
        <div class="col-md-5">
        {!! Form::text('product_small_width',$settings->product_small_width,['class'=>'form-control']) !!}       
        </div>
        <div class="col-md-5">
        {!! Form::text('product_small_height',$settings->product_small_height,['class'=>'form-control']) !!}       
        </div>        
        </div>            

        <div class="form-group row">
        <div class="col-md-2">     
        {!! Form::label('product_big_width', 'Ürün Resim Boyut (Büyük)', array('class'=>'control-label')) !!}     
        {!! Tooltip::standard('Önerilen minimum 450px ve maksimum 1250px olabilir.') !!}    
        </div>
        <div class="col-md-5">
        {!! Form::text('product_big_width',$settings->product_big_width,['class'=>'form-control']) !!}       
        </div>
        <div class="col-md-5">
        {!! Form::text('product_big_height',$settings->product_big_height,['class'=>'form-control']) !!}       
        </div>        
        </div>

        <div class="form-group row">
        {!! Form::label('bank_transfer_url', 'Banka/Ptt Bilgileri Link', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('bank_transfer_url',$settings->bank_transfer_url,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group row">
        <div class="col-md-2">     
        {!! Form::label('facebook_connect_status', 'Facebook ile Bağlan', array('class'=>'control-label')) !!}     
        {!! Tooltip::standard('Güvenlik anahtarı, uygulama izinleri ve detaylar için teknik destek alınız.') !!}    
        </div>
        <div class="col-md-10">
        {!! Form::checkbox('facebook_connect_status', '1', $settings->facebook_connect_status, array('class'=>'checkboxes')); !!}
        </div>
        </div>                    

        <!-- 8 -->  

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