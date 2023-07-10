@extends('site.template')

@section('title', 'Hesabım - '.$settings->title.'')
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
          <h2>HESABIM</h2>
        </div>

                @include('site.errorRequest')

                @if(Session::has('CONFIRM'))
                  @include('site.message', ['status' => "success", 'message' => "Bilgileriniz başarıyla güncellendi."])
                @endif

                @if(Session::has('ERROR'))                  
                  @include('site.message', ['status' => "danger", 'message' => "HATA, lütfen tekrar deneyiniz."])
                @endif  

        <ol class="one-page-checkout" id="checkoutSteps">
          <li id="opc-billing" class="section allow active">
            <div class="step-title"> <span class="number">+</span>
              <h3 class="one_page_heading">Profil Bilgileriniz</h3>
            </div>
            <div id="checkout-step-billing" class="step a-item" >

              {!! Form::open(['url'=>'uye/kaydet','role'=>'form','class'=>'form-horizontal']) !!}

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
                                <input type="text" id="billing:firstname" name="name" class="input-text" value="{{ $user->name }}" />
                              </div>
                              <div class="input-box name-lastname">
                                <label for="billing:lastname"> Soyad <span class="required">*</span> </label>
                                <br />
                                <input type="text" id="billing:lastname" name="surname" class="input-text" value="{{ $user->surname }}"/>
                              </div>
                            </div>
                          </li>
                           <li>
                            <div class="input-box">
                              <label for="billing:phone">Telefon <span class="required">*</span></label>
                              <br />
                              <input type="text" name="phone" class="input-text" id="billing:phone" value="{{ $customer->phone }}"/>
                            </div>
                          </li>
                          <li>                            
                            <div id="div" class="input-box">
                              <label for="billing:region">Cinsiyet <span class="required">*</span></label>
                              <br />
                             {!! Form::select('gender', array(''=>'Lütfen Seçiniz','M'=>'Erkek','F'=>'Kadın'),$customer->gender,['class'=>'validate-select']) !!}
                            </div>
                          </li>
                          <li>                            
                            <div id="div" class="input-box">
                              <label for="billing:region">Doğum Tarihi <span class="required">*</span></label>
                              <br />
                              {!! Form::selectRange('day',01,31,date('d', strtotime($customer->birth_at)),['class'=>'validate-select select-mini']) !!}
                              {!! Form::select('month', array('01'=>'Ocak','02'=>'Şubat','03'=>'Mart','04'=>'Nisan','05'=>'Mayıs','06'=>'Haziran','07'=>'Temmuz','08'=>'Ağustos','09'=>'Eylül','10'=>'Ekim','11'=>'Kasım','12'=>'Aralık'),date('m', strtotime($customer->birth_at)),['class'=>'validate-select select-mini']) !!}
                              {!! Form::selectYear('year',1920,2015,date('Y', strtotime($customer->birth_at)),['class'=>'validate-select select-mini']) !!}                            
                            </div>
                          </li>                          
                          <li>                            
                            <div id="div" class="input-box">
                              <label for="billing:region">Şehir <span class="required">*</span></label>
                              <br />
                              {!! Form::select('city_id',$cities,$customer->city_id,['class'=>'validate-select']) !!}
                            </div>
                          </li>                          
                        </ul>
                      </fieldset>
                    </li>
                    <li class="control">
                     <input @if ($customer->newsletter_status==1) checked="checked" @endif name="newsletter_status" type="checkbox" value="1" id="newsletter_status">
                      <label for="billing:use_for_shipping_yes"> E-Posta Kampanyalarından Haberdar Olmak İstiyorum</label>
                    </li>
                  </ul>
                  <p class="require"><em class="required">* </em>Zorunlu Alanlar</p><br />
                  <button class="button continue" type="submit"><span>BİLGİLERİMİ GÜNCELLE</span></button><br />
                </fieldset>

          {!! Form::close() !!}

      </div>
      </div>

      @include('site.customerMenu')


    </div>
  </div>
</section>

<!-- End Container -->

@stop