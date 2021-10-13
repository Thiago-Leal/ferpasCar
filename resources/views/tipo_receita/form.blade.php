<div class="row">
    <div class="col-md-4">
        <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
            {!! Form::label('name', 'Nome') !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group {!! $errors->has('valor') ? 'has-error' : '' !!}">
            {!! Form::label('valor', 'Valor') !!}
            {!! Form::text('valor', number_format(@$tipo_receita->valor, 2, ',', '.'), ['class'=>'form-control']) !!}
            {!! $errors->first('valor', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>