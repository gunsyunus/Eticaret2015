@extends('panel.template')

@section('content')

@include('panel.module.rate.menu')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>DÖVİZ LİSTESİ <span class="badge">{{ $rates->total() }}</span></h5>
                </div>
                <div class="card-body">
                    <div class="btn-popup pull-right">
                        <button type="button" class="btn btn-primary" > <a style="color:white;" href="{{ URL::to('Pv3/rate/new') }}"> Döviz Ekle</a></button>
                        
                    </div>
                    <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                        <th>Döviz Cinsi</th>
                        <th>Türü</th>
                        <th>Fiyatı</th>
                        <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($rates as $rate)
                        <tr>
                        <th>% {{ $rate->name }}</th> 
                        <td>@if ($rate->id_rate<=3) Merkez Bankası @else Manual @endif</td>
                        <td>{{ $rate->amount }}</td>
                        <td class="text-right"> 
                        @if ($rate->id_rate<=3)
                        {!! Tooltip::standard('Merkez bankası tarafından otomatik güncellenir, işlem yapılamaz !') !!}
                        @else          
                          <div class="btn-group jsgrid">
                          <a href="{{ URL::to('Pv3/rate/edit/'.$rate->id_rate.'') }}"  class="jsgrid-button jsgrid-edit-button"></a>
                          
                          <a href="{{ URL::to('Pv3/rate/delete/'.$rate->id_rate.'') }}" class="jsgrid-button jsgrid-delete-button"></a>
                          
                          </div>
                          @endif
                          </td>
                        </tr> 
                      @endforeach      
                      </tbody>
                    </table>
                    <div class="pagination"> {{ $rates->links() }} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop