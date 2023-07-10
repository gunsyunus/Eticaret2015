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
          <h2>YENİ ADRES</h2>
        </div>

                @include('site.errorRequest')

                @if(Session::has('CONFIRM'))
                  @include('site.message', ['status' => "success", 'message' => "Yeni adres eklendi."])
                @endif

                @if(Session::has('ERROR'))                  
                  @include('site.message', ['status' => "danger", 'message' => "HATA, lütfen tekrar deneyiniz."])
                @endif 

              {!! Form::open(['url'=>'uye/adres/ekle','role'=>'form','class'=>'form-horizontal']) !!}


                <!-- F -->
                <fieldset class="group-select">
                  <ul>
                    <li id="billing-new-address-form">
                      <fieldset>
                        <legend></legend>
                        <input type="hidden" name="billing[address_id]"id="billing:address_id" />
                        <ul>

                          <li>
                            <label for="billing:street1">Adres Başlığı<span class="required">*</span></label>
                            <br />
                            <input type="text" name="title" id="billing:street1 street1"class="input-text" />
                          </li>

              <li>
                            <label for="billing:street1">Telefon<span class="required">*</span></label>
                            <br />
                            <input type="text" name="phone" id="billing:street1 street1" class="input-text phone" />
                          </li>

                          <li>
                            <label for="billing:street1">Adres <span class="required">*</span></label>
                            <br />
                            <input type="text" name="address_1" id="billing:street1 street1"class="input-text" />
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

                  <p class="require"><em class="required">* </em>Zorunlu Alanlar</p><br />
                  <button class="button continue" type="submit"><span>ADRESİ EKLE</span></button><br />
                </fieldset>
      
                {!! Form::close() !!}


<br><br>
         
      </div>

      @include('site.customerMenu')


    </div>
  </div>
</section>

<!-- End Container -->

@stop