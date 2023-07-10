@extends('panel.template')

@section('content')

@include('panel.module.newsletter.menu')
<div class="page-body">

<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="card tab2-card">
        <div class="card-header">
            <h5>LİSTEYİ DIŞARI AKTAR</h5>
        </div>
        <div class="card-body">
    <div class="row">
    <div class="col-md-12">

    <table class="table table-striped">
      <thead>
        <tr>
          <th>Abone Durumu</th>
          <th>Abone Sayısı</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Aktif Abonelik</td>
          <td><span class="label label-success">{{ $newsletters->active }}</span></td>
        </tr>  
        <tr>
          <td>Pasif Abonelik</td>
          <td><span class="label label-warning">{{ $newsletters->passive }}</span></td>
        </tr> 
        <tr>
          <td>Toplam Abonelik</td>
          <td><span style="color:black;" class="label label-default">{{ $newsletters->total }}</span></td>
        </tr>  
        <tr>
          <td colspan="2" align="center">
          <br />
          <a class="btn btn-success btn-lg" href="{{ URL::to('Pv3/newsletter/export') }}"><i class="fa fa-download"></i> LİSTEYİ DIŞARI AKTAR</a></td>
        </tr>                          
      </tbody>
    </table>

    </div>
  </div>
</div>
</div>

@stop