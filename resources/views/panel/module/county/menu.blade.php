<div class="modul-header">
<div class="row">
  <div class="col-xs-8 col-sm-6 col-md-8">
    <h1><i class="fa fa-cubes fa-fw"></i>İLÇE YÖNETİMİ</h1>
    <ol class="breadcrumb hidden-xs">
      <li><a href="{{ URL::to('Pv3/Dashboard') }}">Anasayfa</a></li>
      <li><a href="#">Genel Ayarlar</a></li>
      <li class="active">İlçe</li>
    </ol>  
  </div>
  <div class="col-xs-4 col-sm-6 col-md-4 modul-button">
    <a class="btn btn-success" href="{{ URL::to('Pv3/county/new') }}"><i class="fa fa-plus-circle"></i> İlçe</a>
    <a class="btn btn-info" href="{{ URL::to('Pv3/county') }}"><i class="fa fa-list"></i> Liste</a>
  </div>
</div>
</div>

@include('panel.error')