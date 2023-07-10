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
          <h2>ADRESLERİM</h2>
        </div>

           <fieldset>
              <table class="data-table cart-table" id="shopping-cart-table">
                <colgroup>
                <col width="1">
                <col>
                <col width="1">
                <col width="1">
                <col width="1">
                <col width="1">                
                </colgroup>
                <thead>
                  <tr class="first last">
                    <th rowspan="1"><span class="nobr">Adres Başlığı</span></th>
                    <th class="a-center" rowspan="1">Adres</th> 
                    <th colspan="1"><span class="nobr">Telefon</span></th>
                    <th rowspan="1">&nbsp;</th>
                    <th rowspan="1">&nbsp;</th>                    
                  </tr>
                </thead>
               <tbody>
              @foreach($myaddress as $address)
                  <tr class="first">
                    <td class="a-center last"><b>{{ $address->title }}</b></td>
                    <td class="a-center last">{{ $address->address_1 }} / {{ $address->name }}</td>
                    <td class="a-center last">{{ $address->phone }}</td>
                    <td class="a-center last"><a class="edit-bnt" title="Adresi Güncelle" href="{{ URL::to('uye/adres/duzenle/'.$address->id_address) }}"><span><span>Adresi Sil</span></span></a></td>
                    <td class="a-center last"><a class="button remove-item" title="Adresi Sil" href="{{ URL::to('uye/adres/sil/'.$address->id_address) }}"><span><span>Adresi Sil</span></span></a></td>
                  </tr>
              @endforeach
                </tbody>
              </table>
            </fieldset>


<br>
      

        <a href="{{ URL::to('uye/adres/yeni') }}" style="float:right;"><button class="button" type="button"><span>Yeni Adres Ekle</span></button></a>

         
      </div>

      @include('site.customerMenu')


    </div>
  </div>
</section>

<!-- End Container -->

@stop