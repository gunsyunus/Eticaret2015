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

        <ol class="one-page-checkout" id="checkoutSteps">
          <li id="opc-login" class="section allow active">
            <div class="step-title"><span class="number">+</i></span>
              <h3 class="one_page_heading">ÜYE BİLGİLERİNİZ</h3>
            </div>
          </li>
        </ol>

                <!-- F -->
                <fieldset class="group-select">
                  <ul>
                    <li id="billing-new-address-form">
                      <fieldset>
                        <legend></legend>
                        <input type="hidden" name="billing[address_id]" id="billing:address_id" />
                        <ul>
                          <li>
                            <div class="customer-name">
                              <div class="input-box name-firstname">
                                <label for="billing:firstname"> Ad <span class="required">*</span></label>
                                <br />
                                <input type="text" id="billing:firstname" name="name" class="input-text" />
                              </div>
                              <div class="input-box name-lastname">
                                <label for="billing:lastname"> Soyad <span class="required">*</span> </label>
                                <br />
                                <input type="text" id="billing:lastname" name="surname" class="input-text" />
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="input-box">
                              <label for="billing:company">E-Posta <span class="required">*</span></label>
                              <br />
                              <input type="text" id="billing:email" name="email" class="input-text" />
                            </div>
                            <div class="input-box">
                              <label for="billing:phone">Telefon <span class="required">*</span></label>
                              <br />
                              <input type="text" name="phone" class="input-text phone" id="billing:phone" />
                            </div>
                          </li>
                          <li>                            
                            <div id="div" class="input-box">
                              <label for="billing:region">Cinsiyet <span class="required">*</span></label>
                              <br />
                             {!! Form::select('gender', array(''=>'Lütfen Seçiniz','M'=>'Erkek','F'=>'Kadın'),'',['class'=>'validate-select']) !!}
                            </div>
                          </li>                        
                        </ul>
                      </fieldset>
                    </li>
                  </ul>
                </fieldset>
                <!-- F -->


        <ol class="one-page-checkout" id="checkoutSteps">
          <li id="opc-login" class="section allow active">
            <div class="step-title"><span class="number">+</i></span>
              <h3 class="one_page_heading">TESLİMAT ADRESİ</h3>
            </div>
          </li>
        </ol>

                <!-- F -->
                <fieldset class="group-select">
                  <ul>
                    <li id="billing-new-address-form">
                      <fieldset>
                        <legend></legend>
                        <input type="hidden" name="billing[address_id]" id="billing:address_id" />
                        <ul>
                          <li>
                            <label for="billing:street1">Adres <span class="required">*</span></label>
                            <br />
                            <input type="text" name="address_1" id="billing:street1 street1" class="input-text" />
                          </li>
                          <li>                            
                            <div id="div" class="input-box">
                              <label for="billing:region">Şehir <span class="required">*</span></label>
                              <br />
                              {!! Form::select('city_id',$cities,'',['class'=>'validate-select','id'=>'city_id']) !!}
                            </div>
                            <div id="div" class="input-box">
                              <label for="billing:region">İlçe <span class="required">*</span></label>
                              <br />
                              {!! Form::select('county_id', array(''=>'Lütfen Seçiniz'),'',['class'=>'validate-select','id'=>'county_id']) !!}
                            </div>                            
                          </li>                          
                        </ul>
                      </fieldset>
                    </li> 
                  </ul>

          <div id="billing">
                            <ul>
                    <li id="billing-new-address-form">
                      <fieldset>
                        <legend></legend>
                        <input type="hidden" name="billing[address_id]" id="billing:address_id" />
                        <ul>
                          <li>
                            <label for="billing:street1">Fatura Adresi <span class="required">*</span></label>
                            <br />
                            <input type="text" name="billing_address" id="billing:street1  street1" class="input-text" />
                          </li>
                          <li>                            
                            <div id="div" class="input-box">
                              <label for="billing:region">Şehir <span class="required">*</span></label>
                              <br />
                              {!! Form::select('billing_city',$cities,'',['class'=>'validate-select','id'=>'billing_city']) !!}
                            </div>
                            <div id="div" class="input-box">
                              <label for="billing:region">İlçe <span class="required">*</span></label>
                              <br />
                              {!! Form::select('billing_county', array(''=>'Lütfen Seçiniz'),'',['class'=>'validate-select','id'=>'billing_county']) !!}
                            </div>                            
                          </li>                          
                        </ul>
                      </fieldset>
                    </li> 
                  </ul>          

        </div>

                      <fieldset>
                        <legend></legend>
                        <input type="hidden" name="billing[address_id]"id="billing:address_id" />
                        <ul>
                          <li>
                            <label for="billing:street1">Sipariş Notu<span class="required"></span></label>
                            <br />
                            <input type="text" name="message" id="billing:street1  street1"class="input-text" />
                          </li>
                    </fieldset>


                  <ul>
                  <li class="control">
                     <input checked="checked" name="choose" type="checkbox" value="1" id="choose">
                      <label for="billing:use_for_shipping_yes"> Fatura Adresi, Teslimat Adresiyle Aynı</label>
                  </li>
                  </ul>
                </fieldset>

                <!-- F -->

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