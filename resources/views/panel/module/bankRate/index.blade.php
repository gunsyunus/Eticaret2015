@extends('panel.template')

@section('content')

@include('panel.module.bankRate.menu')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>POS ORANLARI <span class="badge">{{ $rates->total() }}</span></h5>
                </div>
                <div class="card-body">
                    <div class="btn-popup pull-right">
                        <button type="button" class="btn btn-primary" > <a style="color:white;" href="{{ URL::to('Pv3/bank-rate/new') }}"> Pos Oranı Ekle</a></button>
                        
                    </div>
                    <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                        <th>Pos Taksit</th>
                        <th>Pos Oran</th>
                        <th>Banka</th>
                        <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($rates as $rate)
                        <tr>
                        <td>{{ $rate->installment }}</td>
                        <td>%{{ $rate->rate }}</td>
                        <td>{{ $rate->bank->name }}</td> 
                        <td class="text-right">            
                          <div class="btn-group jsgrid">
                          <a href="{{ URL::to('Pv3/bank-rate/edit/'.$rate->id_rate.'') }}"  class="jsgrid-button jsgrid-edit-button"></a>
                          
                          <a href="{{ URL::to('Pv3/bank-rate/delete/'.$rate->id_rate.'') }}" class="jsgrid-button jsgrid-delete-button"></a>
                          
                          </div>
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