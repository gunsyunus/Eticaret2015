@extends('panel.template')

@section('content')

@include('panel.module.coupon.menu')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>ÜST MENÜLER <span class="badge">{{ $coupons->total() }}</span></h5>
                </div>
                <div class="card-body">
 
                    <div class="btn-popup pull-right">
                        <button type="button" class="btn btn-primary" > <a style="color:white;" href="{{ URL::to('Pv3/coupon/new') }}"> Kupon Ekle</a></button>
                        
                    </div>
                    <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                        <th>ID</th>
                        <th>Kupon Oluşturma Tarihi</th>
                        <th>Kupon Kodu</th>
                        <th>Kupon Tipi</th>
                        <th>Kupon Uygulama Tutarı</th>
                        <th>Kupon Adet</th>
                        <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($coupons as $coupon)
                        <tr>
                          <th>{{ $coupon->id_coupon }}</th>
                          <td>{{ $coupon->created_at->format('d.m.Y H:i') }}</td>
                          <td>{{ $coupon->code }}</td>
                          <td>
                              @if ($coupon->type=='money')
                                <span class="label label-default">Nakit Para</span>
                              @elseif ($coupon->type=='percent')
                                <span class="label label-default">Yüzde Bazlı</span>
                              @endif
                          </td>
                          <td>{{ $coupon->total }}</td>
                          <td>{!! $coupon->stock > '0' ? '<span class="label label-success">'.$coupon->stock.'</span>' : '<span class="label label-danger">'.$coupon->stock.'</span>' !!}</td>
                          <td class="text-right">            
                          <div class="btn-group jsgrid">
                          <a href="{{ URL::to('Pv3/coupon/edit/'.$coupon->id_coupon.'') }}" class="jsgrid-button jsgrid-edit-button"></a>
                          
                          <a href="{{ URL::to('Pv3/coupon/delete/'.$coupon->id_coupon.'') }}"class="jsgrid-button jsgrid-delete-button"></a>
                          
                          </div>
                          </td>
                        </tr> 
                      @endforeach      
                      </tbody>
                    </table>
                    <div class="pagination"> {{ $coupons->links() }} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop