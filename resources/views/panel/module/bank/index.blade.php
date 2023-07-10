@extends('panel.template')

@section('content')

@include('panel.module.bank.menu')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>BANKA / ÖDEME MERKEZİ LİSTESİ <span class="badge">{{ $banks->total() }}</span></h5>
                </div>
                <div class="card-body">
                    <div class="btn-popup pull-right">
                        
                    </div>
                    <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                        <th>Banka / Ödeme Merkezi</th>         
                        <th>3D Secure</th>         
                        <th>Pos Durumu</th>
                        <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($banks as $bank)
                        <tr>
                        <td>{{ $bank->name }}</td>
                        <td>{!! $bank->secure_verify_status =='1' ? '<span style="color:black;" class="label label-default">3D Pos</span>' : '<span style="color:black;" class="label label-default">Sanal Pos</span>' !!}</td>
                        <td>{!! $bank->status=='1' ? '<span class="label label-success">AKTİF</span>' : '<span class="label label-danger">PASİF</span>' !!}</td>
                        <td class="text-right">            
                          <div class="btn-group jsgrid">
                          <a href="{{ URL::to('Pv3/bank/edit/'.$bank->id_bank.'') }}"  class="jsgrid-button jsgrid-edit-button"></a>
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