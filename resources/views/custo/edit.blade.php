@extends('adminlte::page')

@section('title', 'Custos')

@section('content_header')
    <h1>Formulário de edição de Custos</h1>
@stop

@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Formulário</h3>
        </div>
        {!! Form::model($custo, ['method' => 'PATCH','route' => ['custo.update', $custo->id], 'class' => 'form']) !!}
            <div class="box-body">
                @include('custo.form', ['custo' => $custo])
            </div>
            <div class="box-footer">
                <a href="{{ route('custo.index') }}" class="btn btn-default">Cancelar</a>
                    <button type="submit" class="btn btn-info pull-right"><i class="fa fa-save"></i> Editar</button>
            </div>
        {!! Form::close() !!}
@stop
