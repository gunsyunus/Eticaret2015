@extends('site.template')

@section('title', 'Üyelik Tipi - '.$settings->title.'')
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
        <h2>LÜTFEN ÜYELİK TİPİNİ SEÇİNİZ</h2>
      </div>
      <fieldset class="col2-set">
        <legend>-</legend>
        <div class="col-1 new-users">
          <div class="content" style="text-align:center; padding-top:100px">

          <a href="{{ URL::to('odeme',[],$settings->ssl_status) }}"><button class="button create-account" type="button">
          <br /><span>ÜYELİKSİZ, ALIŞVERİŞE DEVAM ET</span></button></a>

          </div>
        </div>
        <div class="col-2 registered-users"><strong class="title">Üye Girişi</strong>       
          <div class="content">
            @include('site.errorRequest')
            @if(Session::has('ERROR'))
              @include('site.message', ['status' => "danger", 'message' => "Giriş bilgileriniz hatalı, lütfen kontrol ediniz."])
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
              ya da <a href="{{ URL::to('uye/yeni') }}"><button class="button create-account" type="button"><span>Yeni Hesap Oluştur</span></button></a>
          </div>
          {!! Form::close() !!}
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