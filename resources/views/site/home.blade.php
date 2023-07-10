@extends('site.template')

@section('title', ''.$settings->title.'')
@section('keyword', ''.$settings->keyword.'')
@section('description', ''.$settings->description.'')

@section('meta')
<link rel="stylesheet" type="text/css" href="{{ URL::to('assets/css/slider/style/masterslider.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ URL::to('assets/css/slider/skins/'.$designs->banner_buttons.'/style.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ URL::to('assets/css/slider-banner.css') }}" />
@stop

@section('body')
<script type="text/javascript" src="{{ URL::to('assets/js/jquery.easing.min.js') }}"></script> 
<script type="text/javascript" src="{{ URL::to('assets/js/masterslider.min.js') }}"></script> 
<script type="text/javascript">   
  var slider = new MasterSlider();
  slider.control('arrows', {autohide:@if ($designs->banner_arrows=='1') true @else false @endif});
  @if ($designs->banner_timebar=='1')  slider.control('timebar', {insertTo:'#masterslider'}); @endif
  slider.control('bullets', {autohide:@if ($designs->banner_arrows=='1') true @else false @endif});
  slider.setup('masterslider' , {
  width:{{ $designs->banner_scene_width }}, height:{{ $designs->banner_height }}, space:0,
  layout:'fullwidth', loop:true, preload:0,
  view:"{{ $designs->banner_effect_type }}",
  instantStartLayers:true,
  autoplay:true });
</script>
@stop

@section('content')

<!-- Slider -->
<div class="master-slider ms-skin-{{ $designs->banner_buttons }}" id="masterslider">
    @foreach($bannerSlider as $banner)    
        <div class="ms-slide slide-1" data-delay="{{ $banner->delay }}">        
        <img src="/assets/css/slider/style/blank.gif" data-src="{{ $banner->image }}" alt="{{ $banner->title }}" border="0" /> 
        @if ($banner->url!='#') <a href="{{ $banner->url }}"> @endif
        {!! $banner->elements !!}
        @if ($banner->url!='#') </a> @endif
        </div>
    @endforeach
</div>
<!-- Slider -->

<!-- Text -->
<div class="service-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-3 col-xs-12">
        <div class="services first">
          <h6>{{ $designs->home_text_1 }}</h6>
          <span>{{ $designs->home_text_2 }}</span> </div>
      </div>
      <div class="col-lg-3 col-md-3 hidden-xs">
        <div class="services">
          <h6>{{ $designs->home_text_3 }}</h6>
          <span>{{ $designs->home_text_4 }}</span> </div>
      </div>
      <div class="col-lg-3 col-md-3 hidden-xs">
        <div class="services">
          <h6>{{ $designs->home_text_5 }}</h6>
          <span>{{ $designs->home_text_6 }}</span> </div>
      </div>
      <div class="col-lg-3 col-md-3 hidden-xs">
        <div class="services last">
          <h6>{{ $designs->home_text_7 }}</h6>
          <span>{{ $designs->home_text_8 }}</span> </div>
      </div>
    </div>
  </div>
</div>
<!-- Text -->

<!-- Sub Banner -->
@if ($designs->home_section_1 == 1)
<div class="offer-banner-section">
  <div class="container">
    <div class="row">
      @foreach($bannerBox as $banner)
      <div class="col-lg-3 col-sm-3 col-xs-6">
        <div class="col"><a href="{{ $banner->url }}"><img src="{{ $banner->image }}" alt="{{ $banner->title }}"></a></div>
      </div>
      @endforeach    
    </div>
  </div>
</div>
@endif
<!-- End Sub Banner -->

<!-- Tab Container -->
@if ($designs->home_section_2 == 1)
<div class="main-col">
  <div class="container">
    <div class="row">
      <div class="product-grid-view">
        <div class="col-md-12">
          <div class="std">
            <div class="home-tabs">
              <div class="producttabs">
                <div id="magik_producttabs1" class="magik-producttabs"> 
                  <div class="magik-pdt-container"> 
                    <!-- Tab Nav -->
                    <div class="magik-pdt-nav">
                      <ul class="pdt-nav">
                        <li class="item-nav tab-loaded tab-nav-actived" data-type="order" data-catid="" data-orderby="best_sales" data-href="pdt_best_sales"> <span class="title-navi">{{ $designs->home_tab_text_1 }}</span> </li>
                        <li class="item-nav" data-type="order" data-catid="" data-orderby="new_arrivals" data-href="pdt_new_arrivals"> <span class="title-navi">{{ $designs->home_tab_text_2 }}</span> </li>
                      </ul>
                    </div>
                    <!-- End Tab Nav --> 
                    <!--Begin Tab Content -->
                    <div class="magik-pdt-content wide-4">
                      <div class="pdt-content is-loaded pdt_best_sales tab-content-actived">
                        <ul class="pdt-list products-grid zoomOut play">
              @foreach($tabLeftUpProducts as $product)
              <li class="item item-animate wide-tab">
                <div class="item-inner">
                  <div class="product-wrapper">
                    <div class="thumb-wrapper">                    
                      @if (!empty($product->promotion_text)) <div class="new-label new-top-left">{{ $product->promotion_text }}</div> @endif
                      @if ($product->stock <= 0)<div class="sale-label sale-top-right">TÜKENDİ</div> @endif
                    <div class="thumb-wrapper"><a href="{{ Sef::product($product->sef_url,$product->id_product) }}" class="thumb @if($designs->multiple_product_image == 1) flip @endif"><span class="face"><img src="{{ URL::to($product->image_small_1) }}" alt="{{ $product->name }}" width="250"></span>@if ($designs->multiple_product_image == 1)<span class="face back"><img  src="{{ URL::to($product->image_small_2) }}" alt="{{ $product->name }}" width="250"><span class="quick-view"><span>{{ $product->name }}</span></span></span>@endif</a></div>
                    <div class="actions"><span class="add-to-links"><a href="{{ Sef::product($product->sef_url,$product->id_product) }}" class="link-compare"><span></span></a></span></div>
                  </div>
                  <div class="item-info">
                    <div class="info-inner">
                      <div class="item-title"><a href="{{ Sef::product($product->sef_url,$product->id_product) }}" title="">{{ $product->name }}</a></div>
                      <div class="item-content">
                        <div class="item-price">
                          <div class="price-box">
                            @if ($product->price_old > 0) <p class="old-price"><span class="price">{{ Price::format($product->price_old) }} TL</span></p> @endif
                            <span class="regular-price"><span class="price">{{ Price::product($product->price,$product->tax,$product->rate_id,$product->ratePrice,'F') }} TL</span></span></div>
                        </div>
                      </div>
                    </div>
                    <div class="actions">
                      <a href="{{ Sef::product($product->sef_url,$product->id_product) }}"><button class="button btn-cart" type="button"><span>Sepete Ekle</span></button></a>
                    </div>
                  </div>
                </div>
              </li>
              @endforeach                         
                        </ul>
                      </div>
                      <div class="pdt-content pdt_new_arrivals is-loaded">
                        <ul class="pdt-list products-grid zoomOut play">
              @foreach($tabRightUpProducts as $product)
              <li class="item item-animate wide-tab">
                <div class="item-inner">
                  <div class="product-wrapper">
                    <div class="thumb-wrapper">                    
                      @if (!empty($product->promotion_text)) <div class="new-label new-top-left">{{ $product->promotion_text }}</div> @endif
                      @if ($product->stock <= 0)<div class="sale-label sale-top-right">TÜKENDİ</div> @endif
                    <div class="thumb-wrapper"><a href="{{ Sef::product($product->sef_url,$product->id_product) }}" class="thumb @if($designs->multiple_product_image == 1) flip @endif"><span class="face"><img src="{{ URL::to($product->image_small_1) }}" alt="{{ $product->name }}" width="250"></span>@if ($designs->multiple_product_image == 1)<span class="face back"><img  src="{{ URL::to($product->image_small_2) }}" alt="{{ $product->name }}" width="250"><span class="quick-view"><span>{{ $product->name }}</span></span></span>@endif</a></div>
                    <div class="actions"><span class="add-to-links"><a href="{{ Sef::product($product->sef_url,$product->id_product) }}" class="link-compare"><span></span></a></span></div>
                  </div>
                  <div class="item-info">
                    <div class="info-inner">
                      <div class="item-title"><a href="{{ Sef::product($product->sef_url,$product->id_product) }}" title="">{{ $product->name }}</a></div>
                      <div class="item-content">
                        <div class="item-price">
                          <div class="price-box">
                            @if ($product->price_old > 0) <p class="old-price"><span class="price">{{ Price::format($product->price_old) }} TL</span></p> @endif
                            <span class="regular-price"><span class="price">{{ Price::product($product->price,$product->tax,$product->rate_id,$product->ratePrice,'F') }} TL</span></span></div>
                        </div>
                      </div>
                    </div>
                    <div class="actions">
                      <a href="{{ Sef::product($product->sef_url,$product->id_product) }}"><button class="button btn-cart" type="button"><span>Sepete Ekle</span></button></a>
                    </div>
                  </div>
                </div>
              </li>
              @endforeach                         
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Tab Container -->
@endif

<!-- Middle slider -->
@if ($designs->home_section_3 == 1)
<section class="small-product-slider">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="bag-product-slider small-pr-slider">
          <div class="slider-items-products">
            <div class="new_title center">
              <h2>{{ $designs->home_tab_text_3 }}</h2>
            </div>
            <div id="bag-seller-slider" class="product-flexslider hidden-buttons">
              <div class="slider-items slider-width-col3">                
              @foreach($tabLeftDownProducts as $product)
                <div class="item">
                  <div class="col-item">
                    @if (!empty($product->promotion_text)) <div class="new-label new-top-left">{{ $product->promotion_text }}</div> @endif
                    @if ($product->stock <= 0)<div class="sale-label sale-top-right">TÜKENDİ</div> @endif
                    <div class="item-inner">
                      <div class="product-wrapper">
                        <div class="thumb-wrapper"><a href="{{ Sef::product($product->sef_url,$product->id_product) }}" class="thumb @if($designs->multiple_product_image == 1) flip @endif"><span class="face"><img src="{{ URL::to($product->image_small_1) }}" alt="{{ $product->name }}" width="268"></span>@if ($designs->multiple_product_image == 1)<span class="face back"><img src="{{ URL::to($product->image_small_2) }}" width="268" alt="{{ $product->name }}"><span class="quick-view"><span>{{ $product->name }}</span></span></span>@endif</a></div>
                        <div class="actions"><span class="add-to-links"><a href="{{ Sef::product($product->sef_url,$product->id_product) }}" class="link-compare"><span></span></a></span></div>
                      </div>
                      <div class="item-info">
                        <div class="info-inner">
                        <div class="item-title"><a href="{{ Sef::product($product->sef_url,$product->id_product) }}" title="">{{ $product->name }}</a></div>
                          <div class="item-content">
                            <div class="item-price">
                              <div class="price-box"> <span class="regular-price"><span class="price">{{ Price::product($product->price,$product->tax,$product->rate_id,$product->ratePrice,'F') }} TL</span></span></div>
                            </div>
                          </div>
                        </div>
                        <div class="actions">
                          <a href="{{ Sef::product($product->sef_url,$product->id_product) }}"><button class="button btn-cart" type="button"><span>Sepete Ekle</span></button></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach                
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="shoes-product-slider small-pr-slider">
          <div class="slider-items-products">
            <div class="new_title center">
              <h2>{{ $designs->home_tab_text_4 }}</h2>
            </div>
            <div id="bag-seller-slider1" class="product-flexslider hidden-buttons">
              <div class="slider-items slider-width-col3">                
              @foreach($tabRightDownProducts as $product)
                <div class="item">
                  <div class="col-item">
                    @if (!empty($product->promotion_text)) <div class="new-label new-top-left">{{ $product->promotion_text }}</div> @endif
                    @if ($product->stock <= 0)<div class="sale-label sale-top-right">TÜKENDİ</div> @endif
                    <div class="item-inner">
                      <div class="product-wrapper">
                        <div class="thumb-wrapper"><a href="{{ Sef::product($product->sef_url,$product->id_product) }}" class="thumb @if($designs->multiple_product_image == 1) flip @endif"><span class="face"><img src="{{ URL::to($product->image_small_1) }}" alt="{{ $product->name }}" width="268">@if($designs->multiple_product_image == 1)</span><span class="face back"><img src="{{ URL::to($product->image_small_2) }}" width="268" alt="{{ $product->name }}"><span class="quick-view"><span>{{ $product->name }}</span></span></span>@endif</a></div>
                        <div class="actions"><span class="add-to-links"><a href="{{ Sef::product($product->sef_url,$product->id_product) }}" class="link-compare"><span></span></a></span></div>
                      </div>
                      <div class="item-info">
                        <div class="info-inner">
                        <div class="item-title"><a href="{{ Sef::product($product->sef_url,$product->id_product) }}" title="">{{ $product->name }}</a></div>
                          <div class="item-content">
                            <div class="item-price">
                              <div class="price-box"> <span class="regular-price"><span class="price">{{ Price::product($product->price,$product->tax,$product->rate_id,$product->ratePrice,'F') }} TL</span></span></div>
                            </div>
                          </div>
                        </div>
                        <div class="actions">
                          <a href="{{ Sef::product($product->sef_url,$product->id_product) }}"><button class="button btn-cart" type="button"><span>Sepete Ekle</span></button></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach              
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endif
<!-- End middle slider --> 

<!-- Promo Banner --> 
@if ($designs->home_section_7 == 1)
<div class="promo-banner-section">
  <div class="container">
    <div class="row">
      <div class="col"><a href="{{ $designs->advert_link }}"><img src="{{ $designs->advert_image }}" alt=""></a></div>
    </div>
  </div>
</div>
@endif
<!-- End Promo Banner --> 

<!-- Slider -->
@if ($designs->home_section_4 == 1)
<section class="best-seller-pro">
  <div class="container">
    <div class="slider-items-products">
      <div class="new_title center">
        <h2>{{ $designs->home_tab_text_5 }}</h2>
      </div>
      <div id="best-seller-slider" class="product-flexslider hidden-buttons">
        <div class="slider-items slider-width-col6">          
          @foreach($bandProducts as $product)
          <div class="item">
            <div class="col-item">
                @if (!empty($product->promotion_text)) <div class="new-label new-top-left">{{ $product->promotion_text }}</div> @endif
                @if ($product->stock <= 0)<div class="sale-label sale-top-right">TÜKENDİ</div> @endif
              <div class="item-inner">
                <div class="product-wrapper">
                  <div class="thumb-wrapper"><a href="{{ Sef::product($product->sef_url,$product->id_product) }}" class="thumb @if($designs->multiple_product_image == 1) flip @endif"><span class="face"><img src="{{ URL::to($product->image_small_1) }}" alt="{{ $product->name }}" width="268"></span>@if($designs->multiple_product_image == 1)<span class="face back"><img src="{{ URL::to($product->image_small_2) }}" width="268" alt="{{ $product->name }}"><span class="quick-view"><span>{{ $product->name }}</span></span></span>@endif</a></div>
                    <div class="actions"><span class="add-to-links"><a href="{{ Sef::product($product->sef_url,$product->id_product) }}" class="link-compare"><span></span></a></span></div>
                </div>
                <div class="item-info">
                  <div class="info-inner">
                      <div class="item-title"><a href="{{ Sef::product($product->sef_url,$product->id_product) }}" title="">{{ $product->name }}</a></div>
                    <div class="item-content">
                      <div class="item-price">
                        <div class="price-box"><span class="regular-price"> <span class="price">{{ Price::product($product->price,$product->tax,$product->rate_id,$product->ratePrice,'F') }} TL</span> </span> </div>
                      </div>
                    </div>
                  </div>
                  <div class="actions">
                      <a href="{{ Sef::product($product->sef_url,$product->id_product) }}"><button class="button btn-cart" type="button"><span>Sepete Ekle</span></button></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach        
        </div>
      </div>
    </div>
  </div>
</section>
@endif
<!-- End Slider -->

<!-- Banner Box -->
@if ($designs->home_section_5 == 1)
<section class="latest-blog">
  <div class="container">
    <div class="row">
      <div class="blog-title">
        <h2><span>{{ $designs->home_tab_text_6 }}</span></h2>
      </div>
      @foreach($bannerSub as $banner)
      <div class="col-xs-12 col-sm-3">
        <div class="blog_inner">
          <div class="blog-img"><img src="{{ $banner->image }}">
            <div class="mask"> <a class="info" href="{{ $banner->url }}">{{ $banner->text }}</a> </div>
          </div>
          <h2><a href="{{ $banner->url }}">{{ $banner->title }}</a> </h2>
        </div>
      </div>
      @endforeach       
    </div>
  </div>
</section>
@endif
<!-- End Banner Box -->

<!-- Feature Box -->
<div class="our-features-box">
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-xs-12 col-sm-4">
        <div class="feature-box">
          <div class="content">{{ $designs->home_text_9 }}<span>{{ $designs->home_text_10 }}</span> </div>
        </div>
      </div>
      <div class="col-md-4 col-xs-12 col-sm-4">
        <div class="feature-box">
          <div class="content">{{ $designs->home_text_11 }}<span>{{ $designs->home_text_12 }}</span> </div>
        </div>
      </div>
      <div class="col-md-4 col-xs-12 col-sm-4">
        <div class="feature-box">
          <div class="content">{{ $designs->home_text_13 }}<span>{{ $designs->home_text_14 }}</span> </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Feature Box --> 

<!-- Brand Box -->
@if ($designs->home_section_6 == 1)
<div class="brand-logo">
    <div class="container">
      <div class="slider-items-products">
        <div id="brand-logo-slider" class="product-flexslider hidden-buttons">
          <div class="slider-items slider-width-col6">    
          @foreach($bannerBrand as $banner)
            <div class="item"> <a href="{{ $banner->url }}"><img src="{{ $banner->image }}" alt="{{ $banner->title }}"></a> </div>
          @endforeach            
          </div>
        </div>
      </div>
    </div>
</div>
@endif
<!-- End Brand Box --> 

@stop