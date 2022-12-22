@extends('adminlte::page')

@section('title', 'Custos')

@section('content_header')
    <h1>Custos - <b>{{ Session::get('EMPRESA_DESCRICAO')}}</b></h1>
@stop

@section('content')
    <div class="box box-default">
            <div class="box-tools pull-right" style="text-align: right;">
                <a href="{{ route('custo.create') }}" class="btn pull-right"><i class="fa fa-plus"></i> Adicionar</a>
            </div>
        <div class="box-header with-border">
            <h3 class="box-title">Pesquisa</h3>
        </div>
        {!! Form::open(['route' => 'custo.index', 'method'=>'get', 'class'=>'form']) !!}
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="inputNome">Nome</label>
                        {!! Form::text('q[name]', isset($q['name']) ? $q['name'] : null, ['class'=>'form-control', 'placeholder' => 'Nome do custo']) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="inputNome">Tipo de Custo</label>
                        {!! Form::select('q[tipo_custo_id]', [''=>'']+App\Models\TipoCusto::pluck('name','id')->all(), !empty($q['tipo_custo_id'])?$q['tipo_custo_id']:null, ['class'=>'form-control ']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="checkbox icheck" style="margin-top:0">
                    <input type="checkbox" name="q[deleted]" value="1" {{isset($q['deleted']) ? "checked" : "" }} class="auto-check regular-checkbox" id="ck-deleted" /><label for="ck-deleted"></label><span style="margin-left:1em; vertical-align: text-top;">Listar Deletados</span>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-info btn-block"><i class="fa fa-search"></i> Pesquisar</button>
        </div>
        {!! Form::close() !!}
    </div>
    <hr>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Resultado da pesquisa</h3>
        </div>
        <div class="box-body ">
            @include('custo.list')
            {!! $custos->appends(['q' => $q])->links() !!}
        </div>
    </div>
@stop
