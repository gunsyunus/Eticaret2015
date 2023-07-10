@extends('panel.template')

@section('content')

@include('panel.module.payment.menu')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>ÖDEME TİPLERİ <span class="badge">{{ $payments->total() }}</span></h5>
                </div>
                <div class="card-body">
                    <div class="btn-popup pull-right">
                        
                    </div>
                    <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                        <th>Sıralama</th>         
                        <th>Tip Adı</th>
                        <th>Durum</th>
                        <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($payments as $payment)
                        <tr>
                        <th>{{ $payment->sort }}</th>
                        <td>{{ $payment->name }}</td>
                        <td>{!! $payment->status=='1' ? '<span class="label label-success">AKTİF</span>' : '<span class="label label-danger">PASİF</span>' !!}</td>
                        <td class="text-right">            
                          <div class="btn-group jsgrid">
                          <a href="{{ URL::to('Pv3/payment/edit/'.$payment->id_payment.'') }}"  class="jsgrid-button jsgrid-edit-button"></a>
                          </div>
                          </td>
                        </tr> 
                      @endforeach      
                      </tbody>
                    </table>
                    <div class="pagination"> {{ $payments->links() }} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop