@extends('adminlte::page')

@section('title', 'Custos')

@section('content_header')
    <h1>Formulário de cadastro de Custo</h1>
@stop

@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Formulário</h3>
        </div>
        {!! Form::open(array('route' => 'custo.store','method'=>'POST')) !!}
        <div class="box-body">
            @include('custo.form')
        </div>
        <div class="box-footer">
            <a href="{{ route('custo.index') }}" class="btn btn-default">Cancelar</a>
            <button type="submit" class="btn btn-info pull-right"><i class="fa fa-save"></i> Adicionar</button>
        </div>
        {!! Form::close() !!}
@stop
