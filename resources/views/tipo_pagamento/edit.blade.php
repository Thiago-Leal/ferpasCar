@extends('adminlte::page')

@section('title', 'Tipo de Pagamento')

@section('content_header')
    <h1>Formulário de edição de tipo de Pagamentos</h1>
@stop

@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Formulário</h3>
        </div>
        {!! Form::model($tipo_pagamento, ['method' => 'PATCH','route' => ['tipo_pagamento.update', $tipo_pagamento->id], 'class' => 'form']) !!}
            <div class="box-body">
                @include('tipo_pagamento.form', ['tipo_pagamento' => $tipo_pagamento])
            </div>
            <div class="box-footer">
                <a href="{{ route('tipo_pagamento.index') }}" class="btn btn-default">Cancelar</a>
                    <button type="submit" class="btn btn-info pull-right"><i class="fa fa-save"></i> Editar</button>
            </div>
        {!! Form::close() !!}
@stop
