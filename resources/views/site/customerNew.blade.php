@extends('site.template')

@section('title', 'Üye Ol - '.$settings->title.'')
@section('keyword', ''.$settings->keyword.'')
@section('description', ''.$settings->description.'')

@section('meta')
@stop

@section('body')
@stop

@section('content')

<!-- Container -->
<section class="main-container col2-right-layout">

  <div class="main container">
    <div class="row">
      <div class="col-main col-sm-9">

        <div class="page-title">
          <h2>YENİ ÜYELİK</h2>
        </div>

                @if(Session::has('CONFIRM'))
                  @include('site.message', ['status' => "success", 'message' => "Üyeliğiniz başarıyla tamamlandı, sisteme giriş yapabilirsiniz."])
                 {!! $settings->tracing_customer_code !!}
                @endif

                @if(Session::has('ERROR'))                  
                  @include('site.message', ['status' => "danger", 'message' => "HATA, lütfen tekrar deneyiniz."])
                @endif    

        <ol class="one-page-checkout" id="checkoutSteps">
          <li id="opc-billing" class="section allow active">
            <div class="step-title"> <span class="number">+</span>
              <h3 class="one_page_heading">Üyelik Bilgileriniz</h3>
            </div>
            <div id="checkout-step-billing" class="step a-item" >

                @if ($settings->facebook_connect_status==1)
                <center>
                <a href="{{ URL::to('connect/facebook') }}" class="button btn-facebook">Facebook ile Kayıt Ol</a>
                </center>
                <div class="facebook-login-line"><span>ya da </span>
                </div>
                @endif        
              
              @include('site.errorRequest')
              
              {!! Form::open(['url'=>'uye/kayit','role'=>'form','class'=>'form-horizontal']) !!}

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
                              <label for="billing:pass">Şifre <span class="required">*</span></label>
                              <br />
                              <input type="text" name="password" id="billing:pass" class="input-text" />
                            </div>
                          </li>
                          <li>
                            <div class="input-box">
                              <label for="billing:phone">Telefon <span class="required">*</span></label>
                              <br />
                              <input type="text" name="phone" class="input-text phone" id="billing:phone" />
                            </div>
                          </li>
                          <li>                            
                            <div id="div" class="input-box">
                              <label for="billing:gender">Cinsiyet <span class="required">*</span></label>
                              <br />
                             {!! Form::select('gender', array(''=>'Lütfen Seçiniz','M'=>'Erkek','F'=>'Kadın'),'',['class'=>'validate-select']) !!}
                            </div>
                          </li>
                          <li>                            
                            <div id="div" class="input-box">
                              <label for="billing:birtday">Doğum Tarihi <span class="required">*</span></label>
                              <br />
                              {!! Form::selectRange('day',01,31,01,['class'=>'validate-select select-mini']) !!}
                              {!! Form::select('month', array('01'=>'Ocak','02'=>'Şubat','03'=>'Mart','04'=>'Nisan','05'=>'Mayıs','06'=>'Haziran','07'=>'Temmuz','08'=>'Ağustos','09'=>'Eylül','10'=>'Ekim','11'=>'Kasım','12'=>'Aralık'),'01',['class'=>'validate-select select-mini']) !!}
                              {!! Form::selectYear('year',1920,2010,1920,['class'=>'validate-select select-mini']) !!}                            
                            </div>
                          </li>                          
                          <li>                            
                            <div id="div" class="input-box">
                              <label for="billing:city">Şehir <span class="required">*</span></label>
                              <br />
                              {!! Form::select('city_id',$cities,'',['class'=>'validate-select']) !!}
                            </div>
                          </li>                          
                        </ul>
                      </fieldset>
                    </li>
                    <li class="control">
                     <input checked="checked" name="newsletter_status" type="checkbox" value="1" id="newsletter_status">
                      <label for="billing:use_for_shipping_yes"> <a href="{{ URL::to($settings->agreement_user_url) }}">Üyelik sözleşmesini kabul ediyorum</a></label>
                    </li>
           <li class="control">
                     <input checked="checked" name="newsletter_status" type="checkbox" value="1" id="newsletter_status">
                      <label for="billing:use_for_shipping_yes"> E-Posta Kampanyalarından Haberdar Olmak İstiyorum</label>
                    </li>                    
                  </ul>
                  <p class="require"><em class="required">* </em>Zorunlu Alanlar</p><br />
                  <button class="button continue" type="submit"><span>KAYIT OL</span></button><br />
                </fieldset>

          {!! Form::close() !!}

            </div>
          </li>
        </ol>
      </div>
    </div>
  </div>
  </section>
  <!-- End Container -->

@stop