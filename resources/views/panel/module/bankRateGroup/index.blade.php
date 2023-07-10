@extends('panel.template')

@section('content')

@include('panel.module.bankRateGroup.menu')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>ÖDEME TİPLERİ <span class="badge">{{ $banks->total() }}</span></h5>
                </div>
                <div class="card-body">
                    <div class="btn-popup pull-right">
                    <button type="button" class="btn btn-primary" > <a style="color:white;" href="{{ URL::to('Pv3/bank-rate-group/new') }}"> Banka Ekle</a></button>
                    </div>
                    <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                        <th>Sıralama</th>
                        <th>Banka Adı</th>
                        <th>Resim</th>
                        <th>Durumu </th>
                        <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($banks as $bank)
                        <tr>
                        <th>{{ $bank->sort }}</th>
                        <td>{{ $bank->name }}</td>
                        <td><img src="{{ URL::to($bank->image) }}" class="bank img-thumbnail img-responsive" /></td>          
                        <td>{!! $bank->status=='1' ? '<span class="label label-success">AKTİF</span>' : '<span class="label label-danger">PASİF</span>' !!}</td>
                        <td class="text-right">            
                          <div class="btn-group jsgrid">
                          <a href="{{ URL::to('Pv3/bank-rate-group/edit/'.$bank->id_group.'') }}"  class="jsgrid-button jsgrid-edit-button"></a>
                          <a href="{{ URL::to('Pv3/bank-rate-group/delete/'.$bank->id_group.'') }}"class="jsgrid-button jsgrid-delete-button"></a>

                          </div>
                          </td>
                        </tr> 
                      @endforeach      
                      </tbody>
                    </table>
                    <div class="pagination"> {{ $banks->links() }} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop