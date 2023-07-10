@extends('site.template')

@section('title', 'Şifre Sıfırlama - '.$settings->title.'')
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
        <h2>ŞİFRE SIFIRLAMA</h2>
      </div>

      <fieldset class="col2-set">

      @include('site.errorRequest')

        <div class="col-2 registered-users" style="width:100%;">     
          <div class="content">
            {!! Form::open(['url'=>'uye/sifre/yeni','role'=>'form','method'=>'post','class'=>'form-horizontal']) !!}
            <ul class="form-list">
              <li>
                <label for="user">E-Posta Adresi <span class="required"> *</span></label>
                <br>
                <input type="text" title="E-Posta" class="input-text" id="email" value="{{ $email or old('email') }}" name="email">
                 <input type="hidden" name="token" value="{{ $token }}">
              </li>
              <li>
                <label for="user">Şifre <span class="required"> *</span></label>
                <br>
                <input type="password" class="input-text" id="password" value="" name="password">
              </li>
              <li>
                <label for="user">Şifreyi Tekrar Yazınız <span class="required"> *</span></label>
                <br>
                <input type="password" class="input-text" id="password_confirmation" value="" name="password_confirmation">
              </li>                            
            </ul>
            <p class="required">* Zorunlu Alanlar</p>
            <div class="buttons-set">
              <button id="send2" name="send" type="submit" class="button login"><span>ŞİFREMİ DEĞİŞTİR</span></button>
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