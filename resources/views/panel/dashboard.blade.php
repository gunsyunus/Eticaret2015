@extends('panel.template')

@section('content')

@section('body')
@stop
    
<br />


           <!-- Container-fluid starts-->
           <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-4 col-md-6 xl-50">
                        <div class="card o-hidden widget-cards">
                            <div class="bg-warning card-body">
                                <div class="media static-top-widget row">
                                    <div class="icons-widgets col-4">
                                        <div class="align-self-center text-center"><i data-feather="users" class="font-warning"></i></div>
                                    </div>
                                    <div class="media-body col-8"><span class="m-0">ÜYE</span>
                                        <h3 class="mb-0"> <span class="counter">{{ $statistics->customerTodayCount }}</span><small> Bugün üye olanlar</small></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 xl-50">
                        <div class="card o-hidden  widget-cards">
                            <div class="bg-secondary card-body">
                                <div class="media static-top-widget row">
                                    <div class="icons-widgets col-4">
                                        <div class="align-self-center text-center"><i data-feather="box" class="font-secondary"></i></div>
                                    </div>
                                    <div class="media-body col-8"><span class="m-0">SİPARİŞ</span>
                                        <h3 class="mb-0"> <span class="counter">{{ $statistics->orderNew }}</span><small>Yeni siparişler</small></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 xl-50">
                        <div class="card o-hidden widget-cards">
                            <div class="bg-primary card-body">
                                <div class="media static-top-widget row">
                                    <div class="icons-widgets col-4">
                                        <div style="color:pink;font-size:17px;font-weight:600" class="align-self-center text-center">₺<i data-feather="price" class="font-primary"></i></div>
                                    </div>
                                    <div class="media-body col-8"><span class="m-0">Satış</span>
                                        <h3 class="mb-0">₺ <span class="counter">{{ Price::format($statistics->orderTodaySum) }}</span><small> Bugünkü kazanç</small></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 xl-100">
                        <div class="card">
                            <div class="card-header">
                                <h5>EN ÇOK SATILAN 5 ÜRÜN</h5>
                               
                            </div>
                            <div class="card-body">
                                <div class="user-status table-responsive latest-order-table">
                                    <table class="table table-bordernone">
                                        <thead>
                                        <tr>
                                        <th>Ürün</th>
                                        <th>Satış Adeti</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($products as $product)
                                        <tr>
                                        <td>{{ $product->name }}</td>
                                        <td class="text-center">{{ $product->stock_order }}</td>
                                        </tr>
                                    @endforeach  
  
                                        </tbody>
                                    </table>
                                </div>
                              
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 xl-100">
                        <div class="card">
                            <div class="card-header">
                                <h5>Son Siparişler</h5>
                               
                            </div>
                            <div class="card-body">
                                <div class="user-status table-responsive latest-order-table">
                                    <table class="table table-bordernone">
                                        <thead>
                                        <tr>
                                            <th scope="col">Sipariş Tarihi</th>
                                            <th scope="col">Saat</th>
                                            <th scope="col">Ad Soyad</th>
                                            <th scope="col">Durumu</th>
                                            <th scope="col">Tip</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orders as $order)
                                            <tr>
                                            <th>{{ $order->created_at->format('d.m.Y') }}</th>
                                            <td>{{ $order->created_at->format('H:i') }}</td>
                                            <td>{{ $order->name }} {{ $order->surname }}</td>
                                            <td><span style="padding:5px;" class="label label-{{ $order->status->color }}">{{ $order->status->name }}</span></td>
                                            <td>{{ $order->customer_group=='0' ? 'MİSAFİR' : 'ÜYE' }}</td>
                                            </tr> 
                                        @endforeach 
  
                                        </tbody>
                                    </table>
                                    <a href="{{ URL::to('Pv3/order/list/1') }}" class="btn btn-primary">Tüm Siparişleri Göster</a>
                                </div>
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
@stop