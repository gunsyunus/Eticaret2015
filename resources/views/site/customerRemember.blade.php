@extends('site.template')

@section('title', 'Şifremi Unuttum - '.$settings->title.'')
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
        <h2>ŞİFREMİ UNUTTUM ?</h2>
      </div>

      <fieldset class="col2-set">

      @if(Session::has('status'))
        @include('site.message', ['status' => "success", 'message' => session('status')])
      @endif

      @include('site.errorRequest')

        <div class="col-2 registered-users" style="width:100%; min-height: 200px;">     
          <div class="content">
            {!! Form::open(['url'=>'uye/sifre/gonder','role'=>'form','method'=>'post','class'=>'form-horizontal']) !!}
            <ul class="form-list">
              <li>
                <label for="user">E-Posta Adresi <span class="required"> *</span></label>
                <br>
                <input type="text" title="E-Posta" class="input-text" id="user" value="" name="email">
              </li>
            </ul>
            <p class="required">* Zorunlu Alanlar</p>
            <div class="buttons-set">
              <button id="send2" name="send" type="submit" class="button login"><span>ŞİFREYİ GÖNDER</span></button>
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