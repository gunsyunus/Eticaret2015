@extends('panel.template')

@section('content')

@section('body')
{{ HTML::script('panelv3/js/chart.min.js') }}
@stop

@include('panel.module.statistics.menu')

<div class="row">
  <div class="col-xs-12 col-sm-4 col-md-4">
  @include('panel.module.statistics.list')
  </div>
  <div class="col-xs-12 col-sm-8 col-md-8">

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title panel-modul"><i class="fa fa-tag"></i> ÜRÜNLER İSTATİSTİK</h3>
      </div>
      <div class="panel-body">
        <div class="row">

        <div class="col-xs-12 col-sm-6 col-md-6 text-center">
 
          <br /><canvas id="chart-area" width="250" height="250" />
          <script>
            var pieData = [
            {
              value: {{ $statistics->productsInStock }},
              color:"#F7464A",
              highlight: "#FF5A5E",
              label: "Aktif Ürünler"
          },
          {
              value: {{ $statistics->productsOutStock }},
              color: "#4D5360",
              highlight: "#616774",
              label: "Pasif Ürünler"
          }
          ];
          window.onload = function(){
              var ctx = document.getElementById("chart-area").getContext("2d");
              window.myPie = new Chart(ctx).Pie(pieData);
          };
          </script>

        </div>

        <div class="col-xs-12 col-sm-6 col-md-6">

          <div class="chart-statistic">  

          <table class="table table-striped table-margin-disabled">
          <tbody>
          <tr>
            <th style="border-top:none;">Toplam Ürün</th>
            <td style="border-top:none;">{{ $statistics->productsInStock+$statistics->productsOutStock }}</td>
          </tr>
          <tr>
            <th>Aktif Ürünler</th>
            <td>{{ $statistics->productsInStock }}</td>
          </tr>
          <tr>
            <th>Pasif Ürünler</th>
            <td>{{ $statistics->productsOutStock }}</td>
          </tr> 
          </tbody>
          </table>

          </div>  

          <br />

          <div class="chart-statistic">  

          <table class="table table-striped table-margin-disabled">
          <tbody>
          <tr>
            <th style="border-top:none;">Toplam Kategori</th>
            <td style="border-top:none;">{{ $statistics->category }}</td>
          </tr>
          <tr>
            <th>Toplam Marka</th>
            <td>{{ $statistics->brand }}</td>
          </tr>
 
          </tbody>
          </table>

          </div>  

          <br />          

        </div>
        </div>
      </div>
    </div>  

  </div>
</div> 
@stop