@extends('site.template')

@section('title', 'Üyelik - '.$settings->title.'')
@section('keyword', ''.$settings->keyword.'')
@section('description', ''.$settings->description.'')

@section('meta')
@stop

@section('body')
@stop

@section('content')

<!-- Main Container -->
<section class="main-container col1-layout">
  <div class="main container">
    <div class="account-login">
      <div class="page-title">
        <h2 class="hidden-xs">YENİ ÜYELİK / ÜYE GİRİŞİ</h2>
      </div>
      <fieldset class="col2-set">
        <div class="col-1 new-users hidden-xs"><strong class="title">Yeni Üyelik</strong>
          <div class="content">
            <p>Web sitemizde bir hesap oluşturarak, ödemelerinizi, sevkiyat adreslerinizi, fatura bilgilerinizi ve siparişlerinizi kolay takip eder, çok daha hızlı bir biçimde işlemlerinizi yürütebilirsiniz.</p>
            <div class="buttons-set">
              <a href="{{ URL::to('uye/yeni') }}"><button class="button create-account" type="button"><span>Yeni Hesap Oluştur</span></button></a>
            </div>            
          </div>
        </div>
        <div class="col-2 registered-users"><strong class="title">Üye Girişi</strong>       
          <div class="content">
            @include('site.errorRequest')
            @if(Session::has('ERROR'))
              @include('site.message', ['status' => "danger", 'message' => "Giriş bilgileriniz hatalı, lütfen kontrol ediniz."])
            @endif       
            @if(Session::has('SOCIALERROR'))                  
               @include('site.message', ['status' => "danger", 'message' => "HATA, Facebook profilinizde E-POSTA adresiniz onaylı değil, lütfen kontrol ediniz."])
            @endif     
            {!! Form::open(['url'=>'uye/giris','role'=>'form','class'=>'form-horizontal']) !!}
            <ul class="form-list">
              <li>
                <label for="user">E-Posta Adresi <span class="required">*</span></label>
                <br>
                <input type="text" title="E-Posta" class="input-text" id="email" value="" name="email">
              </li>
              <li>
                <label for="pass">Şifre <span class="required">*</span></label>
                <br>
                <input type="password" title="Şifre" id="password" class="input-text" name="password">
              </li>
            </ul>
            <p class="required">* Zorunlu Alanlar</p>
            <div class="buttons-set">
              <button id="send2" name="send" type="submit" class="button login"><span>Giriş</span></button>
              <a class="forgot-word" href="{{ URL::to('uye/sifremi-unuttum') }}">Şifrenizi mi Unuttunuz?</a> </div>
          </div>
          {!! Form::close() !!}
          @if ($settings->facebook_connect_status==1)
          <a href="{{ URL::to('connect/facebook') }}" class="button btn-facebook">Facebook ile Giriş</a>
          @endif
        </div>
      </fieldset>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
  </div>
</section>
<!-- Main Container End -->

@stop