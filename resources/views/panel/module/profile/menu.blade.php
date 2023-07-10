<div class="modul-header">
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12">
    <h1><i class="fa fa-user fa-fw"></i>Merhaba, {{ Auth::user()->name.' '.Auth::user()->surname }}</h1>
    <ol class="breadcrumb hidden-xs">
      <li><a href="{{ URL::to('Pv3/Dashboard') }}">Anasayfa</a></li>
      <li><a href="{{ URL::to('Pv3/profile') }}">Profilim</a></li>
    </ol>  
  </div>

</div>
</div>

@include('panel.error')