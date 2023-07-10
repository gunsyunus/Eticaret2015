@extends('site.template')

@section('title', 'Sepet - '.$settings->title.'')
@section('keyword', ''.$settings->keyword.'')
@section('description', ''.$settings->description.'')

@section('meta')
@stop

@section('body')
@stop

@section('content')

@if (isset($carts))
  
<section class="main-container col1-layout">
  <div class="main container">
    <div class="col-main">
      <div class="cart">
        <div class="page-title">
          <h2>SEPETİM</h2>
        </div>
        <div class="table-responsive">

          @if(Session::has('status'))
          <strong></strong>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            @if (Session::get("status")=='CONFIRM_INSERT') <strong>BİLGİ : </strong> Ürün sepetinize eklendi.
            @elseif (Session::get("status")=='CONFIRM_SAVE') <strong>BİLGİ : </strong> Ürün adeti güncellendi.
            @elseif (Session::get("status")=='CONFIRM_DELETE') <strong>BİLGİ : </strong> Ürün sepetinizden silindi.
            @elseif (Session::get("status")=='CONFIRM_EMPTY') <strong>SEPETİNİZ TEMİZLENDİ ! </strong>
            @elseif (Session::get("status")=='ERROR') <strong>HATA ! Lütfen, tekrar deneyiniz.</strong>
            @elseif (Session::get("status")=='STOCK_ERROR') <strong>HATA ! Stoklarda istediğiniz adet bulunmamaktadır.</strong>
            @endif
          </div>
          @endif

            <fieldset>
              <table class="data-table cart-table" id="shopping-cart-table">
                <colgroup>
                <col width="1">
                <col>
                <col width="1">
                <col width="1">
                <col width="1">
                <col width="1">
                <col width="1">
                </colgroup>
                <thead>
                  <tr class="first last">
                    <th rowspan="1">&nbsp;</th>
                    <th rowspan="1"><span class="nobr">Ürün Adı</span></th>
                    <th colspan="1" class="a-center"><span class="nobr">Fiyat</span></th>
                    <th class="a-center" rowspan="1">Adet</th>
                    <th colspan="1" class="a-center">Tutar</th>
                    <th class="a-center" rowspan="1">&nbsp;</th>
                    <th rowspan="1">&nbsp;</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr class="first last">
                    <td class="a-right last" colspan="50">                     
                      <a href="{{ URL::to('/') }}"><button class="button btn-continue" type="button"><span>Alışverişe Devam</span></button></a>
                      <a href="{{ URL::to('sepet/temizle') }}"><button id="empty_cart_button" class="button btn-empty" type="button"><span><span>Sepeti Temizle</span></span></button></a>
                      </td>
                  </tr>
                </tfoot>
                <tbody>
              @foreach($carts as $cart)
                  <tr class="first">
                    <td class="image"><a class="product-image" title="" href="{{ Sef::product($cart->sef_url,$cart->product_id) }}"><img width="75" height="75" alt="" src="{{ URL::to($cart->image) }}"></a></td>
                    <td><h2 class="product-name"> <a href="{{ Sef::product($cart->sef_url,$cart->product_id) }}">{{ $cart->name }}</a> @if (!empty($cart->option_name)) <span class="cart-grey">{{ $cart->option_name }} </span> @endif</h2></td>
                    <td class="a-right"><span class="cart-price"> <span class="price">{{ Price::format($cart->price) }} TL</span> </span></td>
                    <td class="a-center movewishlist">
                    {{ Form::open(['url'=>'sepet/guncelle/'.$cart->id_cart,'role'=>'form','class'=>'form-horizontal']) }}
                    <input maxlength="12" class="input-text qty" title="" size="4" value="{{ $cart->stock }}" name="quantity">
                    </td>
                    <td class="a-right movewishlist"><span class="cart-price"> <span class="price">{{ Price::format($cart->total) }} TL</span> </span></td>
                    <td class="a-center"><button type="submit" class="btn"><i class="edit-bnt"></i>{{ Form::close() }}</form></td>
                    <td class="a-center last"><a class="button remove-item" title="Ürünü Sil" href="{{ URL::to('sepet/sil/'.$cart->id_cart) }}"><span><span>Ürünü Sil</span></span></a></td>
                  </tr>
              @endforeach
                </tbody>
              </table>
            </fieldset>

        <!-- Coupon -->
          <div class="col-sm-4">
            <div class="discount">
            <h4 style="font-family:'Open Sans',sans-serif; font-size: 15px;">İNDİRİM KODU</h4>

            @if (Session::get("coupon_message")==0 or Session::get("coupon_message")==2)

              @if(Session::has('COUPON_ERROR'))
                @include('site.message', ['status' => "danger", 'message' => "Hatalı kod girdiniz, lütfen kontrol ediniz."])
              @endif
              {{ Form::open(['url'=>'sepet/kupon','role'=>'form','class'=>'form-horizontal']) }}
                <input type="text" name="code" id="code" class="coupon-input">
                <button class="button coupon" type="submit"><span>Kuponu Kullan</span></button>
              {{ Form::close() }}

            @elseif (Session::get("coupon_message")==1)

                @if (Session::get("coupon_type")=='money')
                <p class="discount-message"><b>TEBRİKLER : </b>{{ Price::format(Session::get("coupon_total")) }} TL ve üstüne {{  Price::format(Session::get("coupon_discount_money")) }} TL indirim kazandın !</p>                
                @elseif (Session::get("coupon_type")=='percent')
                <p class="discount-message"><b>TEBRİKLER : </b>{{  Price::format(Session::get("coupon_total")) }} TL ve üstüne % {{ Session::get("coupon_discount_percent") }} indirim kazandın !</p>
                @endif

            @endif

          </div>
          </div>
        <!-- Coupon -->            

        <!-- Cart Total -->
        @if ($total->cartTotal > 0)
        <div class="totals col-sm-4 col-sm-offset-4">
          <h3>Alışveriş Sepeti Toplamı</h3>
          <div class="inner">
            <table class="table shopping-cart-table-total" id="shopping-cart-totals-table">
              <colgroup>
              <col>
              <col width="1">
              </colgroup>
              <tfoot>
                <tr>
                  <td colspan="1" class="a-left" style=""> Ara Toplam </td>
                  <td class="a-right" style=""><span class="price">{{ Price::format($total->cartTotal) }} TL</span></td>
                </tr>    
                <tr>
                  <td colspan="1" class="a-left" style=""> Kargo Bedeli</td>
                  <td class="a-right" style=""><span class="price">{{ $total->cargoText }} {{ $total->cargoRate }}</span></td>
                </tr>       
                <tr>
                  <td colspan="1" class="a-left" style=""> İndirim Bedeli</td>
                  <td class="a-right" style=""><span class="price">- {{ Price::format($total->couponDiscount) }} TL</span></td>
                </tr>                                       
                <tr>
                  <td colspan="1" class="a-left" style=""><strong>Genel Toplam</strong></td>
                  <td class="a-right" ><strong><span class="price" style="font-size:20px;">{{ Price::format($total->grandTotal) }} TL</span></strong></td>
                </tr>
              </tfoot>
            </table>
            <ul class="checkout">
              <li>
                <a href="@if (!$authControl) @if ($settings->order_method == 1) {{ URL::to('uye') }} @elseif ($settings->order_method == 2) {{ URL::to('uye/devam') }} @else {{ URL::to('odeme',[],$settings->ssl_status) }} @endif @else {{ URL::to('odeme/detay',[],$settings->ssl_status) }} @endif"><button class="button btn-proceed-checkout" type="button"><span>Ödeme Sayfasına İlerle</span></button></a>                           
              </li>
            </ul>
          </div>
        </div>
        @endif
        <!-- Cart Total -->

      </div>
    </div>
</section>

@else 

<section class="main-container col1-layout">
  <div class="main container">
    <div class="col-main">
      <div class="cart">
        <div class="page-title">
          <h2>SEPETİM</h2>
        </div>
        <div class="table-responsive">
        Sepetiniz boş, hemen alışverişe başlayın.     
       </div>
    </div>
    </div>
    </div>
</section>

@endif


@stop