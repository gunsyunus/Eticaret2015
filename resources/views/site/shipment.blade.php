@extends('site.template')

@section('title', 'Kargo Takip - '.$settings->title.'')
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
        <h2>KARGO TAKİP</h2>
      </div>
      <fieldset class="col2-set">
      
            @include('site.errorRequest')

            @if(Session::has('NO_RECORD'))
              @include('site.message', ['status' => "danger", 'message' => "Kargo takip numarası hatalı, lütfen kontrol ediniz."])
            @endif         

        <div class="col-2 registered-users" style="width:100%;">     
          <div class="content">
            {!! Form::open(['url'=>'kargo-sorgula','role'=>'form','method'=>'get','class'=>'form-horizontal']) !!}
            <ul class="form-list">
              <li>
                <label for="user">Kargo Takip Numaranız </label>
                <br>
                <input type="text" class="input-text" id="n" name="n">
              </li>
            </ul>
            <div class="buttons-set">
              <button type="submit" class="button continue"><span>SORGULA</span></button>
          </div>
          {!! Form::close() !!}
        </div>
      </fieldset>
    </div>
    <br>
    <br>
  </div>
</section>
<!-- Main Container End -->

@stop