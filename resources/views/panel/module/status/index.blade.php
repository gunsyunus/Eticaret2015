@extends('panel.template')

@section('content')

@include('panel.module.status.menu')

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title panel-modul">SİPARİŞ DURUM LİSTESİ <span class="badge">{{ $statuses->total() }}</span></h3>
  </div>
  <div class="panel-body">
    <div class="row">
    <div class="col-md-12">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Durum Adı</th>
          <th>Sıralama</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
     	@foreach($statuses as $status)
        <tr>
          <td><span class="label label-{{ $status->color }}">{{ $status->name }}</span></td>
          <td>{{ $status->sort }}</td>
          <td class="text-right"> 
          @if ($status->id_status<=5)
          {!! Tooltip::standard('Raporlamalar için otomatik oluşturulur, işlem yapılamaz.') !!}
          @else
          <div class="btn-group">
          <a href="{{ URL::to('Pv3/status/edit/'.$status->id_status.'') }}" class="btn btn-default"><i class="fa fa-pencil-square-o"></i></a>
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="caret"></span>
          <span class="sr-only">Menü</span>
          </button>
          <ul class="dropdown-menu dropdown-menu-right">
          <li class="delete"><a href="{{ URL::to('Pv3/status/delete/'.$status->id_status.'') }}"><i class="fa fa-times"></i> Durumu Sil</a></li>
          </ul>
          </div>
          @endif
          </td>
        </tr> 
   	  @endforeach      
      </tbody>
    </table>
   	<div class="pagination"> {{ $statuses->links() }} </div>
    </div>
    </div>
  </div>
</div>

@stop