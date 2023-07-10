@extends('site.template')

@section('title', 'Ödeme - '.$settings->title.'')
@section('keyword', ''.$settings->keyword.'')
@section('description', ''.$settings->description.'')

@section('meta')
@stop

@section('body')
@stop

@section('content') 

@if ($total->cartTotal > 0)

<!-- Container -->

{!! Form::open(['url'=>'odeme/onay','role'=>'form','class'=>'form-horizontal']) !!}

<section class="main-container col2-right-layout">
  <div class="main container">
    <div class="row">
      <div class="col-main col-sm-9">


      <div class="state_bar">
        <ul id="checkout-progress-state" class="checkout-progress">
          <li>SİPARİŞ</li>
          <li class="active first">ÖDEME</li>
          <li class="last">ONAY</li>
        </ul>
      </div>
      <br />

                @include('site.errorRequest')

                @if(Session::has('ORDER_CONTROL'))
                  @include('site.message', ['status' => "danger", 'message' => "HATA, lütfen tekrar deneyiniz."])
                @endif       

                @if(Session::has('BANK_CONTROL'))
                  @include('site.message', ['status' => "danger", 'message' => "Kredi kartı bilgileriniz hatalı, lütfen tekrar deneyiniz."])
                @endif    

                @include('site.payment')

                <!-- F -->

                  <br />

                <fieldset class="group-select">
                  <ul>
                  <li class="control">
                     <input checked="checked" name="agreement" type="checkbox" value="1" id="agreement">
                      <label for="billing:use_for_shipping_yes"> <a href="{{ URL::to($settings->agreement_order_url) }}" target="_blank"> "Mesafeli Satış Sözleşmesini" okudum ve kabul ediyorum.</a></label>
                  </li>
                  </ul>
                </fieldset>


<button class="button btn-proceed-checkout" type="submit" style="max-width:300px;"><span>SİPARİŞİ ONAYLA</span></button><br /><br /><br />


      </div>

      <aside class="col-right sidebar col-sm-3">
        <div class="block block-progress">
          <div class="block-title ">SİPARİŞ ÖZETİ</div>
          <div class="block-content">
          <br />
          <!-- Cart Total -->
            <table class="table shopping-cart-table-total" id="shopping-cart-totals-table">
              <colgroup>
              <col>
              <col width="1">
              </colgroup>
              <tfoot>
                <tr>
                  <td colspan="1" class="a-left" style="border-top:none;"> Ara Toplam </td>
                  <td class="a-right" style="border-top:none;"><span class="price">{{ Price::format($total->cartTotal) }} TL</span></td>
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
          <!-- Cart Total -->
          </div>
        </div>
      </aside>

    </div>
  </div>
</section>
<!-- End Container -->

{!! Form::close() !!}

@endif

@stop