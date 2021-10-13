@extends('adminlte::page')

@section('title', 'Tipo de Custo')

@section('content_header')
    <h1>Formulário de edição de tipo de custos</h1>
@stop

@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Formulário</h3>
        </div>
        {!! Form::model($tipo_custo, ['method' => 'PATCH','route' => ['tipo_custo.update', $tipo_custo->id], 'class' => 'form']) !!}
            <div class="box-body">
                @include('tipo_custo.form', ['tipo_custo' => $tipo_custo])
            </div>
            <div class="box-footer">
                <a href="{{ route('tipo_custo.index') }}" class="btn btn-default">Cancelar</a>
                    <button type="submit" class="btn btn-info pull-right"><i class="fa fa-save"></i> Editar</button>
            </div>
        {!! Form::close() !!}
@stop
