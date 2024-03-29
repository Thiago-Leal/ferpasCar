@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard - <b>{{ Session::get('EMPRESA_DESCRICAO')}}</b></h1>
@stop

@section('content')
  <div class="row">

    <div class="col-md-6">
      <div class="row">
        <div class="col-md-4">
          <div class="small-box bg-success">
            <div class="inner">
              <h3>R$ {{number_format($retorno->receita, 2, ',', '.')}}</h3>

              <p>Receitas do mês</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{url('/receita')}}" class="small-box-footer">Receitas <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-md-4">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>R$ {{number_format($retorno->custo, 2, ',', '.')}}</h3>

              <p>Custos do mês</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{url('/custo')}}" class="small-box-footer">Custos <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-md-4">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{$retorno->qtd_servico}}</h3>

              <p>Lavagens do mês</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{url('/receita')}}" class="small-box-footer">Serviços <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4">
          <div class="small-box bg-success">
            <div class="inner">
              <h3>R$ {{number_format($retorno->receita_dia, 2, ',', '.')}}</h3>

              <p>Receitas do dia</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{url('/receita?q[data]='.date('d/m/Y'))}}" class="small-box-footer">Receitas <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-md-4">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{$retorno->qtd_servico_dia}}</h3>

              <p>Lavagens do dia</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{url('/receita?q[data]='.date('d/m/Y'))}}" class="small-box-footer">Serviços <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>

    </div>		

    <!--div class="col-md-3">
      <div class="card card-green">
        <div class="card-header">
          <h3 class="card-title">Tipos de Receitas Mes</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
          <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 731px;" width="731" height="250" class="chartjs-render-monitor"></canvas>
        </div>
      </div>
    </div-->
    <div class="col-md-6">
      <div class="card card-green">
        <div class="card-header">
          <h3 class="card-title">Tipos de Pagamentos Mês</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
          <canvas id="donutChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 731px;" width="731" height="250" class="chartjs-render-monitor"></canvas>
        </div>
      </div>
    </div>
  </div>



	<div class="row">
		<div class="col-md-6">
	    	<div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Receitas x Custos</h3>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg text-green">R$ {{number_format($retorno->receita_anual, 2, ',', '.')}}</span>
                    <span>Receita Anual</span>
                  </p>
                  <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-bold text-lg text-red">R$ {{number_format($retorno->custo_anual, 2, ',', '.')}}</span>
                    <span>Custo Anual</span>
                  </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                  <canvas id="sales-chart" height="200" style="display: block; width: 731px; height: 200px;" width="731" class="chartjs-render-monitor"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-green"></i> Receitas
                  </span>

                  <span>
                    <i class="fas fa-square text-red"></i> Custos
                  </span>
                </div>
              </div>
            </div>
	    </div>

	    <div class="col-md-6">
			<div class="card">
	          <div class="card-header border-0">
	            <div class="d-flex justify-content-between">
	              <h3 class="card-title">Histórico de Serviços</h3>
	            </div>
	          </div>
	          <div class="card-body">
	            <div class="d-flex">
	              <p class="d-flex flex-column">
	                <span class="text-bold text-lg">{{$retorno->qtd_servico_anual}}</span>
	                <span>Quantidade de Serviços Prestados no Ano</span>
	              </p>
	              <p class="ml-auto d-flex flex-column text-right">
	                @if($retorno->diff_qtd_servico > 0)
	                <span class="text-success">
	                  <i class="fas fa-arrow-up"></i> {{$retorno->diff_qtd_servico}}%
	                </span>
	                @else
	                <span class="text-danger">
	                  <i class="fas fa-arrow-down"></i> {{abs($retorno->diff_qtd_servico)}}%
	                </span>
	                @endif
	                <span class="text-muted">Desde o último mês</span>
	              </p>
	            </div>
	            <!-- /.d-flex -->

	            <div class="position-relative mb-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
	              <canvas id="visitors-chart" height="200" width="731" style="display: block; width: 731px; height: 200px;" class="chartjs-render-monitor"></canvas>
	            </div>

	            <div class="d-flex flex-row justify-content-end">
	              <span class="mr-2">
	                <i class="fas fa-square text-primary"></i> Qtd Serviços/mês
	              </span>
	            </div>
	          </div>
	        </div>
	    </div>
	</div>
@stop

@section('js')
<script src="vendor/adminlte/dist/js/adminlte.js"></script>
<script src="vendor/adminlte/dist/js/Chart.min.js"></script>

<script>

var historico = JSON.parse('{!! $historico !!}');
var tipos_pagamento = JSON.parse('{!! $retorno->tipos_pagamento !!}');
var tipos_receita = JSON.parse('{!! $retorno->tipos_receita !!}');
var receitas_tp_pgto_mes = JSON.parse('{!! $retorno->receitas_tp_pgto_mes !!}');
var receitas_tp_receita_mes = JSON.parse('{!! $retorno->receitas_tp_receita_mes !!}');

$(function () {
  'use strict'

  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode = 'index'
  var intersect = true

  var $salesChart = $('#sales-chart')
  // eslint-disable-next-line no-unused-vars
  var salesChart = new Chart($salesChart, {
    type: 'bar',
    data: {
      labels: historico.ult_7_meses,
      datasets: [
        {
          backgroundColor: '#28a745',
          borderColor: '#007bff',
          data: historico.receita
        },
        {
          backgroundColor: '#dc3545',
          borderColor: '#007bff',
          data: historico.custo
        }
      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          // display: false,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,

            // Include a dollar sign in the ticks
            callback: function (value) {
              if (value >= 1000) {
                value /= 1000
                value += 'k'
              }

              return '$' + value
            }
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  })

  var $visitorsChart = $('#visitors-chart')
  // eslint-disable-next-line no-unused-vars
  var visitorsChart = new Chart($visitorsChart, {
    data: {
      labels: historico.ult_7_meses,
      datasets: [{
        type: 'line',
        data: historico.qtd_servico,
        backgroundColor: 'transparent',
        borderColor: '#007bff',
        pointBorderColor: '#007bff',
        pointBackgroundColor: '#007bff',
        fill: false
        // pointHoverBackgroundColor: '#007bff',
        // pointHoverBorderColor    : '#007bff'
      }]
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          // display: false,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,
            //suggestedMax: 200
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  })

  //-------------
  //- DONUT CHART -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
  /*var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
  var donutData        = {
    labels: tipos_receita,
    datasets: [
      {
        data: receitas_tp_receita_mes,
        backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
      }
    ]
  }
  var donutOptions     = {
    maintainAspectRatio : false,
    responsive : true,
  }
  //Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  new Chart(donutChartCanvas, {
    type: 'doughnut',
    data: donutData,
    options: donutOptions
  })*/

  //-------------
  //- DONUT CHART -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
  var donutChartCanvas = $('#donutChart2').get(0).getContext('2d')
  var donutData        = {
    labels: tipos_pagamento,
    datasets: [
      {
        data: receitas_tp_pgto_mes,
        backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
      }
    ]
  }
  var donutOptions     = {
    maintainAspectRatio : false,
    responsive : true,
  }
  //Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  new Chart(donutChartCanvas, {
    type: 'doughnut',
    data: donutData,
    options: donutOptions
  })
})
</script>
@stop