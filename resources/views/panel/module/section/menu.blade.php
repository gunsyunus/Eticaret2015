<div class="modul-header">
<div class="row">
  <div class="col-xs-8 col-sm-6 col-md-8">
    <h1><i class="fa fa-file-text fa-fw"></i>SAYFA BÖLÜMLERİ</h1>
    <ol class="breadcrumb hidden-xs">
      <li><a href="{{ URL::to('Pv3/Dashboard') }}">Anasayfa</a></li>
      <li><a href="#">Sayfa Yönetimi</a></li>
      <li class="active">Bölümler</li>
    </ol>  
  </div>
  <div class="col-xs-4 col-sm-6 col-md-4 modul-button">
    <a class="btn btn-success" href="{{ URL::to('Pv3/section/new') }}"><i class="fa fa-plus-circle"></i> Bölüm</a>
    <a class="btn btn-info" href="{{ URL::to('Pv3/section') }}"><i class="fa fa-list"></i> Liste</a>
  </div>
</div>
</div>

@include('panel.error')