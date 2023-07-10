@extends('site.template')

@section('title', 'Arama - '.$settings->title.'')
@section('keyword', 'arama,'.$settings->keyword.'')
@section('description', 'Arama - '.$settings->description.'')

@section('meta')
@stop

@section('body')
@stop

@section('content')

<div class="breadcrumbs">
  <div class="container">
    <div class="row">
      <div class="inner">
        <ul>
          <li class="home"><a href="{{ URL::to('/') }}">Anasayfa</a><span>&mdash;›</span></li>          
          <li class="category13"><strong>Arama</strong></li>
        </ul>
      </div>
    </div>
  </div>
</div>

<section class="main-container col2-left-layout">
  <div class="container">
    <div class="row">
      <div class="col-main col-sm-9 col-sm-push-3">
        <article class="col-main">
          <div class="page-title" style="padding-left:20px;"><b>Aranan Kelime : </b> {{ $searchText }} <span style="float:right; color:#989898; font-style:italic;">Toplam <b>{{ count($products) }}</b> ürün bulundu</span></div>

          <div class="toolbar">
            <div id="sort-by">
              <label class="left">Sıralama : </label>
              <ul> 
                <li style="border-bottom:1px solid #BDBDBD;"><a href="#">{{ $sortSelect->name }} <span class="right-arrow"></span></a>
                  <ul>
                    <li><a href="{{ url()->current().'?k='.$searchText.'&sort=price_asc' }}">Artan Fiyat</a></li>
                    <li><a href="{{ url()->current().'?k='.$searchText.'&sort=price_desc' }}">Azalan Fiyat</a></li>
                    <li><a href="{{ url()->current().'?k='.$searchText.'&sort=name_asc' }}">A-Z Arası</a></li>
                    <li><a href="{{ url()->current().'?k='.$searchText.'&sort=name_desc' }}">Z-A Arası</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>

          <div class="category-products pull-left">
            <ul class="pdt-list products-grid zoomOut play">
              @foreach($products as $product)
              <li class="item item-animate last">
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
        </article>
      </div>
      <div class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9"> 
        <aside class="col-left sidebar">

          <div class="side-nav-categories">
            <div class="block-title">{{ $designs->product_title_text }}</div>
            <div class="box-content box-category">
              <ul id="magicat">
              @foreach($categories as $category)      
                {!! NodeList::getAccordionMenu($category) !!}
              @endforeach
              </ul>
            </div>
          </div>

          @if ($designs->outlet_section == 1)
          <div class="block block-cart">
            <div class="block-title">{{ $designs->outlet_title_text }}</div>
            <div class="block-content">
              <ul>
                @foreach($outletProducts as $product)
                <li class="item"><a href="{{ Sef::product($product->sef_url,$product->id_product) }}" title="{{ $product->name }}" class="product-image">
                  <img width="60" src="{{ URL::to($product->image_small_1) }}" alt="{{ $product->name }}"></a>
                  <div class="product-details">
                  <p class="product-name"><a href="{{ Sef::product($product->sef_url,$product->id_product) }}">{{ $product->name }}</a></p>
                  <span class="price">{{ Price::product($product->price,$product->tax,$product->rate_id,$product->ratePrice,'F') }} TL</span> </div>
                </li>
                @endforeach
              </ul>
            </div>
          </div>
          @endif

        </aside>
      </div>
    </div>
  </div>
</section>

@stop