@extends('adminlte::page')

@section('title', 'Fluxo de Caixa')

@section('content_header')
    <h1>Fluxo de Caixa</h1>
@stop

@section('content')
	<div class="table-responsive">
		<table  class="table table-striped table-hover" width="100%">
			<tr>
				<td align="center"><a href="{{route('fluxo_caixa', 'menos=1&ano_atual='.$ano_atual)}}"><< Voltar</a></td>
				<td align="center"><b>{{$ano_atual}}</b></td>
				<td align="center"><a href="{{route('fluxo_caixa', 'mais=1&ano_atual='.$ano_atual)}}">Avançar >></a></td>
			</tr>	
		</table>

	    <table class="table table-striped table-hover">
	        <tr>
	        	<th>#</th>
	            @foreach ($estrutura as $mes)
					<th>{!! $mes->mes !!}</th>
				@endforeach
	        </tr>

			<tr style="background-color: #00a65a !important;">
				<td><b>Receitas</b></td>
		        @foreach ($estrutura as $mes)
					<td>{!! $mes->pagamentos !!}</td>
				@endforeach
			</tr>

			<tr><td colspan="13"></td></tr>

	        @foreach ($tipos_custo as $tipo_custo)
	            <tr style="background-color: sandybrown;">
	            	<td><b>{{$tipo_custo->name}}</b></td>
	                @foreach ($estrutura as $mes)
	                	@foreach ($mes->custos as $custo)
							@if ($tipo_custo->name == $custo->tipo)
								<td>{!! $custo->valor !!}</td>
							@endif
						@endforeach
					@endforeach
	            </tr>
	        @endforeach

	        <tr>
				<td><b>Total Custos</b></td>
		        @foreach ($estrutura as $mes)
					<td>{!! $mes->total_custos !!}</td>
				@endforeach
			</tr>

			<tr><td colspan="13"></td></tr>

			<tr>
				<td><b>Saldo</b></td>
		        @foreach ($estrutura as $mes)
					@if($mes->saldo < 0)
					<td style="color:red;">{!! $mes->saldo !!}</td>
					@else
					<td>{!! $mes->saldo !!}</td>
					@endif
				@endforeach
			</tr>

	    </table>
	</div>
@stop