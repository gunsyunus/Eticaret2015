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
          <h2>ŞİFREYİ DEĞİŞTİR</h2>
        </div>

                @include('site.errorRequest')

                @if(Session::has('CONFIRM'))
                  @include('site.message', ['status' => "success", 'message' => "Şifreniz değiştirildi."])
                @endif

                @if(Session::has('ERROR'))                  
                  @include('site.message', ['status' => "danger", 'message' => "HATA, lütfen tekrar deneyiniz."])
                @endif

        <ol class="one-page-checkout" id="checkoutSteps">
          <li id="opc-billing" class="section allow active">
            <div class="step-title"> <span class="number">+</span>
              <h3 class="one_page_heading">Giriş şifrenizi değiştirin</h3>
            </div>
            <div id="checkout-step-billing" class="step a-item" >

              {{ Form::open(['url'=>'uye/guncelle','role'=>'form','class'=>'form-horizontal']) }}

                <fieldset class="group-select">
                  <ul>
                    <li id="billing-new-address-form">
                      <fieldset>
                        <legend></legend>
                        <input type="hidden" name="billing[address_id]"id="billing:address_id" />
                        <ul>
                          <li>
                            <div class="customer-name">
                              <div class="input-box name-firstname">
                                <label for="billing:firstname"> Şifre <span class="required">*</span></label>
                                <br />
                                <input type="password" id="billing:firstname" name="password" class="input-text" />
                             </div>
                          </li>
                         
                  </ul>
                  <p class="require"><em class="required">* </em>Zorunlu Alanlar</p><br />
                  <button class="button continue" type="submit"><span>BİLGİLERİMİ GÜNCELLE</span></button><br />
                </fieldset>

          {{ Form::close() }}

      </div>
      </div>

      @include('site.customerMenu')


    </div>
  </div>
</section>

<!-- End Container -->

@stop