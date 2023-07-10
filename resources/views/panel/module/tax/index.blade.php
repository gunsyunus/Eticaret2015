@extends('panel.template')

@section('content')

@include('panel.module.tax.menu')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>TANIMLI KDV LİSTELERİ <span class="badge">{{ $taxs->total() }}</span></h5>
                </div>
                <div class="card-body">
                    <div class="btn-popup pull-right">
                        <button type="button" class="btn btn-primary" > <a style="color:white;" href="{{ URL::to('Pv3/tax/new') }}"> KDV Ekle</a></button>
                        
                    </div>
                    <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                        <th>KDV Yüzdesi</th>
                         <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      <tr>
                      <td>Dahil</td>
                      <td class="text-right">{!! Tooltip::standard('Otomatik tanımlanır, silinemez veya değiştirilemez.') !!}</td>
                    </tr>      
                      @foreach($taxs as $tax)
                        <tr>
                        <th>% {{ $tax->name }}</th>                                     
                          <td class="text-right">            
                          <div class="btn-group jsgrid">
                          <a href="{{ URL::to('Pv3/tax/edit/'.$tax->id_tax.'') }}"  class="jsgrid-button jsgrid-edit-button"></a>
                          
                          <a href="{{ URL::to('Pv3/tax/delete/'.$tax->id_tax.'') }}" class="jsgrid-button jsgrid-delete-button"></a>
                          
                          </div>
                          </td>
                        </tr> 
                      @endforeach      
                      </tbody>
                    </table>
                    <div class="pagination"> {{ $taxs->links() }} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop