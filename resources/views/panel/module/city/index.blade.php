@extends('panel.template')

@section('content')

@include('panel.module.city.menu')

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title panel-modul">ŞEHİRLER <span class="badge">{{ $cities->total() }}</span></h3>
  </div>
  <div class="panel-body">
    <div class="row">
    <div class="col-md-12">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Şehir Adı</th>
          <th>Sıralama</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
     	@foreach($cities as $city)
        <tr>
          <th>{{ $city->id_city }}</th>
          <td>{{ $city->name }}</td>
          <td>{{ $city->sort }}</td>
          <td class="text-right">            
          <div class="btn-group">
          <a href="{{ URL::to('Pv3/city/edit/'.$city->id_city.'') }}" class="btn btn-default"><i class="fa fa-pencil-square-o"></i></a>
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="caret"></span>
          <span class="sr-only">Menü</span>
          </button>
          <ul class="dropdown-menu dropdown-menu-right">
          <li class="delete"><a href="{{ URL::to('Pv3/city/delete/'.$city->id_city.'') }}"><i class="fa fa-times"></i> Şehiri Sil</a></li>
          </ul>
          </div>
          </td>
        </tr> 
   	  @endforeach      
      </tbody>
    </table>
   	<div class="pagination"> {{ $cities->links() }} </div>
    </div>
    </div>
  </div>
</div>

@stop