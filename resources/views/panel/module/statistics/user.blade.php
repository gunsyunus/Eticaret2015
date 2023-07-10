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
        <h3 class="panel-title panel-modul"><i class="fa fa-user"></i> ÜYE DAĞILIMLARI</h3>
      </div>
      <div class="panel-body">
        <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">
 
        <div style="width: 100%">
          <canvas id="canvas" height="300" width="450"></canvas>
        </div>

        <script>
        var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
        var barChartData = {
          labels : ["Cinsiyet","Alışveriş Oranı","E-Bülten"],
          datasets : [
          {
              fillColor : "rgba(250,50,83,0.5)",
              strokeColor : "rgba(250,50,83,0.8)",
              highlightFill: "rgba(250,50,83,0.75)",
              highlightStroke: "rgba(250,50,83,1)",
              data : [{{ $statistics->genderFemale }},{{ $statistics->orderFemale }},{{ $statistics->newsletterFemale }}]
          },
          {
            fillColor : "rgba(14,140,249,0.5)",
            strokeColor : "rgba(14,140,249,0.8)",
            highlightFill : "rgba(14,140,249,0.75)",
            highlightStroke : "rgba(14,140,249,1)",
            data : [{{ $statistics->genderMale }},{{ $statistics->orderMale }},{{ $statistics->newsletterMale }}]
          }
        ]
        }
        
        window.onload = function(){
          var ctx = document.getElementById("canvas").getContext("2d");
          window.myBar = new Chart(ctx).Bar(barChartData, {
          responsive : true
        });
        }
        </script>

        <p class="text-center">
          <span class="label label-danger">Kadın</span>
          <span class="label label-primary">Erkek</span>
        </p>


        </div>

        </div>
      </div>
    </div>  

  </div>
</div> 
@stop