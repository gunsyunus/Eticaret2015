@extends('panel.template')

@section('content')

@include('panel.module.shipment.menu')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>KARGO LİSTESİ <span class="badge">{{ $shipments->total() }}</span></h5>
                </div>
                <div class="card-body">
                    <div class="btn-popup pull-right">
                        <button type="button" class="btn btn-primary" > <a style="color:white;" href="{{ URL::to('Pv3/shipment/new') }}"> Kargo Ekle</a></button>
                        
                    </div>
                    <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                        <th>Sıralama</th>
                        <th>Kargo Adı</th>
                        <th>Resim</th>
                        <th>Durumu</th>
                        <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($shipments as $shipment)
                        <tr>
                        <th>{{ $shipment->sort }}</th>
                        <td>{{ $shipment->name }}</td>
                        <td><img src="{{ empty($shipment->image) ? URL::to('media/default/no-image.jpg') : URL::to($shipment->image) }}" class="product img-thumbnail img-responsive" /></td>
                        <td>{!! $shipment->status=='1' ? '<span class="label label-success">AKTİF</span>' : '<span class="label label-danger">PASİF</span>' !!}</td>
                        <td class="text-right">            
                          <div class="btn-group jsgrid">
                          <a href="{{ URL::to('Pv3/shipment/edit/'.$shipment->id_shipment.'') }}"  class="jsgrid-button jsgrid-edit-button"></a>
                          
                          <a href="{{ URL::to('Pv3/shipment/delete/'.$shipment->id_shipment.'') }}" class="jsgrid-button jsgrid-delete-button"></a>
                          
                          </div>
                          </td>
                        </tr> 
                      @endforeach      
                      </tbody>
                    </table>
                    <div class="pagination"> {{ $shipments->links() }} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop