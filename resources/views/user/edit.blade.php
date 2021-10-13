@extends('adminlte::page')

@section('title', 'User')

@section('content_header')
    <h1>Formulário para alteração de senha</h1>
@stop

@section('content')
    @if(Session::has('success'))
        <p class="alert alert-info">{{ Session::get('success') }}</p>
    @endif

    <div class="box box-default">
        {!! Form::model($user, ['method' => 'PATCH','route' => ['user.update', $user->id], 'class' => 'form']) !!}
            <div class="box-body">
                @include('user.form', ['user' => $user])
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right"><i class="fa fa-save"></i> Editar</button>
            </div>
        {!! Form::close() !!}
@stop