@extends('panel.template')

@section('content')

@include('panel.module.county.menu')

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title panel-modul">İLÇELER <span class="badge">{{ $counties->total() }}</span></h3>
  </div>
  <div class="panel-body">
    <div class="row">
    <div class="col-md-12">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>İlçe Adı</th>
          <th>Şehir</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
     	@foreach($counties as $county)
        <tr>
          <th>{{ $county->id_county }}</th>
          <td>{{ $county->name }}</td>
          <td>{{ $county->city->name }}</td>          
          <td class="text-right">            
          <div class="btn-group">
          <a href="{{ URL::to('Pv3/county/edit/'.$county->id_county.'') }}" class="btn btn-default"><i class="fa fa-pencil-square-o"></i></a>
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="caret"></span>
          <span class="sr-only">Menü</span>
          </button>
          <ul class="dropdown-menu dropdown-menu-right">
          <li class="delete"><a href="{{ URL::to('Pv3/county/delete/'.$county->id_county.'') }}"><i class="fa fa-times"></i> İlçeyi Sil</a></li>
          </ul>
          </div>
          </td>
        </tr> 
   	  @endforeach      
      </tbody>
    </table>
   	<div class="pagination"> {{ $counties->links() }} </div>
    </div>
    </div>
  </div>
</div>

@stop