@extends('site.template')

@section('title', ''.$product->name.' '.$product->title.'')
@section('keyword', ''.$product->name.','.$product->keyword.'')
@section('description', ''.$product->name.' - '.$product->description.'')

@section('meta')
<link rel="stylesheet" type="text/css" href="{{ URL::to('assets/css/jquery.fancybox.css') }}" />
@stop
 
@section('body')
<script type="text/javascript" src="{{ URL::to('assets/js/jquery.fancybox.pack.js') }}"></script>
<script type="text/javascript" src="{{ URL::to('assets/js/jquery.elevatezoom.js') }}"></script>
<script type="text/javascript" src="{{ URL::to('assets/js/product.js') }}"></script>
@stop

@section('content')

<section class="breadcrumbs">
  <div class="container">
    <div class="row">
      <div class="inner">
        <ul>
          <li class="home"> <a href="{{ URL::to('/') }}">Anasayfa</a><span>&mdash;›</span></li>
          <li class=""><a href="{{ URL::to('urunler') }}">{{ $designs->product_title_text }}</a><span>&mdash;&rsaquo;</span></li>
          <li class="category13"><strong>{{ $product->name }}</strong></li>
        </ul>
      </div>
    </div>
  </div>
</section>

<section class="main-container col1-layout">
  <div class="main container">
    <div class="col-main">
      <div class="row">
        <div class="product-view">
          <div class="product-essential">
              <div class="product-img-box col-sm-4 col-xs-12">
                @if (!empty($product->promotion_text)) <div class="new-label new-top-left">{{ $product->promotion_text }}</div> @endif
                @if ($product->stock <= 0)<div class="sale-label sale-top-right">TÜKENDİ</div> @endif
                <div class="product-image" style="top:0px;z-index:700;position:relative;">

                <img id="gallery_product" src="{{ URL::to($product->image_big_1) }}" data-zoom-image="{{ URL::to($product->image_big_1) }}" class="img-responsive" border="0" />

                <div id="gallery_01">
                  <a href="#" data-image="{{ URL::to($product->image_big_1) }}" data-zoom-image="{{ URL::to($product->image_big_1) }}" class="link-gallery">
                  <img id="g{{ $product->id_product }}" src="{{ URL::to($product->image_small_1) }}" class="img-gallery" border="0" />
                  </a>
                  @foreach($galleries as $gallery)    
                  <a href="#" data-image="{{ URL::to($gallery->image_big) }}" data-zoom-image="{{ URL::to($gallery->image_big) }}" class="link-gallery">
                  <img id="g{{ $gallery->id_gallery }}" src="{{ URL::to($gallery->image_small) }}" class="img-gallery" border="0" />
                  </a>
                  @endforeach
                </div>

                </div>       
                <div class="clear"></div>
              </div>
              <div class="product-shop col-sm-5 col-xs-12">
                <div class="product-next-prev">
      
                @if (empty($nextProduct->sef_url))
                <span class="product-next" style="color:#d8d8d8;"></span> 
                @else
                <a class="product-next" href="{{ Sef::product($nextProduct->sef_url,$nextProduct->id_product) }}"><span></span></a> 
                @endif


                @if (empty($prevProduct->sef_url))
                <span class="product-prev" style="color:#d8d8d8;"></span> 
                @else
                <a class="product-prev" href="{{ Sef::product($prevProduct->sef_url,$prevProduct->id_product) }}"><span></span></a> 
                @endif

                </div>
                <div class="product-name">
                  <h1>{{ $product->name }}</h1>
                </div><br>
                @if ($product->stock > 0) <p class="availability in-stock pull-right"><span>Stokta Var</span></p> @endif               
                <div class="price-block">
                  <div class="price-box">
                    <p class="old-price"> <span class="price-label">Fiyat:</span> <span class="price">@if ($product->price_old > 0) {{ Price::format($product->price_old) }} TL @endif</span> </p>
                    <p class="special-price"><span id="product-price-48" class="price">{{ Price::product($product->price,$product->tax,$product->rate_id,$product->ratePrice,'F') }} TL</span> </p>
                  </div>
                </div>
                <div class="short-description">
                  <h2>Ürün Bilgisi</h2>
                  <p>{{ $product->short_content }} </p>
                </div>

                @if(Session::has('CONFIRM_CHOOSE'))
                 <div class="alert alert-danger" role="alert">Lütfen, seçeneklerden birini seçiniz.</div>
                @endif

                @if(Session::has('CONFIRM_STOCK'))                  
                 <div class="alert alert-danger" role="alert">ÜZGÜNÜZ, istediğiniz adet stoklarda mevcut değil.</div>
                @endif                

                @if ($product->stock > 0) 
                {{ Form::open(['url'=>'sepet/ekle','role'=>'form']) }}
                {{ Form::hidden('id',$product->id_product) }}
                <div class="add-to-box">
                  <div class="add-to-cart">
                  @if ($product->option_status == 1)
                  <label for="qty">SEÇENEKLER</label>
                    @foreach($options as $option)
                      @if ($option->price>'0')
                      <div style="text-align:left; height:7px;"><input type="radio" id="c{{ $option->id_option }}" name="choose" value="{{ $option->id_option }}"> <label for="c{{ $option->id_option }}" style="font-weight:normal; display:inline-block;">{{ $option->name }} - {{ Price::product($option->price,$product->tax,$product->rate_id,$product->ratePrice,'F') }} TL</label></div>
                      @else
                      <div style="text-align:left; height:7px;"><input type="radio" id="c{{ $option->id_option }}" name="choose" value="{{ $option->id_option }}"> <label for="c{{ $option->id_option }}" style="font-weight:normal; display:inline-block;">{{ $option->name }}</label></div>                      
                      @endif
                      <br />
                    @endforeach
                  @endif
                    <br /><label for="qty">ADET</label>
                    <div class="pull-left">
                      <div class="custom pull-left">
                        <input type="text" class="input-text qty" title="Qty" value="1" maxlength="12" id="qty" name="quantity">
                        <button onClick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;" class="increase items-count" type="button"><i class="icon-plus">&nbsp;</i></button>
                        <button onClick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 0 ) result.value--;return false;" class="reduced items-count" type="button"><i class="icon-minus">&nbsp;</i></button>
                      </div>
                    </div>
                    <div class="pull-left">
                      <button onClick="productAddToCartForm.submit(this)" class="button btn-cart" title="" type="submit"><span><i class="icon-basket"></i> Sepete Ekle</span></button>
                    </div>
                  </div>
                </div>
                {{ Form::close() }}
                @endif
              </div>
              <div class="product-img-box col-sm-3 col-xs-12">
                <div class="product-additional">
                  <div class="block block-product-additional">
                    <div class="block-title"><strong><span>{{ $designs->product_advert_title }}</span></strong></div>
                    <div class="block-content">{!! $designs->product_advert_content !!}</div>
                  </div>
                </div>
              </div>
          </div>
        </div>
        <div class="product-collateral">
          <div class="col-sm-12">
            <ul id="product-detail-tab" class="nav nav-tabs product-tabs">
              <li class="active"><a href="#product_tabs_description" data-toggle="tab">Ürün Detayları</a></li>
            </ul>
            <div id="productTabContent" class="tab-content">
              <div class="tab-pane fade in active" id="product_tabs_description">
                <div class="std">
                  <p>{!! $product->content !!} </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Product Slider -->
@if ($designs->similar_product_section == 1)
<section class="slider-items-products">
  <div class="container">
    <div class="slider-items-products">
      <div class="new_title center">
        <h2>{{ $designs->similar_product_title }}</h2>
      </div>
      <div id="related-products-slider" class="product-flexslider hidden-buttons">
        <div class="slider-items slider-width-col4">          
          @foreach($similarProducts as $product)
          <div class="item">
            <div class="col-item">
              <div class="product-wrapper">
                <div class="thumb-wrapper"><a href="{{ Sef::product($product->sef_url,$product->id_product) }}" class="thumb @if($designs->multiple_product_image == 1) flip @endif"><span class="face"><img src="{{ URL::to($product->image_small_1) }}" alt="{{ $product->name }}" width="265"></span>@if ($designs->multiple_product_image == 1)<span class="face back"><img  src="{{ URL::to($product->image_small_2) }}" alt="{{ $product->name }}" width="265"><span class="quick-view"><span>{{ $product->name }}</span></span></span>@endif</a></div>
                <div class="actions"><span class="add-to-links"><a href="{{ Sef::product($product->sef_url,$product->id_product) }}" class="link-compare"><span></span></a></span></div>
              </div>
              <div class="item-info">
                <div class="info-inner">
                    <div class="item-title"><a href="{{ Sef::product($product->sef_url,$product->id_product) }}" title="">{{ $product->name }}</a></div>
                  <div class="item-content">
                    <div class="item-price">
                      <div class="price-box">
                        @if ($product->price_old > 0) <p class="old-price"><span class="price">{{ Price::format($product->price_old) }} TL</span></p> @endif
                        <span class="regular-price"><span class="price">{{ Price::product($product->price,$product->tax,$product->rate_id,$product->ratePrice,'F') }} TL</span></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="actions1">
                  <a href="{{ Sef::product($product->sef_url,$product->id_product) }}"><button class="button btn-cart" type="button"><span>Sepete Ekle</span></button></a>
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
<!-- End Product Slider -->

@stop