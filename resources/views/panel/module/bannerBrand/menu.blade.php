<div class="modul-header">
<div class="row">
  <div class="col-xs-8 col-sm-6 col-md-8">
    <h1><i class="fa fa-star fa-fw"></i>TASARIM</h1>
    <ol class="breadcrumb hidden-xs">
      <li><a href="{{ URL::to('Pv3/Dashboard') }}">Anasayfa</a></li>
      <li><a href="#">Tasarım Yönetimi</a></li>
      <li><a href="{{ URL::to('Pv3/design/section') }}">Blok Yerleşimi Yönetimi</a></li> 
      <li class="active">Anasayfa Logolar</li>
    </ol>  
  </div>
  <div class="col-xs-4 col-sm-6 col-md-4 modul-button">
    <a class="btn btn-success" href="{{ URL::to('Pv3/banner-brand/new') }}"><i class="fa fa-plus-circle"></i> Logo</a>
    <a class="btn btn-info" href="{{ URL::to('Pv3/banner-brand') }}"><i class="fa fa-list"></i> Liste</a>
  </div>
</div>
</div>

@include('panel.error')