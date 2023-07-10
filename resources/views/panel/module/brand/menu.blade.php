<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <div class="page-header-left">
                    <h3>MARKALAR
                    <small>  <ol class="breadcrumb pull-right">
                    <li class="breadcrumb-item"><a href="{{ URL::to('Pv3/Dashboard') }}"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Marka Yönetimi</li>
                    <li class="breadcrumb-item active">Marka İşlemleri</li>
                </ol></small>
                    </h3>
                </div>
            </div>
            <div class="col-lg-6">
                <br>
                <div class="pull-right">
                <a class="btn btn-success" href="{{ URL::to('Pv3/brand/new') }}"><i class="fa fa-plus-circle"></i> Marka</a>
                <a class="btn btn-info" href="{{ URL::to('Pv3/brand') }}"><i class="fa fa-list"></i> Liste</a>
                </div>
                
            </div>
        </div>
    </div>
</div>
@include('panel.error')