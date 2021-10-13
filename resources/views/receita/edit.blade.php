@extends('adminlte::page')

@section('title', 'Receitas')

@section('content_header')
    <h1>Formulário de edição de Receitas</h1>
@stop

@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Formulário</h3>
        </div>
        {!! Form::model($receita, ['method' => 'PATCH','route' => ['receita.update', $receita->id], 'class' => 'form']) !!}
            <div class="box-body">
                @include('receita.form', ['receita' => $receita])
            </div>
            <div class="box-footer">
                <a href="{{ route('receita.index') }}" class="btn btn-default">Cancelar</a>
                    <button type="submit" class="btn btn-info pull-right"><i class="fa fa-save"></i> Editar</button>
            </div>
        {!! Form::close() !!}
@stop

@php
    foreach(App\Models\TipoReceita::all() as $tipo_receita) {
        $tipo_receitas[$tipo_receita->id] = number_format($tipo_receita->valor, 2, ',', '.');
    }
@endphp

@section('js')
    <script>
        var tipo_receitas = JSON.parse('{!! json_encode($tipo_receitas) !!}');

        function changeValue(tipo_receita_id){
            document.getElementById('valor').value = tipo_receitas[tipo_receita_id];
        }
    </script>
@stop