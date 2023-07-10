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

{!! Form::open(['url'=>'odeme/bilgi','role'=>'form','class'=>'form-horizontal']) !!}

<section class="main-container col2-right-layout">
  <div class="main container">
    <div class="row">
      <div class="col-main col-sm-9">


      <div class="state_bar">
        <ul id="checkout-progress-state" class="checkout-progress">
          <li class="active first">SİPARİŞ</li>
          <li>ÖDEME</li>
          <li class="last">ONAY</li>
        </ul>
      </div>
      <br />

                @include('site.errorRequest')

                @if(Session::has('ORDER_CONTROL'))
                  @include('site.message', ['status' => "danger", 'message' => "HATA, lütfen tekrar deneyiniz."])
                @endif       

                     <!-- F -->
        <ol class="one-page-checkout" id="checkoutSteps">
          <li id="opc-login" class="section allow active">
            <div class="step-title"><span class="number">+</i></span>
              <h3 class="one_page_heading">TESLİMAT ADRESİ</h3>            
            </div>
          </li>
        </ol>

        <a href="{{ URL::to('uye/adres/yeni') }}" style="float:right;"><button class="button" type="button"><span>Yeni Adres Ekle</span></button></a>

                <!-- F -->

                @foreach($myaddress as $address)
                <div style="text-align:left; height:7px;"><input type="radio" id="c{{ $address->id_address }}" name="shipping_address_id" value="{{ $address->id_address }}"> <label for="c{{ $address->id_address }}" style="font-weight:normal; display:inline-block;"><b>{{ $address->title }}</b> - ({{ $address->address_1 }})</label></div>
                <br />
                @endforeach

          <div id="billing">

                     <!-- F -->
        <ol class="one-page-checkout" id="checkoutSteps">
          <li id="opc-login" class="section allow active">
            <div class="step-title"><span class="number">+</i></span>
              <h3 class="one_page_heading">FATURA ADRESİ</h3>
            </div>
          </li>
        </ol>

                <!-- F -->

               @foreach($myaddress as $address)
                <div style="text-align:left; height:7px;"><input type="radio" id="c{{ $address->id_address }}" name="billing_address_id" value="{{ $address->id_address }}"> <label for="c{{ $address->id_address }}" style="font-weight:normal; display:inline-block;"><b>{{ $address->title }}</b> - ({{ $address->address_1 }})</label></div>
                <br />
                @endforeach         
          </div>

                 <fieldset class="group-select"> 
                  <ul>
                  <li class="control">
                     <input checked="checked" name="choose" type="checkbox" value="1" id="choose">
                      <label for="billing:use_for_shipping_yes"> Fatura Adresi, Teslimat Adresiyle Aynı</label>
                  </li>
                  </ul>
                </fieldset>


                <!-- F -->

                  <br />
                      <fieldset class="group-select">
                        <legend></legend>
                        <input type="hidden" name="billing[address_id]"id="billing:address_id" />
                        <ul>
                          <li>
                            <label for="billing:street1">Sipariş Notu<span class="required"></span></label>
                            <br />
                            <input type="text" name="message" id="billing:street1  street1"class="input-text" />
                          </li>
                    </fieldset>

                <br />



<button class="button btn-proceed-checkout" type="submit" style="max-width:300px;"><span>DEVAM ET</span></button><br /><br /><br />


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