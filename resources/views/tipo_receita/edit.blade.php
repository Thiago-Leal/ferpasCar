@extends('adminlte::page')

@section('title', 'Tipo de Receita')

@section('content_header')
    <h1>Formulário de edição de tipo de receitas</h1>
@stop

@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Formulário</h3>
        </div>
        {!! Form::model($tipo_receita, ['method' => 'PATCH','route' => ['tipo_receita.update', $tipo_receita->id], 'class' => 'form']) !!}
            <div class="box-body">
                @include('tipo_receita.form', ['tipo_receita' => $tipo_receita])
            </div>
            <div class="box-footer">
                <a href="{{ route('tipo_receita.index') }}" class="btn btn-default">Cancelar</a>
                    <button type="submit" class="btn btn-info pull-right"><i class="fa fa-save"></i> Editar</button>
            </div>
        {!! Form::close() !!}
@stop
