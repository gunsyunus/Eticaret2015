@extends('panel.template')

@section('content')

@include('panel.module.statistics.menu')

<div class="row">
  <div class="col-xs-12 col-sm-4 col-md-4">
  @include('panel.module.statistics.list')
  </div>
  <div class="hidden-xs col-sm-8 col-md-8">

    <div class="chart-statistic text-center statistics-home">  
        <i class="fa fa-chevron-circle-left fa-5x"></i>
        <br /><br />
        LÜTFEN YAN MENÜDEN İŞLEM SEÇİNİZ
    </div>

  </div>
</div> 
@stop